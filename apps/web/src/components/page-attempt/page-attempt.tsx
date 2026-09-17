import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { Attempt, AttemptQuestion } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

const AUTOSAVE_MS = 2000;

@Component({ tag: 'page-attempt', styleUrl: 'page-attempt.css', shadow: true })
export class PageAttempt {
  @Prop() attemptId?: number;

  @State() attempt: Attempt | null = null;
  @State() responses: Record<number, unknown> = {};
  @State() notFound = false;
  @State() error = '';
  @State() busy = false;
  @State() saving = false;

  private timer: ReturnType<typeof setTimeout> | null = null;
  private dirty = false;

  async componentWillLoad() {
    await this.load();
  }

  disconnectedCallback() {
    if (this.timer) {
      clearTimeout(this.timer);
    }
  }

  private async load() {
    if (!this.attemptId) {
      this.notFound = true;
      return;
    }
    try {
      this.attempt = await testsStore.getAttempt(this.attemptId);
      this.responses = Object.fromEntries(
        this.attempt.questions.filter((q) => q.response !== null && q.response !== undefined).map((q) => [q.id, q.response]),
      );
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load this attempt.';
      }
    }
  }

  setResponse(questionId: number, value: unknown) {
    this.responses = { ...this.responses, [questionId]: value };
    this.dirty = true;
    if (this.timer) {
      clearTimeout(this.timer);
    }
    // Shares the caller's single 60/min throttle bucket with everything
    // else, so never save more often than once per pause in typing.
    this.timer = setTimeout(() => this.flush(), AUTOSAVE_MS);
  }

  private async flush(): Promise<void> {
    if (this.timer) {
      clearTimeout(this.timer);
      this.timer = null;
    }
    if (!this.dirty || !this.attempt) {
      return;
    }
    this.saving = true;
    try {
      await testsStore.saveAttempt(this.attempt.id, this.responses);
      this.dirty = false;
    } catch (e) {
      // A 429 (or any transient failure) is retried on the next change; the
      // student is never told their autosave failed mid-question. A 409
      // means the attempt was submitted elsewhere -- reload to show it.
      if (e instanceof ApiError && e.status === 409) {
        await this.load();
      } else {
        recoverFromExpiredSession(e);
      }
    } finally {
      this.saving = false;
    }
  }

  async submit() {
    // Bare `confirm` is unusable here: Stencil's spec testing wipes any
    // override set before mount() (newSpecPage resets the mock window), and
    // once bound the bare global never re-reads a later reassignment anyway
    // -- go through `window.confirm` so a test-time override is honoured.
    if (!this.attempt || !window.confirm('Submit this attempt? You can start another one afterwards.')) {
      return;
    }
    this.busy = true;
    this.error = '';
    try {
      await this.flush();
      this.attempt = await testsStore.submitAttempt(this.attempt.id);
    } catch (e) {
      if (e instanceof ApiError && e.status === 409) {
        await this.load();
      } else if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not submit this attempt. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  private toggleMulti(q: AttemptQuestion, i: number, on: boolean) {
    const current = Array.isArray(this.responses[q.id]) ? (this.responses[q.id] as number[]) : [];
    const next = on ? [...current, i].sort((a, b) => a - b) : current.filter((x) => x !== i);
    this.setResponse(q.id, Array.from(new Set(next)));
  }

  private renderInput(q: AttemptQuestion) {
    const value = this.responses[q.id];
    switch (q.type) {
      case 'multiple_choice':
        return (
          <ol class="options">
            {q.options.map((opt, i) => (
              <li><label><input type="radio" name={`q-${q.id}`} checked={value === i} onChange={() => this.setResponse(q.id, i)} /> {opt}</label></li>
            ))}
          </ol>
        );
      case 'multi_select':
        return (
          <ol class="options">
            {q.options.map((opt, i) => (
              <li><label><input type="checkbox" checked={Array.isArray(value) && value.includes(i)} onChange={(e) => this.toggleMulti(q, i, (e.target as HTMLInputElement).checked)} /> {opt}</label></li>
            ))}
          </ol>
        );
      case 'true_false':
        return (
          <div class="choices">
            <label><input type="radio" name={`q-${q.id}`} checked={value === true} onChange={() => this.setResponse(q.id, true)} /> True</label>
            <label><input type="radio" name={`q-${q.id}`} checked={value === false} onChange={() => this.setResponse(q.id, false)} /> False</label>
          </div>
        );
      case 'short_answer':
        return <input type="text" value={(value as string) ?? ''} onInput={(e) => this.setResponse(q.id, (e.target as HTMLInputElement).value)} />;
      case 'numeric':
        return <input type="number" step="any" value={value === undefined || value === null ? '' : String(value)} onInput={(e) => {
          const raw = (e.target as HTMLInputElement).value;
          this.setResponse(q.id, raw === '' ? null : Number(raw));
        }} />;
    }
  }

  private format(q: AttemptQuestion, value: unknown): string {
    if (value === null || value === undefined) {
      return '(skipped)';
    }
    if (q.options && typeof value === 'number') {
      return q.options[value] ?? String(value);
    }
    if (q.options && Array.isArray(value)) {
      return value.map((i: number) => q.options[i] ?? i).join(', ');
    }
    if (q.type === 'numeric' && value && typeof value === 'object') {
      const a = value as { value: number; tolerance?: number };
      return a.tolerance ? `${a.value} ± ${a.tolerance}` : String(a.value);
    }
    return String(value);
  }

  private renderReview(q: AttemptQuestion, index: number) {
    const answer = q.graded_answer?.answer ?? q.answer;
    const points = q.graded_answer?.points ?? q.points;
    const status = q.awarded === null || q.awarded === undefined ? 'pending' : Number(q.awarded) >= points ? 'right' : Number(q.awarded) > 0 ? 'partial' : 'wrong';
    return (
      <li class={status}>
        <p class="prompt">{index + 1}. {q.prompt}</p>
        <p>Your answer: <strong>{this.format(q, q.response)}</strong></p>
        <p>Correct answer: {this.format(q, answer)}</p>
        <p class="meta">{q.awarded === null || q.awarded === undefined ? 'Awaiting grading' : `${q.awarded} / ${points}`}</p>
        {q.explanation && <p class="explanation">{q.explanation}</p>}
      </li>
    );
  }

  render() {
    if (this.notFound) {
      return <section><h1>Attempt not found</h1></section>;
    }
    if (!this.attempt) {
      return <section><p>{this.error || 'Loading…'}</p></section>;
    }
    const a = this.attempt;
    if (a.submitted_at) {
      return (
        <section>
          <h1>{a.test.title}</h1>
          <p class="score">
            {a.score} / {a.max_score}
            {a.ungraded_count > 0 && ` · ${a.ungraded_count} answer${a.ungraded_count === 1 ? '' : 's'} awaiting grading`}
          </p>
          <ol class="review">{a.questions.map((q, i) => this.renderReview(q, i))}</ol>
          <a href={`/tests/${a.test.id}`} onClick={(e) => { e.preventDefault(); navigate(`/tests/${a.test.id}`); }}>Back to test</a>
        </section>
      );
    }
    return (
      <section>
        <h1>{a.test.title}</h1>
        <p class="meta">{this.saving ? 'Saving…' : 'Your answers save automatically.'}</p>
        {this.error && <p class="error">{this.error}</p>}
        <ol class="questions">
          {a.questions.map((q, i) => (
            <li>
              <p class="prompt">{i + 1}. {q.prompt} <span class="meta">({q.points} pt{q.points === 1 ? '' : 's'})</span></p>
              {this.renderInput(q)}
            </li>
          ))}
        </ol>
        <button type="button" class="btn-primary" disabled={this.busy} onClick={() => this.submit()}>Submit</button>
      </section>
    );
  }
}
