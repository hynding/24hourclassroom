/**
 * Thrown by a profile-store method whose request was issued for an identity
 * that has since been cleared (logout, or a switch to another user).
 *
 * The store's generation guard already refuses to CACHE such a response. It
 * must also refuse to RETURN it: consumers assign what the store hands back
 * -- app-header writes `unreadCount()` straight into its badge -- so a
 * returned-but-uncached value still renders the previous identity's data
 * under the new one.
 *
 * markRead() bumps the same generation counter, so an unreadCount() that
 * spans it is refused for the same reason: the number it carries describes
 * a read state that no longer exists.
 *
 * It lives in its own module rather than in profile-store so that specs
 * which `jest.mock('../../services/profile-store')` can still do a real
 * `instanceof` check against it.
 */
export class StaleIdentityError extends Error {
  constructor() {
    super('Discarded a response belonging to a previous identity.');
    this.name = 'StaleIdentityError';
    // Restores the prototype chain across the ES5 target Stencil transpiles
    // to, without which `instanceof` is false for a subclassed Error.
    Object.setPrototypeOf(this, StaleIdentityError.prototype);
  }
}
