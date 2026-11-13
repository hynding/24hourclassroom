import type { Question } from '@24hc/shared';

/**
 * The order a student sees a question's options in. Seeded content (and a
 * lot of hand-written content) puts the correct answer first, so options
 * are shuffled wherever a student answers: per attempt (seeded by the
 * attempt, so a reload or the review shows the same order and a retake
 * shows a new one) and per practice run.
 *
 * Purely presentational. Responses, answers and option_explanations stay
 * in authored indices, so grading (AttemptGrader) and the teacher's views
 * never change: a caller renders `order.map((i) => q.options[i])` and still
 * records `i`.
 *
 * Left in authored order: anything but multiple choice and select-all, and
 * a question whose options point at each other ("All of the above",
 * "Both A and B", "A and C only"), which a shuffle would break.
 */

/** Options that only make sense in their written position. */
const POSITIONAL = /\b(?:of the above|of these|of those)\b|\b(?:both|neither|only)\s+[A-E]\b|\b[A-E]\s+(?:and|or|nor)\s+[A-E]\b/i;

export function isShuffled(q: Question): boolean {
  return (q.type === 'multiple_choice' || q.type === 'multi_select')
    && Array.isArray(q.options)
    && q.options.length > 1
    && !q.options.some((option) => POSITIONAL.test(option));
}

/** Authored indices in display order. Same seed and question: same order, every time. */
export function optionOrder(q: Question, seed: string | number): number[] {
  const indices = (q.options ?? []).map((_, i) => i);
  if (!isShuffled(q)) {
    return indices;
  }
  const random = mulberry32(fnv1a(`${seed}:${q.id}`));
  for (let i = indices.length - 1; i > 0; i--) {
    const j = Math.floor(random() * (i + 1));
    [indices[i], indices[j]] = [indices[j], indices[i]];
  }
  return indices;
}

/** A fresh seed for one practice run. */
export function newSeed(): string {
  return Math.random().toString(36).slice(2);
}

function fnv1a(text: string): number {
  let hash = 0x811c9dc5;
  for (let i = 0; i < text.length; i++) {
    hash ^= text.charCodeAt(i);
    hash = Math.imul(hash, 0x01000193);
  }
  return hash >>> 0;
}

function mulberry32(seed: number): () => number {
  let a = seed;
  return () => {
    a = (a + 0x6d2b79f5) | 0;
    let t = Math.imul(a ^ (a >>> 15), 1 | a);
    t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t;
    return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
  };
}
