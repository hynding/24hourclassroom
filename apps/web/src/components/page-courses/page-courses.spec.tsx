import { newSpecPage } from '@stencil/core/testing';

const listCourses = jest.fn();
let currentUser: unknown = null;
jest.mock('../../services/courses-store', () => ({ coursesStore: { listCourses: (...a: unknown[]) => listCourses(...a) } }));
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, load: async () => currentUser },
}));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageCourses } from './page-courses';

const mount = async () => {
  const page = await newSpecPage({ components: [PageCourses], html: '<page-courses></page-courses>' });
  await page.waitForChanges();
  return page;
};

describe('page-courses', () => {
  beforeEach(() => {
    listCourses.mockReset();
    currentUser = null;
  });

  it('lists a teacher\'s own courses with visibility and counts', async () => {
    currentUser = { id: 1, role: 'teacher' };
    listCourses.mockResolvedValue({
      data: [{ id: 3, title: 'Biology', subject: 'science', grade_level: '9-12', visibility: 'private', published_at: null, test_count: 1, material_count: 2, author: { id: 1, name: 'Ms K' } }],
      meta: { current_page: 1, last_page: 1, per_page: 15, total: 1 },
    });
    const page = await mount();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Private · 1 test · 2 materials');
    expect(page.root.shadowRoot.querySelector('a[href="/courses/3"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/courses/new"]')).not.toBeNull();
  });

  it('points every other role at the library without asking the API for a shelf', async () => {
    for (const role of ['student', 'admin']) {
      currentUser = { id: 1, role };
      const page = await mount();
      expect(page.root.shadowRoot.querySelector('a[href="/library/courses"]')).not.toBeNull();
    }
    expect(listCourses).not.toHaveBeenCalled();
  });
});
