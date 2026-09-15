import { Component, h, State } from '@stencil/core';
import type { Layout } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { redirectFor, resolveRoute } from '../../services/router';
import { cachedTheme, loadTheme, releaseInlineCanvas } from '../../services/theme-store';

@Component({ tag: 'app-root', shadow: true })
export class AppRoot {
  @State() path: string = window.location.pathname;
  @State() layout: Layout = 'stacked';

  private onPopState = () => {
    this.path = window.location.pathname;
    this.applyGuards();
  };

  componentWillLoad() {
    // Synchronous: the cache is what makes a return visit right on the first
    // frame. Palette/typeset were already applied by the inline boot script.
    this.layout = cachedTheme().layout;
  }

  async connectedCallback() {
    window.addEventListener('popstate', this.onPopState);
    // Not awaited: a hanging API must be a default-themed page, never a blank
    // one. app-layout switches by prop, so a late change remounts nothing.
    loadTheme()
      .then((theme) => { this.layout = theme.layout; })
      // A failed fetch never reaches applyTheme, so nothing else would hand
      // the boot script's inline canvas back to the stylesheet; without
      // this, an unreachable /api/site leaves a stale dark canvas under the
      // Noon tokens the CSS falls back to.
      .catch(() => releaseInlineCanvas());
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
      <app-layout layout={this.layout}>
        <app-header slot="header" orientation={this.layout === 'rail' ? 'vertical' : 'horizontal'}></app-header>
        {this.renderPage()}
        <app-footer slot="footer"></app-footer>
      </app-layout>
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
      case 'page-connections':
        return <page-connections></page-connections>;
      case 'page-notifications':
        return <page-notifications></page-notifications>;
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
