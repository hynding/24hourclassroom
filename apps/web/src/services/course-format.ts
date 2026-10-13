import type { CourseItem } from '@24hc/shared';
import { fileTypeLabel } from './format';
import { isDeckName } from './flashcards';

/** A run of consecutive items sharing one heading (null: no heading). */
export interface CourseSection {
  title: string | null;
  items: CourseItem[];
}

/**
 * A section heading is repeated verbatim on every item of its group, like a
 * question's stimulus, so a page groups CONSECUTIVE items with the same
 * heading. The same heading further down starts a new group: the author's
 * order wins over tidiness.
 */
export function courseSections(items: CourseItem[]): CourseSection[] {
  const out: CourseSection[] = [];
  for (const item of items) {
    const title = item.section || null;
    const last = out[out.length - 1];
    if (last && last.title === title) {
      last.items.push(item);
    } else {
      out.push({ title, items: [item] });
    }
  }
  return out;
}

/**
 * An item's title as the course page shows it: a title that starts with the
 * course's own name and a " · " drops that prefix, so the seeded course's
 * "AP Biology · Week 07 · Quiz · …" reads "Week 07 · Quiz · …" under the
 * "AP Biology" heading. Anything else is shown whole.
 */
export function courseItemTitle(courseTitle: string, title: string): string {
  const prefix = `${courseTitle} · `;
  return title.startsWith(prefix) && title.length > prefix.length ? title.slice(prefix.length) : title;
}

/**
 * The short tag beside an item: "Test", "Flashcards", "Reading" for the
 * markdown and text files page-material shows inline, or the file's type.
 */
export function courseItemKind(item: CourseItem): string {
  if (item.kind === 'test') {
    return 'Test';
  }
  const name = item.material?.original_name ?? '';
  if (isDeckName(name)) {
    return 'Flashcards';
  }
  return /\.(md|txt)$/i.test(name) ? 'Reading' : fileTypeLabel(name);
}
