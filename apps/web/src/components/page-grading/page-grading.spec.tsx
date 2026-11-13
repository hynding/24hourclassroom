import { h } from '@stencil/core';
import { newSpecPage } from '@stencil/core/testing';

const gradingQueue = jest.fn();
const getAttempt = jest.fn();
const gradeAnswer = jest.fn();
const recoverFromExpiredSession = jest.fn();

jest.mock('../../services/tests-store', () => ({
  testsStore: {
    gradingQueue: (...a: unknown[]) => gradingQueue(...a),
    getAttempt: (...a: unknown[]) => getAttempt(...a),
    gradeAnswer: (...a: unknown[]) => gradeAnswer(...a),
  },
}));

jest.mock('../../services/session-recovery', () => ({
  recoverFromExpiredSession: (...a: unknown[]) => recoverFromExpiredSession(...a),
}));

// Imported after jest.mock(): Stencil transpiles with ts.transpileModule.
import { PageGrading } from './page-grading';

const row = {
  id: 7, test_id: 3, assignment_id: 2, started_at: '2026-11-01T10:00:00Z', submitted_at: '2026-11-01T10:30:00Z',
  score: '1.00', max_score: '6.00', graded_at: null, ungraded_count: 1,
  student: { id: 40, name: 'Sam' }, test: { id: 3, title: 'Cells quiz' }, teacher: { id: 2, name: 'Ms A' },
};

const attempt = (awarded: number | null) => ({
  ...row,
  test: { id: 3, title: 'Cells quiz', subject: 'science', grade_level: '9-12' },
  ungraded_count: awarded === null ? 1 : 0,
  score: awarded === null ? '1.00' : String(1 + awarded),
  questions: [{
    id: 11, type: 'short_answer', prompt: 'Why?', points: 5, options: null, answer: 'Light', explanation: 'Accept light.',
    answer_id: 99, response: 'sun', awarded, graded_answer: { answer: 'Light', points: 5 },
  }],
});

describe('page-grading', () => {
  beforeEach(() => {
    gradingQueue.mockReset();
    getAttempt.mockReset();
    gradeAnswer.mockReset();
    recoverFromExpiredSession.mockReset().mockReturnValue(false);
  });

  const mount = () => newSpecPage({ components: [PageGrading], template: () => <page-grading></page-grading> });

  it('says so when nothing is waiting', async () => {
    gradingQueue.mockResolvedValue({ data: [], meta: { current_page: 1, last_page: 1, per_page: 20, total: 0 } });
    const page = await mount();
    expect(page.root.shadowRoot.textContent).toContain('Nothing is waiting for a grade.');
  });

  it('lists each attempt with its student, test and teacher, and grades one in place', async () => {
    gradingQueue.mockResolvedValue({ data: [row], meta: { current_page: 1, last_page: 1, per_page: 20, total: 1 } });
    getAttempt.mockResolvedValue(attempt(null));
    gradeAnswer.mockResolvedValue(attempt(4));

    const page = await mount();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Sam');
    expect(text).toContain('Cells quiz');
    expect(text).toContain('for Ms A');
    expect(text).toContain('1 to grade');

    await (page.rootInstance as PageGrading).open(7);
    await page.waitForChanges();
    expect(getAttempt).toHaveBeenCalledWith(7);
    expect(page.root.shadowRoot.textContent).toContain('What to accept');

    expect(page.root.shadowRoot.querySelectorAll('form.grade')).toHaveLength(1);
    await (page.rootInstance as PageGrading).grade(7, 99, 4);
    await page.waitForChanges();

    expect(gradeAnswer).toHaveBeenCalledWith(7, 99, 4);
    expect(page.root.shadowRoot.textContent).toContain('all graded');
  });
});
