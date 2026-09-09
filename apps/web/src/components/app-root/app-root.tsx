import { Component, h, State } from '@stencil/core';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';

const GUEST_ONLY = ['/login', '/register', '/forgot-password', '/reset-password'];

@Component({ tag: 'app-root', shadow: true })
export class AppRoot {
  @State() path: string = window.location.pathname;

  private onPopState = () => {
    this.path = window.location.pathname;
    this.applyGuards();
  };

  async connectedCallback() {
    window.addEventListener('popstate', this.onPopState);
    await authStore.load();
    this.applyGuards();
  }

  disconnectedCallback() {
    window.removeEventListener('popstate', this.onPopState);
  }

  private applyGuards() {
    const user = authStore.currentUser;
    if (user && GUEST_ONLY.includes(this.path)) {
      navigate('/');
      return;
    }
    if (user && !user.email_verified_at && this.path !== '/verify-email') {
      navigate('/verify-email');
    }
  }

  render() {
    return (
      <div>
        <app-header></app-header>
        <main>{this.renderPage()}</main>
        <app-footer></app-footer>
      </div>
    );
  }

  private renderPage() {
    switch (this.path) {
      case '/login':
        return <page-login></page-login>;
      case '/register':
        return <page-register></page-register>;
      case '/register/role':
        return <page-register-role></page-register-role>;
      case '/forgot-password':
        return <page-forgot-password></page-forgot-password>;
      case '/reset-password':
        return <page-reset-password></page-reset-password>;
      case '/verify-email':
        return <page-verify-email></page-verify-email>;
      default:
        return <page-home></page-home>;
    }
  }
}
