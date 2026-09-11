import { ApiError } from '@24hc/api-client';
import { authStore } from './auth-store';
import { navigate } from './navigate';

/**
 * Handle a 401 from any authenticated call: the session is gone, either
 * because a logged-out visitor reached the page before the route guard
 * resolved, or because a signed-in user's session expired mid-session.
 *
 * Returns true when it handled the error, so callers can `return` early
 * rather than also rendering an error state.
 *
 * sessionExpired() runs BEFORE navigate() deliberately -- the guest-only
 * guard reads authStore.currentUser, so navigating with a stale user there
 * bounces /login straight back to '/'.
 */
export function recoverFromExpiredSession(e: unknown): boolean {
  if (e instanceof ApiError && e.status === 401) {
    authStore.sessionExpired();
    navigate('/login');
    return true;
  }

  return false;
}
