<?php

namespace App\Ai;

use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Integration;
use App\Support\FrontendRedirect;
use App\Support\GenerationMessages;
use App\Support\TestDraftValidator;
use App\Support\TestDraftWriter;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

final class GenerationAdvancer
{
    /**
     * True when THIS call moved the row to a terminal status. Phase 2 reads it
     * to decide whether the teardown still has to run. It is reset at the top
     * of every advance() so a reused instance cannot leak the flag.
     */
    private bool $endedThisCall = false;

    public function __construct(
        private readonly AnthropicGateway $gateway,
        private readonly SessionTeardown $teardown,
    ) {}

    public function advance(Generation $generation): void
    {
        // Non-blocking (spec decision 13): a poll that arrives while another
        // poll is mid-advance serves the current payload instead of queueing
        // behind a 60 s HTTP call. The 180 s lifetime exceeds the worst-case
        // advance -- a multi-page listEvents plus one send, each bounded by the
        // gateway's 60 s request timeout.
        $lock = Cache::lock($generation->lockKey(), 180);

        if (! $lock->get()) {
            return;
        }

        $this->endedThisCall = false;

        try {
            $this->decide($generation);
            $this->settle($generation);
        } finally {
            $lock->release();
        }
    }

    /** Phase 1: decide and commit. No event is ever SENT from here. */
    private function decide(Generation $generation): void
    {
        $key = Integration::forUser($generation->user)->apiKey();

        // Step 0 and step 1 need no network, so they commit on their own.
        $readEvents = DB::transaction(function () use ($generation, $key): bool {
            $this->lockRow($generation);

            if ($generation->isTerminal()) {
                return false;
            }

            if ($this->recoverOrphanedAwait($generation)
                || $this->failNeverStarted($generation)
                || $this->cancelTimedOut($generation)
                || $this->cancelKeyRemoved($generation, $key)) {
                return false;
            }

            // Step 1: a committed-but-unsent result is owed, so phase 2 sends
            // it before we read one more event.
            return $generation->pending_tool_event_id === null;
        });

        if (! $readEvents || $key === null || $generation->session_id === null) {
            return;
        }

        // listEvents runs BEFORE the event-walk transaction opens, never inside
        // it. Two reasons: the call is bounded by the gateway's 60 s request
        // timeout and a transaction held open that long pins InnoDB's undo log
        // and blocks the sweep on this row; and it makes the failure modes
        // trivial -- an unreachable Anthropic leaves the row untouched because
        // no write has happened yet, which is exactly what the spec asks for.
        try {
            $events = $this->gateway->listEvents($key, $generation->session_id);
        } catch (AnthropicUnavailable) {
            return;
        } catch (AnthropicRejected $e) {
            $this->terminate(
                $generation,
                GenerationStatus::Failed,
                GenerationMessages::SESSION_REJECTED.': '.$e->getMessage(),
            );

            return;
        }

        DB::transaction(function () use ($generation, $events): void {
            $this->walk($generation, $events);
        });
    }

