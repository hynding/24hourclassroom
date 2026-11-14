import { Component, h, Prop, State, Watch } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { hasRole, STUDENT_ANSWER_VIEWER_ROLES } from '@24hc/shared';
import type { AttemptSummary, StudentAssignments } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { testsStore } from '../../services/tests-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { formatDueDate } from '../../services/format';

/**
 * A connected student's assignments, for a tutor, teacher assistant or
 * parent/guardian. Read-only. Titles are plain text, not links: a private
 * test 404s for anyone but its author and the student it was assigned to.
 * A parent or guardian (STUDENT_ANSWER_VIEWER_ROLES) also gets a link to
 * each submitted attempt's answers.
 */
@Component({ tag: 'page-student', styleUrl: 'page-student.css', shadow: true })
export class PageStudent {
  @Prop() studentId?: number;
  @State() result: StudentAssignments | null = null;
  @State() notFound = false;
  @State() error = false;

  async componentWillLoad() {
    await this.load();
  }

  @Watch('studentId')
  async onStudentChange() {
    await this.load();
  }

  private async load() {
    this.result = null;
    this.notFound = false;
    this.error = false;
    if (this.studentId === undefined) {
      this.notFound = true;
      return;
    }
    try {
      this.result = await testsStore.studentAssignments(this.studentId);
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = true;
      }
    }
  }

  private seesAnswers(): boolean {
    return hasRole(STUDENT_ANSWER_VIEWER_ROLES, authStore.currentUser?.role);
  }

  private score(a: AttemptSummary | null, prefix: string) {
    if (!a || a.score === null) {
      return null;
    }
    const path = `/attempts/${a.id}`;
    return (
      <span class="score">
        {prefix} {a.score} / {a.max_score}{a.ungraded_count ? ` (${a.ungraded_count} still to grade)` : ''}
        {this.seesAnswers() && [' · ', <a href={path} aria-label={`See answers, ${prefix.toLowerCase()} attempt`} onClick={(e) => { e.preventDefault(); navigate(path); }}>See answers</a>]}
      </span>
    );
  }

  render() {
    if (this.notFound) {
      return (
        <section>
          <h1>Not found</h1>
          <p>You can see a student's assignments once you are connected with them.</p>
        </section>
      );
    }
    if (this.error) {
      return (
        <section>
          <h1>Something went wrong</h1>
          <p>We could not load these assignments. Please try again.</p>
        </section>
      );
    }
    if (!this.result) {
      return <p>Loading…</p>;
    }
    const { student, data } = this.result;
    return (
      <section>
        <h1>{student.name}</h1>
        <h2>Assignments</h2>
        {data.length === 0 && <p>Nothing assigned yet.</p>}
        <ul class="rows">
          {data.map((a) => (
            <li key={a.id}>
              <strong>{a.test.title}</strong>
              <span class="meta">
                by {a.test.author.name} · {a.test.question_count} questions{a.due_at ? ` · due ${formatDueDate(a.due_at)}` : ''}
              </span>
              {a.latest === null ? <span class="meta">Not submitted yet</span> : [this.score(a.latest, 'Latest'), this.score(a.best, 'Best')]}
            </li>
          ))}
        </ul>
      </section>
    );
  }
}
