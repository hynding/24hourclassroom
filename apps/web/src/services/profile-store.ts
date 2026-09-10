import { ApiClient, ProfileInput, TeacherFilters } from '@24hc/api-client';
import type { Paginated, Profile, PublicProfile, TeacherSummary, User } from '@24hc/shared';
import { Env } from '@stencil/core';
import { authStore } from './auth-store';

export class ProfileStore {
  private cached: Profile | null = null;
  // Bumped by clear(). EVERY method that writes to `cached` captures this
  // before its await and only writes if it's unchanged when the request
  // resolves -- closing the window where clear() (e.g. from the
  // auth-invalidation listener) lands while a request for the *previous*
  // identity is in flight. Without the check, that stale response lands in
  // the cache right after clear() emptied it, leaking the old identity's
  // profile into the new one. removeAvatar() needs it for a second reason:
  // its write is a mutation of whatever happens to be cached, so a stale
  // removal would blank the *next* user's avatar rather than the one it was
  // issued against.
  private generation = 0;

  constructor(private readonly client: ApiClient) {}

  searchTeachers(filters: TeacherFilters = {}): Promise<Paginated<TeacherSummary>> {
    return this.client.getTeachers(filters);
  }

  teacher(id: number): Promise<PublicProfile> {
    return this.client.getPublicProfile(id);
  }

  async myProfile(): Promise<Profile> {
    if (!this.cached) {
      const generation = this.generation;
      const profile = await this.client.getProfile();
      if (generation === this.generation) {
        this.cached = profile;
      }
      return profile;
    }
    return this.cached;
  }

  async save(data: ProfileInput): Promise<Profile> {
    const generation = this.generation;
    const profile = await this.client.updateProfile(data);
    if (generation === this.generation) {
      this.cached = profile;
    }
    return profile;
  }

  async uploadAvatar(file: File): Promise<Profile> {
    const generation = this.generation;
    const profile = await this.client.uploadAvatar(file);
    if (generation === this.generation) {
      this.cached = profile;
    }
    return profile;
  }

  async removeAvatar(): Promise<void> {
    const generation = this.generation;
    await this.client.deleteAvatar();
    if (generation === this.generation && this.cached) {
      this.cached = { ...this.cached, avatar_url: null };
    }
  }

  clear(): void {
    this.cached = null;
    this.generation++;
  }
}

export function attachAuthInvalidation(
  auth: { subscribe(fn: (user: User | null) => void): () => void },
  profile: ProfileStore,
): () => void {
  return auth.subscribe(() => profile.clear());
}

export const profileStore = new ProfileStore(
  new ApiClient({ baseUrl: Env?.apiBaseUrl ?? 'http://localhost:8000' }),
);

attachAuthInvalidation(authStore, profileStore);
