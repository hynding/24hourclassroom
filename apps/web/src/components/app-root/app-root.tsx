import { Component, h, State } from '@stencil/core';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { redirectFor, resolveRoute } from '../../services/router';

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
    const target = redirectFor(this.path, authStore.currentUser);
    if (target) {
      navigate(target);
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
    const route = resolveRoute(this.path);

    switch (route.tag) {
      case 'page-teachers':
        return <page-teachers></page-teachers>;
      case 'page-teacher-profile':
        return <page-teacher-profile teacherId={route.teacherId}></page-teacher-profile>;
      case 'page-profile':
        return <page-profile></page-profile>;
      case 'page-login':
        return <page-login></page-login>;
      case 'page-register':
        return <page-register></page-register>;
      case 'page-register-role':
        return <page-register-role></page-register-role>;
      case 'page-forgot-password':
        return <page-forgot-password></page-forgot-password>;
      case 'page-reset-password':
        return <page-reset-password></page-reset-password>;
      case 'page-verify-email':
        return <page-verify-email></page-verify-email>;
      default:
        return <page-home></page-home>;
    }
  }
}
