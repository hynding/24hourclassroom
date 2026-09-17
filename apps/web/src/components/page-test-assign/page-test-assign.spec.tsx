import { newSpecPage } from '@stencil/core/testing';

const connections = jest.fn();
const getTest = jest.fn();
const listAssignments = jest.fn();
const assignTest = jest.fn();
const unassign = jest.fn();
jest.mock('../../services/profile-store', () => ({ profileStore: { connections: (...a: unknown[]) => connections(...a) } }));
jest.mock('../../services/tests-store', () => ({
  testsStore: {
    getTest: (...a: unknown[]) => getTest(...a),
    listAssignments: (...a: unknown[]) => listAssignments(...a),
    assignTest: (...a: unknown[]) => assignTest(...a),
    unassign: (...a: unknown[]) => unassign(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTestAssign } from './page-test-assign';

const mount = async () => {
  getTest.mockResolvedValue({ id: 5, title: 'Cells', is_author: true, questions: [] });
  connections.mockResolvedValue({ data: [
    { id: 1, user: { id: 20, name: 'Sam', role: 'student' } },
    { id: 2, user: { id: 21, name: 'Ms Other', role: 'teacher' } },
    { id: 3, user: { id: 22, name: 'Ali', role: 'student' } },
  ] });
  listAssignments.mockResolvedValue({ data: [{ id: 9, student: { id: 22, name: 'Ali' }, due_at: null, latest: null, best: null }] });
  const page = await newSpecPage({ components: [PageTestAssign], html: '<page-test-assign test-id="5"></page-test-assign>' });
  await page.waitForChanges();
  return page;
};

describe('page-test-assign', () => {
  beforeEach(() => { assignTest.mockReset(); unassign.mockReset(); listAssignments.mockClear(); });

  it('lists only student connections that are not yet assigned, and current assignments', async () => {
    const page = await mount();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Sam');
    expect(text).not.toContain('Ms Other');
    expect(page.root.shadowRoot.querySelectorAll('input[type="checkbox"]')).toHaveLength(1);
    expect(text).toContain('Ali'); // already assigned, in the assigned list
  });

  it('assigns the checked students and shows per-id results', async () => {
    assignTest.mockResolvedValue({ results: [{ id: 20, status: 'assigned' }] });
    const page = await mount();
    const cmp = page.rootInstance as PageTestAssign;
    cmp.selected = new Set([20]);
    cmp.dueAt = '2026-10-01';
    await cmp.assign();
    await page.waitForChanges();
    expect(assignTest).toHaveBeenCalledWith(5, [20], '2026-10-01');
    expect(page.root.shadowRoot.textContent).toContain('1 assigned');
    expect(listAssignments).toHaveBeenCalledTimes(2);
  });

  it('unassigns from the assigned list', async () => {
    unassign.mockResolvedValue(undefined);
    const page = await mount();
    const cmp = page.rootInstance as PageTestAssign;
    await cmp.remove(9);
    expect(unassign).toHaveBeenCalledWith(5, 9);
  });
});
