import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getTest = jest.fn();
const startAttempt = jest.fn();
const copyTest = jest.fn();
const myAttempts = jest.fn();
const publishTest = jest.fn();
const unpublishTest = jest.fn();
const deleteTest = jest.fn();
const navigate = jest.fn();
let currentUser: unknown = null;

jest.mock('../../services/tests-store', () => ({
  testsStore: {
    getTest: (...a: unknown[]) => getTest(...a),
    startAttempt: (...a: unknown[]) => startAttempt(...a),
    copyTest: (...a: unknown[]) => copyTest(...a),
    myAttempts: (...a: unknown[]) => myAttempts(...a),
    publishTest: (...a: unknown[]) => publishTest(...a),
    unpublishTest: (...a: unknown[]) => unpublishTest(...a),
    deleteTest: (...a: unknown[]) => deleteTest(...a),
  },
}));
// app-root leaves authStore.load() in flight while it renders the route, so
// the user only appears once the page awaits it; `pending` models that.
let pending: unknown = null;
const authLoad = jest.fn(async () => { currentUser = pending; return currentUser; });
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, load: () => authLoad() },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTest } from './page-test';
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

const base = {
  id: 5, title: 'Cells', description: 'Intro', subject: 'science', grade_level: '6-8', visibility: 'public', published_at: '2026-09-01',
  copied_from_id: null, question_count: 1, author: { id: 1, name: 'Ms K' }, created_at: '', updated_at: '',
  questions: [{ id: 10, position: 0, type: 'multiple_choice', prompt: 'Powerhouse?', options: ['Nucleus', 'Mitochondria'], points: 1, partial_credit: false }],
  is_author: false, assignment: null, open_attempt_id: null, can_copy: false,
};
const mount = async (view: unknown) => {
  getTest.mockResolvedValue(view);
  myAttempts.mockResolvedValue({ data: [] });
  const page = await newSpecPage({ components: [PageTest, RichText], html: '<page-test test-id="5"></page-test>' });
  await page.waitForChanges();
  return page;
};

