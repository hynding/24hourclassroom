import { Component, h, State } from '@stencil/core';
import { GRADE_LEVELS, GradeLevel, SUBJECTS, Subject, TeacherSummary } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';
import { navigate } from '../../services/navigate';

@Component({ tag: 'page-teachers', shadow: true })
export class PageTeachers {
  @State() teachers: TeacherSummary[] = [];
  @State() subject: Subject | '' = '';
  @State() grade: GradeLevel | '' = '';
  @State() q = '';
  @State() busy = false;
  @State() loaded = false;

  async componentWillLoad() {
    await this.search();
  }

  async search() {
    this.busy = true;
    try {
      const page = await profileStore.searchTeachers({
        ...(this.subject ? { subject: this.subject } : {}),
        ...(this.grade ? { grade: this.grade } : {}),
        ...(this.q ? { q: this.q } : {}),
      });
      this.teachers = page.data;
    } finally {
      this.busy = false;
      this.loaded = true;
    }
  }

  private onSubmit = async (event: Event) => {
    event.preventDefault();
    await this.search();
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
          <button type="submit" disabled={this.busy}>Search</button>
        </form>

        {this.loaded && this.teachers.length === 0 && <p>No teachers match those filters yet.</p>}

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
      </section>
    );
  }
}
