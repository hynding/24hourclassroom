import type { ApiClient } from '@24hc/api-client';
import type { CommentReaction, CommentTargetType } from '@24hc/shared';
import { apiClient } from './profile-store';

/**
 * Thin, stateless pass-through so comment-thread mocks ONE module (the same
 * reason tests-store.ts exists). Nothing is cached: who may see a name, and
 * which comments are on show, can change under the viewer.
 */
export class CommentsStore {
  constructor(private readonly client: ApiClient) {}

  getComments(type: CommentTargetType, id: number) { return this.client.getComments(type, id); }
  postComment(type: CommentTargetType, id: number, body: string, parentId?: number) { return this.client.postComment(type, id, body, parentId); }
  updateComment(id: number, body: string) { return this.client.updateComment(id, body); }
  deleteComment(id: number) { return this.client.deleteComment(id); }
  approveComment(id: number) { return this.client.approveComment(id); }
  denyComment(id: number) { return this.client.denyComment(id); }
  reactToComment(id: number, value: CommentReaction | null) { return this.client.reactToComment(id, value); }
}

export const commentsStore = new CommentsStore(apiClient);
