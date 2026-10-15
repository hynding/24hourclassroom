import { Component, h, Prop, State, Watch } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { COMMENT_MAX_LENGTH, Comment, CommentTargetType, CommentThread, roleLabel } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { commentsStore } from '../../services/comments-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

/**
 * The discussion under a test, a question, a material or a course. The API
 * decides everything -- who may post, edit, delete, and whose name this
 * viewer may see -- and this only renders its answers. `compact` starts
 * closed behind a "Discuss" toggle, for the per-question threads on a test
 * page, and loads only when opened.
 */
@Component({ tag: 'comment-thread', styleUrl: 'comment-thread.css', shadow: true })
export class CommentThreadView {
  @Prop() targetType!: CommentTargetType;
  @Prop() targetId!: number;
  @Prop() compact = false;
  @Prop() heading = 'Discussion';

  @State() open = false;
  @State() signedIn = false;
  @State() thread: CommentThread | null = null;
  @State() loadError = false;
  @State() draft = '';
  @State() replyTo: number | null = null;
  @State() replyDraft = '';
  @State() editing: number | null = null;
  @State() editDraft = '';
  @State() busy = false;
  @State() actionError = '';

  async componentWillLoad() {
    this.signedIn = (await authStore.load()) !== null;
    this.open = !this.compact;
    if (this.open) {
      await this.load();
    }
  }

  /** Stencil reuses this element when a page swaps its target. */
  @Watch('targetId')
  @Watch('targetType')
  async targetChanged() {
    this.thread = null;
    this.replyTo = null;
    this.editing = null;
    this.draft = '';
    if (this.open) {
      await this.load();
    }
  }

