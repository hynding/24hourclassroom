import { Component, h, Prop } from '@stencil/core';
import { renderRich } from '../../services/rich-text';

/**
 * Author text -- a prompt, a stimulus, a rationale, a study guide -- in the
 * markdown subset `services/rich-text` understands. Vnodes only; see that
 * file for why there is no sanitizer.
 */
@Component({ tag: 'rich-text', styleUrl: 'rich-text.css', shadow: true })
export class RichText {
  @Prop() text = '';

  /** Headings, lists, quotes, fences, rules and links: on for materials, off for questions. */
  @Prop() blocks = false;

  render() {
    return <div class="rich">{renderRich(this.text, { blocks: this.blocks })}</div>;
  }
}
