import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const connections = jest.fn();
const pendingConnections = jest.fn();
const acceptConnection = jest.fn();
const removeConnection = jest.fn();
const recoverFromExpiredSession = jest.fn();

jest.mock('../../services/profile-store', () => ({
  profileStore: {
    connections: (...a: unknown[]) => connections(...a),
    pendingConnections: (...a: unknown[]) => pendingConnections(...a),
    acceptConnection: (...a: unknown[]) => acceptConnection(...a),
    removeConnection: (...a: unknown[]) => removeConnection(...a),
  },
}));

jest.mock('../../services/session-recovery', () => ({
  recoverFromExpiredSession: (...a: unknown[]) => recoverFromExpiredSession(...a),
}));

// Imported after jest.mock(): Stencil transpiles with ts.transpileModule, not
// babel-jest, so jest.mock() is not hoisted above static imports.
import { PageConnections } from './page-connections';

const peer = (id: number, name: string) => ({ id, name, role: 'teacher', avatar_url: null });

describe('page-connections', () => {
  beforeEach(() => {
    connections.mockReset().mockResolvedValue({ data: [] });
    pendingConnections.mockReset().mockResolvedValue({ incoming: [], outgoing: [] });
    acceptConnection.mockReset().mockResolvedValue(undefined);
    removeConnection.mockReset().mockResolvedValue(undefined);
    recoverFromExpiredSession.mockReset().mockReturnValue(false);
  });

  const mount = () =>
    newSpecPage({ components: [PageConnections], html: '<page-connections></page-connections>' });

  it('lists accepted connections and incoming requests separately', async () => {
    connections.mockResolvedValue({ data: [{ id: 1, user: peer(10, 'Accepted Ada') }] });
    pendingConnections.mockResolvedValue({
      incoming: [{ id: 2, user: peer(20, 'Incoming Ida') }],
      outgoing: [{ id: 3, user: peer(30, 'Outgoing Otto') }],
    });

    const spec = await mount();
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    expect(text).toContain('Accepted Ada');
    expect(text).toContain('Incoming Ida');
    expect(text).toContain('Outgoing Otto');
  });

  it('shows an error and no empty-state copy when the load fails', async () => {
    connections.mockRejectedValue(new ApiError(500, 'Server Error'));

    const spec = await mount();
    await spec.waitForChanges();
    const text = spec.root.shadowRoot.textContent;

    // A failed request must not read as "you have no connections".
    expect(text).toContain('We could not load your connections.');
    expect(text).not.toContain('You have no connections yet.');
  });

  it('delegates a 401 to session recovery and renders no error of its own', async () => {
    connections.mockRejectedValue(new ApiError(401, 'Unauthenticated.'));
    recoverFromExpiredSession.mockReturnValue(true);

    const spec = await mount();
    await spec.waitForChanges();

    expect(recoverFromExpiredSession).toHaveBeenCalled();
    expect(spec.root.shadowRoot.textContent).not.toContain('We could not load your connections.');
  });

  it('accepts an incoming request by connection id and refreshes', async () => {
    pendingConnections.mockResolvedValue({
      incoming: [{ id: 2, user: peer(20, 'Incoming Ida') }],
      outgoing: [],
    });
    const spec = await mount();
    await spec.waitForChanges();

    await spec.rootInstance.accept(2);

    expect(acceptConnection).toHaveBeenCalledWith(2);
    // Refreshed rather than mutated locally, so the accepted row moves from
    // pending to accepted without a stale copy in both lists.
    expect(connections).toHaveBeenCalledTimes(2);
  });

  it('removes a connection by connection id and refreshes', async () => {
    const spec = await mount();
    await spec.waitForChanges();

    await spec.rootInstance.remove(5);

    expect(removeConnection).toHaveBeenCalledWith(5);
    expect(connections).toHaveBeenCalledTimes(2);
  });

  it('shows the empty state only when the load actually succeeded', async () => {
    const spec = await mount();
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('You have no connections yet.');
  });
});
