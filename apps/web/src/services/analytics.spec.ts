import { optedOut, resetAnalyticsForTests, trackPageView } from './analytics';

describe('analytics', () => {
  const calls: { url: string; init: RequestInit }[] = [];

  beforeEach(() => {
    jest.useFakeTimers();
    calls.length = 0;
    resetAnalyticsForTests();
    window.sessionStorage.clear();
    (globalThis as { fetch?: unknown }).fetch = jest.fn((url: string, init: RequestInit) => {
      calls.push({ url, init });
      return Promise.resolve(new Response(null, { status: 204 }));
    });
    window.location.href = 'http://localhost:3333/courses/12?utm_source=apbio-group&x=secret';
  });

  afterEach(() => {
    jest.useRealTimers();
  });

  it('counts the page it settles on, anonymously, once per path', () => {
    trackPageView();
    trackPageView();
    jest.advanceTimersByTime(1500);
    trackPageView();
    jest.advanceTimersByTime(1500);

    expect(calls).toHaveLength(1);
    expect(calls[0].url).toMatch(/\/api\/analytics\/view$/);
    expect(calls[0].init.credentials).toBe('omit');
    const body = JSON.parse(String(calls[0].init.body));
    expect(body).toEqual({ path: '/courses/12', visit: true, source: 'apbio-group' });
    expect(JSON.stringify(body)).not.toContain('secret');
  });

  it('marks only the first page of a tab as a visit', () => {
    trackPageView();
    jest.advanceTimersByTime(1500);
    window.location.href = 'http://localhost:3333/library/courses';
    trackPageView();
    jest.advanceTimersByTime(1500);

    expect(JSON.parse(String(calls[1].init.body))).toEqual({ path: '/library/courses' });
  });

  it('sends nothing under Do Not Track, Global Privacy Control or automation', () => {
    expect(optedOut({ doNotTrack: '1' } as Navigator)).toBe(true);
    expect(optedOut({ globalPrivacyControl: true } as unknown as Navigator)).toBe(true);
    expect(optedOut({ webdriver: true } as Navigator)).toBe(true);
    expect(optedOut({ doNotTrack: null, webdriver: false } as unknown as Navigator)).toBe(false);
  });
});
