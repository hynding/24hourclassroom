import { Component, h, State } from '@stencil/core';
import { GENERATION_STATUSES, Generation, MyAssignment, MyAttempt, TestSummary } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { testsStore } from '../../services/tests-store';
import { generationStore } from '../../services/generation-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { formatDueDate } from '../../services/format';

@Component({ tag: 'page-tests', styleUrl: 'page-tests.css', shadow: true })
export class PageTests {
  @State() tests: TestSummary[] = [];
  @State() generations: Generation[] = [];
  @State() assignments: MyAssignment[] = [];
  @State() practice: MyAttempt[] = [];
  @State() loaded = false;
  @State() error = false;
  @State() page = 1;
  @State() lastPage = 1;

  private get role(): 'teacher' | 'student' | 'none' {
    // Allowlist: anything that is not exactly teacher or student gets the empty state.
    const role = authStore.currentUser?.role;
    return role === 'teacher' || role === 'student' ? role : 'none';
  }

  async componentWillLoad() {
    // app-root does not await authStore.load() before it renders the route,
    // and `role` is a plain getter, so reading it first would latch the
    // signed-out empty state on any hard load of /tests and never recover.
    await authStore.load();
    await this.load();
  }

  private async load() {
    this.error = false;
    try {
      if (this.role === 'teacher') {
        const result = await testsStore.listTests(this.page > 1 ? this.page : undefined);
        this.tests = result.data;
        this.lastPage = result.meta.last_page;
        await this.loadGenerations();
      } else if (this.role === 'student') {
        const [assignments, attempts] = await Promise.all([testsStore.myAssignments(), testsStore.myAttempts()]);
        this.assignments = assignments.data;
        this.practice = attempts.data.filter((a) => a.assignment_id === null);
      }
      this.loaded = true;
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = true;
      }
    }
  }

  /**
   * Its own try/catch, on purpose: the generations list is a side panel, and
   * a C3 outage must not be able to take the teacher's own tests list down
   * with it. An empty list reads as "No generations yet." either way.
   */
  private async loadGenerations() {
    try {
      const result = await generationStore.listGenerations();
      this.generations = result.data;
    } catch {
      this.generations = [];
    }
  }

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  private score(a: { score: string | null; max_score: string | null; ungraded_count: number } | null, prefix: string) {
    if (!a || a.score === null) {
      return null;
    }
    return <span class="score">{prefix} {a.score} / {a.max_score}{a.ungraded_count ? ` (${a.ungraded_count} to grade)` : ''}</span>;
  }

  private renderTeacher() {
    return (
      <section>
        <h1>My tests</h1>
        <p class="actions">
          {this.link('/tests/new', 'New test')}
          {this.link('/tests/generate', 'Generate a test')}
        </p>
        {this.loaded && this.tests.length === 0 && <p>You have not written any tests yet.</p>}
        <ul class="rows">
          {this.tests.map((t) => (
            <li>
              {this.link(`/tests/${t.id}`, t.title)}
              <span class="meta">
                {t.visibility === 'public' ? 'Public' : 'Private'} · {t.question_count} questions · {t.assignment_count ?? 0} assigned
              </span>
            </li>
          ))}
        </ul>
        {this.lastPage > 1 && (
          <nav aria-label="Test pages">
            <button type="button" class="btn" disabled={this.page <= 1} onClick={() => { this.page -= 1; this.load(); }}>Previous</button>
            <span>Page {this.page} of {this.lastPage}</span>
            <button type="button" class="btn" disabled={this.page >= this.lastPage} onClick={() => { this.page += 1; this.load(); }}>Next</button>
          </nav>
        )}

        <h2>Recent generations</h2>
        {this.loaded && this.generations.length === 0 && <p>No generations yet.</p>}
        <ul class="rows">
          {this.generations.map((g) => (
            <li>
              {this.link(`/generations/${g.id}`, g.title)}
              <span class="pill">{this.label(GENERATION_STATUSES, g.status)}</span>
            </li>
          ))}
        </ul>
      </section>
    );
  }

  private renderStudent() {
    return (
      <section>
        <h1>My tests</h1>
        <h2>Assigned</h2>
        {this.loaded && this.assignments.length === 0 && <p>Nothing assigned yet. Browse the {this.link('/library', 'library')} to practise.</p>}
        <ul class="rows">
          {this.assignments.map((a) => (
            <li>
              {this.link(`/tests/${a.test.id}`, a.test.title)}
              <span class="meta">
                by {a.test.author.name} · {a.test.question_count} questions{a.due_at ? ` · due ${formatDueDate(a.due_at)}` : ''}
              </span>
              {this.score(a.latest, 'Latest')}
              {this.score(a.best, 'Best')}
            </li>
          ))}
        </ul>
        {this.practice.length > 0 && [
          <h2>Practice</h2>,
          <ul class="rows">
            {this.practice.map((a) => (
              <li>
                {this.link(`/attempts/${a.id}`, a.test.title)}
                <span class="meta">{a.submitted_at ? `Submitted ${new Date(a.submitted_at).toLocaleDateString()}` : 'In progress'}</span>
                {this.score(a, 'Score')}
              </li>
            ))}
          </ul>,
        ]}
      </section>
    );
  }

  render() {
    if (this.error) {
      return <section><h1>My tests</h1><p>We could not load your tests. Please try again.</p></section>;
    }
    switch (this.role) {
      case 'teacher':
        return this.renderTeacher();
      case 'student':
        return this.renderStudent();
      default:
        return <section><h1>My tests</h1><p>There are no tests for this account.</p></section>;
    }
  }
}
