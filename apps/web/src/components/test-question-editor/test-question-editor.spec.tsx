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

describe('test-question-editor: stimulus, rationales and the new types', () => {
  const mount = async (question: unknown, previousStimulus?: string | null) => {
    const page = await newSpecPage({ components: [TestQuestionEditor], html: '<test-question-editor></test-question-editor>' });
    const cmp = page.rootInstance as TestQuestionEditor;
    cmp.question = question as TestQuestionEditor['question'];
    // Set on the host, not the instance: `previousStimulus` is an immutable @Prop.
    (page.root as HTMLTestQuestionEditorElement).previousStimulus = previousStimulus;
    await page.waitForChanges();
    const emitted: any[] = [];
    page.root.addEventListener('questionChange', (e: CustomEvent) => emitted.push(e.detail));
    return { page, cmp, emitted };
  };

  it('offers the stimulus textarea for every type and copies the previous one only when there is one', async () => {
    const { page, cmp, emitted } = await mount({ type: 'true_false', prompt: 'p', answer: true, points: 1 }, 'Read the passage.');
    const root = page.root.shadowRoot;
    expect(root.querySelector('textarea.stimulus')).not.toBeNull();
    const copy = Array.from(root.querySelectorAll('button')).find((b) => b.textContent?.includes('Copy stimulus'));
    expect(copy).toBeTruthy();
    copy.click();
    expect(emitted[0].stimulus).toBe('Read the passage.');

    // Clearing the textarea sends null, not '' -- the server treats both as absent.
    const area = root.querySelector('textarea.stimulus') as HTMLTextAreaElement;
    area.value = '';
    area.dispatchEvent(new Event('input'));
    expect(emitted[1].stimulus).toBeNull();

    (page.root as HTMLTestQuestionEditorElement).previousStimulus = null;
    await page.waitForChanges();
    expect(Array.from(root.querySelectorAll('button')).find((b) => b.textContent?.includes('Copy stimulus'))).toBeUndefined();
  });

  it('keeps the stimulus when the type changes', async () => {
    const { cmp, emitted } = await mount({ type: 'short_answer', prompt: 'p', stimulus: 'S', answer: 'x', points: 1 });
    cmp.setType('numeric');
    expect(emitted[0]).toEqual({ type: 'numeric', prompt: 'p', stimulus: 'S', answer: { value: 0, tolerance: 0 }, points: 1 });
  });

  it('keeps rationales parallel to options and drops the key when every one is blank', async () => {
    const { page, cmp, emitted } = await mount({ type: 'multiple_choice', prompt: 'p', options: ['a', 'b'], answer: 0, points: 1 });
    expect(page.root.shadowRoot.querySelectorAll('textarea.rationale')).toHaveLength(2);

    cmp.setRationale(1, 'Because b.');
    expect(emitted[0].option_explanations).toEqual(['', 'Because b.']);

    cmp.addOption();
    expect(emitted[1].options).toEqual(['a', 'b', '']);
    expect(emitted[1].option_explanations).toEqual(['', 'Because b.', '']);

    cmp.removeOption(0);
    expect(emitted[2].options).toEqual(['b', '']);
    expect(emitted[2].option_explanations).toEqual(['Because b.', '']);

    cmp.setRationale(0, '');
    expect(emitted[3]).not.toHaveProperty('option_explanations');

    // Without any rationale written, option edits never introduce the key.
    cmp.addOption();
    expect(emitted[4]).not.toHaveProperty('option_explanations');
  });

  it('drops the rationale key when removing the only option that had one', async () => {
    const { cmp, emitted } = await mount({ type: 'multi_select', prompt: 'p', options: ['a', 'b', 'c'], option_explanations: ['', '', 'only c'], answer: [2], points: 1, partial_credit: false });
    cmp.removeOption(2);
    expect(emitted[0].options).toEqual(['a', 'b']);
    expect(emitted[0]).not.toHaveProperty('option_explanations');
  });

  it('edits the accepted answers and the auto-grade switch of a fill_blank', async () => {
    const { page, cmp, emitted } = await mount({ type: 'fill_blank', prompt: 'The ____ is the powerhouse.', answer: ['mitochondria'], auto_grade: true, points: 1 });
    const root = page.root.shadowRoot;
    expect(root.textContent).toContain('must contain ____');
    expect(root.querySelectorAll('input[type="text"][maxlength="100"]')).toHaveLength(1);
    expect((root.querySelector('input[type="checkbox"]') as HTMLInputElement).checked).toBe(true);

    cmp.addAccepted();
    expect(emitted[0].answer).toEqual(['mitochondria', '']);
    cmp.setAccepted(1, 'mitochondrion');
    expect(emitted[1].answer).toEqual(['mitochondria', 'mitochondrion']);
    cmp.removeAccepted(0);
    expect(emitted[2].answer).toEqual(['mitochondrion']);
    cmp.removeAccepted(0);
    expect(emitted[3].answer).toEqual(['']);

    const auto = root.querySelector('input[type="checkbox"]') as HTMLInputElement;
    auto.checked = false;
    auto.dispatchEvent(new Event('change'));
    expect(emitted[4].auto_grade).toBe(false);

    await page.waitForChanges();
    expect(root.querySelectorAll('input[type="text"][maxlength="100"]')).toHaveLength(1);
    expect((root.querySelector('input[type="text"][maxlength="100"]') as HTMLInputElement).value).toBe('');
  });

  it('renders a model-answer textarea and a 4-10 points range for long_answer', async () => {
    const { page, cmp, emitted } = await mount({ type: 'short_answer', prompt: 'p', answer: 'x', points: 2 });
    cmp.setType('long_answer');
    expect(emitted[0]).toEqual({ type: 'long_answer', prompt: 'p', answer: '', points: 6 });
    await page.waitForChanges();
    const root = page.root.shadowRoot;
    expect(root.querySelector('textarea.model-answer')).not.toBeNull();
    const points = root.querySelector('input[type="number"]') as HTMLInputElement;
    expect(points.getAttribute('min')).toBe('4');
    expect(points.getAttribute('max')).toBe('10');
  });
});
