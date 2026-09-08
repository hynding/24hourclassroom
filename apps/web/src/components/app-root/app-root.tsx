import { Component, h, State } from '@stencil/core';

@Component({ tag: 'app-root', shadow: true })
export class AppRoot {
  @State() path: string = window.location.pathname;

  private onPopState = () => {
    this.path = window.location.pathname;
  };

  connectedCallback() {
    window.addEventListener('popstate', this.onPopState);
  }

  disconnectedCallback() {
    window.removeEventListener('popstate', this.onPopState);
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
      default:
        return <page-home></page-home>;
    }
  }
}
