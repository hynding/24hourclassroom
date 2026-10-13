import { Component, h, State } from '@stencil/core';
import { CourseSummary } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { coursesStore } from '../../services/courses-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

/** The teacher's own courses. Everyone else finds courses in the library. */
@Component({ tag: 'page-courses', styleUrl: 'page-courses.css', shadow: true })
export class PageCourses {
  @State() courses: CourseSummary[] = [];
  @State() loaded = false;
  @State() error = false;
  @State() page = 1;
  @State() lastPage = 1;

  /** Allowlist: only a teacher has a courses shelf (the API's own rule). */
  private get isTeacher(): boolean {
    return authStore.currentUser?.role === 'teacher';
  }

  async componentWillLoad() {
    // Same reason as page-tests: the role is a plain getter, and app-root
    // does not await authStore.load() before rendering the route.
    await authStore.load();
    await this.load();
  }

  private async load() {
    this.error = false;
    if (!this.isTeacher) {
      this.loaded = true;
      return;
    }
    try {
      const result = await coursesStore.listCourses(this.page > 1 ? this.page : undefined);
      this.courses = result.data;
      this.lastPage = result.meta.last_page;
      this.loaded = true;
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = true;
      }
    }
  }

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  render() {
    if (this.error) {
      return <section><h1>My courses</h1><p>We could not load your courses. Please try again.</p></section>;
    }
    if (!this.isTeacher) {
      return <section><h1>My courses</h1><p>Browse public courses in the {this.link('/library/courses', 'library')}.</p></section>;
    }
    return (
      <section>
        <h1>My courses</h1>
        <p class="actions">{this.link('/courses/new', 'New course')}</p>
        {this.loaded && this.courses.length === 0 && (
          <p>You have not built any courses yet. A course gathers your tests and materials into one page, in order; publish it and anyone can work through it.</p>
        )}
        <ul class="rows">
          {this.courses.map((c) => (
            <li>
              {this.link(`/courses/${c.id}`, c.title)}
              <span class="meta">
                {c.visibility === 'public' ? 'Public' : 'Private'} · {c.test_count} test{c.test_count === 1 ? '' : 's'} · {c.material_count} material{c.material_count === 1 ? '' : 's'}
              </span>
            </li>
          ))}
        </ul>
        {this.lastPage > 1 && (
          <nav aria-label="Course pages">
            <button type="button" class="btn" disabled={this.page <= 1} onClick={() => { this.page -= 1; this.load(); }}>Previous</button>
            <span>Page {this.page} of {this.lastPage}</span>
            <button type="button" class="btn" disabled={this.page >= this.lastPage} onClick={() => { this.page += 1; this.load(); }}>Next</button>
          </nav>
        )}
      </section>
    );
  }
}
