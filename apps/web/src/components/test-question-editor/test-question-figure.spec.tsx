import { newSpecPage } from '@stencil/core/testing';

const uploadFigure = jest.fn();
jest.mock('../../services/tests-store', () => ({ testsStore: { uploadFigure: (...a: unknown[]) => uploadFigure(...a) } }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { TestQuestionEditor } from './test-question-editor';
import { renderFigure } from '../../services/question-figure';

describe('question pictures', () => {
  beforeEach(() => uploadFigure.mockReset());

  it('uploads a picture, attaches it by id and asks for alt text', async () => {
    uploadFigure.mockResolvedValue({ id: 9, url: 'https://api.test/api/figures/9/image?signature=x' });
    const page = await newSpecPage({ components: [TestQuestionEditor], html: '<test-question-editor></test-question-editor>' });
    const cmp = page.rootInstance as TestQuestionEditor;
    cmp.question = { type: 'true_false', prompt: 'p', answer: true, points: 1 };
    await page.waitForChanges();
    const changes: any[] = [];
    const uploads: any[] = [];
    page.root.addEventListener('questionChange', (e: CustomEvent) => changes.push(e.detail));
    page.root.addEventListener('figureUploaded', (e: CustomEvent) => uploads.push(e.detail));

    await cmp.uploadFigure(new File(['x'], 'dots.png', { type: 'image/png' }));
    await page.waitForChanges();

    expect(uploads[0]).toEqual({ id: 9, url: 'https://api.test/api/figures/9/image?signature=x' });
    expect(changes[0]).toEqual(expect.objectContaining({ figure_id: 9, figure_alt: '' }));
    expect(page.root.shadowRoot.textContent).toContain('Describe the picture for screen readers');

    cmp.removeFigure();
    expect(changes[1].figure_id).toBeUndefined();
    expect(changes[1].figure_alt).toBeUndefined();
  });

  it('shows the server\'s message when an upload is refused', async () => {
    uploadFigure.mockRejectedValue(Object.assign(new Error('422'), { errors: { file: ['Choose a PNG or JPEG picture under 2 MB.'] } }));
    const page = await newSpecPage({ components: [TestQuestionEditor], html: '<test-question-editor></test-question-editor>' });
    const cmp = page.rootInstance as TestQuestionEditor;
    cmp.question = { type: 'true_false', prompt: 'p', answer: true, points: 1 };
    await page.waitForChanges();

    await cmp.uploadFigure(new File(['x'], 'big.png', { type: 'image/png' }));
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('Choose a PNG or JPEG picture under 2 MB.');
  });

  it('renders nothing without a picture and an img with its alt text with one', () => {
    expect(renderFigure(null)).toBeNull();
    const vnode: any = renderFigure({ id: 1, url: 'https://x/y', alt: 'A clock showing 3:15' });
    const img = vnode.$children$[0];
    expect(img.$attrs$.alt).toBe('A clock showing 3:15');
    expect(img.$attrs$.src).toBe('https://x/y');
  });
});
