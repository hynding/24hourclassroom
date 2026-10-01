import { h } from '@stencil/core';
import { newSpecPage } from '@stencil/core/testing';
import { readFileSync } from 'fs';
import { join } from 'path';
import { FlashcardDeck } from './flashcard-deck';
import { RichText } from '../rich-text/rich-text';
import { Flashcard } from '../../services/flashcards';

const cards: Flashcard[] = [
  { front: 'Capital of France?', back: 'Paris, on the **Seine**.', hint: 'Starts with P', topic: 'Geography' },
  { front: 'Two plus two?', back: 'Four', hint: null, topic: null },
  { front: 'Largest planet?', back: 'Jupiter', hint: 'Gas giant', topic: 'Space' },
];

async function mount(deck: Flashcard[] = cards) {
  const page = await newSpecPage({ components: [FlashcardDeck, RichText], template: () => <flashcard-deck cards={deck}></flashcard-deck> });
  await page.waitForChanges();
  return page;
}

type Page = Awaited<ReturnType<typeof mount>>;

const root = (page: Page) => page.root.shadowRoot;
const frontText = (page: Page) => root(page).querySelector('.front')?.textContent ?? null;
const backText = (page: Page) => root(page).querySelector('rich-text')?.shadowRoot.textContent ?? null;
const counter = (page: Page) => root(page).querySelector('.counter').textContent;
const button = (page: Page, label: string) =>
  Array.from(root(page).querySelectorAll('button')).find((b) => b.textContent.trim() === label);

async function click(page: Page, label: string) {
  const b = button(page, label);
  expect(b).toBeTruthy();
  b.click();
  await page.waitForChanges();
}

async function key(page: Page, k: string) {
  const event = new (page.win as any).KeyboardEvent('keydown', { key: k, bubbles: true, cancelable: true });
  page.root.dispatchEvent(event);
  await page.waitForChanges();
  return event as KeyboardEvent;
}

describe('flashcard-deck', () => {
  it('shows the first front with a counter and no back', async () => {
    const page = await mount();
    expect(frontText(page)).toBe('Capital of France?');
    expect(backText(page)).toBeNull();
    expect(counter(page)).toBe('1 / 3');
    expect(root(page).textContent).toContain('Geography');
    expect(page.root.hasAttribute('flipped')).toBe(false);
  });

  it('flips to the rich-text back and reflects the flipped attribute', async () => {
    const page = await mount();
    await click(page, 'Flip');

    expect(page.root.getAttribute('flipped')).toBe('');
    expect(frontText(page)).toBeNull();
    expect(backText(page)).toBe('Paris, on the Seine.');
    expect(root(page).querySelector('rich-text').shadowRoot.querySelector('strong').textContent).toBe('Seine');

    await click(page, 'Flip');
    expect(page.root.hasAttribute('flipped')).toBe(false);
    expect(frontText(page)).toBe('Capital of France?');
  });

  it('flips by clicking the card itself', async () => {
    const page = await mount();
    (root(page).querySelector('.card') as HTMLElement).click();
    await page.waitForChanges();
    expect(backText(page)).toBe('Paris, on the Seine.');
    expect(root(page).querySelector('.card').getAttribute('aria-label')).toContain('Back of card 1 of 3');
  });

  it('moves with the buttons, un-flipping and updating the counter', async () => {
    const page = await mount();
    expect(button(page, 'Previous').hasAttribute('disabled')).toBe(true);

    await click(page, 'Flip');
    await click(page, 'Next');
    expect(frontText(page)).toBe('Two plus two?');
    expect(backText(page)).toBeNull();
    expect(counter(page)).toBe('2 / 3');

    await click(page, 'Next');
    expect(counter(page)).toBe('3 / 3');
    expect(button(page, 'Next').hasAttribute('disabled')).toBe(true);

    await click(page, 'Previous');
    expect(counter(page)).toBe('2 / 3');
  });

  it('moves with the arrow keys and flips with Space and Enter on the host', async () => {
    const page = await mount();
    await key(page, 'ArrowRight');
    expect(frontText(page)).toBe('Two plus two?');

    const space = await key(page, ' ');
    expect(space.defaultPrevented).toBe(true);
    expect(backText(page)).toBe('Four');

    await key(page, 'ArrowLeft');
    expect(frontText(page)).toBe('Capital of France?');
    expect(backText(page)).toBeNull();

    const enter = await key(page, 'Enter');
    expect(enter.defaultPrevented).toBe(true);
    expect(backText(page)).toBe('Paris, on the Seine.');

    await key(page, 'ArrowLeft');
    expect(counter(page)).toBe('1 / 3');
  });

  it('shuffles (button and the s key) keeping the same card set and returning to the first card', async () => {
    const page = await mount();
    await click(page, 'Next');
    await click(page, 'Shuffle');
    expect(counter(page)).toBe('1 / 3');

    const seen: string[] = [frontText(page)];
    await click(page, 'Next');
    seen.push(frontText(page));
    await click(page, 'Next');
    seen.push(frontText(page));
    expect(seen.sort()).toEqual(cards.map((c) => c.front).sort());

    await key(page, 's');
    expect(counter(page)).toBe('1 / 3');
  });

  it('shows and hides the hint, and only offers it when the card has one', async () => {
    const page = await mount();
    expect(root(page).querySelector('[data-testid="hint"]')).toBeNull();

    await click(page, 'Show hint');
    expect(root(page).querySelector('[data-testid="hint"]').textContent).toBe('Hint: Starts with P');
    expect(button(page, 'Hide hint')).toBeTruthy();

    await click(page, 'Hide hint');
    expect(root(page).querySelector('[data-testid="hint"]')).toBeNull();

    await click(page, 'Show hint');
    await click(page, 'Next');
    expect(root(page).querySelector('[data-testid="hint"]')).toBeNull();
    expect(button(page, 'Show hint')).toBeUndefined();
  });

  it('renders the empty state for a deck with no cards', async () => {
    const page = await mount([]);
    expect(root(page).textContent).toContain('This deck has no cards.');
    expect(root(page).querySelector('button')).toBeNull();
    await key(page, ' ');
    expect(page.root.hasAttribute('flipped')).toBe(false);
  });

  it('keys the back styling off the reflected attribute', () => {
    const css = readFileSync(join(__dirname, 'flashcard-deck.css'), 'utf8');
    expect(css).toContain(':host([flipped]) .card');
  });
});
