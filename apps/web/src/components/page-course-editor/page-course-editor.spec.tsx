import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getCourse = jest.fn();
const courseCandidates = jest.fn();
const createCourse = jest.fn();
const updateCourse = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/courses-store', () => ({
  coursesStore: {
    getCourse: (...a: unknown[]) => getCourse(...a),
    courseCandidates: (...a: unknown[]) => courseCandidates(...a),
    createCourse: (...a: unknown[]) => createCourse(...a),
    updateCourse: (...a: unknown[]) => updateCourse(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageCourseEditor } from './page-course-editor';

const candidates = {
  tests: [{ id: 5, title: 'Cells quiz', visibility: 'private', question_count: 4 }, { id: 6, title: 'Draft', visibility: 'private', question_count: 0 }],
  materials: [{ id: 7, title: 'Cells guide', visibility: 'public', original_name: 'guide.md' }],
};
const existing = {
  id: 3, title: 'Biology', subject: 'science', grade_level: '9-12', visibility: 'public', published_at: '2026-09-01',
  test_count: 1, material_count: 0, author: { id: 1, name: 'Ms K' }, description: 'A term.', created_at: '', updated_at: '', is_author: true,
  branched_from: null, can_branch: false, my_branch_id: null,
  items: [{ id: 30, position: 0, section: 'Unit 1', kind: 'test', test: { id: 5, title: 'Cells quiz', visibility: 'public', question_count: 4 } }],
};
const mount = async (attrs = '') => {
  const page = await newSpecPage({ components: [PageCourseEditor], html: `<page-course-editor ${attrs}></page-course-editor>` });
  await page.waitForChanges();
  return page;
};
const options = (page: Awaited<ReturnType<typeof mount>>) =>
  Array.from(page.root.shadowRoot.querySelectorAll('[data-testid="pick"] option')).map((o) => o.getAttribute('value'));

describe('page-course-editor', () => {
  beforeEach(() => {
    [getCourse, courseCandidates, createCourse, updateCourse, navigate].forEach((m) => m.mockReset());
    courseCandidates.mockResolvedValue(candidates);
  });

  it('builds a new course from the candidates, under the section typed for the next item, and creates it', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageCourseEditor;
    expect(options(page)).toEqual(['', 'test:5', 'test:6', 'material:7']);
    expect(page.root.shadowRoot.textContent).toContain('Draft (no questions)');

    cmp.title = 'Biology';
    cmp.subject = 'science';
    cmp.grade = '9-12';
    cmp.nextSection = 'Unit 1';
    cmp.pick = 'material:7';
    cmp.add();
    cmp.pick = 'test:5';
    cmp.add();
    await page.waitForChanges();

    // Added items leave the picker; the rows show what was added.
    expect(options(page)).toEqual(['', 'test:6']);
    expect(Array.from(page.root.shadowRoot.querySelectorAll('.item .title')).map((t) => t.textContent)).toEqual(['Cells guide', 'Cells quiz']);

    createCourse.mockResolvedValue({ id: 4 });
    await cmp.save();
    expect(createCourse).toHaveBeenCalledWith({
      title: 'Biology', description: null, subject: 'science', grade_level: '9-12',
      items: [{ kind: 'material', id: 7, section: 'Unit 1' }, { kind: 'test', id: 5, section: 'Unit 1' }],
    });
    expect(navigate).toHaveBeenCalledWith('/courses/4');
  });

  it('loads an existing course, reorders and removes rows, and saves with blank sections as null', async () => {
    getCourse.mockResolvedValue(existing);
    const page = await mount('course-id="3"');
    const cmp = page.rootInstance as PageCourseEditor;
    expect(cmp.title).toBe('Biology');
    expect(page.root.shadowRoot.textContent).toContain('This course is public: anything you add is published with it.');
    expect(cmp.nextSection).toBe('Unit 1');

    cmp.nextSection = '  ';
    cmp.pick = 'test:6';
    cmp.add();
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('Private: published when you save');

    page.root.shadowRoot.querySelector<HTMLButtonElement>('button[aria-label="Move Draft up"]').click();
    await page.waitForChanges();
    expect(cmp.items.map((i) => i.id)).toEqual([6, 5]);

    updateCourse.mockResolvedValue({ id: 3 });
    await cmp.save();
    expect(updateCourse).toHaveBeenCalledWith(3, expect.objectContaining({
      items: [{ kind: 'test', id: 6, section: null }, { kind: 'test', id: 5, section: 'Unit 1' }],
    }));

    page.root.shadowRoot.querySelector<HTMLButtonElement>('button[aria-label="Remove Draft"]').click();
    await page.waitForChanges();
    expect(cmp.items.map((i) => i.id)).toEqual([5]);
  });

  it('marks a branch\'s shared material, labels only newly added items as published on save, and keeps both in the body', async () => {
    getCourse.mockResolvedValue({
      ...existing,
      items: [
        { id: 31, position: 0, section: null, kind: 'material', material: { id: 70, title: 'Original reading', visibility: 'public', original_name: 'r.md', mime_type: 'text/plain', size_bytes: 9, author: { id: 9, name: 'Mr Original' } } },
        { id: 32, position: 1, section: null, kind: 'test', test: { id: 6, title: 'Draft', visibility: 'private', question_count: 0 } },
      ],
    });
    courseCandidates.mockResolvedValue({ ...candidates, tests: [...candidates.tests, { id: 8, title: 'Fresh', visibility: 'private', question_count: 2 }] });
    const page = await mount('course-id="3"');
    const cmp = page.rootInstance as PageCourseEditor;
    cmp.pick = 'test:8';
    cmp.add();
    await page.waitForChanges();

    const metas = Array.from(page.root.shadowRoot.querySelectorAll('.item .what')).map((w) => w.textContent);
    expect(metas[0]).toContain("From Mr Original's original");
    expect(metas[1]).toContain('Private');
    expect(metas[1]).not.toContain('published when you save');
    expect(metas[2]).toContain('Private: published when you save');

    updateCourse.mockResolvedValue({ id: 3 });
    await cmp.save();
    expect(updateCourse.mock.calls[0][1].items).toEqual([
      { kind: 'material', id: 70, section: null }, { kind: 'test', id: 6, section: null }, { kind: 'test', id: 8, section: null },
    ]);
  });

  it('shows the server\'s per-item errors beside the row', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageCourseEditor;
    cmp.pick = 'test:5';
    cmp.add();
    createCourse.mockRejectedValue(new ApiError(422, 'Invalid', { 'items.0.id': ['Choose one of your own tests.'] }));

    await cmp.save();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('Please fix the highlighted fields.');
    expect(page.root.shadowRoot.querySelector('.item .error').textContent).toBe('Choose one of your own tests.');
    expect(navigate).not.toHaveBeenCalled();
  });

  it('sends a non-author back to the course page and paints nothing', async () => {
    getCourse.mockResolvedValue({ ...existing, is_author: false });
    const page = await mount('course-id="3"');
    expect(navigate).toHaveBeenCalledWith('/courses/3');
    expect(page.root.shadowRoot.innerHTML).toBe('');
    expect(courseCandidates).not.toHaveBeenCalled();
  });
});
