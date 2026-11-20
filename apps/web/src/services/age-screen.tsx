import { h } from '@stencil/core';
import { AGE_SCREEN_ROLES, hasRole } from '@24hc/shared';
import type { Role } from '@24hc/shared';

/**
 * The neutral age screen on sign-up (App\Support\AgeScreen server-side).
 * For AGE_SCREEN_ROLES the form asks the month and year of birth without
 * saying what age is wanted; the server refuses anyone who may be under 13
 * and stores nothing. After a refusal this tab keeps showing the notice
 * (sessionStorage), so going back and changing the answer is not the
 * obvious next step. That flag never leaves the browser.
 */
export const AGE_BLOCK_KEY = '24hc.age-screen.v1';

export const UNDER_AGE_NOTICE =
  'You need to be 13 or older to make your own account. Ask your teacher or a parent about other ways to use the site.';

export const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

export interface BirthAnswer {
  month: number | null;
  year: number | null;
}

export function screensAge(role: Role): boolean {
  return hasRole(AGE_SCREEN_ROLES, role);
}

export function isAgeBlocked(): boolean {
  try {
    return sessionStorage.getItem(AGE_BLOCK_KEY) === 'blocked';
  } catch {
    return false;
  }
}

export function markAgeBlocked(): void {
  try {
    sessionStorage.setItem(AGE_BLOCK_KEY, 'blocked');
  } catch {
    // Private mode or blocked storage: the server still refuses every try.
  }
}

/** True when a 422's errors are the server's under-13 refusal. */
export function isUnderAgeRefusal(errors: Record<string, string[]> | undefined): boolean {
  return (errors?.birth_year ?? []).some((m) => m.includes('13 or older'));
}

/** The body fields, or nothing when the role is not screened. */
export function birthFields(role: Role, answer: BirthAnswer): { birth_month?: number; birth_year?: number } {
  return screensAge(role) && answer.month && answer.year ? { birth_month: answer.month, birth_year: answer.year } : {};
}

export function renderBirthFields(answer: BirthAnswer, onChange: (next: BirthAnswer) => void, now: Date = new Date()) {
  const thisYear = now.getFullYear();
  const years = Array.from({ length: 100 }, (_, i) => thisYear - i);
  return (
    <fieldset class="birth">
      <legend>When were you born?</legend>
      <p class="muted">We check this once to set up your account and do not keep it.</p>
      <div class="birth-fields">
        <select aria-label="Birth month" required onInput={(e) => onChange({ ...answer, month: Number((e.target as HTMLSelectElement).value) || null })}>
          <option value="" selected={answer.month === null}>Month</option>
          {MONTHS.map((m, i) => <option value={String(i + 1)} selected={answer.month === i + 1}>{m}</option>)}
        </select>
        <select aria-label="Birth year" required onInput={(e) => onChange({ ...answer, year: Number((e.target as HTMLSelectElement).value) || null })}>
          <option value="" selected={answer.year === null}>Year</option>
          {years.map((y) => <option value={String(y)} selected={answer.year === y}>{y}</option>)}
        </select>
      </div>
    </fieldset>
  );
}
