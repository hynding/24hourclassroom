import { Component, h, Listen, State } from '@stencil/core';
import type { User } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { profileStore } from '../../services/profile-store';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { navigate } from '../../services/navigate';
import { StaleIdentityError } from '../../services/stale-identity';

@Component({ tag: 'app-header', shadow: true })
export class AppHeader {
  @State() user: User | null = null;
  @State() unread = 0;

  private unsubscribe: () => void = () => undefined;

  connectedCallback() {
    this.unsubscribe = authStore.subscribe((user) => {
      this.user = user;
      this.loadUnread();
    });
    this.user = authStore.currentUser;
    this.loadUnread();
  }

  disconnectedCallback() {
    this.unsubscribe();
  }

  // app-header is mounted once, persistently, outside the route switch --
  // app-root's renderPage() swaps only <main>'s content -- so navigating to
  // /notifications never re-mounts the header or re-fires the auth
  // subscription. page-notifications announces its markRead() with this
  // event so the header's own `unread` copy doesn't go stale until the next
  // login/logout.
  @Listen('notifications:read', { target: 'window' })
  onNotificationsRead() {
    this.loadUnread();
  }

  private async loadUnread() {
    // Every notification-producing action is behind `verified` on the
    // server, so a signed-out or unverified user can never have one --
    // fetching would be a guaranteed wasted request.
    if (!this.user || !this.user.email_verified_at) {
      this.unread = 0;
      return;
    }
    try {
      this.unread = await profileStore.unreadCount();
    } catch (e) {
      if (e instanceof StaleIdentityError) {
        // This response was issued for a previous identity and the store
        // refused to hand it back. Write NOTHING: the current identity's
        // own loadUnread() -- fired by the same auth change that
        // invalidated this one -- is the only call entitled to this
        // field, and it may already have landed. Falling through would
        // blank a badge that is correct.
        return;
      }
      if (recoverFromExpiredSession(e)) {
        return;
      }
      // A persistent chrome element is the wrong place to surface a
      // transient fetch failure -- leave the badge off rather than adding
      // an error banner to the header.
      this.unread = 0;
    }
  }

  private onNav = (event: MouseEvent, path: string) => {
    event.preventDefault();
    navigate(path);
  };

  private onLogout = async (event: MouseEvent) => {
    event.preventDefault();
    await authStore.logout();
    navigate('/');
  };

  render() {
    return (
      <header>
        <a href="/" onClick={(e) => this.onNav(e, '/')}>24 Hour Classroom</a>
        <nav>
          <a href="/teachers" onClick={(e) => this.onNav(e, '/teachers')}>Teachers</a>
          {this.user
            ? [
                <a href="/notifications" onClick={(e) => this.onNav(e, '/notifications')}>
                  Notifications
                  {this.unread > 0 && <span data-testid="unread-badge">{this.unread}</span>}
                </a>,
                <a href="/profile" onClick={(e) => this.onNav(e, '/profile')}>My profile</a>,
                <span>{this.user.name}</span>,
                <a href="/" onClick={this.onLogout}>Log out</a>,
              ]
            : [
                <a href="/login" onClick={(e) => this.onNav(e, '/login')}>Sign in</a>,
                <a href="/register" onClick={(e) => this.onNav(e, '/register')}>Sign up</a>,
              ]}
        </nav>
      </header>
    );
  }
}
