import { newSpecPage } from '@stencil/core/testing';

const getTest = jest.fn();
jest.mock('../../services/tests-store', () => ({ testsStore: { getTest: (...a: unknown[]) => getTest(...a) } }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTestPrint } from './page-test-print';
import { RichText } from '../rich-text/rich-text';

// Text across shadow boundaries: a parent's `shadowRoot.textContent` stops
// at a child's shadow root, and every prompt now renders inside <rich-text>.
const deepText = (node: Node): string => {
  if (node.nodeType === 3) {
    return node.textContent ?? '';
  }
  const root = (node as Element).shadowRoot ?? node;
  return Array.from(root.childNodes).map(deepText).join('');
};

const test = {
  id: 5, title: 'Cells', description: 'Answer every question.', subject: 'science', grade_level: '6-8', visibility: 'public', published_at: '', copied_from_id: null,
  question_count: 4, author: { id: 1, name: 'Ms K' }, created_at: '', updated_at: '', is_author: false, assignment: null, open_attempt_id: null, can_copy: false,
  questions: [
    { id: 10, position: 0, type: 'multiple_choice', prompt: 'Powerhouse?', options: ['Nucleus', 'Mitochondria'], points: 1, partial_credit: false },
    { id: 11, position: 1, type: 'short_answer', prompt: 'Why?', options: null, points: 2, partial_credit: false },
    { id: 12, position: 2, type: 'numeric', prompt: 'How many?', options: null, points: 1, partial_credit: false },
    { id: 13, position: 3, type: 'true_false', prompt: 'Cells divide.', options: null, points: 1, partial_credit: false },
  ],
};

const mount = async (view: unknown, url = 'http://testing.stenciljs.com/tests/5/print') => {
  getTest.mockResolvedValue(view);
  const page = await newSpecPage({ components: [PageTestPrint, RichText], html: '<page-test-print test-id="5"></page-test-print>', url });
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
    expect(deepText(root)).toContain('Powerhouse?');
    expect(root.querySelectorAll('.answer-line')).toHaveLength(2);
    expect(root.querySelector('.stimulus')).toBeNull();
    expect(root.querySelector('.answer-block')).toBeNull();
    expect(root.textContent).toContain('☐ True');
    expect(root.textContent).toContain('☐ False');
    expect(root.textContent).not.toContain('&nbsp;');
    expect(root.querySelector('.key')).toBeNull();
  });

  it('adds the answer key only when ?key=1 and the payload carries answers', async () => {
    const withAnswers = {
      ...test,
      is_author: true,
      questions: test.questions.map((q, i) => ({
        ...q,
        answer: i === 0 ? 1 : i === 1 ? 'ATP' : i === 2 ? { value: 2, tolerance: 0 } : true,
      })),
    };
    const keyed = await mount(withAnswers, 'http://testing.stenciljs.com/tests/5/print?key=1');
    expect(keyed.root.shadowRoot.querySelector('.key').textContent).toContain('B');
    expect(keyed.root.shadowRoot.querySelector('.key').textContent).toContain('ATP');
    expect(keyed.root.shadowRoot.querySelector('.key').textContent).toContain('True');

    const noAnswers = await mount(test, 'http://testing.stenciljs.com/tests/5/print?key=1');
    expect(noAnswers.root.shadowRoot.querySelector('.key')).toBeNull();
  });

  const withNewTypes = {
    ...test,
    questions: [
      { id: 20, position: 0, type: 'fill_blank', prompt: 'The ____ makes ATP.', stimulus: '| Trial | O₂ |\n|---|---|\n| 1 | 4 |', options: null, points: 1, partial_credit: false, auto_grade: true },
      { id: 21, position: 1, type: 'long_answer', prompt: 'Explain the data.', stimulus: '| Trial | O₂ |\n|---|---|\n| 1 | 4 |', options: null, points: 6, partial_credit: false, auto_grade: true },
      { id: 22, position: 2, type: 'short_answer', prompt: 'Why?', stimulus: null, options: null, points: 2, partial_credit: false, auto_grade: true },
    ],
  };

  it('prints a shared stimulus once as a table, ruled lines for a long answer and nothing extra for a blank', async () => {
    const page = await mount(withNewTypes);
    const root = page.root.shadowRoot;
    const stimuli = root.querySelectorAll('.stimulus');
    expect(stimuli).toHaveLength(1);
    expect(stimuli[0].querySelector('rich-text').shadowRoot.querySelector('table')).not.toBeNull();
    expect(root.querySelectorAll('.answer-block')).toHaveLength(1);
    expect(root.querySelectorAll('.answer-block .rule')).toHaveLength(8);
    expect(root.querySelectorAll('.answer-line')).toHaveLength(1); // the short answer only
    expect(deepText(root)).toContain('The ____ makes ATP.');
  });

  it('keys a blank on its canonical accepted answer and a long answer on its model answer', async () => {
    const keyed = await mount({
      ...withNewTypes,
      is_author: true,
      questions: withNewTypes.questions.map((q, i) => ({ ...q, answer: i === 0 ? ['mitochondria', 'mitochondrion'] : i === 1 ? 'A model answer.' : 'ATP' })),
    }, 'http://testing.stenciljs.com/tests/5/print?key=1');
    const items = keyed.root.shadowRoot.querySelectorAll('.key li');
    expect(items).toHaveLength(3);
    expect(items[0].textContent).toBe('mitochondria');
    expect(items[1].textContent).toBe('A model answer.');
    expect(items[2].textContent).toBe('ATP');
  });
});
