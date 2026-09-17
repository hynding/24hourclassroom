import { Component, h, State } from '@stencil/core';
import { GRADE_LEVELS, GradeLevel, SUBJECTS, Subject, TestSummary } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

@Component({ tag: 'page-library', styleUrl: 'page-library.css', shadow: true })
export class PageLibrary {
  @State() tests: TestSummary[] = [];
  @State() subject: Subject | '' = '';
  @State() grade: GradeLevel | '' = '';
  @State() q = '';
  @State() busy = false;
  @State() loaded = false;
  @State() error = false;
  @State() page = 1;
  @State() lastPage = 1;

  async componentWillLoad() {
    await this.search();
  }

  async search() {
    this.busy = true;
    this.error = false;
    try {
      const result = await testsStore.library({
        ...(this.subject ? { subject: this.subject } : {}),
        ...(this.grade ? { grade: this.grade } : {}),
        ...(this.q ? { q: this.q } : {}),
        ...(this.page > 1 ? { page: this.page } : {}),
      });
      this.tests = result.data;
      this.lastPage = result.meta.last_page;
      this.loaded = true;
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      this.error = true;
    } finally {
      this.busy = false;
    }
  }

  /** Every filter change restarts at page 1 (same rule as the directory). */
  async submitSearch() {
    this.page = 1;
    await this.search();
  }

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    await this.submitSearch();
  };

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  render() {
    return (
      <section>
        <h1>Test library</h1>
        <form onSubmit={this.onSubmit}>
          <label>
            Subject
            <select onInput={(e) => (this.subject = (e.target as HTMLSelectElement).value as Subject | '')}>
              <option value="">Any subject</option>
              {SUBJECTS.map((s) => <option value={s.value}>{s.label}</option>)}
            </select>
          </label>
          <label>
            Grade level
            <select onInput={(e) => (this.grade = (e.target as HTMLSelectElement).value as GradeLevel | '')}>
              <option value="">Any grade</option>
              {GRADE_LEVELS.map((g) => <option value={g.value}>{g.label}</option>)}
            </select>
          </label>
          <label>
            Search
            <input type="search" placeholder="Title or description" value={this.q} onInput={(e) => (this.q = (e.target as HTMLInputElement).value)} />
          </label>
          <button type="submit" class="btn-primary" disabled={this.busy}>Search</button>
        </form>

        {this.busy && <p>Searching…</p>}
        {this.error && <p>We could not load the library. Please try again.</p>}
        {this.loaded && !this.busy && !this.error && this.tests.length === 0 && <p>No tests match those filters yet.</p>}

        <ul class="cards">
          {this.tests.map((test) => (
            <li>
              <a href={`/tests/${test.id}`} onClick={(e) => { e.preventDefault(); navigate(`/tests/${test.id}`); }}>{test.title}</a>
              <span class="meta">
                {this.label(SUBJECTS, test.subject)} · {this.label(GRADE_LEVELS, test.grade_level)} · {test.question_count} questions · by {test.author.name}
              </span>
            </li>
          ))}
        </ul>

        {this.lastPage > 1 && (
          <nav aria-label="Library pages">
            <button type="button" class="btn" disabled={this.page <= 1 || this.busy} onClick={() => { this.page -= 1; this.search(); }}>Previous</button>
            <span>Page {this.page} of {this.lastPage}</span>
            <button type="button" class="btn" disabled={this.page >= this.lastPage || this.busy} onClick={() => { this.page += 1; this.search(); }}>Next</button>
          </nav>
        )}
      </section>
    );
  }
}
