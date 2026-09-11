import { Component, h, State } from '@stencil/core';
import type { User } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { profileStore } from '../../services/profile-store';
import { navigate } from '../../services/navigate';

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

  private async loadUnread() {
    // Every notification-producing action is behind `verified` on the
    // server, so a signed-out or unverified user can never have one --
    // fetching would be a guaranteed wasted request.
    if (!this.user || !this.user.email_verified_at) {
      this.unread = 0;
      return;
    }
    this.unread = await profileStore.unreadCount();
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
