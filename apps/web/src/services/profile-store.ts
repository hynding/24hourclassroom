import { ApiClient, ProfileInput, TeacherFilters } from '@24hc/api-client';
import type {
  AppNotification,
  Connection,
  Paginated,
  PendingConnections,
  Profile,
  PublicProfile,
  TeacherSummary,
  User,
} from '@24hc/shared';
import { Env } from '@stencil/core';
import { authStore } from './auth-store';
import { StaleIdentityError } from './stale-identity';

export class ProfileStore {
  private cached: Profile | null = null;
  private cachedUnread: number | null = null;
  // Bumped by clear(). EVERY method that writes to `cached` captures this
  // before its await and, if it has changed by the time the request
  // resolves, throws StaleIdentityError rather than writing OR returning
  // -- closing the window where clear() (e.g. from the auth-invalidation
  // listener) lands while a request for the *previous* identity is in
  // flight. Without the check, that stale response lands in
  // the cache right after clear() emptied it, leaking the old identity's
  // profile into the new one. Rejecting rather than merely declining to
  // cache is load-bearing: consumers assign what the store returns
  // (app-header writes unreadCount() into its badge), so a
  // returned-but-uncached value renders the old identity's data anyway.
  // removeAvatar() needs the guard for a second reason:
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
      if (generation !== this.generation) {
        throw new StaleIdentityError();
      }
      this.cached = profile;
      return profile;
    }
    return this.cached;
  }

  async save(data: ProfileInput): Promise<Profile> {
    const generation = this.generation;
    const profile = await this.client.updateProfile(data);
    if (generation !== this.generation) {
      throw new StaleIdentityError();
    }
    this.cached = profile;
    return profile;
  }

  async uploadAvatar(file: File): Promise<Profile> {
    const generation = this.generation;
    const profile = await this.client.uploadAvatar(file);
    if (generation !== this.generation) {
      throw new StaleIdentityError();
    }
    this.cached = profile;
    return profile;
  }

  async removeAvatar(): Promise<void> {
    const generation = this.generation;
    await this.client.deleteAvatar();
    if (generation === this.generation && this.cached) {
      this.cached = { ...this.cached, avatar_url: null };
    }
  }

  connections(): Promise<{ data: Connection[] }> {
    return this.client.getConnections();
  }

  pendingConnections(): Promise<PendingConnections> {
    return this.client.getPendingConnections();
  }

  follow(userId: number): Promise<void> {
    return this.client.followTeacher(userId);
  }

  unfollow(userId: number): Promise<void> {
    return this.client.unfollowTeacher(userId);
  }

  requestConnection(userId: number): Promise<void> {
    return this.client.requestConnection(userId);
  }

  acceptConnection(connectionId: number): Promise<void> {
    return this.client.acceptConnection(connectionId);
  }

  removeConnection(connectionId: number): Promise<void> {
    return this.client.removeConnection(connectionId);
  }

  notifications(page?: number): Promise<Paginated<AppNotification>> {
    return this.client.getNotifications(page);
  }

  async unreadCount(): Promise<number> {
    if (this.cachedUnread === null) {
      const generation = this.generation;
      const count = await this.client.getUnreadCount();
      if (generation !== this.generation) {
        throw new StaleIdentityError();
      }
      this.cachedUnread = count;
      return count;
    }
    return this.cachedUnread;
  }

  async markRead(ids?: string[]): Promise<void> {
    await this.client.markNotificationsRead(ids);
    this.cachedUnread = null;
    // Invalidate any unreadCount() that started before this landed, the same
    // way clear() does -- otherwise it can resolve afterward and write the
    // pre-read stale count back into the cache, leaving the bell showing
    // notifications the user just read.
    this.generation++;
  }

  clear(): void {
    this.cached = null;
    this.cachedUnread = null;
    this.generation++;
  }
}

export function attachAuthInvalidation(
  auth: { subscribe(fn: (user: User | null) => void): () => void },
  profile: ProfileStore,
): () => void {
  return auth.subscribe(() => profile.clear());
}

export const apiClient = new ApiClient({ baseUrl: Env?.apiBaseUrl ?? 'http://localhost:8000' });

export const profileStore = new ProfileStore(apiClient);

attachAuthInvalidation(authStore, profileStore);
