import type {
  AppNotification,
  Connection,
  GradeLevel,
  Paginated,
  PendingConnections,
  Profile,
  PublicProfile,
  RegistrationRole,
  SiteConfig,
  Subject,
  TeacherSummary,
  User,
} from '@24hc/shared';

export interface ApiClientOptions {
  baseUrl: string;
  fetchFn?: typeof fetch;
}

export class ApiError extends Error {
  constructor(
    public readonly status: number,
    message: string,
    public readonly errors?: Record<string, string[]>,
  ) {
    super(message);
    this.name = 'ApiError';
  }
}

export interface RegisterData {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
  role: RegistrationRole;
}

export interface ResetPasswordData {
  token: string;
  email: string;
  password: string;
  password_confirmation: string;
}

export interface ProfileInput {
  bio?: string | null;
  school?: string | null;
  specialties?: string | null;
  subjects?: Subject[];
  grade_levels?: GradeLevel[];
}

export interface TeacherFilters {
  subject?: Subject;
  grade?: GradeLevel;
  q?: string;
  page?: number;
}

export class ApiClient {
  private csrfReady = false;

  constructor(private readonly opts: ApiClientOptions) {}

  private get fetchFn(): typeof fetch {
    return this.opts.fetchFn ?? fetch.bind(globalThis);
  }

  async get<T>(path: string): Promise<T> {
    return this.request<T>('GET', path);
  }

  async post<T>(path: string, body?: unknown): Promise<T> {
    await this.ensureCsrf();
    return this.request<T>('POST', path, body);
  }

  async put<T>(path: string, body?: unknown): Promise<T> {
    await this.ensureCsrf();
    return this.request<T>('PUT', path, body);
  }

  async patch<T>(path: string, body?: unknown): Promise<T> {
    await this.ensureCsrf();
    return this.request<T>('PATCH', path, body);
  }

  async delete<T>(path: string): Promise<T> {
    await this.ensureCsrf();
    return this.request<T>('DELETE', path);
  }

  async postForm<T>(path: string, form: FormData): Promise<T> {
    await this.ensureCsrf();
    return this.request<T>('POST', path, form);
  }

  async currentUser(): Promise<User | null> {
    try {
      return await this.get<User>('/api/user');
    } catch (e) {
      if (e instanceof ApiError && (e.status === 401 || e.status === 419)) {
        return null;
      }
      throw e;
    }
  }

  async register(data: RegisterData): Promise<void> {
    await this.post('/api/auth/register', data);
  }

  async login(data: { email: string; password: string }): Promise<void> {
    await this.post('/api/auth/login', data);
  }

  async logout(): Promise<void> {
    await this.post('/api/auth/logout');
  }

  async forgotPassword(email: string): Promise<{ message: string }> {
    return this.post('/api/auth/forgot-password', { email });
  }

  async resetPassword(data: ResetPasswordData): Promise<void> {
    await this.post('/api/auth/reset-password', data);
  }

  async resendVerification(): Promise<void> {
    await this.post('/api/auth/verification-notification');
  }

  async completeOauth(role: RegistrationRole): Promise<void> {
    await this.post('/api/auth/oauth/complete', { role });
  }

  async getTeachers(filters: TeacherFilters = {}): Promise<Paginated<TeacherSummary>> {
    const params = new URLSearchParams();
    if (filters.subject) params.set('subject', filters.subject);
    if (filters.grade) params.set('grade', filters.grade);
    if (filters.q) params.set('q', filters.q);
    if (filters.page != null) params.set('page', String(filters.page));
    const query = params.toString();

    return this.get<Paginated<TeacherSummary>>(`/api/teachers${query ? `?${query}` : ''}`);
  }

  async getPublicProfile(id: number): Promise<PublicProfile> {
    return this.get<PublicProfile>(`/api/users/${id}`);
  }

  async getProfile(): Promise<Profile> {
    return this.get<Profile>('/api/profile');
  }

  async updateProfile(data: ProfileInput): Promise<Profile> {
    return this.put<Profile>('/api/profile', data);
  }

  async uploadAvatar(file: File): Promise<Profile> {
    const form = new FormData();
    form.append('avatar', file);

    return this.postForm<Profile>('/api/profile/avatar', form);
  }

  async deleteAvatar(): Promise<void> {
    await this.delete('/api/profile/avatar');
  }

  async followTeacher(userId: number): Promise<void> {
    await this.post(`/api/users/${userId}/follow`);
  }

  async unfollowTeacher(userId: number): Promise<void> {
    await this.delete(`/api/users/${userId}/follow`);
  }

  async getConnections(): Promise<{ data: Connection[] }> {
    return this.get<{ data: Connection[] }>('/api/connections');
  }

  async getPendingConnections(): Promise<PendingConnections> {
    return this.get<PendingConnections>('/api/connections/pending');
  }

  /** Takes the id of the USER being asked. */
  async requestConnection(userId: number): Promise<void> {
    await this.post(`/api/connections/${userId}`);
  }

  /** Takes the id of the CONNECTION row, not the user. */
  async acceptConnection(connectionId: number): Promise<void> {
    await this.patch(`/api/connections/${connectionId}`);
  }

  /** Takes the id of the CONNECTION row, not the user. */
  async removeConnection(connectionId: number): Promise<void> {
    await this.delete(`/api/connections/${connectionId}`);
  }

  async getNotifications(page?: number): Promise<Paginated<AppNotification>> {
    // Page 1 sends no param, matching getTeachers.
    const query = page && page > 1 ? `?page=${page}` : '';
    return this.get<Paginated<AppNotification>>(`/api/notifications${query}`);
  }

  async getUnreadCount(): Promise<number> {
    const body = await this.get<{ count: number }>('/api/notifications/unread-count');
    return body.count;
  }

  async getSite(): Promise<SiteConfig> {
    return this.get<SiteConfig>('/api/site');
  }

  async markNotificationsRead(ids?: string[]): Promise<void> {
    await this.post('/api/notifications/read', ids ? { ids } : {});
  }

  private async ensureCsrf(): Promise<void> {
    if (this.csrfReady) {
      return;
    }
    await this.fetchFn(`${this.opts.baseUrl}/sanctum/csrf-cookie`, { credentials: 'include' });
    this.csrfReady = true;
  }

  private readXsrfToken(): string | null {
    if (typeof document === 'undefined') {
      return null;
    }
    const match = document.cookie.match(/(?:^|;\s*)XSRF-TOKEN=([^;]+)/);
    return match ? decodeURIComponent(match[1]) : null;
  }

  private async request<T>(method: string, path: string, body?: unknown): Promise<T> {
    const isForm = typeof FormData !== 'undefined' && body instanceof FormData;
    const headers: Record<string, string> = { Accept: 'application/json' };
    // FormData must set its own Content-Type so the browser can add the multipart boundary.
    if (body !== undefined && !isForm) {
      headers['Content-Type'] = 'application/json';
    }
    const token = this.readXsrfToken();
    if (token) {
      headers['X-XSRF-TOKEN'] = token;
    }

    const res = await this.fetchFn(`${this.opts.baseUrl}${path}`, {
      method,
      credentials: 'include',
      headers,
      body: body === undefined ? undefined : isForm ? (body as FormData) : JSON.stringify(body),
    });

    if (!res.ok) {
      const body = (await res.json().catch(() => null)) as
        | { message?: string; errors?: Record<string, string[]> }
        | null;
      throw new ApiError(
        res.status,
        body?.message ?? `${method} ${path} failed with status ${res.status}`,
        body?.errors,
      );
    }

    return res.status === 204 ? (undefined as T) : ((await res.json()) as T);
  }
}
