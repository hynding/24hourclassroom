import type { MyAssignment } from '@24hc/shared';

/**
 * A student's home-page to-do list, split out of their assignments
 * (`GET /api/assignments`, already soonest-due first).
 *
 * Due dates are calendar days stored at midnight UTC (formatDueDate reads
 * them in UTC too), so they are compared as YYYY-MM-DD strings against the
 * student's own local date: due "today" is due until their day ends.
 */
export interface UpNext {
  /** Not submitted, due before today. */
  overdue: MyAssignment[];
  /** Not submitted, due today through the next six days. */
  thisWeek: MyAssignment[];
  /** Everything else still open: due later, or undated. */
  laterCount: number;
  /** Submitted in the last fortnight, newest first. */
  recent: MyAssignment[];
}

export const WEEK_DAYS = 7;
const RECENT_DAYS = 14;

/** The local calendar date as YYYY-MM-DD. */
export function localDay(now: Date): string {
  const pad = (n: number) => String(n).padStart(2, '0');
  return `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}`;
}

function addDays(now: Date, days: number): Date {
  const d = new Date(now.getTime());
  d.setDate(d.getDate() + days);
  return d;
}

/** Submitted at least once. A started, unsubmitted attempt is still open work. */
export function isDone(a: MyAssignment): boolean {
  return !!a.latest?.submitted_at;
}

export function upNext(assignments: MyAssignment[], now: Date = new Date()): UpNext {
  const today = localDay(now);
  const weekEnd = localDay(addDays(now, WEEK_DAYS - 1));
  const recentSince = addDays(now, -RECENT_DAYS).getTime();

  const open = assignments.filter((a) => !isDone(a));
  const dueDay = (a: MyAssignment) => a.due_at?.slice(0, 10) ?? null;
  const overdue = open.filter((a) => dueDay(a) !== null && dueDay(a) < today);
  const thisWeek = open.filter((a) => dueDay(a) !== null && dueDay(a) >= today && dueDay(a) <= weekEnd);
  const recent = assignments
    .filter((a) => isDone(a) && new Date(a.latest.submitted_at).getTime() >= recentSince)
    .sort((x, y) => y.latest.submitted_at.localeCompare(x.latest.submitted_at));

  return { overdue, thisWeek, laterCount: open.length - overdue.length - thisWeek.length, recent };
}
