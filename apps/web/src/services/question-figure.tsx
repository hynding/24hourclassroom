import { h } from '@stencil/core';
import type { QuestionFigure } from '@24hc/shared';

/**
 * A question's picture, wherever a question is drawn (test, attempt,
 * practice, print). The alt text is required server-side, so a screen
 * reader always hears what the picture shows.
 */
export function renderFigure(figure: QuestionFigure | null | undefined) {
  if (!figure) {
    return null;
  }
  return (
    <figure class="q-figure">
      <img src={figure.url} alt={figure.alt} loading="lazy" decoding="async" />
    </figure>
  );
}
