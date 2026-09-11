const sessionExpired = jest.fn();
const navigate = jest.fn();

jest.mock('./auth-store', () => ({
  authStore: { sessionExpired: (...a: unknown[]) => sessionExpired(...a) },
}));

jest.mock('./navigate', () => ({
  navigate: (...a: unknown[]) => navigate(...a),
}));

import { ApiError } from '@24hc/api-client';
import { recoverFromExpiredSession } from './session-recovery';

describe('session-recovery', () => {
  beforeEach(() => {
    sessionExpired.mockClear();
    navigate.mockClear();
  });

  it('handles a 401 by clearing auth state before navigating', () => {
    const order: string[] = [];
    sessionExpired.mockImplementation(() => order.push('cleared'));
    navigate.mockImplementation(() => order.push('navigated'));

    expect(recoverFromExpiredSession(new ApiError(401, 'Unauthenticated.'))).toBe(true);

    // Order matters: the guest-only guard reads authStore.currentUser, so
    // navigating first bounces /login back to '/'.
    expect(order).toEqual(['cleared', 'navigated']);
    expect(navigate).toHaveBeenCalledWith('/login');
  });

  it('leaves a non-401 ApiError alone', () => {
    expect(recoverFromExpiredSession(new ApiError(500, 'Server Error'))).toBe(false);
    expect(sessionExpired).not.toHaveBeenCalled();
    expect(navigate).not.toHaveBeenCalled();
  });

  it('leaves a plain Error alone', () => {
    expect(recoverFromExpiredSession(new Error('network drop'))).toBe(false);
    expect(sessionExpired).not.toHaveBeenCalled();
    expect(navigate).not.toHaveBeenCalled();
  });
});
