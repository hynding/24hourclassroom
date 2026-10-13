import { FunctionalComponent, h } from '@stencil/core';
import type { Question } from '@24hc/shared';
import { assertNever } from './assert-never';

interface QuestionInputProps {
  question: Question;
  value: unknown;
  onChange: (value: unknown) => void;
}

/**
 * The answer control for one question, shared by a real attempt
 * (page-attempt) and practice mode (page-course-practice) so the two take
 * answers in exactly the same shapes -- the shapes AttemptGrader scores. A
 * functional component, not a tag: it renders into the caller's own shadow
 * root, where the caller's stylesheet (and its specs) can reach it.
 */
export const QuestionInput: FunctionalComponent<QuestionInputProps> = ({ question: q, value, onChange }) => {
  switch (q.type) {
    case 'multiple_choice':
      return (
        <ol class="options">
          {q.options.map((opt, i) => (
            <li><label><input type="radio" name={`q-${q.id}`} checked={value === i} onChange={() => onChange(i)} /> {opt}</label></li>
          ))}
        </ol>
      );
    case 'multi_select': {
      const toggle = (i: number, on: boolean) => {
        const current = Array.isArray(value) ? (value as number[]) : [];
        const next = on ? [...current, i].sort((a, b) => a - b) : current.filter((x) => x !== i);
        onChange(Array.from(new Set(next)));
      };
      return (
        <ol class="options">
          {q.options.map((opt, i) => (
            <li><label><input type="checkbox" checked={Array.isArray(value) && value.includes(i)} onChange={(e) => toggle(i, (e.target as HTMLInputElement).checked)} /> {opt}</label></li>
          ))}
        </ol>
      );
    }
    case 'true_false':
      return (
        <div class="choices">
          <label><input type="radio" name={`q-${q.id}`} checked={value === true} onChange={() => onChange(true)} /> True</label>
          <label><input type="radio" name={`q-${q.id}`} checked={value === false} onChange={() => onChange(false)} /> False</label>
        </div>
      );
    case 'short_answer':
      return <input type="text" value={(value as string) ?? ''} onInput={(e) => onChange((e.target as HTMLInputElement).value)} />;
    case 'numeric':
      return <input type="number" step="any" value={value === undefined || value === null ? '' : String(value)} onInput={(e) => {
        const raw = (e.target as HTMLInputElement).value;
        onChange(raw === '' ? null : Number(raw));
      }} />;
    case 'fill_blank':
      // The prompt keeps its ____ on screen; the student fills a labelled input beneath it.
      return (
        <label class="blank">
          Your answer for the blank
          <input type="text" maxlength="100" value={(value as string) ?? ''} onInput={(e) => onChange((e.target as HTMLInputElement).value)} />
        </label>
      );
    case 'long_answer':
      return <textarea rows={8} maxlength="10000" aria-label="Your answer" value={(value as string) ?? ''} onInput={(e) => onChange((e.target as HTMLTextAreaElement).value)}></textarea>;
    default:
      return assertNever(q.type, 'question type');
  }
};
