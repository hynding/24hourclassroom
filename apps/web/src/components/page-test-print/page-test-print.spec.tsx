import { newSpecPage } from '@stencil/core/testing';

const getTest = jest.fn();
jest.mock('../../services/tests-store', () => ({ testsStore: { getTest: (...a: unknown[]) => getTest(...a) } }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTestPrint } from './page-test-print';

const test = {
  id: 5, title: 'Cells', description: 'Answer every question.', subject: 'science', grade_level: '6-8', visibility: 'public', published_at: '', copied_from_id: null,
  question_count: 3, author: { id: 1, name: 'Ms K' }, created_at: '', updated_at: '', is_author: false, assignment: null, open_attempt_id: null, can_copy: false,
  questions: [
    { id: 10, position: 0, type: 'multiple_choice', prompt: 'Powerhouse?', options: ['Nucleus', 'Mitochondria'], points: 1, partial_credit: false },
    { id: 11, position: 1, type: 'short_answer', prompt: 'Why?', options: null, points: 2, partial_credit: false },
    { id: 12, position: 2, type: 'numeric', prompt: 'How many?', options: null, points: 1, partial_credit: false },
  ],
};

const mount = async (view: unknown, url = 'http://testing.stenciljs.com/tests/5/print') => {
  getTest.mockResolvedValue(view);
  const page = await newSpecPage({ components: [PageTestPrint], html: '<page-test-print test-id="5"></page-test-print>', url });
  await page.waitForChanges();
  return page;
};

describe('page-test-print', () => {
  it('renders title, instructions, numbered questions, options, and answer lines, with no key', async () => {
    const page = await mount(test);
    const root = page.root.shadowRoot;
    expect(root.textContent).toContain('Cells');
    expect(root.textContent).toContain('Answer every question.');
    expect(root.textContent).toContain('Mitochondria');
    expect(root.querySelectorAll('.answer-line')).toHaveLength(2);
    expect(root.querySelector('.key')).toBeNull();
  });

  it('adds the answer key only when ?key=1 and the payload carries answers', async () => {
    const withAnswers = { ...test, is_author: true, questions: test.questions.map((q, i) => ({ ...q, answer: i === 0 ? 1 : i === 1 ? 'ATP' : { value: 2, tolerance: 0 } })) };
    const keyed = await mount(withAnswers, 'http://testing.stenciljs.com/tests/5/print?key=1');
    expect(keyed.root.shadowRoot.querySelector('.key').textContent).toContain('B');
    expect(keyed.root.shadowRoot.querySelector('.key').textContent).toContain('ATP');

    const noAnswers = await mount(test, 'http://testing.stenciljs.com/tests/5/print?key=1');
    expect(noAnswers.root.shadowRoot.querySelector('.key')).toBeNull();
  });
});
