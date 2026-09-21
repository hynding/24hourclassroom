import type { User } from '@24hc/shared';

export interface ResolvedRoute {
  tag: string;
  teacherId?: number;
  testId?: number;
  attemptId?: number;
  materialId?: number;
  /** Which library segment page-library is showing. */
  kind?: 'tests' | 'materials';
}

const GUEST_ONLY = ['/login', '/register', '/forgot-password', '/reset-password'];
const AUTH_ONLY = ['/profile', '/connections', '/notifications', '/tests', '/tests/new', '/materials', '/materials/new'];
const TEACHER_PREFIX = '/teachers/';
const TESTS_PREFIX = '/tests/';
const MATERIALS_PREFIX = '/materials/';
const ATTEMPTS_PREFIX = '/attempts/';
const TEST_SUBPAGES: Record<string, string> = {
  edit: 'page-test-editor',
  assign: 'page-test-assign',
  results: 'page-test-results',
  print: 'page-test-print',
};
const MATERIAL_SUBPAGES: Record<string, string> = {
  edit: 'page-material-form',
  share: 'page-material-share',
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

/**
 * A sibling of testRoute(), not a parameterised helper: testRoute() is
 * hardcoded to its prefix, sub-page map and `testId` key, and generalising it
 * would churn three call sites for no gain.
 */
function materialRoute(path: string): ResolvedRoute | null {
  if (!path.startsWith(MATERIALS_PREFIX)) {
    return null;
  }
  const [idSegment, sub, ...rest] = path.slice(MATERIALS_PREFIX.length).split('/');
  if (rest.length > 0) {
    return { tag: 'page-home' };
  }
  const materialId = parseId(idSegment);
  if (sub === undefined || sub === '') {
    return { tag: 'page-material', materialId };
  }
  const tag = MATERIAL_SUBPAGES[sub];
  return tag ? { tag, materialId } : { tag: 'page-home' };
}

/** Public even logged out, so exempt from the verification gate. */
function isPublic(path: string): boolean {
  if (path === '/teachers' || path.startsWith(TEACHER_PREFIX) || path === '/library' || path === '/library/materials') {
    return true;
  }
  // '/tests/new' and '/materials/new' parse through their helpers as a
  // (bogus) /:prefix/:id with id "new" -- the same shape as /tests/abc --
  // which would otherwise read as the public single-item view. Both are
  // distinct, auth-only routes (see AUTH_ONLY), so exclude them before
  // consulting either helper.
  if (path === '/tests/new' || path === '/materials/new') {
    return false;
  }
  const test = testRoute(path);
  if (test !== null) {
    return test.tag === 'page-test' || test.tag === 'page-test-print';
  }
  const material = materialRoute(path);
  return material !== null && material.tag === 'page-material';
}

function isAuthOnly(path: string): boolean {
  if (AUTH_ONLY.includes(path) || path.startsWith(ATTEMPTS_PREFIX)) {
    return true;
  }
  const test = testRoute(path);
  if (test !== null && ['page-test-editor', 'page-test-assign', 'page-test-results'].includes(test.tag)) {
    return true;
  }
  const material = materialRoute(path);
  return material !== null && ['page-material-form', 'page-material-share'].includes(material.tag);
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
  if (path === '/materials') {
    return { tag: 'page-materials' };
  }
  if (path === '/materials/new') {
    return { tag: 'page-material-form', materialId: undefined };
  }
  if (path === '/library') {
    return { tag: 'page-library', kind: 'tests' };
  }
  if (path === '/library/materials') {
    return { tag: 'page-library', kind: 'materials' };
  }
  const test = testRoute(path);
  if (test) {
    return test;
  }
  const material = materialRoute(path);
  if (material) {
    return material;
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
