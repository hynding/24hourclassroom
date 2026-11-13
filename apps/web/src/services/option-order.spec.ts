import type { Question } from '@24hc/shared';
import { isShuffled, optionOrder } from './option-order';

const mc = (id: number, options: string[], type: Question['type'] = 'multiple_choice') =>
  ({ id, type, prompt: 'Pick', options, points: 1, partial_credit: false, position: 0 }) as unknown as Question;

const sorted = (xs: number[]) => [...xs].sort((a, b) => a - b);

describe('optionOrder', () => {
  it('is a permutation of the authored indices, the same for the same seed', () => {
    const q = mc(7, ['a', 'b', 'c', 'd', 'e']);
    const order = optionOrder(q, 'attempt-3');
    expect(sorted(order)).toEqual([0, 1, 2, 3, 4]);
    expect(optionOrder(q, 'attempt-3')).toEqual(order);
  });

  it('moves the first option off the top for most seeds', () => {
    // The point of the shuffle: seeded content put the answer at A.
    const q = mc(9, ['right', 'w1', 'w2', 'w3']);
    const firsts = Array.from({ length: 400 }, (_, s) => optionOrder(q, `attempt-${s}`)[0]);
    const stayed = firsts.filter((i) => i === 0).length;
    expect(stayed).toBeGreaterThan(50);
    expect(stayed).toBeLessThan(150);
    expect(new Set(firsts)).toEqual(new Set([0, 1, 2, 3]));
  });

  it('differs between questions under one seed', () => {
    const orders = Array.from({ length: 20 }, (_, id) => optionOrder(mc(id, ['a', 'b', 'c', 'd']), 'attempt-1').join(''));
    expect(new Set(orders).size).toBeGreaterThan(5);
  });

  it('shuffles select-all too', () => {
    expect(isShuffled(mc(1, ['a', 'b', 'c'], 'multi_select'))).toBe(true);
  });

  it('leaves alone other types and options that point at each other', () => {
    for (const q of [
      mc(1, ['True', 'False'], 'true_false'),
      mc(2, ['Cats', 'Dogs', 'All of the above']),
      mc(3, ['Cats', 'Dogs', 'None of these']),
      mc(4, ['Cats', 'Dogs', 'Both A and B']),
      mc(5, ['Cats', 'Dogs', 'Fish', 'A and C only']),
      mc(6, ['only']),
    ]) {
      expect(optionOrder(q, 'attempt-1')).toEqual(q.options.map((_, i) => i));
    }
  });

  it('still shuffles ordinary prose that happens to say "and"', () => {
    expect(isShuffled(mc(1, ['Salt and pepper', 'Oil and vinegar', 'A cup of tea']))).toBe(true);
  });
});
