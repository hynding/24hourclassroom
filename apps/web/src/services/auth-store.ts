import { ApiClient, RegisterData, ResetPasswordData } from '@24hc/api-client';
import type { Role, User } from '@24hc/shared';
import { Env } from '@stencil/core';

type Listener = (user: User | null) => void;

export class AuthStore {
  private user: User | null = null;
  private loaded = false;
  private listeners = new Set<Listener>();

  constructor(private readonly client: ApiClient) {}

  get currentUser(): User | null {
    return this.user;
  }

  subscribe(fn: Listener): () => void {
    this.listeners.add(fn);
    return () => this.listeners.delete(fn);
  }

  async load(): Promise<User | null> {
    if (!this.loaded) {
      this.user = await this.client.currentUser();
      this.loaded = true;
      this.notify();
    }
    return this.user;
  }

  async login(email: string, password: string): Promise<void> {
    await this.client.login({ email, password });
    await this.refresh();
  }

  async register(data: RegisterData): Promise<void> {
    await this.client.register(data);
    await this.refresh();
  }

  async logout(): Promise<void> {
    await this.client.logout();
    this.user = null;
    this.notify();
  }

  async completeOauth(role: Role): Promise<void> {
    await this.client.completeOauth(role);
    await this.refresh();
  }

  forgotPassword(email: string): Promise<{ message: string }> {
    return this.client.forgotPassword(email);
  }

  resetPassword(data: ResetPasswordData): Promise<void> {
    return this.client.resetPassword(data);
  }

  resendVerification(): Promise<void> {
    return this.client.resendVerification();
  }

  /**
   * Drop the cached user because the server rejected the session (a 401),
   * without asking the server again -- it just told us. Callers navigate
   * afterwards; clearing first is what stops the guest-only guard on /login
   * from reading a stale user and bouncing the request straight back to '/'.
   */
  sessionExpired(): void {
    this.user = null;
    this.notify();
  }

  private async refresh(): Promise<void> {
    this.user = await this.client.currentUser();
    this.loaded = true;
    this.notify();
  }

  private notify(): void {
    this.listeners.forEach((l) => l(this.user));
  }
}

export const authStore = new AuthStore(
  new ApiClient({ baseUrl: Env?.apiBaseUrl ?? 'http://localhost:8000' }),
);
