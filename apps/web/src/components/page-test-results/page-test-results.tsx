import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { AssignmentResult, Attempt, AttemptSummary, TestView } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { GradedAnswers } from '../../services/attempt-grading';

@Component({ tag: 'page-test-results', styleUrl: 'page-test-results.css', shadow: true })
export class PageTestResults {
  @Prop() testId?: number;

  @State() test: TestView | null = null;
  @State() rows: AssignmentResult[] = [];
  @State() page = 1;
  @State() lastPage = 1;
  @State() opened: Record<number, Attempt> = {};
  @State() busy = false;
  @State() notFound = false;
  @State() error = '';

  async componentWillLoad() {
    if (!this.testId) {
      this.notFound = true;
      return;
    }
    try {
      this.test = await testsStore.getTest(this.testId);
      if (!this.test.is_author) {
        navigate(`/tests/${this.test.id}`);
        return;
      }
      await this.load();
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load results.';
      }
    }
  }

  private async load() {
    const result = await testsStore.listTestAttempts(this.testId, this.page > 1 ? this.page : undefined);
    this.rows = result.data;
    this.lastPage = result.meta.last_page;
  }

  private async changePage(delta: -1 | 1) {
    const next = this.page + delta;
    if (next < 1 || next > this.lastPage) {
      return;
    }
    this.page = next;
    this.error = '';
    try {
      await this.load();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load results.';
      }
    }
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
      await this.load();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = e instanceof ApiError ? e.message : 'We could not save that grade.';
      }
    } finally {
      this.busy = false;
    }
  }

  private score(a: AttemptSummary | null, prefix: string) {
    return a && a.score !== null ? <span class="meta">{prefix} {a.score} / {a.max_score}{a.ungraded_count ? ` (${a.ungraded_count} to grade)` : ''}</span> : null;
  }

  render() {
    if (this.notFound) {
      return <section><h1>Test not found</h1></section>;
    }
    if (!this.test) {
      return <section><p>{this.error || 'Loading…'}</p></section>;
    }
    return (
      <section>
        <h1>Results for "{this.test.title}"</h1>
        {this.error && <p class="error">{this.error}</p>}
        {this.rows.length === 0 && <p>No assigned students have attempted this test yet.</p>}
        <ul class="students">
          {this.rows.map((row) => (
            <li>
              <div class="student">
                <strong>{row.student.name}</strong>
                {this.score(row.latest, 'Latest')}
                {this.score(row.best, 'Best')}
              </div>
              <ul class="attempts">
                {row.attempts.map((a) => (
                  <li>
                    <button type="button" class="btn" onClick={() => this.open(a.id)}>
                      {a.submitted_at ? new Date(a.submitted_at).toLocaleString() : 'In progress'} · {a.score ?? '—'} / {a.max_score ?? '—'}{a.ungraded_count ? ` (${a.ungraded_count} to grade)` : ''}
                    </button>
                    {this.opened[a.id] && <GradedAnswers attempt={this.opened[a.id]} busy={this.busy} onGrade={(attemptId, answerId, awarded) => this.grade(attemptId, answerId, awarded)} />}
                  </li>
                ))}
              </ul>
            </li>
          ))}
        </ul>
        {this.lastPage > 1 && (
          <nav aria-label="Result pages">
            <button type="button" class="btn" disabled={this.page <= 1} onClick={() => this.changePage(-1)}>Previous</button>
            <span>Page {this.page} of {this.lastPage}</span>
            <button type="button" class="btn" disabled={this.page >= this.lastPage} onClick={() => this.changePage(1)}>Next</button>
          </nav>
        )}
        <a href={`/tests/${this.test.id}`} onClick={(e) => { e.preventDefault(); navigate(`/tests/${this.test.id}`); }}>Back to test</a>
      </section>
    );
  }
}
