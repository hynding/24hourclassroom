import { newSpecPage } from '@stencil/core/testing';

const listTests = jest.fn();
const myAssignments = jest.fn();
const myAttempts = jest.fn();
let currentUser: unknown = null;
jest.mock('../../services/tests-store', () => ({
  testsStore: {
    listTests: (...a: unknown[]) => listTests(...a),
    myAssignments: (...a: unknown[]) => myAssignments(...a),
    myAttempts: (...a: unknown[]) => myAttempts(...a),
  },
}));
// load() is what app-root leaves in flight while the route renders; these
// specs resolve it to `pending` so a component that reads the role without
// awaiting sees no user, exactly as it does in a browser on a hard load.
let pending: unknown = null;
const authLoad = jest.fn(async () => { currentUser = pending; return currentUser; });
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, load: () => authLoad() },
}));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTests } from './page-tests';

const mount = () => newSpecPage({ components: [PageTests], html: '<page-tests></page-tests>' });

describe('page-tests', () => {
  beforeEach(() => {
    listTests.mockReset(); myAssignments.mockReset(); myAttempts.mockReset(); authLoad.mockClear();
    currentUser = null;
    pending = null;
  });

  it('shows a teacher their own tests with a New button', async () => {
    pending = { id: 1, role: 'teacher' };
    listTests.mockResolvedValue({ data: [{ id: 3, title: 'Cells', subject: 'science', grade_level: '6-8', visibility: 'private', published_at: null, question_count: 4, assignment_count: 2, author: { id: 1, name: 'Me' } }], meta: { current_page: 1, last_page: 1, per_page: 15, total: 1 } });
    const page = await mount();
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('Cells');
    expect(page.root.shadowRoot.textContent).toContain('2 assigned');
    expect(page.root.shadowRoot.querySelector('a[href="/tests/new"]')).not.toBeNull();
    expect(myAssignments).not.toHaveBeenCalled();
    // The role has to come from the awaited load, not from whatever the
    // store happened to hold when app-root rendered the route.
    expect(authLoad).toHaveBeenCalled();
  });

  it('shows a student assigned tests and practice attempts', async () => {
    pending = { id: 2, role: 'student' };
    myAssignments.mockResolvedValue({ data: [{ id: 1, due_at: null, test: { id: 3, title: 'Cells', subject: 'science', grade_level: '6-8', question_count: 4, author: { id: 1, name: 'Ms K' } }, latest: null, best: { id: 9, score: '3.00', max_score: '4.00', ungraded_count: 0 } }] });
    myAttempts.mockResolvedValue({ data: [{ id: 12, test_id: 8, assignment_id: null, submitted_at: '2026-09-02', score: '1.00', max_score: '2.00', ungraded_count: 0, test: { id: 8, title: 'Volcanoes' } }] });
    const page = await mount();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Cells');
    expect(text).toContain('Best 3.00 / 4.00');
    expect(text).toContain('Volcanoes');
    expect(listTests).not.toHaveBeenCalled();
  });

  it('renders an empty state for any other role', async () => {
    pending = { id: 4, role: 'admin' };
    const page = await mount();
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('no tests');
    expect(listTests).not.toHaveBeenCalled();
    expect(myAssignments).not.toHaveBeenCalled();
  });

  it('shows the signed-out empty state only when the load really finds nobody', async () => {
    pending = null;
    const page = await mount();
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('no tests');
    expect(listTests).not.toHaveBeenCalled();
    expect(myAssignments).not.toHaveBeenCalled();
  });
});
