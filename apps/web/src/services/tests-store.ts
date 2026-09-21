import type { ApiClient } from '@24hc/api-client';
import type { LibraryFilters, TestInput } from '@24hc/shared';
import { apiClient } from './profile-store';

/**
 * Thin, stateless pass-through so pages mock ONE module. Nothing is cached:
 * every test page re-fetches on load, which is what keeps a stale tab from
 * showing answers it should not.
 */
export class TestsStore {
  constructor(private readonly client: ApiClient) {}

  listTests(page?: number) { return this.client.listTests(page); }
  createTest(data: TestInput) { return this.client.createTest(data); }
  getTest(id: number) { return this.client.getTest(id); }
  updateTest(id: number, data: TestInput) { return this.client.updateTest(id, data); }
  deleteTest(id: number) { return this.client.deleteTest(id); }
  publishTest(id: number) { return this.client.publishTest(id); }
  unpublishTest(id: number) { return this.client.unpublishTest(id); }
  copyTest(id: number) { return this.client.copyTest(id); }
  listAssignments(testId: number) { return this.client.listAssignments(testId); }
  assignTest(testId: number, studentIds: number[], dueAt?: string | null) { return this.client.assignTest(testId, studentIds, dueAt); }
  unassign(testId: number, assignmentId: number) { return this.client.unassign(testId, assignmentId); }
  listTestAttempts(testId: number, page?: number) { return this.client.listTestAttempts(testId, page); }
  myAssignments() { return this.client.myAssignments(); }
  myAttempts() { return this.client.myAttempts(); }
  startAttempt(testId: number) { return this.client.startAttempt(testId); }
  getAttempt(id: number) { return this.client.getAttempt(id); }
  saveAttempt(id: number, responses: Record<number, unknown>) { return this.client.saveAttempt(id, responses); }
  submitAttempt(id: number) { return this.client.submitAttempt(id); }
  gradeAnswer(attemptId: number, answerId: number, awarded: number) { return this.client.gradeAnswer(attemptId, answerId, awarded); }
  library(filters: LibraryFilters = {}) { return this.client.library(filters); }
}

export const testsStore = new TestsStore(apiClient);
