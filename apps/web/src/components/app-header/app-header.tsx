import { Component, Env, h } from '@stencil/core';

@Component({ tag: 'app-header', shadow: true })
export class AppHeader {
  private get signInUrl(): string {
    const redirect = encodeURIComponent(window.location.origin);
    return `${Env.apiBaseUrl}/login?redirect=${redirect}`;
  }

  render() {
    return (
      <header>
        <a href="/">24 Hour Classroom</a>
        <nav>
          <a href={this.signInUrl}>Sign in</a>
        </nav>
      </header>
    );
  }
}
