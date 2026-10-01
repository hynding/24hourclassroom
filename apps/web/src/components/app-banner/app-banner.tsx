import { Component, h, Listen, State } from '@stencil/core';
import type { SiteConfig } from '@24hc/shared';
import { siteStore } from '../../services/site-store';

/**
 * The site-wide announcement. An <aside>, not a live region: it is static
 * content, not a response to a user action, and live regions inside shadow
 * roots announce unevenly. Not dismissible (one admin, one notice).
 */
@Component({ tag: 'app-banner', styleUrl: 'app-banner.css', shadow: true })
export class AppBanner {
  // A snapshot, not a getter: Stencil re-renders on a @State write, not on a
  // @Listen call. load() assigns a new object, so the reference changes.
  @State() site: SiteConfig = siteStore.config;

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  render() {
    const { enabled, text } = this.site.banner;
    if (!enabled || !text) {
      return null;
    }
    return (
      <aside aria-label="Site announcement">
        <p>{text}</p>
      </aside>
    );
  }
}
