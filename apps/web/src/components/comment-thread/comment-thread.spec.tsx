import { newSpecPage } from '@stencil/core/testing';

const getComments = jest.fn();
const postComment = jest.fn();
const updateComment = jest.fn();
const deleteComment = jest.fn();
let currentUser: unknown = null;

jest.mock('../../services/comments-store', () => ({
  commentsStore: {
    getComments: (...a: unknown[]) => getComments(...a),
    postComment: (...a: unknown[]) => postComment(...a),
    updateComment: (...a: unknown[]) => updateComment(...a),
    deleteComment: (...a: unknown[]) => deleteComment(...a),
  },
}));
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, load: async () => currentUser },
}));
jest.mock('../../services/navigate', () => ({ navigate: jest.fn() }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { CommentThreadView } from './comment-thread';

const comment = (over: Record<string, unknown> = {}) => ({
  id: 1, parent_id: null, body: 'Why is it B?', created_at: '2026-10-15T10:00:00Z', edited_at: null,
  author: { id: null, name: null, role: 'student', avatar_url: null },
  is_mine: false, can_edit: false, can_delete: false, replies: [],
  ...over,
});

const mount = async (html = '<comment-thread target-type="test" target-id="5"></comment-thread>') => {
  const page = await newSpecPage({ components: [CommentThreadView], html });
  await page.waitForChanges();
  return page;
};

const button = (page: Awaited<ReturnType<typeof mount>>, label: string) =>
  Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.trim() === label);

const type = async (page: Awaited<ReturnType<typeof mount>>, selector: string, value: string) => {
  const area = page.root.shadowRoot.querySelector(selector) as HTMLTextAreaElement;
  area.value = value;
  area.dispatchEvent(new Event('input'));
  await page.waitForChanges();
};

describe('comment-thread', () => {
  beforeEach(() => {
    [getComments, postComment, updateComment, deleteComment].forEach((f) => f.mockReset());
    currentUser = { id: 9, name: 'Mr T', role: 'teacher' };
  });

  it('asks a guest to sign in and never calls the API', async () => {
    currentUser = null;
    const page = await mount();
    expect(page.root.shadowRoot.textContent).toContain('Sign in to join the discussion.');
    expect(getComments).not.toHaveBeenCalled();
  });

  it('loads the discussion and names an unnamed commenter by role', async () => {
    getComments.mockResolvedValue({ data: [comment({ replies: [comment({ id: 2, parent_id: 1, body: 'Because', author: { id: 3, name: 'Ms K', role: 'teacher', avatar_url: null } })] })], can_comment: true, can_moderate: false });
    const page = await mount();
    expect(getComments).toHaveBeenCalledWith('test', 5);
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Discussion (2)');
    expect(text).toContain('A student');
    expect(text).toContain('Ms K');
    expect(text).toContain('Because');
    expect(button(page, 'Edit')).toBeUndefined();
    expect(button(page, 'Delete')).toBeUndefined();
  });

  it('posts a comment and appends it', async () => {
    getComments.mockResolvedValue({ data: [], can_comment: true, can_moderate: false });
    postComment.mockResolvedValue(comment({ id: 7, body: 'Great quiz', author: { id: 9, name: 'Mr T', role: 'teacher', avatar_url: null }, is_mine: true, can_edit: true, can_delete: true }));
    const page = await mount();
    expect(page.root.shadowRoot.textContent).toContain('No comments yet.');

    await type(page, '#new-comment', '  Great quiz ');
    page.root.shadowRoot.querySelector('form.new').dispatchEvent(new Event('submit'));
    await page.waitForChanges();
    await page.waitForChanges();

    expect(postComment).toHaveBeenCalledWith('test', 5, 'Great quiz');
    expect(page.root.shadowRoot.textContent).toContain('Great quiz');
    expect(button(page, 'Edit')).toBeTruthy();
  });

  it('replies under a top-level comment', async () => {
    getComments.mockResolvedValue({ data: [comment()], can_comment: true, can_moderate: false });
    postComment.mockResolvedValue(comment({ id: 8, parent_id: 1, body: 'Look at the second clue', replies: undefined }));
    const page = await mount();

    button(page, 'Reply').click();
    await page.waitForChanges();
    await type(page, '#reply-1', 'Look at the second clue');
    page.root.shadowRoot.querySelector('.replies form').dispatchEvent(new Event('submit'));
    await page.waitForChanges();
    await page.waitForChanges();

    expect(postComment).toHaveBeenCalledWith('test', 5, 'Look at the second clue', 1);
    expect(page.root.shadowRoot.querySelector('.replies').textContent).toContain('Look at the second clue');
  });

  it('edits and deletes when the API allows it', async () => {
    getComments.mockResolvedValue({ data: [comment({ is_mine: true, can_edit: true, can_delete: true })], can_comment: true, can_moderate: false });
    updateComment.mockResolvedValue(comment({ body: 'Is it C?', edited_at: '2026-10-15T11:00:00Z', is_mine: true, can_edit: true, can_delete: true }));
    deleteComment.mockResolvedValue(undefined);
    const page = await mount();

    button(page, 'Edit').click();
    await page.waitForChanges();
    await type(page, '#edit-1', 'Is it C?');
    page.root.shadowRoot.querySelector('.comment form').dispatchEvent(new Event('submit'));
    await page.waitForChanges();
    await page.waitForChanges();
    expect(updateComment).toHaveBeenCalledWith(1, 'Is it C?');
    expect(page.root.shadowRoot.textContent).toContain('Is it C?');
    expect(page.root.shadowRoot.textContent).toContain('edited');

    window.confirm = jest.fn(() => true);
    button(page, 'Delete').click();
    await page.waitForChanges();
    await page.waitForChanges();
    expect(deleteComment).toHaveBeenCalledWith(1);
    expect(page.root.shadowRoot.textContent).toContain('No comments yet.');
  });

  it('compact starts closed and loads only when opened', async () => {
    getComments.mockResolvedValue({ data: [comment()], can_comment: false, can_moderate: false });
    const page = await mount('<comment-thread compact target-type="question" target-id="10"></comment-thread>');
    expect(getComments).not.toHaveBeenCalled();

    button(page, 'Discuss').click();
    await page.waitForChanges();
    await page.waitForChanges();
    expect(getComments).toHaveBeenCalledWith('question', 10);
    expect(page.root.shadowRoot.textContent).toContain('Why is it B?');
    // No form for a viewer who may not post.
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
    expect(button(page, 'Reply')).toBeUndefined();
  });

  it('says so when the discussion fails to load', async () => {
    getComments.mockRejectedValue(new Error('boom'));
    const page = await mount();
    expect(page.root.shadowRoot.textContent).toContain('We could not load the discussion.');
  });
});
