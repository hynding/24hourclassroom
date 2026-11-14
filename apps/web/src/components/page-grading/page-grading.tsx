import { Component, h, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import type { Attempt, GradingQueueItem } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { GradedAnswers } from '../../services/attempt-grading';

/**
 * Everything waiting for a hand grade, oldest submission first: a teacher's
 * own assignments, and for a teacher assistant every connected teacher's
 * (GET /api/grading). Grading here is the same call the results page makes.
 */
@Component({ tag: 'page-grading', styleUrl: 'page-grading.css', shadow: true })
export class PageGrading {
  @State() rows: GradingQueueItem[] = [];
  @State() loaded = false;
  @State() page = 1;
  @State() lastPage = 1;
  @State() opened: Record<number, Attempt> = {};
  @State() busy = false;
  @State() error = '';

  async componentWillLoad() {
    await this.load();
  }

  private async load() {
    try {
      const result = await testsStore.gradingQueue(this.page > 1 ? this.page : undefined);
      this.rows = result.data;
      this.lastPage = result.meta.last_page;
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load the grading queue.';
      }
    } finally {
      this.loaded = true;
    }
  }

  private async changePage(delta: -1 | 1) {
    const next = this.page + delta;
    if (next < 1 || next > this.lastPage) {
      return;
    }
    this.page = next;
    this.error = '';
    await this.load();
  }

  async open(attemptId: number) {
    if (this.opened[attemptId]) {
      this.opened = Object.fromEntries(Object.entries(this.opened).filter(([k]) => Number(k) !== attemptId));
      return;
    }
    try {
      const attempt = await testsStore.getAttempt(attemptId);
      this.opened = { ...this.opened, [attemptId]: attempt };
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load that attempt.';
      }
    }
  }

  async grade(attemptId: number, answerId: number, awarded: number) {
    this.busy = true;
    this.error = '';
    try {
      const attempt = await testsStore.gradeAnswer(attemptId, answerId, awarded);
      this.opened = { ...this.opened, [attemptId]: attempt };
      // The row keeps its place until the page is reloaded, so a grader can
      // check their work; its count updates from the fresh attempt.
      this.rows = this.rows.map((r) => (r.id === attemptId ? { ...r, score: attempt.score, max_score: attempt.max_score, ungraded_count: attempt.ungraded_count } : r));
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = e instanceof ApiError ? e.message : 'We could not save that grade.';
      }
    } finally {
      this.busy = false;
    }
  }

  render() {
    if (!this.loaded) {
      return <section><p>Loading…</p></section>;
    }
    return (
      <section>
        <h1>To grade</h1>
        <p class="meta">Submitted answers that need a hand grade, oldest first.</p>
        {this.error && <p class="error">{this.error}</p>}
        {this.rows.length === 0 && !this.error && <p>Nothing is waiting for a grade.</p>}
        <ul class="queue">
          {this.rows.map((row) => (
            <li key={row.id}>
              <div class="row">
                <strong>{row.student.name}</strong>
                <span>{row.test.title}</span>
                <span class="meta">
                  for {row.teacher.name}
                  {row.submitted_at ? ` · submitted ${new Date(row.submitted_at).toLocaleString()}` : ''}
                  {' · '}
                  {row.ungraded_count ? `${row.ungraded_count} to grade` : 'all graded'}
                </span>
                <button type="button" class="btn" aria-expanded={this.opened[row.id] ? 'true' : 'false'} onClick={() => this.open(row.id)}>
                  {this.opened[row.id] ? 'Close' : 'Grade'}
                </button>
              </div>
              {this.opened[row.id] && <GradedAnswers attempt={this.opened[row.id]} busy={this.busy} onGrade={(a, b, c) => this.grade(a, b, c)} />}
            </li>
          ))}
        </ul>
        {this.lastPage > 1 && (
          <nav aria-label="Grading pages">
            <button type="button" class="btn" disabled={this.page <= 1} onClick={() => this.changePage(-1)}>Previous</button>
            <span>Page {this.page} of {this.lastPage}</span>
            <button type="button" class="btn" disabled={this.page >= this.lastPage} onClick={() => this.changePage(1)}>Next</button>
          </nav>
        )}
      </section>
    );
  }
}
