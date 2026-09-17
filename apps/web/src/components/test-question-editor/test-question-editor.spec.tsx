import { newSpecPage } from '@stencil/core/testing';
import { TestQuestionEditor } from './test-question-editor';

describe('test-question-editor', () => {
  it('switches shape when the type changes and emits the new question', async () => {
    const page = await newSpecPage({ components: [TestQuestionEditor], html: '<test-question-editor></test-question-editor>' });
    const cmp = page.rootInstance as TestQuestionEditor;
    cmp.question = { type: 'multiple_choice', prompt: 'p', options: ['a', 'b'], answer: 0, points: 1 };
    cmp.index = 0;
    await page.waitForChanges();
    const emitted: unknown[] = [];
    page.root.addEventListener('questionChange', (e: CustomEvent) => emitted.push(e.detail));

    cmp.setType('numeric');
    expect(emitted[0]).toEqual({ type: 'numeric', prompt: 'p', answer: { value: 0, tolerance: 0 }, points: 1 });

    cmp.setType('multi_select');
    expect(emitted[1]).toEqual({ type: 'multi_select', prompt: 'p', options: ['', ''], answer: [], points: 1, partial_credit: false });
  });

  it('toggles a multi-select correct option and edits option text', async () => {
    const page = await newSpecPage({ components: [TestQuestionEditor], html: '<test-question-editor></test-question-editor>' });
    const cmp = page.rootInstance as TestQuestionEditor;
    cmp.question = { type: 'multi_select', prompt: 'p', options: ['a', 'b', 'c'], answer: [0], points: 1, partial_credit: false };
    await page.waitForChanges();
    const emitted: any[] = [];
    page.root.addEventListener('questionChange', (e: CustomEvent) => emitted.push(e.detail));

    cmp.toggleCorrect(2);
    expect(emitted[0].answer).toEqual([0, 2]);
    cmp.toggleCorrect(0);
    expect(emitted[1].answer).toEqual([2]);
    cmp.setOption(1, 'bee');
    expect(emitted[2].options).toEqual(['a', 'bee', 'c']);
    cmp.removeOption(0);
    expect(emitted[3].options).toEqual(['bee', 'c']);
    expect(emitted[3].answer).toEqual([1]);
  });
});
