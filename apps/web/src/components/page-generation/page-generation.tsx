import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import {
  GENERATION_POLL_MS,
  GENERATION_STATUSES,
  GRADE_LEVELS,
  Generation,
  SUBJECTS,
} from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { generationStore } from '../../services/generation-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { formatCents } from '../../services/format';

/** The 429 back-off ceiling: 5 s doubles to 10, 20, then stays at 30. */
const MAX_INTERVAL_MS = 30000;

/**
 * The four statuses a run never leaves. Mirrors GenerationStatus::isTerminal()
 * -- the server decides, this list only decides when to stop asking.
 */
const TERMINAL: string[] = ['done', 'failed', 'cancelled', 'budget_reached'];

@Component({ tag: 'page-generation', styleUrl: 'page-generation.css', shadow: true })
export class PageGeneration {
  @Prop() generationId?: number;

  @State() generation: Generation | null = null;
  @State() notFound = false;
  @State() loadError = false;
  @State() actionError = '';
  @State() busy = false;
  @State() intervalMs = GENERATION_POLL_MS;

  /**
   * The re-armed poll handle. A plain public field, not @State: it drives no
   * rendering, and specs read it to prove the loop stopped (fake timers
   * cannot be enabled before mount, so tick() is called directly instead).
   */
  timer: ReturnType<typeof setTimeout> | null = null;

  /**
   * Set once the element leaves the DOM. A tick() that was awaiting the fetch
   * when the teacher navigated away resolves AFTER disconnectedCallback ran,
   * and without this flag it would re-arm the loop on a detached element and
   * poll forever.
   */
  private detached = false;

  /** Allowlist: anything that is not exactly teacher gets the empty state. */
  private get role(): 'teacher' | 'none' {
    return authStore.currentUser?.role === 'teacher' ? 'teacher' : 'none';
  }

  async componentWillLoad() {
    await authStore.load();
    if (this.role !== 'teacher') {
      return;
    }
    await this.tick();
  }

  disconnectedCallback() {
    this.detached = true;
    this.stop();
  }

  private stop() {
    if (this.timer !== null) {
      clearTimeout(this.timer);
      this.timer = null;
    }
  }

  /**
   * One poll, then re-arm. Each GET also advances the run server-side, which
   * is why a closed tab pauses it. Public so the specs can step the loop by
   * hand instead of with fake timers.
   */
  async tick(): Promise<void> {
    if (!this.generationId) {
      this.notFound = true;
      return;
    }
    this.stop();
    // Default for the paths that leave the payload untouched (a 429, or a
    // transient failure on a row already on screen): keep polling.
    let live = this.generation === null || !TERMINAL.includes(this.generation.status);
    try {
      this.generation = await generationStore.getGeneration(this.generationId);
      this.loadError = false;
      this.intervalMs = GENERATION_POLL_MS;
      live = !TERMINAL.includes(this.generation.status);
    } catch (e) {
      if (e instanceof ApiError && e.status === 429) {
        // The SPA's poll shares one 60/min bucket with the rest of its
        // traffic, so a 429 is the app's own doing: back off, keep the row.
        this.intervalMs = Math.min(this.intervalMs * 2, MAX_INTERVAL_MS);
      } else if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
        return;
      } else if (recoverFromExpiredSession(e)) {
        return;
      } else if (this.generation === null) {
        this.loadError = true;
        return;
      }
    }
    if (live && !this.detached) {
      this.timer = setTimeout(() => this.tick(), this.intervalMs);
    }
  }

  cancel() {
    // Ask BEFORE the request, and through `window.confirm` rather than the
    // bare global -- newSpecPage resets the mock window, so a spec can only
    // stub the property after mount.
    if (!window.confirm('Cancel this generation?')) {
      return undefined;
    }
    return this.runCancel(true);
  }

  private async runCancel(retry: boolean) {
    this.actionError = '';
    this.busy = true;
    try {
      this.generation = await generationStore.cancelGeneration(this.generation.id);
      this.stop();
    } catch (e) {
      if (e instanceof ApiError && e.status === 409 && retry) {
        // The advancer held the row's lock for this poll. One retry is the
        // whole contract; a second 409 is reported rather than looped on.
        await this.runCancel(false);
        return;
      }
      if (!recoverFromExpiredSession(e)) {
        this.actionError = e instanceof ApiError ? e.message : 'We could not cancel that generation.';
      }
    } finally {
      this.busy = false;
    }
  }

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  render() {
    if (this.role !== 'teacher') {
      return (
        <section>
          <h1>Generation</h1>
          <p>Only teachers can generate tests.</p>
        </section>
      );
    }
    if (this.notFound) {
      return (
        <section>
          <h1>Generation not found</h1>
          <p>This generation does not exist or is not available to you.</p>
        </section>
      );
    }
    if (this.loadError) {
      return (
        <section>
          <h1>Generation</h1>
          <p>We could not load this generation. Please try again.</p>
        </section>
      );
    }
    if (this.generation === null) {
      return <section><p>Loading…</p></section>;
    }
    const g = this.generation;
    const live = !TERMINAL.includes(g.status);
    return (
      <section>
        <h1>{g.title}</h1>
        <p class="meta">
          <span class="pill">{this.label(GENERATION_STATUSES, g.status)}</span>
          <span>
            {this.label(SUBJECTS, g.subject)} · {this.label(GRADE_LEVELS, g.grade_level)} · {g.question_count} questions
          </span>
        </p>
        {g.agent_note && <p class="note">{g.agent_note}</p>}
        {g.list_cost_cents !== null && <p class="meta">{formatCents(g.list_cost_cents)} at list price</p>}
        {g.error && <p class="error">{g.error}</p>}
        {this.actionError && <p class="error">{this.actionError}</p>}
        <div class="actions">
          {live && (
            <button type="button" class="btn" disabled={this.busy} onClick={() => this.cancel()}>Cancel</button>
          )}
          {g.test_id !== null && this.link(`/tests/${g.test_id}/edit`, 'Open the draft')}
          {(g.status === 'failed' || g.status === 'budget_reached') && this.link(`/tests/generate?from=${g.id}`, 'Try again')}
        </div>
        {this.link('/tests', 'Back to my tests')}
      </section>
    );
  }
}
