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
