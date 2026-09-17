import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getTest = jest.fn();
const startAttempt = jest.fn();
const copyTest = jest.fn();
const myAttempts = jest.fn();
const navigate = jest.fn();
let currentUser: unknown = null;

jest.mock('../../services/tests-store', () => ({
  testsStore: {
    getTest: (...a: unknown[]) => getTest(...a),
    startAttempt: (...a: unknown[]) => startAttempt(...a),
    copyTest: (...a: unknown[]) => copyTest(...a),
    myAttempts: (...a: unknown[]) => myAttempts(...a),
    publishTest: jest.fn(),
    unpublishTest: jest.fn(),
    deleteTest: jest.fn(),
  },
}));
jest.mock('../../services/auth-store', () => ({ authStore: { get currentUser() { return currentUser; } } }));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageTest } from './page-test';

const base = {
  id: 5, title: 'Cells', description: 'Intro', subject: 'science', grade_level: '6-8', visibility: 'public', published_at: '2026-09-01',
  copied_from_id: null, question_count: 1, author: { id: 1, name: 'Ms K' }, created_at: '', updated_at: '',
  questions: [{ id: 10, position: 0, type: 'multiple_choice', prompt: 'Powerhouse?', options: ['Nucleus', 'Mitochondria'], points: 1, partial_credit: false }],
  is_author: false, assignment: null, open_attempt_id: null, can_copy: false,
};
const mount = async (view: unknown) => {
  getTest.mockResolvedValue(view);
  myAttempts.mockResolvedValue({ data: [] });
  const page = await newSpecPage({ components: [PageTest], html: '<page-test test-id="5"></page-test>' });
  await page.waitForChanges();
  return page;
};

describe('page-test', () => {
  beforeEach(() => { getTest.mockReset(); startAttempt.mockReset(); copyTest.mockReset(); navigate.mockReset(); currentUser = null; });

  it('renders the public view without answers for a guest', async () => {
    const page = await mount(base);
    const text = page.root.shadowRoot.textContent;
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
    currentUser = { id: 1, role: 'teacher', email_verified_at: 'x' };
    const page = await mount({ ...base, is_author: true, questions: [{ ...base.questions[0], answer: 1, explanation: 'ATP.' }] });
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Mitochondria');
    expect(text).toContain('ATP.');
    expect(page.root.shadowRoot.querySelector('a[href="/tests/5/edit"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/tests/5/results"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/tests/5/print"]')).not.toBeNull();
  });

  it('lets a student start an attempt and navigates to it', async () => {
    currentUser = { id: 3, role: 'student', email_verified_at: 'x' };
    startAttempt.mockResolvedValue({ id: 77 });
    const page = await mount(base);
    const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.includes('Start'));
    button.click();
    await page.waitForChanges();
    expect(startAttempt).toHaveBeenCalledWith(5);
    expect(navigate).toHaveBeenCalledWith('/attempts/77');
  });

  it('offers Copy only when can_copy and navigates to the copy', async () => {
    currentUser = { id: 9, role: 'teacher', email_verified_at: 'x' };
    copyTest.mockResolvedValue({ id: 81 });
    const page = await mount({ ...base, can_copy: true });
    const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.includes('Copy'));
    button.click();
    await page.waitForChanges();
    expect(navigate).toHaveBeenCalledWith('/tests/81/edit');
  });

  it('renders not found on 404', async () => {
    getTest.mockRejectedValue(new ApiError(404, 'nope'));
    const page = await newSpecPage({ components: [PageTest], html: '<page-test test-id="5"></page-test>' });
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('not found');
  });
});
