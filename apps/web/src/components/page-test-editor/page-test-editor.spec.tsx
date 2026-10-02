import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getTest = jest.fn();
const createTest = jest.fn();
const updateTest = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/tests-store', () => ({
  testsStore: { getTest: (...a: unknown[]) => getTest(...a), createTest: (...a: unknown[]) => createTest(...a), updateTest: (...a: unknown[]) => updateTest(...a) },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTestEditor } from './page-test-editor';
import { TestQuestionEditor } from '../test-question-editor/test-question-editor';

describe('page-test-editor', () => {
  beforeEach(() => { getTest.mockReset(); createTest.mockReset(); updateTest.mockReset(); navigate.mockReset(); });

  it('starts a new test with one blank multiple-choice question and creates on save', async () => {
    createTest.mockResolvedValue({ id: 42 });
    const page = await newSpecPage({ components: [PageTestEditor, TestQuestionEditor], html: '<page-test-editor></page-test-editor>' });
    await page.waitForChanges();
    const cmp = page.rootInstance as PageTestEditor;
    expect(cmp.questions).toHaveLength(1);
    expect(cmp.questions[0].type).toBe('multiple_choice');

    cmp.title = 'New one';
    cmp.subject = 'math';
    cmp.grade = 'k-2';
    cmp.questions = [{ type: 'true_false', prompt: 'Is it?', answer: true, points: 1 }];
    await cmp.save();

    expect(createTest).toHaveBeenCalledWith({ title: 'New one', description: null, subject: 'math', grade_level: 'k-2', questions: [{ type: 'true_false', prompt: 'Is it?', answer: true, points: 1 }] });
    expect(navigate).toHaveBeenCalledWith('/tests/42');
  });

  it('loads an existing test into the form and updates on save, surfacing 422 errors', async () => {
    getTest.mockResolvedValue({ id: 5, title: 'Cells', description: 'd', subject: 'science', grade_level: '6-8', is_author: true, questions: [{ id: 10, position: 0, type: 'short_answer', prompt: 'p', options: null, points: 2, partial_credit: false, answer: 'x', explanation: null }] });
    updateTest.mockRejectedValue(new ApiError(422, 'The given data was invalid.', { 'questions.0': ['The answer must be a non-empty expected answer.'] }));
    const page = await newSpecPage({ components: [PageTestEditor, TestQuestionEditor], html: '<page-test-editor test-id="5"></page-test-editor>' });
    await page.waitForChanges();
    const cmp = page.rootInstance as PageTestEditor;
    expect(cmp.title).toBe('Cells');
    expect(cmp.questions[0]).toEqual({ id: 10, type: 'short_answer', prompt: 'p', answer: 'x', points: 2, explanation: null });

    await cmp.save();
    await page.waitForChanges();
    expect(updateTest).toHaveBeenCalledWith(5, expect.objectContaining({ title: 'Cells' }));
    const editor = page.root.shadowRoot.querySelector('test-question-editor');
    expect(editor.shadowRoot.textContent).toContain('non-empty expected answer');
  });

  it('bounces a non-author to the test page', async () => {
    getTest.mockResolvedValue({ id: 5, is_author: false, questions: [] });
    await newSpecPage({ components: [PageTestEditor], html: '<page-test-editor test-id="5"></page-test-editor>' });
    expect(navigate).toHaveBeenCalledWith('/tests/5');
  });
});

describe('page-test-editor: stimulus, rationales and the new types', () => {
  beforeEach(() => { getTest.mockReset(); createTest.mockReset(); updateTest.mockReset(); navigate.mockReset(); });

  it('hydrates stimulus, rationales and auto_grade from the server and offers the previous stimulus to the next editor', async () => {
    getTest.mockResolvedValue({ id: 5, title: 'Cells', description: null, subject: 'science', grade_level: '6-8', is_author: true, questions: [
      { id: 10, position: 0, type: 'multiple_choice', prompt: 'p', stimulus: 'Read this.', options: ['a', 'b'], option_explanations: [null, 'Because b.'], points: 1, partial_credit: false, auto_grade: true, answer: 1, explanation: null },
      { id: 11, position: 1, type: 'fill_blank', prompt: 'The ____.', stimulus: 'Read this.', options: null, points: 1, partial_credit: false, auto_grade: false, answer: ['x', 'y'], explanation: 'Accept either.' },
      { id: 12, position: 2, type: 'long_answer', prompt: 'Discuss.', stimulus: null, options: null, points: 8, partial_credit: false, auto_grade: true, answer: 'A model.', explanation: null },
      { id: 13, position: 3, type: 'multi_select', prompt: 'Pick.', stimulus: null, options: ['a', 'b'], option_explanations: [null, null], points: 1, partial_credit: true, auto_grade: true, answer: [0], explanation: null },
    ] });
    const page = await newSpecPage({ components: [PageTestEditor, TestQuestionEditor], html: '<page-test-editor test-id="5"></page-test-editor>' });
    await page.waitForChanges();
    const cmp = page.rootInstance as PageTestEditor;
    expect(cmp.questions[0]).toEqual({ id: 10, type: 'multiple_choice', prompt: 'p', stimulus: 'Read this.', options: ['a', 'b'], option_explanations: ['', 'Because b.'], answer: 1, points: 1, explanation: null });
    expect(cmp.questions[1]).toEqual({ id: 11, type: 'fill_blank', prompt: 'The ____.', stimulus: 'Read this.', answer: ['x', 'y'], points: 1, auto_grade: false, explanation: 'Accept either.' });
    expect(cmp.questions[2]).toEqual({ id: 12, type: 'long_answer', prompt: 'Discuss.', answer: 'A model.', points: 8, explanation: null });
    // All-blank rationales from the server are dropped, like all-blank ones typed here.
    expect(cmp.questions[3]).not.toHaveProperty('option_explanations');

    const editors = Array.from(page.root.shadowRoot.querySelectorAll<HTMLTestQuestionEditorElement>('test-question-editor'));
    expect(editors[0].previousStimulus).toBeFalsy();
    expect(editors[1].previousStimulus).toBe('Read this.');
    expect(editors[2].previousStimulus).toBe('Read this.');
    // A null stimulus is hydrated as absent, so the next editor sees nothing to copy.
    expect(editors[3].previousStimulus).toBeFalsy();
  });

  it('sends the new shapes through unchanged on save', async () => {
    createTest.mockResolvedValue({ id: 43 });
    const page = await newSpecPage({ components: [PageTestEditor, TestQuestionEditor], html: '<page-test-editor></page-test-editor>' });
    await page.waitForChanges();
    const cmp = page.rootInstance as PageTestEditor;
    cmp.title = 'T';
    cmp.subject = 'math';
    cmp.grade = 'k-2';
    cmp.questions = [
      { type: 'fill_blank', prompt: '2 + 2 = ____', stimulus: 'Sums', answer: ['4', 'four'], auto_grade: true, points: 1 },
      { type: 'long_answer', prompt: 'Show your work.', stimulus: 'Sums', answer: 'Model.', points: 6 },
      { type: 'multiple_choice', prompt: 'Pick', options: ['a', 'b'], option_explanations: ['no', 'yes'], answer: 1, points: 1 },
    ];
    await cmp.save();
    expect(createTest).toHaveBeenCalledWith(expect.objectContaining({ questions: cmp.questions }));
    expect(navigate).toHaveBeenCalledWith('/tests/43');
  });
});
