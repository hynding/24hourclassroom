import { ApiClient, ProfileInput, TeacherFilters } from '@24hc/api-client';
import type { Paginated, Profile, PublicProfile, TeacherSummary, User } from '@24hc/shared';
import { Env } from '@stencil/core';
import { authStore } from './auth-store';

export class ProfileStore {
  private cached: Profile | null = null;

  constructor(private readonly client: ApiClient) {}

  searchTeachers(filters: TeacherFilters = {}): Promise<Paginated<TeacherSummary>> {
    return this.client.getTeachers(filters);
  }

  teacher(id: number): Promise<PublicProfile> {
    return this.client.getPublicProfile(id);
  }

  async myProfile(): Promise<Profile> {
    if (!this.cached) {
      this.cached = await this.client.getProfile();
    }
    return this.cached;
  }

  async save(data: ProfileInput): Promise<Profile> {
    this.cached = await this.client.updateProfile(data);
    return this.cached;
  }

  async uploadAvatar(file: File): Promise<Profile> {
    this.cached = await this.client.uploadAvatar(file);
    return this.cached;
  }

  async removeAvatar(): Promise<void> {
    await this.client.deleteAvatar();
    if (this.cached) {
      this.cached = { ...this.cached, avatar_url: null };
    }
  }

  clear(): void {
    this.cached = null;
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
