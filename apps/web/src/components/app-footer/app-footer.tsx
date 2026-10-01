import { Component, h, Listen, State } from '@stencil/core';
import type { SiteConfig } from '@24hc/shared';
import { siteStore } from '../../services/site-store';

@Component({ tag: 'app-footer', styleUrl: 'app-footer.css', shadow: true })
export class AppFooter {
  @State() site: SiteConfig = siteStore.config;

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  render() {
    return (
      <footer>
        <p>© {this.site.identity.name}</p>
      </footer>
    );
  }
}