  private async load() {
    if (!this.signedIn || !this.targetId) {
      return;
    }
    this.loadError = false;
    try {
      this.thread = await commentsStore.getComments(this.targetType, this.targetId);
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.loadError = true;
      }
    }
  }

  private toggle = async () => {
    this.open = !this.open;
    if (this.open && !this.thread) {
      await this.load();
    }
  };

  private async run(action: () => Promise<void>) {
    this.busy = true;
    this.actionError = '';
    try {
      await action();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.actionError = e instanceof ApiError ? e.message : 'Something went wrong.';
      }
    } finally {
      this.busy = false;
    }
  }

  private post = (e: Event) => {
    e.preventDefault();
    const body = this.draft.trim();
    if (!body) {
      return;
    }
    return this.run(async () => {
      const comment = await commentsStore.postComment(this.targetType, this.targetId, body);
      this.thread = { ...this.thread, data: [...this.thread.data, comment] };
      this.draft = '';
    });
  };

  private postReply = (e: Event, parent: Comment) => {
    e.preventDefault();
    const body = this.replyDraft.trim();
    if (!body) {
      return;
    }
    return this.run(async () => {
      const reply = await commentsStore.postComment(this.targetType, this.targetId, body, parent.id);
      this.thread = {
        ...this.thread,
        data: this.thread.data.map((c) => (c.id === parent.id ? { ...c, replies: [...(c.replies ?? []), reply] } : c)),
      };
      this.replyTo = null;
      this.replyDraft = '';
    });
  };

  private saveEdit = (e: Event, comment: Comment) => {
    e.preventDefault();
    const body = this.editDraft.trim();
    if (!body) {
      return;
    }
    return this.run(async () => {
      const updated = await commentsStore.updateComment(comment.id, body);
      this.thread = { ...this.thread, data: this.replace(this.thread.data, comment.id, (c) => ({ ...c, ...updated, replies: c.replies })) };
      this.editing = null;
    });
  };

  private remove = (comment: Comment) => {
    // `window.confirm`, not the bare global: see page-test.
    const replies = comment.replies?.length ?? 0;
    if (!window.confirm(replies ? 'Delete this comment and its replies?' : 'Delete this comment?')) {
      return;
    }
    return this.run(async () => {
      await commentsStore.deleteComment(comment.id);
      this.thread = {
        ...this.thread,
        data: this.thread.data
          .filter((c) => c.id !== comment.id)
          .map((c) => (c.replies ? { ...c, replies: c.replies.filter((r) => r.id !== comment.id) } : c)),
      };
    });
  };

  private replace(list: Comment[], id: number, fn: (c: Comment) => Comment): Comment[] {
    return list.map((c) => (c.id === id ? fn(c) : c.replies ? { ...c, replies: this.replace(c.replies, id, fn) } : c));
  }

  private count(): number {
    return this.thread?.data.reduce((n, c) => n + 1 + (c.replies?.length ?? 0), 0) ?? 0;
  }

  /** A name when the API gives one; otherwise the role ("A student"). */
  private who(c: Comment): string {
    if (c.author.name) {
      return c.author.name;
    }
    const label = roleLabel(c.author.role).toLowerCase();
    return `${/^[aeiou]/.test(label) ? 'An' : 'A'} ${label}`;
  }

  private renderComment(c: Comment, top: boolean) {
    const editing = this.editing === c.id;
    return (
      <li class="comment" key={c.id}>
        <p class="byline">
          <span class="author">{this.who(c)}</span>
          {' · '}
          <time dateTime={c.created_at}>{new Date(c.created_at).toLocaleString()}</time>
          {c.edited_at && ' · edited'}
        </p>
        {editing ? (
          <form onSubmit={(e) => this.saveEdit(e, c)}>
            <label class="visually-hidden" htmlFor={`edit-${c.id}`}>Edit comment</label>
            <textarea id={`edit-${c.id}`} maxLength={COMMENT_MAX_LENGTH} value={this.editDraft}
              onInput={(e) => (this.editDraft = (e.target as HTMLTextAreaElement).value)}></textarea>
            <div class="row">
              <button type="submit" class="btn-primary" disabled={this.busy || !this.editDraft.trim()}>Save</button>
              <button type="button" class="btn" onClick={() => (this.editing = null)}>Cancel</button>
            </div>
          </form>
        ) : (
          <p class="body">{c.body}</p>
        )}
        {!editing && (
          <div class="row">
            {top && this.thread.can_comment && (
              <button type="button" class="link" onClick={() => { this.replyTo = c.id; this.replyDraft = ''; }}>Reply</button>
            )}
            {c.can_edit && (
              <button type="button" class="link" onClick={() => { this.editing = c.id; this.editDraft = c.body; }}>Edit</button>
            )}
            {c.can_delete && (
              <button type="button" class="link" disabled={this.busy} onClick={() => this.remove(c)}>Delete</button>
            )}
          </div>
        )}
        {top && (c.replies?.length > 0 || this.replyTo === c.id) && (
          <ul class="replies">
            {(c.replies ?? []).map((r) => this.renderComment(r, false))}
            {this.replyTo === c.id && (
              <li>
                <form onSubmit={(e) => this.postReply(e, c)}>
                  <label class="visually-hidden" htmlFor={`reply-${c.id}`}>Reply to {this.who(c)}</label>
                  <textarea id={`reply-${c.id}`} maxLength={COMMENT_MAX_LENGTH} value={this.replyDraft} placeholder="Write a reply"
                    onInput={(e) => (this.replyDraft = (e.target as HTMLTextAreaElement).value)}></textarea>
                  <div class="row">
                    <button type="submit" class="btn-primary" disabled={this.busy || !this.replyDraft.trim()}>Reply</button>
                    <button type="button" class="btn" onClick={() => (this.replyTo = null)}>Cancel</button>
                  </div>
                </form>
              </li>
            )}
          </ul>
        )}
      </li>
    );
  }

  private renderBody() {
    if (!this.signedIn) {
      return (
        <p class="muted">
          <a href="/login" onClick={(e) => { e.preventDefault(); navigate('/login'); }}>Sign in</a> to join the discussion.
        </p>
      );
    }
    if (this.loadError) {
      return (
        <p class="error">
          We could not load the discussion. <button type="button" class="link" onClick={() => this.load()}>Retry</button>
        </p>
      );
    }
    if (!this.thread) {
      return <p class="muted">Loading…</p>;
    }
    return [
      this.actionError && <p class="error">{this.actionError}</p>,
      this.thread.data.length === 0
        ? <p class="muted">No comments yet.</p>
        : <ul class="comments">{this.thread.data.map((c) => this.renderComment(c, true))}</ul>,
      this.thread.can_comment && (
        <form class="new" onSubmit={this.post}>
          <label htmlFor="new-comment">Add a comment</label>
          <textarea id="new-comment" maxLength={COMMENT_MAX_LENGTH} value={this.draft}
            onInput={(e) => (this.draft = (e.target as HTMLTextAreaElement).value)}></textarea>
          <div class="row">
            <button type="submit" class="btn-primary" disabled={this.busy || !this.draft.trim()}>Post comment</button>
          </div>
        </form>
      ),
    ];
  }

  render() {
    if (this.compact) {
      return (
        <div class="compact">
          <button type="button" class="link" aria-expanded={this.open ? 'true' : 'false'} onClick={this.toggle}>
            {this.open ? 'Hide discussion' : this.thread ? `Discuss (${this.count()})` : 'Discuss'}
          </button>
          {this.open && <div class="panel">{this.renderBody()}</div>}
        </div>
      );
    }
    return (
      <section class="thread" aria-label={this.heading}>
        <h2>{this.heading}{this.thread && this.count() > 0 ? ` (${this.count()})` : ''}</h2>
        {this.renderBody()}
      </section>
    );
  }
}
