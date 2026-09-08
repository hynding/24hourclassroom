import type { User } from '@24hc/shared';

export interface ApiClientOptions {
  baseUrl: string;
  fetchFn?: typeof fetch;
}

export class ApiError extends Error {
  constructor(
    public readonly status: number,
    message: string,
  ) {
    super(message);
    this.name = 'ApiError';
  }
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
    const headers: Record<string, string> = { Accept: 'application/json' };
    if (body !== undefined) {
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
      body: body === undefined ? undefined : JSON.stringify(body),
    });

    if (!res.ok) {
      throw new ApiError(res.status, `${method} ${path} failed with status ${res.status}`);
    }

    return res.status === 204 ? (undefined as T) : ((await res.json()) as T);
  }
}
