<?php

namespace App\Ai;

use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Integration;
use App\Support\GenerationMessages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

            if ($this->failNeverStarted($generation)
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

    /** Phase 2: outside every transaction, still inside the cache lock. */
    private function settle(Generation $generation): void
    {
        if ($this->endedThisCall) {
            // The teardown runs after every terminal transition. With no
            // session id, or no key, it skips the session steps and still
            // deletes file_ids, so an upload never outlives its run.
            $this->teardown->run($generation);
        }
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
            // the marker and nothing else. Task 3 adds the
            // agent.custom_tool_use arm.
            $stop = match ($event->type) {
                'agent.message' => $this->note($generation, $event),
                'session.status_idle' => $this->idle($generation, $event),
                'session.error' => $this->terminate($generation, GenerationStatus::Failed, $event->errorMessage),
                'session.status_terminated' => $this->terminate($generation, GenerationStatus::Failed, GenerationMessages::SESSION_ENDED),
                default => false,
            };

            // terminate() has already saved the row, marker included.
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
        // The latest note wins; earlier ones are not kept. 60 000 characters is
        // the column's own cap (spec data model).
        $generation->agent_note = mb_strcut((string) $event->text, 0, 60000);

        return false;
    }

    private function idle(Generation $generation, SessionEvent $event): bool
    {
        $reason = (string) $event->stopReasonType;

        // requires_action accompanies the custom_tool_use we handle separately:
        // the session is waiting for us, not finished.
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