    /**
     * Phase 2: the send, after phase 1 has committed and outside every
     * transaction, still inside the cache lock. Whether Anthropic accepts a
     * duplicate user.custom_tool_result is undocumented, so the lock plus the
     * stored event id -- not the platform -- is what makes this at-most-once.
     *
     * A saved draft ends the run immediately (spec ruling 6). The terminal
     * write comes BEFORE the teardown, the same order GenerationController's
     * own failure path uses: a teardown interrupted halfway -- the process
     * dies mid-archive -- then leaves a terminal row whose leftovers
     * (archived_at still null, file ids still listed) the sweep's second pass
     * retries. Torn down first and interrupted before markTerminal, the row
     * would stay live and be swept as an abandoned RUN instead.
     */
    private function settle(Generation $generation): void
    {
        if ($this->endedThisCall) {
            // The teardown runs after every terminal transition. With no
            // session id, or no key, it skips the session steps and still
            // deletes file_ids, so an upload never outlives its run.
            $this->teardown->run($generation);

            return;
        }

        $eventId = $generation->pending_tool_event_id;

        if ($generation->isTerminal() || $eventId === null || $generation->session_id === null) {
            return;
        }

        // Step 0 cancels a keyless row, so this is belt and braces.
        $key = Integration::forUser($generation->user)->apiKey();

        if ($key === null) {
            return;
        }

        // A pending id with no stored result is a half-written decision --
        // the columns are saved together, so only a torn write produces it.
        // Fail closed: an empty, successful result would finish the run `done`
        // with no draft behind it, which is the one outcome the teacher can
        // neither use nor understand.
        $result = $generation->pending_tool_result ?? [
            'content' => [['type' => 'text', 'text' => 'The draft could not be read back.']],
            'is_error' => true,
        ];
        $isError = (bool) ($result['is_error'] ?? false);

        try {
            $this->gateway->sendCustomToolResult(
                $key,
                $generation->session_id,
                $eventId,
                $result['content'] ?? [],
                $isError,
            );
        } catch (AnthropicUnavailable) {
            // The pending columns stay exactly as they are and the next poll
            // retries with the same event id.
            return;
        } catch (AnthropicRejected) {
            // Treated as sent: the likeliest cause is a previous send that
            // Anthropic accepted before this process died. Retrying forever
            // would strand the run.
        }

        DB::transaction(function () use ($generation, $eventId): void {
            $generation->pending_tool_event_id = null;
            $generation->pending_tool_result = null;
            $generation->last_event_id = $eventId;
            $generation->save();
        });

        if (! $isError) {
            // The session has nothing left to do and every minute of it is
            // billed, so it is torn down -- but only once the row can no
            // longer be mistaken for a live run.
            $generation->markTerminal(GenerationStatus::Done);
            $this->teardown->run($generation);

            return;
        }

        if ($generation->tool_failures >= (int) config('generation.max_tool_failures')) {
            $generation->markTerminal(GenerationStatus::Failed, GenerationMessages::rejected());
            $this->teardown->run($generation);

            return;
        }

        // The agent has been told what was wrong and gets another turn.
        $generation->status = GenerationStatus::Running;
        $generation->save();
    }

    /**
     * Steps 2 and 3: every event after the marker, in order, until one of them
     * says stop.
     *
     * @param  list<SessionEvent>  $events
     */
    private function walk(Generation $generation, array $events): void
    {
        $this->lockRow($generation);

        if ($generation->isTerminal() || $generation->pending_tool_event_id !== null) {
            return;
        }

        foreach ($this->unprocessed($generation, $events) as $event) {
            // The marker only ever advances to a real, persisted id: an echoed
            // user.interrupt arrives with an empty id, and storing that would
            // reset the marker and replay the whole session next poll.
            if ($event->id !== '') {
                $generation->last_event_id = $event->id;
            }

            // Anything not named here -- session.status_running, session.usage,
            // span.*, agent.tool_use, agent.tool_result, echoed user.* -- moves
            // the marker and nothing else.
            $stop = match ($event->type) {
                'agent.message' => $this->note($generation, $event),
                'agent.custom_tool_use' => $this->toolCall($generation, $event),
                'session.status_idle' => $this->idle($generation, $event),
                'session.error' => $this->terminate($generation, GenerationStatus::Failed, $event->errorMessage),
                'session.status_terminated' => $this->terminate($generation, GenerationStatus::Failed, GenerationMessages::SESSION_ENDED),
                default => false,
            };

            // terminate() and pend() have both already saved the row, marker
            // included.
            if ($stop) {
                return;
            }
        }

        $generation->save();
    }

    /**
     * Everything after `last_event_id`. The marker is our own "processed up to
     * here" note, not a server cursor: listEvents returns the whole session
     * every time, so the head is re-skipped on every poll. A marker that is not
     * in the list means something we do not understand happened -- return
     * nothing rather than replay, because a replayed save_test_draft would
     * create a second test.
     *
     * @param  list<SessionEvent>  $events
     * @return list<SessionEvent>
     */
    private function unprocessed(Generation $generation, array $events): array
    {
        $marker = $generation->last_event_id;

        if ($marker === null || $marker === '') {
            return $events;
        }

        foreach ($events as $i => $event) {
            if ($event->id === $marker) {
                return array_values(array_slice($events, $i + 1));
            }
        }

        return [];
    }

