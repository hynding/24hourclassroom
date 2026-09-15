import { Component, h, Prop } from '@stencil/core';
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

  render() {
    return (
      <div class="shell">
        <slot name="header"></slot>
        <main>
          <slot></slot>
        </main>
        <slot name="footer"></slot>
      </div>
    );
  }
}
