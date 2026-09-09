import type { User } from '@24hc/shared';

export interface ResolvedRoute {
  tag: string;
  teacherId?: number;
}

const GUEST_ONLY = ['/login', '/register', '/forgot-password', '/reset-password'];
const AUTH_ONLY = ['/profile'];
const TEACHER_PREFIX = '/teachers/';

/** Teacher profiles are public even logged out, so they are exempt from the verification gate. */
function isPublic(path: string): boolean {
  return path === '/teachers' || path.startsWith(TEACHER_PREFIX);
}

export function resolveRoute(path: string): ResolvedRoute {
  if (path === '/teachers') {
    return { tag: 'page-teachers' };
  }

  if (path.startsWith(TEACHER_PREFIX)) {
    const id = Number(path.slice(TEACHER_PREFIX.length));
    return { tag: 'page-teacher-profile', teacherId: Number.isInteger(id) && id > 0 ? id : undefined };
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
    default:
      return { tag: 'page-home' };
  }
}

export function redirectFor(path: string, user: User | null): string | null {
  if (user && GUEST_ONLY.includes(path)) {
    return '/';
  }

  if (!user && AUTH_ONLY.includes(path)) {
    return '/login';
  }

  if (user && !user.email_verified_at && path !== '/verify-email' && !isPublic(path)) {
    return '/verify-email';
  }

  return null;
}
