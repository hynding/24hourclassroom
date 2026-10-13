import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getPracticeTest = jest.fn();
const checkPractice = jest.fn();
jest.mock('../../services/courses-store', () => ({
  coursesStore: {
    getPracticeTest: (...a: unknown[]) => getPracticeTest(...a),
    checkPractice: (...a: unknown[]) => checkPractice(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageCoursePractice } from './page-course-practice';
import { RichText } from '../rich-text/rich-text';

const deepText = (node: Node): string => {
  if (node.nodeType === 3) {
    return node.textContent ?? '';
  }
  const root = (node as Element).shadowRoot ?? node;
  return Array.from(root.childNodes).map(deepText).join('');
};

const practice = {
  id: 9, title: 'AP Biology · Week 01 · Quiz · Water', description: null, subject: 'science', grade_level: '9-12', visibility: 'public',
  published_at: '2026-09-01', copied_from_id: null, question_count: 3, author: { id: 1, name: 'Ms K' }, created_at: '', updated_at: '',
  course: { id: 3, title: 'AP Biology', author: { id: 1, name: 'Ms K' } },
  questions: [
    {
      id: 10, position: 0, type: 'multiple_choice', prompt: 'Powerhouse?', stimulus: null, options: ['Nucleus', 'Mitochondria'], points: 2,
      partial_credit: false, auto_grade: true, answer: 1, explanation: 'Makes ATP.', option_explanations: ['Holds DNA.', 'Right: respiration happens here.'],
    },
    { id: 11, position: 1, type: 'true_false', prompt: 'Cells divide.', stimulus: null, options: null, points: 1, partial_credit: false, auto_grade: true, answer: true, explanation: null },
    { id: 12, position: 2, type: 'short_answer', prompt: 'Why?', stimulus: null, options: null, points: 3, partial_credit: false, auto_grade: true, answer: 'Energy.', explanation: null },
  ],
};

const mount = async (view: unknown = practice) => {
  getPracticeTest.mockResolvedValue(view);
  const page = await newSpecPage({ components: [PageCoursePractice, RichText], html: '<page-course-practice course-id="3" test-id="9"></page-course-practice>' });
  await page.waitForChanges();
  return page;
};
const button = (page: Awaited<ReturnType<typeof mount>>, label: string) =>
  Array.from(page.root.shadowRoot.querySelectorAll('button')).filter((b) => b.textContent === label);

describe('page-course-practice', () => {
  beforeEach(() => {
    getPracticeTest.mockReset();
    checkPractice.mockReset();
  });

  it('loads the course-scoped test with an input and a Show answer button per question, and no answers on screen', async () => {
    const page = await mount();
    const text = deepText(page.root.shadowRoot);

    expect(getPracticeTest).toHaveBeenCalledWith(3, 9);
    expect(text).toContain('Week 01 · Quiz · Water');
    expect(page.root.shadowRoot.querySelector('a[href="/courses/3"]').textContent).toBe('AP Biology');
    expect(text).toContain('nothing is saved');
    expect(page.root.shadowRoot.querySelectorAll('input[type="radio"]')).toHaveLength(4);
    expect(button(page, 'Show answer')).toHaveLength(3);
    expect(text).not.toContain('Makes ATP.');
    expect(text).not.toContain('(correct)');
  });

  it('reveals one answer at a time, with its rationales and explanation, and hides it again', async () => {
    const page = await mount();
    button(page, 'Show answer')[0].click();
    await page.waitForChanges();

    const text = deepText(page.root.shadowRoot);
    expect(text).toContain('Mitochondria (correct)');
    expect(text).toContain('Right: respiration happens here.');
    expect(text).toContain('Makes ATP.');
    expect(text).not.toContain('Correct answer: True');
    const reveal = button(page, 'Hide answer')[0];
    expect(reveal.getAttribute('aria-expanded')).toBe('true');
    expect(reveal.getAttribute('aria-controls')).toBe('key-10');
    expect(page.root.shadowRoot.querySelector('#key-10')).not.toBeNull();

    reveal.click();
    await page.waitForChanges();
    expect(deepText(page.root.shadowRoot)).not.toContain('Makes ATP.');
    expect(button(page, 'Show answer')).toHaveLength(3);
  });

  it('finishes with one check of the responses, then shows the score, every answer and each mark', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageCoursePractice;
    cmp.setResponse(10, 0);
    cmp.setResponse(11, true);
    cmp.toggleReveal(11);
    await page.waitForChanges();
    checkPractice.mockResolvedValue({
      score: 1, max_score: 6, ungraded_count: 1,
      results: [{ question_id: 10, awarded: 0, points: 2 }, { question_id: 11, awarded: 1, points: 1 }, { question_id: 12, awarded: null, points: 3 }],
    });

    button(page, 'Finish and see results')[0].click();
    await page.waitForChanges();
    await page.waitForChanges();

    expect(checkPractice).toHaveBeenCalledWith(3, 9, { 10: 0, 11: true });
    const root = page.root.shadowRoot;
    const text = deepText(root);
    expect(root.querySelector('[role="status"]').textContent).toContain('You scored 1 / 6');
    expect(text).toContain('1 answer is not marked automatically');
    expect(text).toContain('Nucleus (your answer)');
    expect(text).toContain('Mitochondria (correct)');
    expect(text).toContain('Correct answer: True');
    expect(text).toContain('answer shown before finishing');
    expect(text).toContain('Your answer:(skipped)');
    expect(text).toContain('Correct answer: Energy.');
    expect(text).toContain('compare your answer with the one above');
    expect(Array.from(root.querySelectorAll('.questions > li')).map((li) => li.className)).toEqual(['wrong', 'right', 'self']);
    // Finished: no inputs and no reveal buttons, just the way back in.
    expect(root.querySelectorAll('input')).toHaveLength(0);
    expect(button(page, 'Show answer')).toHaveLength(0);

    button(page, 'Try again')[0].click();
    await page.waitForChanges();
    expect(cmp.responses).toEqual({});
    expect(cmp.revealed).toEqual({});
    expect(button(page, 'Show answer')).toHaveLength(3);
    expect(root.querySelector('[role="status"]')).toBeNull();
  });

  it('keeps the run when the check fails, and says why', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageCoursePractice;
    cmp.setResponse(10, 1);
    checkPractice.mockRejectedValue(new ApiError(500, 'Server Error'));

    await cmp.finish();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('We could not check your answers');
    expect(cmp.responses).toEqual({ 10: 1 });
    expect(button(page, 'Finish and see results')).toHaveLength(1);
  });

  it('is not available when the course or test is hidden, at load or by the time of the check', async () => {
    getPracticeTest.mockRejectedValue(new ApiError(404, 'Not Found'));
    const hidden = await newSpecPage({ components: [PageCoursePractice], html: '<page-course-practice course-id="3" test-id="9"></page-course-practice>' });
    await hidden.waitForChanges();
    expect(hidden.root.shadowRoot.textContent).toContain('Practice not available');

    const page = await mount();
    checkPractice.mockRejectedValue(new ApiError(404, 'Not Found'));
    await (page.rootInstance as PageCoursePractice).finish();
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('Practice not available');
  });
});
