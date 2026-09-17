import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { AssignResult, AssignmentRow, Connection, TestView } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';
import { testsStore } from '../../services/tests-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { formatDueDate } from '../../services/format';

@Component({ tag: 'page-test-assign', styleUrl: 'page-test-assign.css', shadow: true })
export class PageTestAssign {
  @Prop() testId?: number;

  @State() test: TestView | null = null;
  @State() students: Connection[] = [];
  @State() assigned: AssignmentRow[] = [];
  @State() selected: Set<number> = new Set();
  @State() dueAt = '';
  @State() results: AssignResult[] | null = null;
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
      const connections = await profileStore.connections();
      // Allowlist: only a student can be assigned. A connected teacher never appears here.
      this.students = connections.data.filter((c) => c.user.role === 'student');
      await this.refresh();
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load this page.';
      }
    }
  }

  private async refresh() {
    this.assigned = (await testsStore.listAssignments(this.testId)).data;
  }

  private get unassignedStudents(): Connection[] {
    const taken = new Set(this.assigned.map((a) => a.student.id));
    return this.students.filter((c) => !taken.has(c.user.id));
  }

  private toggle(id: number, on: boolean) {
    const next = new Set(this.selected);
    on ? next.add(id) : next.delete(id);
    this.selected = next;
  }

  async assign() {
    if (this.selected.size === 0) {
      return;
    }
    this.busy = true;
    this.error = '';
    try {
      // `undefined`, not null: an empty date field means "say nothing about
      // the due date", which leaves an existing one alone. Sending null would
      // CLEAR it on every re-assign made without retyping the date.
      const res = await testsStore.assignTest(this.testId, Array.from(this.selected), this.dueAt ? this.dueAt : undefined);
      this.results = res.results;
      this.selected = new Set();
      await this.refresh();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = e instanceof ApiError ? e.message : 'We could not assign this test.';
      }
    } finally {
      this.busy = false;
    }
  }

  async remove(assignmentId: number) {
    this.busy = true;
    try {
      await testsStore.unassign(this.testId, assignmentId);
      await this.refresh();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not remove that assignment.';
      }
    } finally {
      this.busy = false;
    }
  }

  private score(a: { score: string | null; max_score: string | null; ungraded_count: number } | null, prefix: string) {
    return a && a.score !== null ? <span class="meta">{prefix} {a.score} / {a.max_score}{a.ungraded_count ? ` (${a.ungraded_count} to grade)` : ''}</span> : null;
  }

  render() {
    if (this.notFound) {
      return <section><h1>Test not found</h1></section>;
    }
    if (!this.test) {
      return <section><p>{this.error || 'Loading…'}</p></section>;
    }
    const assignedCount = this.results?.filter((r) => r.status === 'assigned').length ?? 0;
    const missedCount = (this.results?.length ?? 0) - assignedCount;
    return (
      <section>
        <h1>Assign "{this.test.title}"</h1>
        {this.error && <p class="error">{this.error}</p>}
        {this.results && (
          <p class="notice">{assignedCount} assigned{missedCount ? `, ${missedCount} could not be assigned` : ''}.</p>
        )}

        <form onSubmit={(e) => { e.preventDefault(); this.assign(); }}>
          <fieldset>
            <legend>Connected students</legend>
            {this.unassignedStudents.length === 0 && <p>Every connected student already has this test.</p>}
            {this.unassignedStudents.map((c) => (
              <label class="row">
                <input type="checkbox" checked={this.selected.has(c.user.id)} onChange={(e) => this.toggle(c.user.id, (e.target as HTMLInputElement).checked)} />
                {c.user.name}
              </label>
            ))}
          </fieldset>
          <label>
            Due date (optional)
            <input type="date" value={this.dueAt} onInput={(e) => (this.dueAt = (e.target as HTMLInputElement).value)} />
          </label>
          <button type="submit" class="btn-primary" disabled={this.busy || this.selected.size === 0}>Assign</button>
        </form>

        <h2>Assigned</h2>
        {this.assigned.length === 0 && <p>Nobody yet.</p>}
        <ul class="rows">
          {this.assigned.map((a) => (
            <li>
              <span>{a.student.name}{a.due_at ? ` · due ${formatDueDate(a.due_at)}` : ''}</span>
              {this.score(a.latest, 'Latest')}
              {this.score(a.best, 'Best')}
              <button type="button" class="btn" disabled={this.busy} onClick={() => this.remove(a.id)}>Unassign</button>
            </li>
          ))}
        </ul>
        <a href={`/tests/${this.test.id}`} onClick={(e) => { e.preventDefault(); navigate(`/tests/${this.test.id}`); }}>Back to test</a>
      </section>
    );
  }
}
