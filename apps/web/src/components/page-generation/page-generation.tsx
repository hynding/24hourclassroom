import { Component, h, Prop } from '@stencil/core';

/**
 * Stub: plan 4 task 7 replaces this with the real page. The prop is declared
 * here already so the generated components.d.ts knows it and app-root's
 * `<page-generation generationId={...}>` type-checks.
 */
@Component({ tag: 'page-generation', shadow: true })
export class PageGeneration {
  @Prop() generationId?: number;

  render() {
    return (
      <section>
        <h1>Generation</h1>
      </section>
    );
  }
}
