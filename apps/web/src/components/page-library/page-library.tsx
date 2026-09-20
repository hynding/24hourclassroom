import { Component, h, Prop, State, Watch } from '@stencil/core';
import { GRADE_LEVELS, GradeLevel, MaterialSummary, SUBJECTS, Subject, TestSummary } from '@24hc/shared';
import { testsStore } from '../../services/tests-store';
import { materialsStore } from '../../services/materials-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { fileTypeLabel, formatBytes } from '../../services/format';

@Component({ tag: 'page-library', styleUrl: 'page-library.css', shadow: true })
export class PageLibrary {
  /**
   * Which segment is showing. reflect: true is load-bearing --
   * page-library.css keys on :host([kind='materials']) for the wider grid
   * the extra type and size cells need.
   */
  @Prop({ reflect: true }) kind: 'tests' | 'materials' = 'tests';

  @State() tests: TestSummary[] = [];
  @State() materials: MaterialSummary[] = [];
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

  /**
   * Both /library and /library/materials resolve to this tag, so Stencil
   * reuses the element and componentWillLoad does NOT re-run on the switch.
   * Reset the results and the pager -- but never subject/grade/q: those
   * <select>s are uncontrolled, so clearing the state would leave the DOM
   * showing filters the query no longer applies.
   */
  @Watch('kind')
  async onKindChange() {
    this.page = 1;
    this.tests = [];
    this.materials = [];
    this.loaded = false;
    await this.search();
  }

  async search() {
    this.busy = true;
    this.error = false;
    const filters = {
      ...(this.subject ? { subject: this.subject } : {}),
      ...(this.grade ? { grade: this.grade } : {}),
      ...(this.q ? { q: this.q } : {}),
      ...(this.page > 1 ? { page: this.page } : {}),
    };
    try {
      // Allowlist on the segment, not a ternary fallback: an unknown kind
      // must not silently fetch the other library.
      if (this.kind === 'materials') {
        const result = await materialsStore.materialsLibrary(filters);
        this.materials = result.data;
        this.lastPage = result.meta.last_page;
      } else {
        const result = await testsStore.library(filters);
        this.tests = result.data;
        this.lastPage = result.meta.last_page;
      }
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

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  private get isMaterials(): boolean {
    return this.kind === 'materials';
  }

  private get count(): number {
    return this.isMaterials ? this.materials.length : this.tests.length;
  }

  render() {
    return (
      <section>
        <h1>{this.isMaterials ? 'Material library' : 'Test library'}</h1>

        <nav class="segments" aria-label="Library sections">
          {this.link('/library', 'Tests')}
          {this.link('/library/materials', 'Materials')}
        </nav>

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
        {this.loaded && !this.busy && !this.error && this.count === 0 && (
          <p>{this.isMaterials ? 'No materials match those filters yet.' : 'No tests match those filters yet.'}</p>
        )}

        <ul class="cards">
          {this.isMaterials
            ? this.materials.map((m) => (
                <li>
                  {this.link(`/materials/${m.id}`, m.title)}
                  <span class="meta">
                    {this.label(SUBJECTS, m.subject)} · {this.label(GRADE_LEVELS, m.grade_level)} · {fileTypeLabel(m.original_name)} · {formatBytes(m.size_bytes)} · by {m.author.name}
                  </span>
                </li>
              ))
            : this.tests.map((t) => (
                <li>
                  {this.link(`/tests/${t.id}`, t.title)}
                  <span class="meta">
                    {this.label(SUBJECTS, t.subject)} · {this.label(GRADE_LEVELS, t.grade_level)} · {t.question_count} questions · by {t.author.name}
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
