import { QUESTION_TYPES, Question } from '@24hc/shared';
import { blankQuestion } from './question-shapes';
import { formatAnswer, formatResponse, isTextResponse, keyFor, optionChosen, showsStimulus } from './question-format';

const asQuestion = (partial: Partial<Question>): Question => ({
  id: 1, position: 0, type: 'short_answer', prompt: 'p', stimulus: null, options: null, points: 1, partial_credit: false, auto_grade: true, ...partial,
});

describe('question-format', () => {
  // The guard: every type the shared package knows must have a blank shape
  // and must format without throwing. A new type added to QUESTION_TYPES
  // fails here (and at compile time via assertNever) instead of rendering
  // nothing on the attempt, author, print and results pages.
  describe.each(QUESTION_TYPES.map((t) => [t.value] as const))('%s', (type) => {
    const blank = blankQuestion(type);
    const q = asQuestion({ type, options: blank.options ?? null, answer: blank.answer });

    it('has a blank shape of the same type', () => {
      expect(blank.type).toBe(type);
    });

    it('formats a skipped response, the blank answer and the key as strings', () => {
      expect(formatResponse(q, undefined)).toBe('(skipped)');
      expect(formatResponse(q, null)).toBe('(skipped)');
      expect(typeof formatResponse(q, blank.answer)).toBe('string');
      expect(typeof formatAnswer(q, blank.answer)).toBe('string');
      expect(typeof keyFor(q, blank.answer)).toBe('string');
      expect(typeof isTextResponse(type)).toBe('boolean');
    });
  });

  it('labels option responses and answers with the option text', () => {
    const q = asQuestion({ type: 'multiple_choice', options: ['Nucleus', 'Mitochondria'] });
    expect(formatResponse(q, 1)).toBe('Mitochondria');
    expect(formatAnswer(q, 1)).toBe('Mitochondria');
    const multi = asQuestion({ type: 'multi_select', options: ['Ribosome', 'Car', 'Golgi'] });
    expect(formatResponse(multi, [0, 2])).toBe('Ribosome, Golgi');
    expect(formatAnswer(multi, [0, 2])).toBe('Ribosome, Golgi');
    expect(formatResponse(multi, [7])).toBe('7');
  });

  it('prints letters for option types in the key', () => {
    expect(keyFor(asQuestion({ type: 'multiple_choice', options: ['a', 'b'] }), 1)).toBe('B');
    expect(keyFor(asQuestion({ type: 'multi_select', options: ['a', 'b', 'c'] }), [0, 2])).toBe('A, C');
  });

  it('spells out true / false and numeric tolerances', () => {
    const tf = asQuestion({ type: 'true_false' });
    expect(formatResponse(tf, true)).toBe('True');
    expect(formatAnswer(tf, false)).toBe('False');
    expect(keyFor(tf, true)).toBe('True');
    const num = asQuestion({ type: 'numeric' });
    expect(formatAnswer(num, { value: 2, tolerance: 0.5 })).toBe('2 ± 0.5');
    expect(formatAnswer(num, { value: 2, tolerance: 0 })).toBe('2');
    expect(keyFor(num, { value: 3 })).toBe('3');
    expect(formatResponse(num, 4)).toBe('4');
  });

  it('joins accepted fill_blank answers and keys on the canonical first one', () => {
    const q = asQuestion({ type: 'fill_blank' });
    expect(formatAnswer(q, ['mitochondria', 'mitochondrion'])).toBe('mitochondria / mitochondrion');
    expect(keyFor(q, ['mitochondria', 'mitochondrion'])).toBe('mitochondria');
    expect(formatResponse(q, 'mito')).toBe('mito');
  });

  it('passes written answers through untouched', () => {
    const q = asQuestion({ type: 'long_answer' });
    expect(formatResponse(q, 'line one\nline two')).toBe('line one\nline two');
    expect(formatAnswer(q, 'model')).toBe('model');
    expect(keyFor(q, 'model')).toBe('model');
    expect(formatAnswer(q, undefined)).toBe('');
  });

  it('knows which types carry a typed response', () => {
    expect(isTextResponse('short_answer')).toBe(true);
    expect(isTextResponse('fill_blank')).toBe(true);
    expect(isTextResponse('long_answer')).toBe(true);
    expect(isTextResponse('multiple_choice')).toBe(false);
    expect(isTextResponse('numeric')).toBe(false);
  });

  it('matches a chosen option against a single index or a list', () => {
    expect(optionChosen(1, 1)).toBe(true);
    expect(optionChosen(0, 1)).toBe(false);
    expect(optionChosen([0, 2], 2)).toBe(true);
    expect(optionChosen([0, 2], 1)).toBe(false);
    expect(optionChosen(undefined, 0)).toBe(false);
  });

  it('shows a stimulus once per run of questions that share it', () => {
    const questions = [
      { stimulus: 'Passage A' },
      { stimulus: 'Passage A' },
      { stimulus: null },
      { stimulus: 'Passage B' },
      { stimulus: '' },
      { stimulus: 'Passage A' },
    ];
    expect(questions.map((_, i) => showsStimulus(questions, i))).toEqual([true, false, false, true, false, true]);
  });

  describe('blankQuestion', () => {
    it('carries the stimulus across a type switch but leaves an empty one absent', () => {
      expect(blankQuestion('numeric', { type: 'multiple_choice', prompt: 'p', stimulus: 'Read this', answer: 0 })).toEqual({ type: 'numeric', prompt: 'p', points: 1, stimulus: 'Read this', answer: { value: 0, tolerance: 0 } });
      expect(blankQuestion('numeric', { stimulus: null })).not.toHaveProperty('stimulus');
      expect(blankQuestion('numeric', { stimulus: '' })).not.toHaveProperty('stimulus');
    });

    it('starts a fill_blank with one empty accepted answer graded automatically', () => {
      expect(blankQuestion('fill_blank', { prompt: 'The ____.' })).toEqual({ type: 'fill_blank', prompt: 'The ____.', points: 1, answer: [''], auto_grade: true });
    });

    it('defaults long_answer points to 6 unless the previous value is already 4-10', () => {
      expect(blankQuestion('long_answer')).toEqual({ type: 'long_answer', prompt: '', points: 6, answer: '' });
      expect(blankQuestion('long_answer', { points: 2 }).points).toBe(6);
      expect(blankQuestion('long_answer', { points: 8 }).points).toBe(8);
      expect(blankQuestion('long_answer', { points: 11 }).points).toBe(6);
    });
  });
});
