import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getCourse = jest.fn();
const publishCourse = jest.fn();
const unpublishCourse = jest.fn();
const deleteCourse = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/courses-store', () => ({
  coursesStore: {
    getCourse: (...a: unknown[]) => getCourse(...a),
    publishCourse: (...a: unknown[]) => publishCourse(...a),
    unpublishCourse: (...a: unknown[]) => unpublishCourse(...a),
    deleteCourse: (...a: unknown[]) => deleteCourse(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

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
  material: { id, title: `AP Biology · Week 0${id} · Study Guide`, visibility: 'public', original_name: 'guide.md', mime_type: 'text/plain', size_bytes: 900 },
});
const course = (over: Record<string, unknown> = {}) => ({
  id: 3, title: 'AP Biology', subject: 'science', grade_level: '9-12', visibility: 'public', published_at: '2026-09-01',
  test_count: 2, material_count: 1, author: { id: 1, name: 'Ms K' }, description: 'A full year.', created_at: '', updated_at: '',
  is_author: false,
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
    [getCourse, publishCourse, unpublishCourse, deleteCourse, navigate].forEach((m) => m.mockReset());
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

  it('renders not-found on a 404 and an empty state for an empty course', async () => {
    getCourse.mockRejectedValue(new ApiError(404, 'Not Found'));
    const missing = await newSpecPage({ components: [PageCourse], html: '<page-course course-id="3"></page-course>' });
    await missing.waitForChanges();
    expect(missing.root.shadowRoot.textContent).toContain('Course not found');

    const empty = await mount(course({ items: [], test_count: 0, material_count: 0, description: null }));
    expect(empty.root.shadowRoot.textContent).toContain('Nothing has been published in this course yet.');
  });
});
