import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getCourse = jest.fn();
const publishCourse = jest.fn();
const unpublishCourse = jest.fn();
const deleteCourse = jest.fn();
const branchCourse = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/courses-store', () => ({
  coursesStore: {
    getCourse: (...a: unknown[]) => getCourse(...a),
    publishCourse: (...a: unknown[]) => publishCourse(...a),
    unpublishCourse: (...a: unknown[]) => unpublishCourse(...a),
    deleteCourse: (...a: unknown[]) => deleteCourse(...a),
    branchCourse: (...a: unknown[]) => branchCourse(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));
// Signed in by default, so the guest pitch stays out of every other test.
const authLoad = jest.fn();
jest.mock('../../services/auth-store', () => ({ authStore: { load: () => authLoad() } }));
const rememberReturnPath = jest.fn();
jest.mock('../../services/return-path', () => ({ rememberReturnPath: (...a: unknown[]) => rememberReturnPath(...a) }));
let registrationOpen = true;
jest.mock('../../services/site-store', () => ({
  siteStore: { get config() { return { identity: { name: '24 Hour Classroom', tagline: null }, registration: { open: registrationOpen, message: null } }; } },
}));

import { PageCourse } from './page-course';
import { RichText } from '../rich-text/rich-text';

const deepText = (node: Node): string => {
  if (node.nodeType === 3) {
    return node.textContent ?? '';
  }
  const root = (node as Element).shadowRoot ?? node;
  return Array.from(root.childNodes).map(deepText).join('');
};

const quiz = (id: number, section: string | null, visibility = 'public') => ({
  id: id * 10, position: id, section, kind: 'test',
  test: { id, title: `AP Biology · Week 0${id} · Quiz · Cells`, visibility, question_count: 12 },
});
const guide = (id: number, section: string | null) => ({
  id: id * 10, position: id, section, kind: 'material',
  material: {
    id, title: `AP Biology · Week 0${id} · Study Guide`, visibility: 'public', original_name: 'guide.md', mime_type: 'text/plain', size_bytes: 900,
    author: { id: 1, name: 'Ms K' },
  },
});
const course = (over: Record<string, unknown> = {}) => ({
  id: 3, title: 'AP Biology', subject: 'science', grade_level: '9-12', visibility: 'public', published_at: '2026-09-01',
  test_count: 2, material_count: 1, author: { id: 1, name: 'Ms K' }, description: 'A full year.', created_at: '', updated_at: '',
  is_author: false, branched_from: null, can_branch: false, my_branch_id: null, comment_reactions: false,
  items: [guide(1, 'Unit 1 · Chemistry of Life'), quiz(1, 'Unit 1 · Chemistry of Life'), quiz(2, 'Unit 2 · Cells')],
  ...over,
});
const mount = async (view: unknown) => {
  getCourse.mockResolvedValue(view);
  const page = await newSpecPage({ components: [PageCourse, RichText], html: '<page-course course-id="3"></page-course>' });
  await page.waitForChanges();
  return page;
};
const buttons = (page: Awaited<ReturnType<typeof mount>>) => Array.from(page.root.shadowRoot.querySelectorAll('button')).map((b) => b.textContent);

