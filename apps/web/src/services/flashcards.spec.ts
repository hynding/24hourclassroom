import { isDeckName, isReadableText, MAX_READABLE_BYTES, parseDeck } from './flashcards';

describe('isDeckName', () => {
  it('matches only names ending in .flashcards.md, case-insensitively', () => {
    expect(isDeckName('unit-3.flashcards.md')).toBe(true);
    expect(isDeckName('Unit-3.FLASHCARDS.MD')).toBe(true);
    expect(isDeckName('unit-3.md')).toBe(false);
    expect(isDeckName('flashcards.md')).toBe(false);
    expect(isDeckName('unit-3.flashcards.md.pdf')).toBe(false);
    expect(isDeckName('unit-3.flashcards.txt')).toBe(false);
  });
});

describe('isReadableText', () => {
  it('accepts .md and .txt under the size cap', () => {
    expect(isReadableText({ original_name: 'guide.md', size_bytes: 10 })).toBe(true);
    expect(isReadableText({ original_name: 'NOTES.TXT', size_bytes: MAX_READABLE_BYTES })).toBe(true);
    expect(isReadableText({ original_name: 'deck.flashcards.md', size_bytes: 500 })).toBe(true);
  });

  it('rejects other types and oversized text', () => {
    expect(isReadableText({ original_name: 'guide.pdf', size_bytes: 10 })).toBe(false);
    expect(isReadableText({ original_name: 'guide.docx', size_bytes: 10 })).toBe(false);
    expect(isReadableText({ original_name: 'md', size_bytes: 10 })).toBe(false);
    expect(isReadableText({ original_name: 'guide.md', size_bytes: MAX_READABLE_BYTES + 1 })).toBe(false);
  });
});

describe('parseDeck', () => {
  it('reads the title and each card with its back, hint and topic', () => {
    const deck = parseDeck([
      '# Cell biology',
      '',
      'Some intro text that is not a card.',
      '',
      '## What is the powerhouse of the cell?',
      '',
      'The **mitochondrion**.',
      '',
      'Hint: It makes ATP.',
      'Topic: Organelles',
      '',
      '## Define osmosis',
      'Topic: Transport',
      'hint: think water',
      'Water moving across a membrane.',
      '',
      '## Empty back',
      '',
      '## Only a hint',
      'HINT: nothing else',
    ].join('\n'));

    expect(deck.title).toBe('Cell biology');
    expect(deck.cards).toEqual([
      { front: 'What is the powerhouse of the cell?', back: 'The **mitochondrion**.', hint: 'It makes ATP.', topic: 'Organelles' },
      // Hint/Topic lines are only lifted from the END of the back.
      { front: 'Define osmosis', back: 'Topic: Transport\nhint: think water\nWater moving across a membrane.', hint: null, topic: null },
      { front: 'Empty back', back: '', hint: null, topic: null },
      { front: 'Only a hint', back: '', hint: 'nothing else', topic: null },
    ]);
  });

  it('normalizes Windows line endings', () => {
    const deck = parseDeck('# T\r\n## Q\r\nA\r\nHint: h\r\n');
    expect(deck.title).toBe('T');
    expect(deck.cards).toEqual([{ front: 'Q', back: 'A', hint: 'h', topic: null }]);
  });

  it('has no title and no cards for text with no card headings', () => {
    const deck = parseDeck('Just some notes.\n\n- a list\n');
    expect(deck).toEqual({ title: '', cards: [] });
    expect(parseDeck('')).toEqual({ title: '', cards: [] });
  });

  it('does not treat ### subheadings as cards and keeps them in the back', () => {
    const deck = parseDeck('## Q\n### detail\nbody');
    expect(deck.cards).toEqual([{ front: 'Q', back: '### detail\nbody', hint: null, topic: null }]);
  });

  it('ignores a # heading after the first card and only takes the first title', () => {
    const deck = parseDeck('# One\n# Two\n## Q\n# Not a title\nback');
    expect(deck.title).toBe('One');
    expect(deck.cards[0].back).toBe('# Not a title\nback');
  });
});
