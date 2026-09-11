import { Component, h, State } from '@stencil/core';
import type { Connection } from '@24hc/shared';
import { profileStore } from '../../services/profile-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { navigate } from '../../services/navigate';

@Component({ tag: 'page-connections', shadow: true })
export class PageConnections {
  @State() accepted: Connection[] = [];
  @State() incoming: Connection[] = [];
  @State() outgoing: Connection[] = [];
  @State() loaded = false;
  @State() error = false;
  @State() busy = false;

  async componentWillLoad() {
    await this.load();
  }

  private async load() {
    this.error = false;
    try {
      const [accepted, pending] = await Promise.all([
        profileStore.connections(),
        profileStore.pendingConnections(),
      ]);
      this.accepted = accepted.data;
      this.incoming = pending.incoming;
      this.outgoing = pending.outgoing;
      this.loaded = true;
    } catch (e) {
      if (recoverFromExpiredSession(e)) {
        return;
      }
      // Never fall through to the empty state -- "no connections" would be a
      // confident, wrong answer to a request that simply failed.
      this.error = true;
    }
  }

  async accept(connectionId: number) {
    this.busy = true;
    try {
      await profileStore.acceptConnection(connectionId);
      await this.load();
    } finally {
      this.busy = false;
    }
  }

  async remove(connectionId: number) {
    this.busy = true;
    try {
      await profileStore.removeConnection(connectionId);
      await this.load();
    } finally {
      this.busy = false;
    }
  }

  private personLink(connection: Connection) {
    return (
      <a
        href={`/teachers/${connection.user.id}`}
        onClick={(e) => {
          e.preventDefault();
          navigate(`/teachers/${connection.user.id}`);
        }}
      >
        {connection.user.name}
      </a>
    );
  }

  render() {
    if (this.error) {
      return (
        <section>
          <h1>Connections</h1>
          <p class="error">We could not load your connections.</p>
          <button type="button" onClick={() => this.load()}>Retry</button>
        </section>
      );
    }

    if (!this.loaded) {
      return (
        <section>
          <h1>Connections</h1>
          <p>Loading…</p>
        </section>
      );
    }

    return (
      <section>
        <h1>Connections</h1>

        {this.incoming.length > 0 && (
          <section data-testid="incoming-section">
            <h2>Requests for you</h2>
            <ul>
              {this.incoming.map((connection) => (
                <li key={connection.id}>
                  {this.personLink(connection)}
                  <button
                    type="button"
                    data-testid={`accept-${connection.id}`}
                    disabled={this.busy}
                    onClick={() => this.accept(connection.id)}
                  >
                    Accept
                  </button>
                  <button
                    type="button"
                    data-testid={`decline-${connection.id}`}
                    disabled={this.busy}
                    onClick={() => this.remove(connection.id)}
                  >
                    Decline
                  </button>
                </li>
              ))}
            </ul>
          </section>
        )}

        {this.outgoing.length > 0 && (
          <section data-testid="outgoing-section">
            <h2>Requests you sent</h2>
            <ul>
              {this.outgoing.map((connection) => (
                <li key={connection.id}>
                  {this.personLink(connection)}
                  <button
                    type="button"
                    data-testid={`cancel-${connection.id}`}
                    disabled={this.busy}
                    onClick={() => this.remove(connection.id)}
                  >
                    Cancel
                  </button>
                </li>
              ))}
            </ul>
          </section>
        )}

        <section data-testid="accepted-section">
          {this.accepted.length === 0 ? (
            <p>You have no connections yet.</p>
          ) : (
            <ul>
              {this.accepted.map((connection) => (
                <li key={connection.id}>
                  {this.personLink(connection)}
                  <button
                    type="button"
                    data-testid={`disconnect-${connection.id}`}
                    disabled={this.busy}
                    onClick={() => this.remove(connection.id)}
                  >
                    Disconnect
                  </button>
                </li>
              ))}
            </ul>
          )}
        </section>
      </section>
    );
  }
}
