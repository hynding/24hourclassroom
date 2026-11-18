import { Component, h, Prop, State, Watch } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { CourseItem, CourseItemProgress, CourseView, GRADE_LEVELS, SUBJECTS } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { coursesStore } from '../../services/courses-store';
import { materialsStore } from '../../services/materials-store';
import { adoptCanonicalPath, navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { courseItemKind, courseItemTitle, courseSections } from '../../services/course-format';
import { courseMeta, setPageMeta } from '../../services/page-meta';
import { rememberReturnPath } from '../../services/return-path';
import { siteStore } from '../../services/site-store';
import { saveCsv } from '../../services/csv';

@Component({ tag: 'page-course', styleUrl: 'page-course.css', shadow: true })
export class PageCourse {
  @Prop() courseId?: number;

  @State() course: CourseView | null = null;
  @State() notFound = false;
  @State() loadError = false;
  @State() busy = false;
  @State() actionError = '';
  /** Confirmed signed out, so the teacher sign-up pitch applies. Unknown (a failed /api/user) counts as not a guest. */
  @State() guest = false;

  async componentWillLoad() {
    // Permissions come from payload fields (is_author, can_branch), never
    // the viewer's role; the session is read only to pitch sign-up to guests.
    await Promise.all([this.load(), this.loadGuest()]);
  }

  private async loadGuest() {
    try {
      this.guest = (await authStore.load()) === null;
    } catch {
      this.guest = false;
    }
  }

  /**
   * Course-to-course links (a branch and its original, "Open your branch",
   * landing on a new branch) resolve to this same tag, so Stencil reuses the
   * element and componentWillLoad does NOT re-run: without this the page
   * would keep showing the course it was mounted with.
   */
  @Watch('courseId')
  async onCourseChange() {
    this.course = null;
    this.notFound = false;
    this.loadError = false;
    this.actionError = '';
    await this.load();
  }

  private async load() {
    if (!this.courseId) {
      this.notFound = true;
      return;
    }
    try {
      this.course = await coursesStore.getCourse(this.courseId);
      // Opened by id: show the course's own address (its slug) instead.
      adoptCanonicalPath(this.course.path, `/courses/${this.courseId}`);
      setPageMeta(courseMeta(this.course));
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.loadError = true;
      }
    }
  }

  private async run(action: () => Promise<void>) {
    this.busy = true;
    this.actionError = '';
    try {
      await action();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.actionError = e instanceof ApiError ? e.message : 'Something went wrong.';
      }
    } finally {
      this.busy = false;
    }
  }

  /**
   * Publishing sweeps the contents too, so the same call serves a private
   * course and a public one with hidden items. Ask BEFORE run(), for the
   * same reason page-test does: entering run() disables every button for a
   * dialog the teacher may still cancel.
   */
  private publish = () => {
    const question = this.course.visibility === 'public'
      ? 'Publish the hidden tests and materials in this course? Visitors will see them, and can practise the tests with the answers shown.'
      : 'Publish this course? Anyone will be able to open it, and every test and material in it is published too. Visitors can practise its tests with the answers shown, so any student you assign them to can see the answers as well.';
    if (!window.confirm(question)) {
      return;
    }
    return this.run(async () => {
      this.course = await coursesStore.publishCourse(this.course.id);
    });
  };

  /** Students against the course's tests, best scores, as a spreadsheet. */
  private downloadGradebook = () => this.run(async () => {
    saveCsv(await coursesStore.courseGradebook(this.course.id));
  });

  private unpublish = () => this.run(async () => {
    this.course = await coursesStore.unpublishCourse(this.course.id);
  });

  /**
   * The server decides who may branch (`can_branch`); this only asks first,
   * because a branch copies every test into the teacher's account.
   */
  private branch = () => {
    if (!window.confirm('Make your own private branch of this course? Its tests are copied into your account, private, for you to change: rewrite or add questions and answers, and assign them to your students. Its readings and flashcards stay shared from the original. Nothing you change touches the original.')) {
      return;
    }
    return this.run(async () => {
      const branch = await coursesStore.branchCourse(this.course.id);
      navigate(`/courses/${branch.id}`);
    });
  };

  private remove = () => {
    if (!window.confirm('Delete this course? Its tests and materials are kept. This cannot be undone.')) {
      return;
    }
    return this.run(async () => {
      await coursesStore.deleteCourse(this.course.id);
      navigate('/courses');
    });
  };

  /**
   * The viewer's own "done" mark on a reading or deck. Kept on the item,
   * so it shows in every course that holds it; the page patches its copy
   * of the course instead of reloading it.
   */
  private async toggleDone(item: CourseItem, done: boolean) {
    this.actionError = '';
    try {
      const progress = await materialsStore.markMaterialDone(item.material.id, done);
      const items = { ...this.course.progress.items };
      if (progress.done_at) {
        items[item.id] = { done_at: progress.done_at, best_score: null, best_max: null };
      } else {
        delete items[item.id];
      }
      this.course = { ...this.course, progress: { items } };
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.actionError = 'We could not save that. Please try again.';
      }
    }
  }

  private itemPath(c: CourseView, item: CourseItem): string {
    return item.kind === 'test' ? `/courses/${c.id}/tests/${item.test.id}` : `/materials/${item.material.id}`;
  }

  /** The item's progress for this viewer, if they have any. */
  private progressOf(c: CourseView, item: CourseItem): CourseItemProgress | undefined {
    return c.progress?.items[item.id];
  }

  /**
   * "N of M done" and the first item not yet done, in course order. Only
   * for a viewer whose progress is kept (`progress` present).
   */
  private renderProgress(c: CourseView) {
    const items = c.items.filter((item) => item.test ?? item.material);
    if (!c.progress || items.length === 0) {
      return null;
    }
    const done = items.filter((item) => this.progressOf(c, item)?.done_at).length;
    const next = items.find((item) => !this.progressOf(c, item)?.done_at);
    return (
      <aside class="progress" aria-label="Your progress">
        <p>
          <strong>Your progress:</strong> {done} of {items.length} done
        </p>
        <progress max={items.length} value={done} aria-label={`${done} of ${items.length} done`}></progress>
        {next
          ? <p>{done === 0 ? 'Start with' : 'Up next'}: {this.link(this.itemPath(c, next), courseItemTitle(c.title, (next.test ?? next.material).title))}</p>
          : <p>You have done everything in this course.</p>}
        <p class="meta">Only you can see your progress.</p>
      </aside>
    );
  }

  /** A practice run's best, or the done mark and its toggle. */
  private renderItemProgress(c: CourseView, item: CourseItem) {
    if (!c.progress) {
      return null;
    }
    const p = this.progressOf(c, item);
    if (item.kind === 'test') {
      if (!p?.done_at) {
        return null;
      }
      return <span class="done">✓ {p.best_max ? `Best ${p.best_score} / ${p.best_max}` : 'Practised'}</span>;
    }
    const done = !!p?.done_at;
    return (
      <button type="button" class={{ btn: true, mark: true, on: done }} aria-pressed={done ? 'true' : 'false'} onClick={() => this.toggleDone(item, !done)}>
        {done ? '✓ Done' : 'Mark done'}
      </button>
    );
  }

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  /** Leaves for sign-up or log-in, remembering to come back to this course afterwards. */
  private signIn(path: string, text: string, cls: string) {
    return (
      <a class={cls} href={path} onClick={(e) => {
        e.preventDefault();
        rememberReturnPath(`/courses/${this.course.id}`);
        navigate(path);
      }}>{text}</a>
    );
  }

  /**
   * A shared course link is how most teachers will arrive, signed out. The
   * branch is what an account gets them: private answer keys and assigning.
   */
  private renderTeacherPitch(c: CourseView) {
    if (!this.guest || c.visibility !== 'public' || c.test_count === 0) {
      return null;
    }
    const open = siteStore.config.registration.open;
    return (
      <aside class="pitch" aria-label="For teachers">
        <h2>Teaching this course?</h2>
        <p>
          It's free to use with your class. {open ? 'Create a teacher account' : 'Log in'} and branch it: you get your own private copy of
          every test, with an answer key only you and your students can see, ready to edit and assign.
        </p>
        <div class="actions">
          {open && this.signIn('/register', 'Sign up free', 'btn-primary')}
          {this.signIn('/login', 'Log in', 'btn')}
        </div>
      </aside>
    );
  }

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  private count(n: number, one: string, many: string) {
    return `${n} ${n === 1 ? one : many}`;
  }

  private renderItem(c: CourseView, item: CourseItem) {
    const target = item.kind === 'test' ? item.test : item.material;
    if (!target) {
      return null;
    }
    const path = this.itemPath(c, item);
    const shared = item.kind === 'material' && item.material.author.id !== c.author.id;
    return (
      <li class={{ item: true, [item.kind]: true, finished: !!this.progressOf(c, item)?.done_at }}>
        <span class="kind">{courseItemKind(item)}</span>
        {this.link(path, courseItemTitle(c.title, target.title))}
        {item.kind === 'test' && <span class="meta">{this.count(item.test.question_count, 'question', 'questions')}</span>}
        {shared && <span class="meta">from {item.material.author.name}</span>}
        {c.is_author && target.visibility === 'private' && <span class="meta">Private</span>}
        {c.is_author && item.kind === 'test' && this.link(`/tests/${target.id}/edit`, 'Edit questions')}
        {this.renderItemProgress(c, item)}
      </li>
    );
  }

  render() {
    if (this.notFound) {
      return <section><h1>Course not found</h1><p>This course does not exist or is not available to you.</p></section>;
    }
    if (this.loadError) {
      return <section><h1>Course</h1><p>We could not load this course. Please try again.</p></section>;
    }
    if (!this.course) {
      return <section><p>Loading…</p></section>;
    }
    const c = this.course;
    const isPublic = c.visibility === 'public';
    // Only the author ever receives a private item.
    const hidden = c.items.filter((item) => (item.test ?? item.material)?.visibility === 'private').length;
    return (
      <section>
        <header>
          <h1>{c.title}</h1>
          <p class="meta">
            {this.label(SUBJECTS, c.subject)} · {this.label(GRADE_LEVELS, c.grade_level)} · {this.count(c.test_count, 'test', 'tests')} · {this.count(c.material_count, 'material', 'materials')} · by {this.link(`/teachers/${c.author.id}`, c.author.name)}
            {c.is_author && (isPublic ? ' · Public' : ' · Private')}
          </p>
          {c.branched_from && (
            <p class="meta">Branched from {this.link(`/courses/${c.branched_from.id}`, c.branched_from.title)} by {c.branched_from.author.name}</p>
          )}
          {c.description && <rich-text blocks text={c.description}></rich-text>}
        </header>

        {this.actionError && <p class="error">{this.actionError}</p>}

        {c.is_author && (
          <div class="actions">
            {this.link(`/courses/${c.id}/edit`, 'Edit')}
            {isPublic
              ? [
                  hidden > 0 && <button type="button" class="btn" disabled={this.busy} onClick={this.publish}>Publish hidden items</button>,
                  <button type="button" class="btn" disabled={this.busy} onClick={this.unpublish}>Unpublish</button>,
                ]
              : <button type="button" class="btn-primary" disabled={this.busy} onClick={this.publish}>Publish course</button>}
            {c.test_count > 0 && <button type="button" class="btn" disabled={this.busy} onClick={this.downloadGradebook}>Download gradebook (CSV)</button>}
            <button type="button" class="btn" disabled={this.busy} onClick={this.remove}>Delete</button>
          </div>
        )}
        {c.can_branch && (
          <div class="actions">
            {c.my_branch_id && this.link(`/courses/${c.my_branch_id}`, 'Open your branch')}
            <button type="button" class={c.my_branch_id ? 'btn' : 'btn-primary'} disabled={this.busy} onClick={this.branch}>
              {c.my_branch_id ? 'Branch again' : 'Branch this course'}
            </button>
          </div>
        )}
        {c.can_branch && !c.my_branch_id && (
          <p class="notice">Anyone can see this course's answers. Branch it to get your own private copy whose questions and answers you can change and keep to yourself and your students.</p>
        )}
        {c.is_author && !isPublic && c.branched_from && (
          <p class="notice">This is your private branch. Its tests are your own copies: edit them, add your own questions and answers, and assign them. Only you and the students you assign them to can see them, unless you publish the course.</p>
        )}
        {c.is_author && !isPublic && !c.branched_from && (
          <p class="notice">Only you can see this course. Publishing it makes the course and everything in it public, and lets anyone practise its tests with the answers available.</p>
        )}
        {c.is_author && isPublic && hidden > 0 && (
          <p class="notice">Items marked private are hidden from visitors.</p>
        )}

        {this.renderTeacherPitch(c)}

        {!c.is_author && c.test_count > 0 && (
          <p class="notice">
            Open any test to practise it: check each answer as you go, or finish and see your results.
            {c.progress
              ? ' Your best score on each is saved for you.'
              : this.guest ? [' Nothing is saved while you are signed out: ', this.signIn('/login', 'log in', ''), ' to keep your progress.'] : ' Nothing is recorded.'}
          </p>
        )}

        {this.renderProgress(c)}

        {c.items.length === 0 && <p>{c.is_author ? 'This course is empty. Edit it to add tests and materials.' : 'Nothing has been published in this course yet.'}</p>}

        {courseSections(c.items).map((group) => (
          <section class="group">
            {group.title && <h2>{group.title}</h2>}
            <ol class="items">{group.items.map((item) => this.renderItem(c, item))}</ol>
          </section>
        ))}
        <comment-thread targetType="course" targetId={c.id}></comment-thread>
      </section>
    );
  }
}
