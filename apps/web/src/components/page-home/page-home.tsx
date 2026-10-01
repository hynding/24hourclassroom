import { Component, h, Listen, State } from '@stencil/core';
import type { SiteConfig } from '@24hc/shared';
import { siteStore } from '../../services/site-store';

@Component({ tag: 'page-home', styleUrl: 'page-home.css', shadow: true })
export class PageHome {
  @State() site: SiteConfig = siteStore.config;

  @Listen('site:changed', { target: 'window' })
  onSiteChanged() {
    this.site = siteStore.config;
  }

  render() {
    const { name, tagline } = this.site.identity;
    return (
      <section>
        <h1>{name}</h1>
        {tagline && <p>{tagline}</p>}
      </section>
    );
  }
}
