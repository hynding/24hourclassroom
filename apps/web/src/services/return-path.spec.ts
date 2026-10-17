import { RETURN_PATH_KEY, rememberReturnPath, takeReturnPath } from './return-path';

describe('return-path', () => {
  beforeEach(() => window.localStorage.clear());

  it('hands back a remembered course once', () => {
    rememberReturnPath('/courses/12', 1000);
    expect(takeReturnPath(2000)).toBe('/courses/12');
    expect(takeReturnPath(3000)).toBeNull();
  });

  it('remembers only course pages', () => {
    for (const path of ['/', '/login', '/courses/12/edit', '//evil.example', 'https://evil.example/courses/1', '/courses/abc']) {
      rememberReturnPath(path);
      expect(window.localStorage.getItem(RETURN_PATH_KEY)).toBeNull();
    }
  });

  it('drops a path older than a day, and anything tampered with', () => {
    rememberReturnPath('/courses/12', 0);
    expect(takeReturnPath(24 * 60 * 60 * 1000)).toBeNull();

    window.localStorage.setItem(RETURN_PATH_KEY, JSON.stringify({ path: '//evil.example', at: 0 }));
    expect(takeReturnPath(1)).toBeNull();
    window.localStorage.setItem(RETURN_PATH_KEY, 'not json');
    expect(takeReturnPath(1)).toBeNull();
    expect(window.localStorage.getItem(RETURN_PATH_KEY)).toBeNull();
  });
});
