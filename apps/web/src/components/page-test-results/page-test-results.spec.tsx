import { newSpecPage } from '@stencil/core/testing';

const getTest = jest.fn();
const listTestAttempts = jest.fn();
const getAttempt = jest.fn();
const gradeAnswer = jest.fn();
jest.mock('../../services/tests-store', () => ({
  testsStore: {
    getTest: (...a: unknown[]) => getTest(...a),
    listTestAttempts: (...a: unknown[]) => listTestAttempts(...a),
    getAttempt: (...a: unknown[]) => getAttempt(...a),
    gradeAnswer: (...a: unknown[]) => gradeAnswer(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTestResults } from './page-test-results';

const summary = (id: number, score: string, ungraded = 0) => ({ id, test_id: 5, assignment_id: 9, started_at: '', submitted_at: '2026-09-02T10:00:00Z', score, max_score: '4.00', graded_at: ungraded ? null : '2026-09-02', ungraded_count: ungraded });

describe('page-test-results', () => {
  beforeEach(() => { getAttempt.mockReset(); gradeAnswer.mockReset(); });

  it('shows one row per student with latest and best, and expands to grade a short answer', async () => {
    getTest.mockResolvedValue({ id: 5, title: 'Cells', is_author: true, questions: [] });
    listTestAttempts.mockResolvedValue({ data: [{ assignment_id: 9, student: { id: 20, name: 'Sam' }, due_at: null, attempts: [summary(2, '3.00', 1), summary(1, '4.00')], latest: summary(2, '3.00', 1), best: summary(1, '4.00') }], meta: { current_page: 1, last_page: 1, per_page: 15, total: 1 } });
    getAttempt.mockResolvedValue({ ...summary(2, '3.00', 1), student: { id: 20, name: 'Sam' }, test: { id: 5, title: 'Cells' }, questions: [
      { id: 10, position: 0, type: 'short_answer', prompt: 'Why?', options: null, points: 2, partial_credit: false, answer: 'because', response: 'since', answer_id: 55, awarded: null, graded_answer: { answer: 'because', points: 2 } },
    ] });
    gradeAnswer.mockResolvedValue({ ...summary(2, '4.50'), student: { id: 20, name: 'Sam' }, test: { id: 5, title: 'Cells' }, questions: [] });

    const page = await newSpecPage({ components: [PageTestResults], html: '<page-test-results test-id="5"></page-test-results>' });
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Sam');
    expect(text).toContain('Latest 3.00 / 4.00 (1 to grade)');
    expect(text).toContain('Best 4.00 / 4.00');

    const cmp = page.rootInstance as PageTestResults;
    await cmp.open(2);
    await page.waitForChanges();
    expect(getAttempt).toHaveBeenCalledWith(2);
    expect(page.root.shadowRoot.textContent).toContain('since');
    expect(page.root.shadowRoot.textContent).toContain('because');

    await cmp.grade(2, 55, 1.5);
    expect(gradeAnswer).toHaveBeenCalledWith(2, 55, 1.5);
  });
});
