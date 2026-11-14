import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { CourseCandidates, CourseInput, CourseItemKind, CourseView, GRADE_LEVELS, GradeLevel, SUBJECTS, SlugState, Subject, Visibility } from '@24hc/shared';
import { coursesStore } from '../../services/courses-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { courseItemTitle } from '../../services/course-format';

/** One row of the contents list: what is sent, plus what the row shows. */
interface EditorItem {
  kind: CourseItemKind;
  id: number;
  section: string;
  title: string;
  visibility: Visibility;
  /** Another teacher's material kept from the original of a branch: their name. */
  sharedBy?: string;
  /** Added in this editing session: on a public course, saving publishes it (and only it). */
  added?: boolean;
}

/** The server's cap (SaveCourseRequest::MAX_ITEMS). */
const MAX_ITEMS = 300;

@Component({ tag: 'page-course-editor', styleUrl: 'page-course-editor.css', shadow: true })
export class PageCourseEditor {
  /** Undefined = creating (/courses/new); set = editing (/courses/:id/edit). */
  @Prop() courseId?: number;

  @State() title = '';
  @State() description = '';
  @State() subject: Subject | '' = '';
  @State() grade: GradeLevel | '' = '';
  @State() items: EditorItem[] = [];
  @State() candidates: CourseCandidates = { tests: [], materials: [] };
  /** `kind:id` of the test or material chosen in the Add picker, or ''. */
  @State() pick = '';
  /** The heading the next added item goes under; follows the last row by default. */
  @State() nextSection = '';
  @State() isPublic = false;
  @State() commentReactions = false;
  @State() errors: Record<string, string[]> = {};
  @State() message = '';
  @State() busy = false;
  @State() loading = true;
  @State() notFound = false;
  /** Set when a non-author is being navigated away; render() paints nothing. */
  @State() bounced = false;
  /** The course's address under the author's handle (App\Support\Slugs). */
  @State() slug = '';
  @State() slugState: SlugState | null = null;
  @State() siteSlug: string | null = null;
  @State() handle: string | null = null;
  @State() slugError = '';
  @State() slugMessage = '';
  @State() slugBusy = false;

