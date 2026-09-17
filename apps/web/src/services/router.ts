import type { User } from '@24hc/shared';

export interface ResolvedRoute {
  tag: string;
  teacherId?: number;
  testId?: number;
  attemptId?: number;
}

const GUEST_ONLY = ['/login', '/register', '/forgot-password', '/reset-password'];
const AUTH_ONLY = ['/profile', '/connections', '/notifications', '/tests', '/tests/new'];
const TEACHER_PREFIX = '/teachers/';
const TESTS_PREFIX = '/tests/';
const ATTEMPTS_PREFIX = '/attempts/';
const TEST_SUBPAGES: Record<string, string> = {
  edit: 'page-test-editor',
  assign: 'page-test-assign',
  results: 'page-test-results',
  print: 'page-test-print',
};

/** Positive integer or undefined; pages render not-found off undefined. */
function parseId(segment: string | undefined): number | undefined {
  const id = Number(segment);
  return segment !== undefined && segment !== '' && Number.isInteger(id) && id > 0 ? id : undefined;
}

function testRoute(path: string): ResolvedRoute | null {
  if (!path.startsWith(TESTS_PREFIX)) {
    return null;
  }
  const [idSegment, sub, ...rest] = path.slice(TESTS_PREFIX.length).split('/');
  if (rest.length > 0) {
    return { tag: 'page-home' };
  }
  const testId = parseId(idSegment);
  if (sub === undefined || sub === '') {
    return { tag: 'page-test', testId };
  }
  const tag = TEST_SUBPAGES[sub];
  return tag ? { tag, testId } : { tag: 'page-home' };
}

/** Public even logged out, so exempt from the verification gate. */
function isPublic(path: string): boolean {
  if (path === '/teachers' || path.startsWith(TEACHER_PREFIX) || path === '/library') {
    return true;
  }
  // '/tests/new' parses through testRoute() as a (bogus) /tests/:id with
  // id "new" -- same shape as /tests/abc -- which would otherwise read as
  // the public page-test view. It is a distinct, auth-only route (see
  // AUTH_ONLY), so exclude it before consulting testRoute().
  if (path === '/tests/new') {
    return false;
  }
  const route = testRoute(path);
  return route !== null && (route.tag === 'page-test' || route.tag === 'page-test-print');
}

function isAuthOnly(path: string): boolean {
  if (AUTH_ONLY.includes(path) || path.startsWith(ATTEMPTS_PREFIX)) {
    return true;
  }
  const route = testRoute(path);
  return route !== null && ['page-test-editor', 'page-test-assign', 'page-test-results'].includes(route.tag);
}

export function resolveRoute(path: string): ResolvedRoute {
  if (path === '/teachers') {
    return { tag: 'page-teachers' };
  }
  if (path.startsWith(TEACHER_PREFIX)) {
    return { tag: 'page-teacher-profile', teacherId: parseId(path.slice(TEACHER_PREFIX.length)) };
  }
  if (path === '/tests') {
    return { tag: 'page-tests' };
  }
  if (path === '/tests/new') {
    return { tag: 'page-test-editor', testId: undefined };
  }
  if (path === '/library') {
    return { tag: 'page-library' };
  }
  const test = testRoute(path);
  if (test) {
    return test;
  }
  if (path.startsWith(ATTEMPTS_PREFIX)) {
    const [idSegment, ...rest] = path.slice(ATTEMPTS_PREFIX.length).split('/');
    return rest.length > 0 ? { tag: 'page-home' } : { tag: 'page-attempt', attemptId: parseId(idSegment) };
  }

  switch (path) {
    case '/login':
      return { tag: 'page-login' };
    case '/register':
      return { tag: 'page-register' };
    case '/register/role':
      return { tag: 'page-register-role' };
    case '/forgot-password':
      return { tag: 'page-forgot-password' };
    case '/reset-password':
      return { tag: 'page-reset-password' };
    case '/verify-email':
      return { tag: 'page-verify-email' };
    case '/profile':
      return { tag: 'page-profile' };
    case '/connections':
      return { tag: 'page-connections' };
    case '/notifications':
      return { tag: 'page-notifications' };
    default:
      return { tag: 'page-home' };
  }
}

export function redirectFor(path: string, user: User | null): string | null {
  if (user && GUEST_ONLY.includes(path)) {
    return '/';
  }
  if (!user && isAuthOnly(path)) {
    return '/login';
  }
  if (user && !user.email_verified_at && path !== '/verify-email' && !isPublic(path)) {
    return '/verify-email';
  }
  return null;
}
