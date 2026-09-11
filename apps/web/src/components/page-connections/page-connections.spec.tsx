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
const student = (id: number, name: string) => ({ id, name, role: 'student', avatar_url: null });

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

    // Scoped to each section rather than the flattened textContent: the
    // page's entire job is keeping incoming (Accept/Decline), outgoing
    // (Cancel) and accepted (Disconnect) apart, since a misrouted row offers
    // the wrong action -- most visibly an Accept button on the user's own
    // outgoing request, which the API rejects with a 403. Presence alone
    // would not catch a row rendering in the wrong section, or in two.
    const incomingText = spec.root.shadowRoot.querySelector('[data-testid="incoming-section"]').textContent;
    const outgoingText = spec.root.shadowRoot.querySelector('[data-testid="outgoing-section"]').textContent;
    const acceptedText = spec.root.shadowRoot.querySelector('[data-testid="accepted-section"]').textContent;

    expect(incomingText).toContain('Incoming Ida');
    expect(incomingText).not.toContain('Outgoing Otto');
    expect(incomingText).not.toContain('Accepted Ada');

    expect(outgoingText).toContain('Outgoing Otto');
    expect(outgoingText).not.toContain('Incoming Ida');
    expect(outgoingText).not.toContain('Accepted Ada');

    expect(acceptedText).toContain('Accepted Ada');
    expect(acceptedText).not.toContain('Incoming Ida');
    expect(acceptedText).not.toContain('Outgoing Otto');
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

  it('accepts a rendered incoming request by connection id, not the user id', async () => {
    // Connection id (2) and user id (20) are deliberately distinct numbers
    // so a bug that wired the button to connection.user.id would show up as
    // a wrong-argument assertion failure instead of passing by coincidence.
    pendingConnections.mockResolvedValue({
      incoming: [{ id: 2, user: peer(20, 'Incoming Ida') }],
      outgoing: [],
    });
    const spec = await mount();
    await spec.waitForChanges();

    const button = spec.root.shadowRoot.querySelector('[data-testid="accept-2"]') as HTMLButtonElement;
    expect(button).not.toBeNull();
    button.click();
    await spec.waitForChanges();
    await spec.waitForChanges();

    expect(acceptConnection).toHaveBeenCalledWith(2);
    expect(acceptConnection).not.toHaveBeenCalledWith(20);
    // Refreshed rather than mutated locally, so the accepted row moves from
    // pending to accepted without a stale copy in both lists.
    expect(connections).toHaveBeenCalledTimes(2);
  });

  it('removes a rendered connection by connection id, not the user id', async () => {
    // Connection id (5) and user id (50) are deliberately distinct numbers,
    // for the same reason as above.
    connections.mockResolvedValue({ data: [{ id: 5, user: peer(50, 'Accepted Anna') }] });
    const spec = await mount();
    await spec.waitForChanges();

    const button = spec.root.shadowRoot.querySelector('[data-testid="disconnect-5"]') as HTMLButtonElement;
    expect(button).not.toBeNull();
    button.click();
    await spec.waitForChanges();
    await spec.waitForChanges();

    expect(removeConnection).toHaveBeenCalledWith(5);
    expect(removeConnection).not.toHaveBeenCalledWith(50);
    expect(connections).toHaveBeenCalledTimes(2);
  });

  it('shows the empty state only when the load actually succeeded', async () => {
    const spec = await mount();
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('You have no connections yet.');
  });

  it('resyncs instead of leaving a failed accept unhandled', async () => {
    pendingConnections.mockResolvedValue({
      incoming: [{ id: 2, user: peer(20, 'Incoming Ida') }],
      outgoing: [],
    });
    const spec = await mount();
    await spec.waitForChanges();

    // The other party cancelled the request from their own tab, so this
    // still-rendered Accept button now 404s.
    const gone = new ApiError(404, 'Not Found');
    acceptConnection.mockRejectedValue(gone);

    (spec.root.shadowRoot.querySelector('[data-testid="accept-2"]') as HTMLButtonElement).click();
    await spec.waitForChanges();
    await spec.waitForChanges();

    // The rejection is handled rather than escaping as an unhandled promise
    // rejection: offered to session recovery first...
    expect(recoverFromExpiredSession).toHaveBeenCalledWith(gone);
    // ...and, because 404 is not a recovery case, the page resyncs so the
    // dead row disappears instead of surviving until a hard refresh.
    expect(connections).toHaveBeenCalledTimes(2);
  });

  it('delegates a 401 from accept to session recovery and does not resync over the redirect', async () => {
    pendingConnections.mockResolvedValue({
      incoming: [{ id: 2, user: peer(20, 'Incoming Ida') }],
      outgoing: [],
    });
    const spec = await mount();
    await spec.waitForChanges();

    acceptConnection.mockRejectedValue(new ApiError(401, 'Unauthenticated.'));
    recoverFromExpiredSession.mockReturnValue(true);

    (spec.root.shadowRoot.querySelector('[data-testid="accept-2"]') as HTMLButtonElement).click();
    await spec.waitForChanges();
    await spec.waitForChanges();

    expect(recoverFromExpiredSession).toHaveBeenCalled();
    // The exclusion side: a handled 401 has already navigated to /login, so
    // reloading the list would fire a second doomed request at it.
    expect(connections).toHaveBeenCalledTimes(1);
  });

  it('resyncs instead of leaving a failed remove unhandled', async () => {
    connections.mockResolvedValue({ data: [{ id: 5, user: peer(50, 'Accepted Anna') }] });
    const spec = await mount();
    await spec.waitForChanges();

    const gone = new ApiError(404, 'Not Found');
    removeConnection.mockRejectedValue(gone);

    (spec.root.shadowRoot.querySelector('[data-testid="disconnect-5"]') as HTMLButtonElement).click();
    await spec.waitForChanges();
    await spec.waitForChanges();

    expect(recoverFromExpiredSession).toHaveBeenCalledWith(gone);
    expect(connections).toHaveBeenCalledTimes(2);
  });

  it('labels a redacted outgoing pending row rather than rendering it blank', async () => {
    // Wave A's A3: an outgoing pending request addressed to a STUDENT now
    // carries `user: { id }` only -- no name, no role, no avatar_url --
    // so the student's identity is not disclosed by a request the teacher
    // sent. `connection.user.name` is undefined here, and tsconfig sets no
    // "strict", so nothing but this test catches the blank row.
    pendingConnections.mockResolvedValue({
      incoming: [],
      outgoing: [{ id: 3, user: { id: 30 } }],
    });

    const spec = await mount();
    await spec.waitForChanges();

    const outgoing = spec.root.shadowRoot.querySelector('[data-testid="outgoing-section"]');
    expect(outgoing.textContent).toContain('Pending request');
    // And it stays cancellable: an unlabelled row the user cannot clear is
    // exactly the unclearable-row bug wave A fixed server-side.
    expect(outgoing.querySelector('[data-testid="cancel-3"]')).not.toBeNull();
  });

  it('does not label a named row as a pending request', async () => {
    // The exclusion side: the placeholder is scoped to a missing name, not
    // applied to every outgoing row.
    pendingConnections.mockResolvedValue({
      incoming: [],
      outgoing: [{ id: 3, user: peer(30, 'Outgoing Otto') }],
    });

    const spec = await mount();
    await spec.waitForChanges();

    const outgoing = spec.root.shadowRoot.querySelector('[data-testid="outgoing-section"]');
    expect(outgoing.textContent).toContain('Outgoing Otto');
    expect(outgoing.textContent).not.toContain('Pending request');
  });

  it('does not link a pending student counterpart, whose profile 404s', async () => {
    // GET /api/users/{student} is 404 to anyone who is not an ACCEPTED
    // connection, so a link on a PENDING student row lands the user on a
    // Not Found page for someone who is plainly listed right above it.
    pendingConnections.mockResolvedValue({
      incoming: [{ id: 2, user: student(20, 'Sam Student') }],
      outgoing: [],
    });

    const spec = await mount();
    await spec.waitForChanges();

    const incoming = spec.root.shadowRoot.querySelector('[data-testid="incoming-section"]');
    // The name still shows -- the addressee has to know who is asking.
    expect(incoming.textContent).toContain('Sam Student');
    expect(incoming.querySelector('a')).toBeNull();
  });

  it('does not link a redacted outgoing row either', async () => {
    // No `role` at all on the redacted payload, which must read as
    // "not a teacher" rather than falling through to a link.
    pendingConnections.mockResolvedValue({
      incoming: [],
      outgoing: [{ id: 3, user: { id: 30 } }],
    });

    const spec = await mount();
    await spec.waitForChanges();

    expect(
      spec.root.shadowRoot.querySelector('[data-testid="outgoing-section"]').querySelector('a'),
    ).toBeNull();
  });

  it('still links a pending teacher counterpart', async () => {
    // The inclusion side: teachers are publicly reachable at
    // /api/users/{id}, so their pending rows keep the link.
    pendingConnections.mockResolvedValue({
      incoming: [{ id: 2, user: peer(20, 'Pending Pat') }],
      outgoing: [],
    });

    const spec = await mount();
    await spec.waitForChanges();

    const link = spec.root.shadowRoot
      .querySelector('[data-testid="incoming-section"]')
      .querySelector('a');
    expect(link.getAttribute('href')).toBe('/teachers/20');
  });

  it('still links an ACCEPTED student counterpart', async () => {
    // The other exclusion side: acceptance is exactly what makes a student
    // reachable (decision 5), so the rule must be scoped to pending rows
    // and not degenerate into "never link a student".
    connections.mockResolvedValue({ data: [{ id: 4, user: student(40, 'Accepted Ann') }] });

    const spec = await mount();
    await spec.waitForChanges();

    const link = spec.root.shadowRoot
      .querySelector('[data-testid="accepted-section"]')
      .querySelector('a');
    expect(link.getAttribute('href')).toBe('/teachers/40');
  });
});