    private function note(Generation $generation, SessionEvent $event): bool
    {
        // The latest note wins; earlier ones are not kept. mb_strcut, not
        // substr: the cut is 60 000 bytes (the TEXT column's budget) and has to
        // land on a character boundary.
        $text = mb_strcut((string) $event->text, 0, 60000);

        // A message whose content is empty -- tool-only turns produce them --
        // would otherwise blank a real note and leave the SPA showing nothing
        // while the run is still working.
        if (trim($text) === '') {
            return false;
        }

        $generation->agent_note = $text;

        return false;
    }

    /**
     * The only path that writes a test. Either outcome stops the walk: the
     * session is idle waiting for our result, so the events after the call
     * belong to a turn that has not resumed.
     */
    private function toolCall(Generation $generation, SessionEvent $event): bool
    {
        if ($event->toolName !== 'save_test_draft') {
            // The agent's built-in tools (read, web_search) are Anthropic's to
            // answer; we only ever owe a result for our own custom tool.
            return false;
        }

        if ($event->id === '') {
            // A result is addressed to the tool_use event's id, so a call
            // without one can never be answered. Leaving it unanswered would
            // park the session -- billing the teacher -- until the wall-clock
            // cap, so the run ends here instead.
            return $this->terminate(
                $generation,
                GenerationStatus::Failed,
                GenerationMessages::PLATFORM_STOPPED.': tool call without an id',
            );
        }

        if ($generation->test_id !== null) {
            // Defensive: an accepted draft ends the run `done` in phase 2, so a
            // live row that already has a test_id should be unreachable. One
            // run may never mint two tests, so the agent is told no instead.
            $this->pend($generation, $event->id, 'A draft was already saved for this run.', isError: true);

            return true;
        }

        try {
            $validated = TestDraftValidator::validate($event->toolInput ?? []);

            // Private, owned by the teacher, written through C1's validated
            // path -- nothing generated can be malformed.
            $test = TestDraftWriter::create($generation->user, $validated);
        } catch (ValidationException $e) {
            // A bad draft is a tool error the agent can correct; phase 2 counts
            // the strikes. The sentences are truncated on the column's own byte
            // budget, exactly like the note and the error.
            return $this->strike(
                $generation,
                $event->id,
                mb_strcut(implode(' ', Arr::flatten($e->errors())), 0, 60000),
            );
        } catch (Throwable $e) {
            // The write itself failed -- a deadlock, a column the draft
            // overflows, anything. It is still OUR failure, not a run-ending
            // one: the agent is told the same way it is told about an invalid
            // draft and gets its remaining turns, and the strike count is what
            // stops a permanently broken write looping until the cap.
            Log::warning('Could not save a generated draft', [
                'generation_id' => $generation->id,
                'error' => $e->getMessage(),
            ]);

            return $this->strike($generation, $event->id, 'The draft could not be saved.');
        }

        $generation->test_id = $test->id;

        $this->pend($generation, $event->id, json_encode([
            'ok' => true,
            'test_id' => $test->id,
            'url' => FrontendRedirect::spaOrigin()."/tests/{$test->id}/edit",
        ], JSON_THROW_ON_ERROR), isError: false);

        return true;
    }

    /** A rejected draft: one strike, and the reason goes back to the agent. */
    private function strike(Generation $generation, string $eventId, string $text): bool
    {
        $generation->tool_failures = $generation->tool_failures + 1;
        $this->pend($generation, $eventId, $text, isError: true);

        return true;
    }

    /**
     * Commit the tool result we owe, without sending it. Phase 2 is the only
     * place a result goes over the wire, so a crash between the two leaves a
     * row whose next poll retries the send with the SAME event id.
     */
    private function pend(Generation $generation, string $eventId, string $text, bool $isError): void
    {
        $generation->pending_tool_event_id = $eventId;
        $generation->pending_tool_result = [
            'content' => [['type' => 'text', 'text' => $text]],
            'is_error' => $isError,
        ];
        $generation->status = GenerationStatus::AwaitingTool;
        $generation->save();
    }

