import { Component, h, State } from '@stencil/core';
import { GRADE_LEVELS, GradeLevel, SUBJECTS, Subject, TeacherSummary } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

@Component({ tag: 'page-teachers', styleUrl: 'page-teachers.css', shadow: true })
export class PageTeachers {
  @State() teachers: TeacherSummary[] = [];
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
    // Clear any previous failure so a retry that succeeds doesn't leave a
    // stale error message on screen.
    this.error = false;
    try {
      const result = await profileStore.searchTeachers({
        ...(this.subject ? { subject: this.subject } : {}),
        ...(this.grade ? { grade: this.grade } : {}),
        ...(this.q ? { q: this.q } : {}),
        // Omitted on page 1 so the common case sends no page param at all.
        ...(this.page > 1 ? { page: this.page } : {}),
      });
      this.teachers = result.data;
      this.lastPage = result.meta.last_page;
      this.loaded = true;
    } catch (e) {
      // `active` sits on the api host's PUBLIC throttle group, so a
      // DEACTIVATED session gets 401 from /api/teachers where a guest gets
      // 200 (R-F3). Swallowing that into the error state below would strand
      // the user on a dead public page with no explanation and no way out;
      // send them to /login, where ?error=deactivated says why.
      if (recoverFromExpiredSession(e)) {
        return;
      }
      // Any other failure must not be presented as "no teachers match" --
      // that would tell the user a confident, wrong answer. Render a
      // distinct error state instead, and don't re-throw: this is the right
      // level to handle the rejection rather than letting it escape as an
      // unhandled promise rejection.
      this.error = true;
    } finally {
      // `loaded` deliberately stays false on the recovery path -- it only
      // gates the "no teachers match" empty state, and recovery has already
      // navigated away. `busy` must clear either way.
      this.busy = false;
    }
  }

  /**
   * Every filter change restarts at page 1. Searching from page 2 with a new
   * filter would request page 2 of a result set that often has only one page,
   * and an out-of-range page comes back empty -- which renders identically to
   * "no teachers match", telling the user a confident, wrong answer.
   */
  async submitSearch() {
    this.page = 1;
    await this.search();
  }

  async nextPage() {
    if (this.page >= this.lastPage) {
      return;
    }
    this.page += 1;
    await this.search();
  }

  async previousPage() {
    if (this.page <= 1) {
      return;
    }
    this.page -= 1;
    await this.search();
  }

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    await this.submitSearch();
  };

  render() {
    return (
      <section>
        <h1>Find a teacher</h1>
        <form onSubmit={this.onSubmit}>
          <label>
            Subject
            <select onInput={(e) => (this.subject = (e.target as HTMLSelectElement).value as Subject | '')}>
              <option value="">Any subject</option>
              {SUBJECTS.map((s) => (
                <option value={s.value}>{s.label}</option>
              ))}
            </select>
          </label>
          <label>
            Grade level
            <select onInput={(e) => (this.grade = (e.target as HTMLSelectElement).value as GradeLevel | '')}>
              <option value="">Any grade</option>
              {GRADE_LEVELS.map((g) => (
                <option value={g.value}>{g.label}</option>
              ))}
            </select>
          </label>
          <label>
            Search
            <input type="search" placeholder="Name or school" value={this.q} onInput={(e) => (this.q = (e.target as HTMLInputElement).value)} />
          </label>
          <button type="submit" class="btn-primary" disabled={this.busy}>Search</button>
        </form>

        {this.busy && <p>Searching…</p>}

        {this.error && <p>We could not load teachers. Please try again.</p>}

        {this.loaded && !this.busy && !this.error && this.teachers.length === 0 && <p>No teachers match those filters yet.</p>}

        <ul>
          {this.teachers.map((teacher) => (
            <li>
              <a
                href={`/teachers/${teacher.id}`}
                onClick={(e) => {
                  e.preventDefault();
                  navigate(`/teachers/${teacher.id}`);
                }}
              >
                {teacher.name}
              </a>
              {teacher.school && <span>{teacher.school}</span>}
            </li>
          ))}
        </ul>

        {this.lastPage > 1 && (
          <nav aria-label="Directory pages">
            <button type="button" class="btn" disabled={this.page <= 1 || this.busy} onClick={() => this.previousPage()}>
              Previous
            </button>
            <span>
              Page {this.page} of {this.lastPage}
            </span>
            <button type="button" class="btn" disabled={this.page >= this.lastPage || this.busy} onClick={() => this.nextPage()}>
              Next
            </button>
          </nav>
        )}
      </section>
    );
  }
}