describe('page-course', () => {
  beforeEach(() => {
    [getCourse, publishCourse, unpublishCourse, deleteCourse, branchCourse, navigate, rememberReturnPath].forEach((m) => m.mockReset());
    authLoad.mockReset().mockResolvedValue({ id: 9, role: 'student' });
    registrationOpen = true;
  });

  describe('the teacher pitch', () => {
    it('asks a signed-out visitor to sign up and branch, and remembers to come back', async () => {
      authLoad.mockResolvedValue(null);
      const page = await mount(course());
      const pitch = page.root.shadowRoot.querySelector('.pitch');

      expect(pitch.querySelector('h2').textContent).toBe('Teaching this course?');
      expect(pitch.textContent).toContain('answer key only you and your students can see');
      const signUp = pitch.querySelector('a[href="/register"]') as HTMLAnchorElement;
      signUp.click();
      expect(rememberReturnPath).toHaveBeenCalledWith('/courses/3');
      expect(navigate).toHaveBeenCalledWith('/register');
      expect(pitch.querySelector('a[href="/login"]')).not.toBeNull();
    });

    it('offers only Log in while registration is closed', async () => {
      authLoad.mockResolvedValue(null);
      registrationOpen = false;
      const page = await mount(course());
      const pitch = page.root.shadowRoot.querySelector('.pitch');

      expect(pitch.querySelector('a[href="/register"]')).toBeNull();
      expect(pitch.querySelector('a[href="/login"]')).not.toBeNull();
    });

    it('is not shown to anyone signed in, when the session is unknown, or on a course with no tests', async () => {
      expect((await mount(course())).root.shadowRoot.querySelector('.pitch')).toBeNull();

      authLoad.mockRejectedValue(new Error('offline'));
      expect((await mount(course())).root.shadowRoot.querySelector('.pitch')).toBeNull();

      authLoad.mockResolvedValue(null);
      expect((await mount(course({ test_count: 0, items: [guide(1, null)] }))).root.shadowRoot.querySelector('.pitch')).toBeNull();
    });
  });

  it('shows a visitor the course in sections, tests linked to practice mode, and no author controls', async () => {
    const page = await mount(course());
    const root = page.root.shadowRoot;
    const text = deepText(root);

    expect(text).toContain('AP Biology');
    expect(text).toContain('2 tests · 1 material · by Ms K');
    expect(text).toContain('A full year.');
    expect(text).toContain('Nothing is recorded');
    expect(Array.from(root.querySelectorAll('h2')).map((h) => h.textContent)).toEqual(['Unit 1 · Chemistry of Life', 'Unit 2 · Cells']);
    // The course's own name is dropped from each item title.
    expect(root.querySelector('a[href="/courses/3/tests/1"]').textContent).toBe('Week 01 · Quiz · Cells');
    expect(root.querySelector('a[href="/materials/1"]').textContent).toBe('Week 01 · Study Guide');
    expect(text).toContain('Reading');
    expect(text).toContain('12 questions');
    expect(text).not.toContain('Public');
    expect(root.querySelector('button')).toBeNull();
  });

  it('offers the author Publish on a private course and replaces the view with the response', async () => {
    const page = await mount(course({ is_author: true, visibility: 'private', items: [quiz(1, null, 'private')] }));
    expect(deepText(page.root.shadowRoot)).toContain('Only you can see this course');
    expect(deepText(page.root.shadowRoot)).toContain('Private');
    expect(buttons(page)).toEqual(['Publish course', 'Delete']);

    publishCourse.mockResolvedValue(course({ is_author: true, items: [quiz(1, null)] }));
    window.confirm = jest.fn(() => true);
    page.root.shadowRoot.querySelector('button').click();
    await page.waitForChanges();
    await page.waitForChanges();

    expect(window.confirm).toHaveBeenCalledWith(expect.stringContaining('answers'));
    expect(publishCourse).toHaveBeenCalledWith(3);
    expect(buttons(page)).toEqual(['Unpublish', 'Delete']);
  });

  it('does not publish when the author cancels the warning', async () => {
    const page = await mount(course({ is_author: true, visibility: 'private' }));
    window.confirm = jest.fn(() => false);
    page.root.shadowRoot.querySelector('button').click();
    await page.waitForChanges();
    expect(publishCourse).not.toHaveBeenCalled();
  });

  it('offers to publish hidden items only while a public course has some', async () => {
    const page = await mount(course({ is_author: true, items: [quiz(1, null), quiz(2, null, 'private')] }));
    expect(buttons(page)).toEqual(['Publish hidden items', 'Unpublish', 'Delete']);
    expect(deepText(page.root.shadowRoot)).toContain('hidden from visitors');

    const clean = await mount(course({ is_author: true }));
    expect(buttons(clean)).toEqual(['Unpublish', 'Delete']);
  });

  it('deletes after confirming and returns to the shelf', async () => {
    const page = await mount(course({ is_author: true }));
    window.confirm = jest.fn(() => true);
    deleteCourse.mockResolvedValue(undefined);
    Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent === 'Delete').click();
    await page.waitForChanges();
    await page.waitForChanges();
    expect(deleteCourse).toHaveBeenCalledWith(3);
    expect(navigate).toHaveBeenCalledWith('/courses');
  });

  it('offers another teacher a branch, and opens the new branch once it exists', async () => {
    const page = await mount(course({ can_branch: true }));
    expect(buttons(page)).toEqual(['Branch this course']);
    expect(deepText(page.root.shadowRoot)).toContain('Branch it to get your own private copy');

    branchCourse.mockResolvedValue(course({ id: 8, is_author: true, visibility: 'private' }));
    window.confirm = jest.fn(() => true);
    page.root.shadowRoot.querySelector('button').click();
    await page.waitForChanges();
    await page.waitForChanges();
    expect(window.confirm).toHaveBeenCalledWith(expect.stringContaining('private'));
    expect(branchCourse).toHaveBeenCalledWith(3);
    expect(navigate).toHaveBeenCalledWith('/courses/8');
  });

  it('points a teacher who already branched at their branch, and does not branch on a cancelled confirm', async () => {
    const page = await mount(course({ can_branch: true, my_branch_id: 8 }));
    expect(page.root.shadowRoot.querySelector('a[href="/courses/8"]').textContent).toBe('Open your branch');
    expect(buttons(page)).toEqual(['Branch again']);
    window.confirm = jest.fn(() => false);
    page.root.shadowRoot.querySelector('button').click();
    await page.waitForChanges();
    expect(branchCourse).not.toHaveBeenCalled();
  });

  it('shows a branch where it came from, whose materials are shared, and links its own tests to their editor', async () => {
    const shared = guide(1, null);
    shared.material.author = { id: 9, name: 'Mr Original' };
    const page = await mount(course({
      is_author: true, visibility: 'private', author: { id: 1, name: 'Ms K' },
      branched_from: { id: 2, title: 'AP Biology', author: { id: 9, name: 'Mr Original' } },
      items: [shared, quiz(4, null, 'private')],
    }));
    const root = page.root.shadowRoot;
    const text = deepText(root);
    expect(root.querySelector('a[href="/courses/2"]').textContent).toBe('AP Biology');
    expect(text).toContain('by Mr Original');
    expect(text).toContain('from Mr Original');
    expect(text).toContain('This is your private branch');
    expect(text).not.toContain('Only you can see this course');
    expect(root.querySelector('a[href="/tests/4/edit"]').textContent).toBe('Edit questions');
  });

  it('loads the new course when the route moves to another one on the same element', async () => {
    const page = await mount(course());
    getCourse.mockResolvedValue(course({ id: 8, title: 'My branch', is_author: true, visibility: 'private' }));

    page.root.courseId = 8;
    await page.waitForChanges();
    await page.waitForChanges();

    expect(getCourse).toHaveBeenLastCalledWith(8);
    expect(page.root.shadowRoot.querySelector('h1').textContent).toBe('My branch');
  });

  it('renders not-found on a 404 and an empty state for an empty course', async () => {
    getCourse.mockRejectedValue(new ApiError(404, 'Not Found'));
    const missing = await newSpecPage({ components: [PageCourse], html: '<page-course course-id="3"></page-course>' });
    await missing.waitForChanges();
    expect(missing.root.shadowRoot.textContent).toContain('Course not found');

    const empty = await mount(course({ items: [], test_count: 0, material_count: 0, description: null }));
    expect(empty.root.shadowRoot.textContent).toContain('Nothing has been published in this course yet.');
  });
});
