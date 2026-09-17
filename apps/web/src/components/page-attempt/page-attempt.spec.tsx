import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getAttempt = jest.fn();
const saveAttempt = jest.fn();
const submitAttempt = jest.fn();
jest.mock('../../services/tests-store', () => ({
  testsStore: { getAttempt: (...a: unknown[]) => getAttempt(...a), saveAttempt: (...a: unknown[]) => saveAttempt(...a), submitAttempt: (...a: unknown[]) => submitAttempt(...a) },
}));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageAttempt } from './page-attempt';

const open = {
  id: 7, test_id: 5, assignment_id: null, started_at: '', submitted_at: null, score: null, max_score: null, graded_at: null, ungraded_count: 0,
  student: { id: 3, name: 'Sam' }, test: { id: 5, title: 'Cells', subject: 'science', grade_level: '6-8' },
  questions: [
    { id: 10, position: 0, type: 'multiple_choice', prompt: 'Powerhouse?', options: ['Nucleus', 'Mitochondria'], points: 1, partial_credit: false, response: null },
    { id: 11, position: 1, type: 'multi_select', prompt: 'Organelles?', options: ['Ribosome', 'Car', 'Golgi'], points: 2, partial_credit: true, response: [0] },
    { id: 12, position: 2, type: 'true_false', prompt: 'Cells divide.', options: null, points: 1, partial_credit: false, response: null },
    { id: 13, position: 3, type: 'short_answer', prompt: 'Why?', options: null, points: 2, partial_credit: false, response: 'energy' },
    { id: 14, position: 4, type: 'numeric', prompt: 'How many?', options: null, points: 1, partial_credit: false, response: null },
  ],
};

const mount = async (attempt: unknown) => {
  getAttempt.mockResolvedValue(attempt);
  const page = await newSpecPage({ components: [PageAttempt], html: '<page-attempt attempt-id="7"></page-attempt>' });
  await page.waitForChanges();
  return page;
};

describe('page-attempt', () => {
  // Fake timers are switched on AFTER mount in the tests that need them:
  // newSpecPage/waitForChanges must run on real timers.
  beforeEach(() => { getAttempt.mockReset(); saveAttempt.mockReset().mockResolvedValue(open); submitAttempt.mockReset(); });
  afterEach(() => jest.useRealTimers());

  it('renders one input per type with saved responses and never shows answers', async () => {
    const page = await mount(open);
    const root = page.root.shadowRoot;
    expect(root.querySelectorAll('input[type="radio"]')).toHaveLength(2 + 2); // MC + true/false
    expect(root.querySelectorAll('input[type="checkbox"]')).toHaveLength(3);
    expect((root.querySelector('input[type="checkbox"]') as HTMLInputElement).checked).toBe(true);
    expect((root.querySelector('input[type="text"]') as HTMLInputElement).value).toBe('energy');
    expect(root.querySelector('input[type="number"]')).not.toBeNull();
    expect(root.textContent).not.toContain('Correct answer');
  });

  it('debounces autosave 2s after the last change and sends every response', async () => {
    const page = await mount(open);
    jest.useFakeTimers();
    const cmp = page.rootInstance as PageAttempt;
    cmp.setResponse(10, 1);
    cmp.setResponse(14, 4);
    jest.advanceTimersByTime(1500);
    expect(saveAttempt).not.toHaveBeenCalled();
    jest.advanceTimersByTime(600);
    expect(saveAttempt).toHaveBeenCalledTimes(1);
    expect(saveAttempt).toHaveBeenCalledWith(7, { 10: 1, 11: [0], 13: 'energy', 14: 4 });
  });

  it('swallows a 429 on autosave and retries on the next change', async () => {
    saveAttempt.mockRejectedValueOnce(new ApiError(429, 'slow down')).mockResolvedValue(open);
    const page = await mount(open);
    jest.useFakeTimers();
    const cmp = page.rootInstance as PageAttempt;
    cmp.setResponse(10, 0);
    jest.advanceTimersByTime(2100);
    await Promise.resolve();
    expect(page.root.shadowRoot.textContent).not.toContain('slow down');
    cmp.setResponse(10, 1);
    jest.advanceTimersByTime(2100);
    expect(saveAttempt).toHaveBeenCalledTimes(2);
  });

  it('submits after a flush and renders the review with answers and explanations', async () => {
    const submitted = { ...open, submitted_at: '2026-09-02', score: '2.00', max_score: '7.00', ungraded_count: 1, questions: [
      { ...open.questions[0], response: 1, answer: 1, explanation: 'ATP.', answer_id: 1, awarded: '1.00', graded_answer: { answer: 1, points: 1 } },
      { ...open.questions[3], response: 'energy', answer: 'ATP', answer_id: 2, awarded: null, graded_answer: { answer: 'ATP', points: 2 } },
    ] };
    submitAttempt.mockResolvedValue(submitted);
    const page = await mount(open);
    // Stencil's newSpecPage resets the mock window (win.close()), which
    // strips any override set before mount -- so confirm is stubbed after.
    window.confirm = () => true;
    const cmp = page.rootInstance as PageAttempt;
    cmp.setResponse(10, 1);
    await cmp.submit();
    await page.waitForChanges();
    expect(saveAttempt).toHaveBeenCalledTimes(1);
    expect(submitAttempt).toHaveBeenCalledWith(7);
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('2.00 / 7.00');
    expect(text).toContain('1 answer awaiting grading');
    expect(text).toContain('ATP.');
    expect(text).toContain('Correct answer: ATP');
  });

  it('reloads the attempt on a 409 submit', async () => {
    submitAttempt.mockRejectedValue(new ApiError(409, 'already'));
    const page = await mount(open);
    // See the note in the previous test: confirm must be stubbed after mount.
    window.confirm = () => true;
    getAttempt.mockResolvedValue({ ...open, submitted_at: '2026-09-02', score: '1.00', max_score: '7.00', questions: [] });
    await (page.rootInstance as PageAttempt).submit();
    expect(getAttempt).toHaveBeenCalledTimes(2);
  });
});
