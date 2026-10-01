/**
 * Flashcard decks are plain markdown materials whose filename ends in
 * `.flashcards.md`. page-material fetches the body of any small .md/.txt
 * upload to render it inline; a deck name routes that body here instead of
 * to rich-text, and flashcard-deck plays the parsed cards.
 *
 * Pure functions, no DOM -- everything here is spec-tested on its own.
 */

export interface Flashcard {
  front: string;
  back: string;
  hint: string | null;
  topic: string | null;
}

export interface Deck {
  title: string;
  cards: Flashcard[];
}

/**
 * Only bodies this small are fetched for inline reading. 256 KiB is far
 * past any study guide and keeps a mislabelled binary from being pulled
 * into memory as text.
 */
export const MAX_READABLE_BYTES = 262144;

export function isDeckName(originalName: string): boolean {
  return /\.flashcards\.md$/i.test(originalName);
}

export function isReadableText(m: { original_name: string; size_bytes: number }): boolean {
  return /\.(md|txt)$/i.test(m.original_name) && m.size_bytes <= MAX_READABLE_BYTES;
}

const TITLE = /^#\s+(.*)$/;
const CARD = /^##\s+(.*)$/;
const META = /^(hint|topic):\s*(.*)$/i;

function trimBlankEdges(lines: string[]): string[] {
  let start = 0;
  let end = lines.length;
  while (start < end && lines[start].trim() === '') start += 1;
  while (end > start && lines[end - 1].trim() === '') end -= 1;
  return lines.slice(start, end);
}

/**
 * Lift trailing `Hint:` / `Topic:` lines (any order, case-insensitive) off
 * the back and return the card. The back is trimmed of blank lines on both
 * sides, after the lift as well, so a blank line separating the answer from
 * its hint does not survive as a trailing paragraph.
 */
function buildCard(front: string, bodyLines: string[]): Flashcard {
  const lines = trimBlankEdges(bodyLines);
  let hint: string | null = null;
  let topic: string | null = null;
  while (lines.length > 0) {
    const match = lines[lines.length - 1].match(META);
    if (!match) break;
    lines.pop();
    const value = match[2].trim();
    if (match[1].toLowerCase() === 'hint') {
      hint = value;
    } else {
      topic = value;
    }
  }
  return { front: front.trim(), back: trimBlankEdges(lines).join('\n'), hint, topic };
}

export function parseDeck(markdown: string): Deck {
  const lines = markdown.replace(/\r\n?/g, '\n').split('\n');
  let title = '';
  const cards: Flashcard[] = [];
  let front: string | null = null;
  let body: string[] = [];

  for (const line of lines) {
    const card = line.match(CARD);
    if (card) {
      if (front !== null) cards.push(buildCard(front, body));
      front = card[1];
      body = [];
      continue;
    }
    if (front !== null) {
      body.push(line);
      continue;
    }
    // Before the first card: the first `# Title` names the deck, anything
    // else (a description, a blank line) is ignored.
    const heading = line.match(TITLE);
    if (heading && !title) title = heading[1].trim();
  }
  if (front !== null) cards.push(buildCard(front, body));

  return { title, cards };
}
