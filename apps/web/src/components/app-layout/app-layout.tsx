import { Component, h, Method, Prop } from '@stencil/core';
import type { Layout } from '@24hc/shared';

/**
 * One component for every layout, switched by a reflected prop. A wrapper
 * TAG change (<layout-stacked> -> <layout-rail>) would make Stencil's vdom
 * rebuild the subtree, remounting the slotted header/page/footer and
 * re-firing their fetches; a prop change re-renders only this shadow tree
 * and the light-DOM children stay put.
 */
@Component({ tag: 'app-layout', styleUrl: 'app-layout.css', shadow: true })
export class AppLayout {
  /** reflect: true is load-bearing -- app-layout.css keys on :host([layout]). */
  @Prop({ reflect: true }) layout: Layout = 'stacked';

  /** reflect: true is load-bearing -- app-layout.css keys on :host([bare]). Set by app-root for the print page. */
  @Prop({ reflect: true }) bare = false;

  private main?: HTMLElement;

  /**
   * Moves keyboard and screen-reader focus to the page content. app-root
   * calls it after each in-app navigation: the SPA swaps <main>'s content
   * without a page load, so focus would otherwise stay on the link just
   * pressed, possibly in a menu that is now closed. No scroll: where the
   * page sits is the router's business, not this.
   */
  @Method()
  async focusMain() {
    this.main?.focus({ preventScroll: true });
  }

  /** Same-page anchors do not reach into a shadow root, so the skip link focuses <main> itself. */
  private skip = (e: Event) => {
    e.preventDefault();
    this.main?.focus();
  };

  render() {
    return (
      <div class="shell">
        <a class="skip" href="#main" onClick={this.skip}>Skip to content</a>
        <slot name="banner"></slot>
        <slot name="header"></slot>
        <main id="main" tabindex="-1" ref={(el) => (this.main = el)}>
          <slot></slot>
        </main>
        <slot name="footer"></slot>
      </div>
    );
  }
}