describe('page-test', () => {
  beforeEach(() => { getTest.mockReset(); startAttempt.mockReset(); copyTest.mockReset(); publishTest.mockReset(); unpublishTest.mockReset(); deleteTest.mockReset(); navigate.mockReset(); authLoad.mockClear(); currentUser = null; pending = null; });

  const clickButton = async (page: Awaited<ReturnType<typeof mount>>, label: string) => {
    const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.includes(label));
    expect(button).toBeTruthy();
    button.click();
    await page.waitForChanges();
    await page.waitForChanges();
  };

  it('renders the public view without answers for a guest', async () => {
    const page = await mount(base);
    const text = deepText(page.root.shadowRoot);
    expect(text).toContain('Cells');
    expect(text).toContain('Powerhouse?');
    expect(text).not.toContain('Correct answer');
    expect(page.root.shadowRoot.querySelector('button')).toBeNull();
    // Pins the manual "{index + 1}." prefix rendered once in .prompt, not
    // the <ol> marker itself -- jsdom (and jest-dom's textContent) doesn't
    // render CSS list markers, so this can't see a doubled "1.  1." caused
    // by a missing `list-style: none` on .questions. That regression is a
    // visual-only defect this assertion cannot catch; it only guards the
    // text-content half of the fix.
    expect(text.match(/1\. Powerhouse\?/g)).toHaveLength(1);
  });

  it('shows author controls and answers to the author', async () => {
    pending = { id: 1, role: 'teacher', email_verified_at: 'x' };
    const page = await mount({ ...base, is_author: true, questions: [{ ...base.questions[0], answer: 1, explanation: 'ATP.' }] });
    const text = deepText(page.root.shadowRoot);
    expect(text).toContain('Mitochondria');
    expect(text).toContain('ATP.');
    expect(page.root.shadowRoot.querySelector('a[href="/tests/5/edit"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/tests/5/results"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/tests/5/print"]')).not.toBeNull();
  });

  it('shows the author stimuli once per set, rationales under options, and the new answer lines', async () => {
    pending = { id: 1, role: 'teacher', email_verified_at: 'x' };
    const page = await mount({ ...base, is_author: true, questions: [
      { ...base.questions[0], stimulus: 'Read the passage.', answer: 1, option_explanations: ['Holds DNA.', 'Makes ATP.'] },
      { id: 11, position: 1, type: 'fill_blank', prompt: 'The ____ makes ATP.', stimulus: 'Read the passage.', options: null, points: 1, partial_credit: false, auto_grade: true, answer: ['mitochondria', 'mitochondrion'] },
      { id: 12, position: 2, type: 'long_answer', prompt: 'Explain.', stimulus: null, options: null, points: 6, partial_credit: false, auto_grade: true, answer: 'A model answer.' },
    ] });
    const root = page.root.shadowRoot;
    expect(root.querySelectorAll('.stimulus')).toHaveLength(1);
    expect(deepText(root.querySelector('.stimulus'))).toContain('Read the passage.');
    const options = root.querySelectorAll('.options > li');
    expect(options[1].classList.contains('correct')).toBe(true);
    expect(deepText(options[1])).toContain('Makes ATP.');
    expect(root.textContent).toContain('Accepted answers: mitochondria / mitochondrion');
    expect(root.textContent).toContain('Model answer: A model answer.');
  });

  it('hides rationales from a viewer without answers', async () => {
    const page = await mount({ ...base, questions: [{ ...base.questions[0], stimulus: null }] });
    expect(page.root.shadowRoot.querySelector('.rationale')).toBeNull();
  });

  it('lets a student start an attempt and navigates to it', async () => {
    pending = { id: 3, role: 'student', email_verified_at: 'x' };
    startAttempt.mockResolvedValue({ id: 77 });
    const page = await mount(base);
    const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.includes('Start'));
    button.click();
    await page.waitForChanges();
    expect(startAttempt).toHaveBeenCalledWith(5);
    expect(navigate).toHaveBeenCalledWith('/attempts/77');
  });

  it('offers Copy only when can_copy and navigates to the copy', async () => {
    pending = { id: 9, role: 'teacher', email_verified_at: 'x' };
    copyTest.mockResolvedValue({ id: 81 });
    const page = await mount({ ...base, can_copy: true });
    const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.includes('Copy'));
    button.click();
    await page.waitForChanges();
    expect(navigate).toHaveBeenCalledWith('/tests/81/edit');
  });

  it('publishes a private test and flips the visibility line', async () => {
    pending = { id: 1, role: 'teacher', email_verified_at: 'x' };
    publishTest.mockResolvedValue({ ...base, visibility: 'public' });
    const page = await mount({ ...base, is_author: true, visibility: 'private', published_at: null });
    expect(page.root.shadowRoot.textContent).toContain('Private');

    await clickButton(page, 'Publish to library');

    expect(publishTest).toHaveBeenCalledWith(5);
    expect(page.root.shadowRoot.textContent).toContain('Public');
  });

  it('unpublishes a public test and flips the visibility line back', async () => {
    pending = { id: 1, role: 'teacher', email_verified_at: 'x' };
    unpublishTest.mockResolvedValue({ ...base, visibility: 'private', published_at: null });
    const page = await mount({ ...base, is_author: true, visibility: 'public' });
    expect(page.root.shadowRoot.textContent).toContain('Public');

    await clickButton(page, 'Unpublish');

    expect(unpublishTest).toHaveBeenCalledWith(5);
    expect(page.root.shadowRoot.textContent).toContain('Private');
  });

  it('deletes the test once confirmed and returns to the list', async () => {
    pending = { id: 1, role: 'teacher', email_verified_at: 'x' };
    deleteTest.mockResolvedValue(undefined);
    const page = await mount({ ...base, is_author: true });
    // newSpecPage resets the mock window, so the stub only lands after mount --
    // which is exactly why the component calls `window.confirm`, not `confirm`.
    window.confirm = () => true;

    await clickButton(page, 'Delete');

    expect(deleteTest).toHaveBeenCalledWith(5);
    expect(navigate).toHaveBeenCalledWith('/tests');
  });

  it('does not delete when the confirm dialog is cancelled', async () => {
    pending = { id: 1, role: 'teacher', email_verified_at: 'x' };
    const page = await mount({ ...base, is_author: true });
    window.confirm = () => false;

    await clickButton(page, 'Delete');

    expect(deleteTest).not.toHaveBeenCalled();
    expect(navigate).not.toHaveBeenCalled();
  });

  it('renders not found on 404', async () => {
    getTest.mockRejectedValue(new ApiError(404, 'nope'));
    const page = await newSpecPage({ components: [PageTest], html: '<page-test test-id="5"></page-test>' });
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('not found');
  });
});