  async componentWillLoad() {
    try {
      if (this.courseId) {
        const course = await coursesStore.getCourse(this.courseId);
        if (!course.is_author) {
          this.bounced = true;
          navigate(`/courses/${course.id}`);
          return;
        }
        this.fill(course);
      }
      this.candidates = await coursesStore.courseCandidates();
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.message = this.courseId ? 'We could not load this course.' : 'We could not load your tests and materials.';
      }
    }
    this.loading = false;
  }

  private fill(course: CourseView) {
    this.title = course.title;
    this.description = course.description ?? '';
    this.subject = course.subject;
    this.grade = course.grade_level;
    this.isPublic = course.visibility === 'public';
    this.commentReactions = course.comment_reactions;
    this.slugState = course.slug ?? null;
    this.slug = course.slug?.slug ?? '';
    this.siteSlug = course.site_slug ?? null;
    this.handle = course.handle ?? null;
    this.items = course.items
      .map((item) => {
        const target = item.kind === 'test' ? item.test : item.material;
        if (!target) {
          return null;
        }
        const sharedBy = item.kind === 'material' && item.material.author.id !== course.author.id ? item.material.author.name : undefined;
        return { kind: item.kind, id: target.id, section: item.section ?? '', title: target.title, visibility: target.visibility, ...(sharedBy ? { sharedBy } : {}) };
      })
      .filter((item): item is EditorItem => item !== null);
    this.nextSection = this.items[this.items.length - 1]?.section ?? '';
  }

  private body(): CourseInput {
    return {
      title: this.title,
      description: this.description || null,
      subject: this.subject as Subject,
      grade_level: this.grade as GradeLevel,
      comment_reactions: this.commentReactions,
      items: this.items.map((item) => ({ kind: item.kind, id: item.id, section: item.section.trim() || null })),
    };
  }

  async save() {
    this.busy = true;
    this.errors = {};
    this.message = '';
    try {
      const saved = this.courseId
        ? await coursesStore.updateCourse(this.courseId, this.body())
        : await coursesStore.createCourse(this.body());
      navigate(`/courses/${saved.id}`);
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      if (e instanceof ApiError && e.status === 422) {
        this.errors = e.errors ?? {};
        this.message = 'Please fix the highlighted fields.';
      } else {
        this.message = 'We could not save the course. Please try again.';
      }
    } finally {
      this.busy = false;
    }
  }

  private has(kind: CourseItemKind, id: number): boolean {
    return this.items.some((item) => item.kind === kind && item.id === id);
  }

  add() {
    const [kind, raw] = this.pick.split(':');
    const id = Number(raw);
    const source = kind === 'test' ? this.candidates.tests : kind === 'material' ? this.candidates.materials : [];
    const found = source.find((c) => c.id === id);
    if (!found || this.has(kind as CourseItemKind, id) || this.items.length >= MAX_ITEMS) {
      return;
    }
    this.items = [...this.items, { kind: kind as CourseItemKind, id, section: this.nextSection, title: found.title, visibility: found.visibility, added: true }];
    this.pick = '';
  }

  private setSection(i: number, section: string) {
    this.items = this.items.map((item, j) => (j === i ? { ...item, section } : item));
    if (i === this.items.length - 1) {
      this.nextSection = section;
    }
  }

  private remove(i: number) {
    this.items = this.items.filter((_, j) => j !== i);
  }

  private move(i: number, dir: -1 | 1) {
    const j = i + dir;
    if (j < 0 || j >= this.items.length) {
      return;
    }
    const next = [...this.items];
    [next[i], next[j]] = [next[j], next[i]];
    this.items = next;
  }

  private fieldError(key: string) {
    const list = this.errors[key];
    return list ? <p class="error">{list[0]}</p> : null;
  }

  private renderItem(item: EditorItem, i: number) {
    return (
      <li class="item">
        <label class="section">
          Section
          <input type="text" maxlength="160" placeholder="No heading" value={item.section} onInput={(e) => this.setSection(i, (e.target as HTMLInputElement).value)} />
        </label>
        <div class="what">
          <span class="kind">{item.kind === 'test' ? 'Test' : 'Material'}</span>
          <span class="title">{courseItemTitle(this.title, item.title)}</span>
          {item.sharedBy && <span class="meta">From {item.sharedBy}'s original: keep, move or remove it</span>}
          {item.visibility === 'private' && <span class="meta">{this.isPublic && item.added ? 'Private: published when you save' : 'Private'}</span>}
        </div>
        <div class="row-actions">
          <button type="button" class="btn" aria-label={`Move ${item.title} up`} disabled={i === 0} onClick={() => this.move(i, -1)}>Up</button>
          <button type="button" class="btn" aria-label={`Move ${item.title} down`} disabled={i === this.items.length - 1} onClick={() => this.move(i, 1)}>Down</button>
          <button type="button" class="btn" aria-label={`Remove ${item.title}`} onClick={() => this.remove(i)}>Remove</button>
        </div>
        {this.fieldError(`items.${i}.id`)}
        {this.fieldError(`items.${i}.section`)}
      </li>
    );
  }

  private async saveSlug() {
    if (!this.courseId) {
      return;
    }
    this.slugBusy = true;
    this.slugError = '';
    this.slugMessage = '';
    try {
      const course = await coursesStore.setCourseSlug(this.courseId, this.slug.trim() || null);
      this.slugState = course.slug ?? null;
      this.slug = course.slug?.slug ?? '';
      this.handle = course.handle ?? null;
      this.slugMessage = this.slugState === null ? 'Address removed. Old links still work.' : this.slugState.status === 'approved' ? 'Saved.' : 'Saved. It goes live once your handle is approved.';
    } catch (e) {
      if (e instanceof ApiError) {
        this.slugError = e.errors?.slug?.[0] ?? e.message;
      } else if (!recoverFromExpiredSession(e)) {
        this.slugError = 'Something went wrong.';
      }
    } finally {
      this.slugBusy = false;
    }
  }

  private renderAddress() {
    const prefix = this.handle ? `/teachers/${this.handle}/` : '/teachers/<your handle>/';
    return (
      <form class="address" onSubmit={(e) => { e.preventDefault(); this.saveSlug(); }}>
        <h2>Address</h2>
        {this.siteSlug && <p class="notice">This course's address is <code>/courses/{this.siteSlug}</code>, set by the site.</p>}
        <label>
          Course address under your handle
          <span class="slug-input">
            <span class="prefix">{prefix}</span>
            <input type="text" maxlength="60" pattern="[a-z0-9]+(-[a-z0-9]+)*" placeholder="algebra-1" value={this.slug} onInput={(e) => (this.slug = (e.target as HTMLInputElement).value.toLowerCase())} />
          </span>
        </label>
        {this.slugError && <p class="error">{this.slugError}</p>}
        {!this.handle && (
          <p class="notice">
            Ask for a handle on <a href="/profile" onClick={(e) => { e.preventDefault(); navigate('/profile'); }}>your profile</a>. Course addresses go live once an admin approves it.
          </p>
        )}
        {this.slugState?.status === 'pending' && <p class="notice">Waiting for your handle to be approved.</p>}
        {this.slugMessage && <p class="notice" role="status">{this.slugMessage}</p>}
        <div class="actions">
          <button type="submit" class="btn" disabled={this.slugBusy || this.slug.trim() === (this.slugState?.slug ?? '')}>Save address</button>
        </div>
      </form>
    );
  }

  render() {
    if (this.bounced) {
      return null;
    }
    if (this.notFound) {
      return <section><h1>Course not found</h1></section>;
    }
    if (this.loading) {
      return <section><p>Loading…</p></section>;
    }
    const tests = this.candidates.tests.filter((t) => !this.has('test', t.id));
    const materials = this.candidates.materials.filter((m) => !this.has('material', m.id));
    return (
      <section>
        <h1>{this.courseId ? 'Edit course' : 'New course'}</h1>
        {this.message && <p class="error">{this.message}</p>}
        <form onSubmit={(e) => { e.preventDefault(); this.save(); }}>
          <label>
            Title
            <input type="text" maxlength="160" value={this.title} onInput={(e) => (this.title = (e.target as HTMLInputElement).value)} required />
          </label>
          {this.fieldError('title')}
          <label>
            Description
            <textarea value={this.description} onInput={(e) => (this.description = (e.target as HTMLTextAreaElement).value)}></textarea>
          </label>
          {this.fieldError('description')}
          <label>
            Subject
            <select onInput={(e) => (this.subject = (e.target as HTMLSelectElement).value as Subject)} required>
              <option value="" selected={this.subject === ''}>Choose…</option>
              {SUBJECTS.map((s) => <option value={s.value} selected={s.value === this.subject}>{s.label}</option>)}
            </select>
          </label>
          {this.fieldError('subject')}
          <label>
            Grade level
            <select onInput={(e) => (this.grade = (e.target as HTMLSelectElement).value as GradeLevel)} required>
              <option value="" selected={this.grade === ''}>Choose…</option>
              {GRADE_LEVELS.map((g) => <option value={g.value} selected={g.value === this.grade}>{g.label}</option>)}
            </select>
          </label>
          {this.fieldError('grade_level')}
          <label class="check">
            <input type="checkbox" checked={this.commentReactions} onChange={(e) => (this.commentReactions = (e.target as HTMLInputElement).checked)} />
            Allow thumbs up and down on approved comments
          </label>
          {this.fieldError('comment_reactions')}

          <h2>Contents</h2>
          <p class="notice">
            Only your own tests and materials can go in a course. Items under the same section heading are grouped together.
            {this.isPublic && ' This course is public: anything you add is published with it. Items already here keep their own visibility.'}
          </p>
          {this.fieldError('items')}
          {this.items.length === 0 && <p>Nothing in this course yet.</p>}
          <ol class="items">{this.items.map((item, i) => this.renderItem(item, i))}</ol>

          <fieldset class="add">
            <legend>Add to the course</legend>
            <label>
              Test or material
              <select data-testid="pick" onInput={(e) => (this.pick = (e.target as HTMLSelectElement).value)}>
                <option value="" selected={this.pick === ''}>Choose…</option>
                {tests.length > 0 && (
                  <optgroup label="Tests">
                    {tests.map((t) => <option value={`test:${t.id}`} selected={this.pick === `test:${t.id}`}>{t.title}{t.question_count === 0 ? ' (no questions)' : ''}</option>)}
                  </optgroup>
                )}
                {materials.length > 0 && (
                  <optgroup label="Materials">
                    {materials.map((m) => <option value={`material:${m.id}`} selected={this.pick === `material:${m.id}`}>{m.title}</option>)}
                  </optgroup>
                )}
              </select>
            </label>
            <label>
              Section
              <input type="text" maxlength="160" placeholder="No heading" value={this.nextSection} onInput={(e) => (this.nextSection = (e.target as HTMLInputElement).value)} />
            </label>
            <button type="button" class="btn" disabled={this.pick === '' || this.items.length >= MAX_ITEMS} onClick={() => this.add()}>Add</button>
            {tests.length === 0 && materials.length === 0 && <p class="notice">Everything you have written or uploaded is already in this course.</p>}
          </fieldset>

          <div class="actions">
            <button type="submit" class="btn-primary" disabled={this.busy}>{this.courseId ? 'Save changes' : 'Create course'}</button>
            {this.courseId
              ? <a href={`/courses/${this.courseId}`} onClick={(e) => { e.preventDefault(); navigate(`/courses/${this.courseId}`); }}>Cancel</a>
              : <a href="/courses" onClick={(e) => { e.preventDefault(); navigate('/courses'); }}>Cancel</a>}
          </div>
        </form>
        {this.courseId && this.renderAddress()}
      </section>
    );
  }
}
