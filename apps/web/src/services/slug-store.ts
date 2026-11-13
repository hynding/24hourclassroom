import type { ApiClient } from '@24hc/api-client';
import { apiClient } from './profile-store';

/**
 * Vanity paths (App\Support\Slugs): resolving them, and a teacher's
 * handle. A stateless pass-through so specs mock one module. A course's
 * own slug is set through coursesStore.setCourseSlug.
 */
export class SlugStore {
  constructor(private readonly client: ApiClient) {}

  resolve(path: string) { return this.client.resolvePath(path); }
  getHandle() { return this.client.getHandle(); }
  requestHandle(handle: string | null) { return this.client.requestHandle(handle); }
}

export const slugStore = new SlugStore(apiClient);
