import { Component, h, Prop, State, Watch } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { CourseItem, CourseView, GRADE_LEVELS, SUBJECTS } from '@24hc/shared';
import { coursesStore } from '../../services/courses-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { courseItemKind, courseItemTitle, courseSections } from '../../services/course-format';

@Component({ tag: 'page-course', styleUrl: 'page-course.css', shadow: true })
export class PageCourse {
  @Prop() courseId?: number;

  @State() course: CourseView | null = null;
  @State() notFound = false;
  @State() loadError = false;
  @State() busy = false;
  @State() actionError = '';

  async componentWillLoad() {
    // No authStore.load(): every branch reads a payload field (is_author),
    // never the viewer's role.
    await this.load();
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

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
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
    const path = item.kind === 'test' ? `/courses/${c.id}/tests/${target.id}` : `/materials/${target.id}`;
    const shared = item.kind === 'material' && item.material.author.id !== c.author.id;
    return (
      <li class={`item ${item.kind}`}>
        <span class="kind">{courseItemKind(item)}</span>
        {this.link(path, courseItemTitle(c.title, target.title))}
        {item.kind === 'test' && <span class="meta">{this.count(item.test.question_count, 'question', 'questions')}</span>}
        {shared && <span class="meta">from {item.material.author.name}</span>}
        {c.is_author && target.visibility === 'private' && <span class="meta">Private</span>}
        {c.is_author && item.kind === 'test' && this.link(`/tests/${target.id}/edit`, 'Edit questions')}
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

        {!c.is_author && c.test_count > 0 && (
          <p class="notice">Open any test to practise it: check each answer as you go, or finish and see your results. Nothing is recorded.</p>
        )}

        {c.items.length === 0 && <p>{c.is_author ? 'This course is empty. Edit it to add tests and materials.' : 'Nothing has been published in this course yet.'}</p>}

        {courseSections(c.items).map((group) => (
          <section class="group">
            {group.title && <h2>{group.title}</h2>}
            <ol class="items">{group.items.map((item) => this.renderItem(c, item))}</ol>
          </section>
        ))}
      </section>
    );
  }
}
