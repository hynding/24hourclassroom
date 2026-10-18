import { Component, h, Listen, State } from '@stencil/core';
import type { Layout } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { navigate } from '../../services/navigate';
import { takeReturnPath } from '../../services/return-path';
import { redirectFor, resolveRoute } from '../../services/router';
import type { ResolvedRoute } from '../../services/router';
import { applyHead, resetPageMeta } from '../../services/page-meta';
import { siteStore } from '../../services/site-store';
import { cachedTheme, releaseInlineCanvas } from '../../services/theme-store';

@Component({ tag: 'app-root', shadow: true })
export class AppRoot {
  @State() path: string = window.location.pathname;
  @State() layout: Layout = 'stacked';

  private onPopState = () => {
    this.path = window.location.pathname;
    resetPageMeta(this.path);
    this.applyGuards();
  };

  componentWillLoad() {
    // Synchronous: the cache is what makes a return visit right on the first
    // frame. Palette/typeset were already applied by the inline boot script.
    this.layout = cachedTheme().layout;
    resetPageMeta(this.path);
  }

  async connectedCallback() {
    window.addEventListener('popstate', this.onPopState);
    // Not awaited: a hanging API must be a default-themed page, never a blank
    // one. app-layout switches by prop, so a late change remounts nothing.
    siteStore
      .load()
      .then((config) => { this.layout = config.theme.layout; })
      // A failed fetch never reaches applyTheme, so nothing else would hand
      // the boot script's inline canvas back to the stylesheet.
      .catch(() => releaseInlineCanvas());
    await authStore.load();
    this.applyGuards();
  }

  disconnectedCallback() {
    window.removeEventListener('popstate', this.onPopState);
  }

  // No @State snapshot here, deliberately: the only job is a side effect.
  // load() dispatches this before resolving; the head re-renders with the
  // fetched site name around whatever the current page has described.
  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    applyHead();
  }

  private applyGuards() {
    const user = authStore.currentUser;
    // Every sign-in route ends on `/`; only a verified user can act on the
    // page they left (branching needs `verified`), so an unverified one
    // keeps the path until the verification link brings them back here.
    const target = redirectFor(this.path, user)
      ?? (this.path === '/' && user?.email_verified_at ? takeReturnPath() : null);
    if (target) {
      navigate(target);
    }
  }

  render() {
    const route = resolveRoute(this.path);
    return (
      <app-layout layout={this.layout} bare={route.tag === 'page-test-print'}>
        <app-banner slot="banner"></app-banner>
        <app-header slot="header" orientation={this.layout === 'rail' ? 'vertical' : 'horizontal'}></app-header>
        {this.renderPage(route)}
        <app-footer slot="footer"></app-footer>
      </app-layout>
    );
  }

  private renderPage(route: ResolvedRoute) {
    switch (route.tag) {
      case 'page-teachers':
        return <page-teachers></page-teachers>;
      case 'page-teacher-profile':
        return <page-teacher-profile teacherId={route.teacherId}></page-teacher-profile>;
      case 'page-tests':
        return <page-tests></page-tests>;
      case 'page-test-editor':
        return <page-test-editor testId={route.testId}></page-test-editor>;
      case 'page-test':
        return <page-test testId={route.testId}></page-test>;
      case 'page-test-assign':
        return <page-test-assign testId={route.testId}></page-test-assign>;
      case 'page-test-results':
        return <page-test-results testId={route.testId}></page-test-results>;
      case 'page-test-print':
        return <page-test-print testId={route.testId}></page-test-print>;
      case 'page-attempt':
        return <page-attempt attemptId={route.attemptId}></page-attempt>;
      case 'page-materials':
        return <page-materials></page-materials>;
      case 'page-material':
        return <page-material materialId={route.materialId}></page-material>;
      case 'page-material-form':
        return <page-material-form materialId={route.materialId}></page-material-form>;
      case 'page-material-share':
        return <page-material-share materialId={route.materialId}></page-material-share>;
      case 'page-courses':
        return <page-courses></page-courses>;
      case 'page-course':
        return <page-course courseId={route.courseId}></page-course>;
      case 'page-course-editor':
        return <page-course-editor courseId={route.courseId}></page-course-editor>;
      case 'page-course-practice':
        return <page-course-practice courseId={route.courseId} testId={route.testId}></page-course-practice>;
      case 'page-library-index':
        return <page-library-index></page-library-index>;
      case 'page-library':
        return <page-library kind={route.kind ?? 'tests'}></page-library>;
      case 'page-integrations':
        return <page-integrations></page-integrations>;
      case 'page-test-generate':
        return <page-test-generate></page-test-generate>;
      case 'page-generation':
        return <page-generation generationId={route.generationId}></page-generation>;
      case 'page-profile':
        return <page-profile></page-profile>;
      case 'page-connections':
        return <page-connections></page-connections>;
      case 'page-student':
        return <page-student studentId={route.studentId}></page-student>;
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
