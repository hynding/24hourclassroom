import { Component, h, State } from '@stencil/core';
import type { User } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';

@Component({ tag: 'app-header', shadow: true })
export class AppHeader {
  @State() user: User | null = null;

  private unsubscribe: () => void = () => undefined;

  connectedCallback() {
    this.unsubscribe = authStore.subscribe((user) => (this.user = user));
    this.user = authStore.currentUser;
  }

  disconnectedCallback() {
    this.unsubscribe();
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
