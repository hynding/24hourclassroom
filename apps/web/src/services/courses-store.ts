import type { ApiClient } from '@24hc/api-client';
import type { CourseInput, LibraryFilters } from '@24hc/shared';
import { apiClient } from './profile-store';

/**
 * Thin, stateless pass-through so pages mock ONE module (the same reason
 * tests-store.ts exists). Nothing is cached: a course's visibility, and
 * which of its items a visitor may see, can change under the viewer.
 */
export class CoursesStore {
  constructor(private readonly client: ApiClient) {}

  listCourses(page?: number) { return this.client.listCourses(page); }
  coursesLibrary(filters: LibraryFilters = {}) { return this.client.coursesLibrary(filters); }
  courseCandidates() { return this.client.courseCandidates(); }
  getCourse(id: number) { return this.client.getCourse(id); }
  createCourse(data: CourseInput) { return this.client.createCourse(data); }
  updateCourse(id: number, data: CourseInput) { return this.client.updateCourse(id, data); }
  deleteCourse(id: number) { return this.client.deleteCourse(id); }
  publishCourse(id: number) { return this.client.publishCourse(id); }
  unpublishCourse(id: number) { return this.client.unpublishCourse(id); }
  getPracticeTest(courseId: number, testId: number) { return this.client.getPracticeTest(courseId, testId); }
  checkPractice(courseId: number, testId: number, responses: Record<number, unknown>) { return this.client.checkPractice(courseId, testId, responses); }
}

export const coursesStore = new CoursesStore(apiClient);