    private function idle(Generation $generation, SessionEvent $event): bool
    {
        $reason = (string) $event->stopReasonType;

        // requires_action accompanies the custom_tool_use handled above: the
        // session is waiting for us, not finished.
        if ($reason === 'requires_action') {
            return false;
        }

        if ($reason === 'end_turn') {
            // test_id is only ever set by a draft we saved, so a null one here
            // means the agent stopped without calling the tool.
            return $generation->test_id === null
                ? $this->terminate($generation, GenerationStatus::Failed, GenerationMessages::NO_DRAFT)
                : false;
        }

        if ($reason === 'budget_reached') {
            return $this->terminate($generation, GenerationStatus::BudgetReached, GenerationMessages::budget());
        }

        // retries_exhausted, or a reason this code has never heard of. Naming
        // the reason is what keeps a new platform value from parking a row in
        // `running` forever.
        return $this->terminate(
            $generation,
            GenerationStatus::Failed,
            GenerationMessages::PLATFORM_STOPPED.': '.$reason,
        );
    }

    /**
     * Belt and braces (spec decision 13): the cache lock is the guard, but a
     * row lock makes a second PHP process -- the sweep, say -- wait for this
     * commit instead of interleaving its own write, and the refresh() re-reads
     * the row we just locked so every decision below is made on committed
     * state rather than on whatever the controller happened to hold.
     */
    private function lockRow(Generation $generation): void
    {
        Generation::whereKey($generation->id)->lockForUpdate()->first();
        $generation->refresh();
    }

    /**
     * `awaiting_tool` with a null pending_tool_event_id is a state no writer
     * produces on purpose: pend() sets the id and the status in one save, and
     * phase 2 clears the id and only then ends the run or returns it to
     * `running`. A process killed between those two writes leaves the status
     * stranded. With a test_id the draft is already written and its result
     * already accepted, so the run really is finished: end it `done` and let
     * phase 2 tear the session down. Without one nothing is owed -- the row
     * goes back to `running` and this very poll walks the events as usual.
     *
     * @return bool Whether the caller must stop here.
     */
    private function recoverOrphanedAwait(Generation $generation): bool
    {
        if ($generation->status !== GenerationStatus::AwaitingTool
            || $generation->pending_tool_event_id !== null) {
            return false;
        }

        if ($generation->test_id !== null) {
            return $this->terminate($generation, GenerationStatus::Done);
        }

        $generation->status = GenerationStatus::Running;
        $generation->save();

        return false;
    }

    private function failNeverStarted(Generation $generation): bool
    {
        // The create request died between the row insert and createSession.
        if ($generation->status === GenerationStatus::Queued && $generation->session_id === null) {
            return $this->terminate($generation, GenerationStatus::Failed, GenerationMessages::NEVER_STARTED);
        }

        return false;
    }

    private function cancelTimedOut(Generation $generation): bool
    {
        // coalesce(started_at, created_at): a row that never reached `running`
        // has no started_at, and list cost bills session running time either
        // way, so the cap is measured from whichever exists.
        $since = $generation->started_at ?? $generation->created_at;

        if ($since->lt(now()->subMinutes((int) config('generation.max_run_minutes')))) {
            return $this->terminate($generation, GenerationStatus::Cancelled, GenerationMessages::TIMED_OUT);
        }

        return false;
    }

    private function cancelKeyRemoved(Generation $generation, ?string $key): bool
    {
        // Only reachable when IntegrationTeardown's own cancel pass missed the
        // row; the same constant the DELETE uses, so the teacher reads one
        // explanation wherever they see it.
        if ($key === null) {
            return $this->terminate($generation, GenerationStatus::Cancelled, GenerationMessages::KEY_REMOVED);
        }

        return false;
    }

    /**
     * The one terminal write. markTerminal() sets the status, the truncated
     * error, finished_at, and clears the pending tool columns -- spec step 1: a
     * result owed to a run we are abandoning is never sent. Returns true so
     * callers can use it as "stop here".
     */
    private function terminate(Generation $generation, GenerationStatus $status, ?string $error = null): bool
    {
        $generation->markTerminal($status, $error);
        $this->endedThisCall = true;

        return true;
    }
}
