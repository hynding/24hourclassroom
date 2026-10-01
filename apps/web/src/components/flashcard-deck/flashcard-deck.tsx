import { Component, h, Listen, Prop, State, Watch } from '@stencil/core';
import { Flashcard } from '../../services/flashcards';

/**
 * Plays a parsed `.flashcards.md` deck: one card at a time, front first,
 * flip to the back, step or shuffle. All state is local -- nothing is
 * persisted, so reloading starts the deck over.
 */
@Component({ tag: 'flashcard-deck', styleUrl: 'flashcard-deck.css', shadow: true })
export class FlashcardDeck {
  @Prop() cards: Flashcard[] = [];

  /**
   * Which side is up. A reflected prop rather than @State because
   * flashcard-deck.css keys on :host([flipped]) for the back's styling.
   */
  @Prop({ reflect: true, mutable: true }) flipped = false;

  /** Positions into `cards`; identity order until shuffled. */
  @State() order: number[] = [];
  @State() index = 0;
  @State() showHint = false;

  componentWillLoad() {
    this.reset();
  }

  @Watch('cards')
  onCardsChange() {
    this.reset();
  }

  /**
   * Host-level, not window: two decks on a page (or a deck under an open
   * form) must not both react to one keystroke. Space/Enter are left to a
   * focused button so "Next" does not also flip the card it moves to.
   */
  @Listen('keydown')
  onKeydown(event: KeyboardEvent) {
    const origin = (event.composedPath ? event.composedPath()[0] : event.target) as Element | null;
    const onControl = !!origin && typeof origin.tagName === 'string' && ['BUTTON', 'A', 'INPUT', 'SELECT', 'TEXTAREA'].includes(origin.tagName);
    switch (event.key) {
      case 'ArrowLeft':
        event.preventDefault();
        this.previous();
        break;
      case 'ArrowRight':
        event.preventDefault();
        this.next();
        break;
      case ' ':
      case 'Enter':
        if (onControl) return;
        event.preventDefault();
        this.flip();
        break;
      case 's':
      case 'S':
        if (onControl && origin.tagName !== 'BUTTON') return;
        this.shuffle();
        break;
      default:
        return;
    }
  }

  private reset() {
    this.order = this.cards.map((_, i) => i);
    this.index = 0;
    this.flipped = false;
    this.showHint = false;
  }

  private goTo(index: number) {
    if (index < 0 || index >= this.order.length) return;
    this.index = index;
    this.flipped = false;
    this.showHint = false;
  }

  private previous = () => this.goTo(this.index - 1);
  private next = () => this.goTo(this.index + 1);

  private flip = () => {
    if (this.order.length === 0) return;
    this.flipped = !this.flipped;
  };

  private toggleHint = () => {
    this.showHint = !this.showHint;
  };

  /** Fisher-Yates over a copy, then back to the first card. */
  private shuffle = () => {
    const order = [...this.order];
    for (let i = order.length - 1; i > 0; i -= 1) {
      const j = Math.floor(Math.random() * (i + 1));
      [order[i], order[j]] = [order[j], order[i]];
    }
    this.order = order;
    this.goTo(0);
  };

  private get current(): Flashcard | null {
    const position = this.order[this.index];
    return position === undefined ? null : this.cards[position] ?? null;
  }

  render() {
    const card = this.current;
    if (!card) {
      return <p class="empty">This deck has no cards.</p>;
    }
    const total = this.order.length;
    const n = this.index + 1;
    const side = this.flipped ? 'Back' : 'Front';
    return (
      <div class="deck">
        <div
          class="card"
          role="button"
          tabindex="0"
          aria-label={`${side} of card ${n} of ${total}. Press Enter or Space to flip.`}
          onClick={this.flip}
        >
          <span class="side">{side}</span>
          {this.flipped
            ? <rich-text class="back" text={card.back}></rich-text>
            : <p class="front">{card.front}</p>}
        </div>

        {this.showHint && card.hint && <p class="hint" data-testid="hint">Hint: {card.hint}</p>}
        {card.topic && <p class="topic">{card.topic}</p>}

        <div class="controls">
          <button type="button" class="btn" disabled={this.index <= 0} onClick={this.previous}>Previous</button>
          <span class="counter" aria-live="polite">{n} / {total}</span>
          <button type="button" class="btn" disabled={this.index >= total - 1} onClick={this.next}>Next</button>
          <button type="button" class="btn-primary" onClick={this.flip}>Flip</button>
          {card.hint && (
            <button type="button" class="btn" aria-pressed={this.showHint ? 'true' : 'false'} onClick={this.toggleHint}>
              {this.showHint ? 'Hide hint' : 'Show hint'}
            </button>
          )}
          <button type="button" class="btn" onClick={this.shuffle}>Shuffle</button>
        </div>
        <p class="keys">Arrow keys move, Space flips, S shuffles.</p>
      </div>
    );
  }
}
