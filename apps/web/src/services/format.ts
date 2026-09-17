/**
 * A date-only value (e.g. an assignment's due date) is stored and returned
 * by the API as UTC midnight, such as `2026-10-01T00:00:00.000000Z` --
 * there is no meaningful time-of-day, only a calendar date. Formatting that
 * with `toLocaleDateString()` in the browser's local zone re-interprets
 * midnight UTC as an earlier local instant for any zone west of UTC, so it
 * renders the day *before* the one the API meant (e.g. "9/30/2026" instead
 * of "10/1/2026" in US zones). Pinning the format call to the UTC zone
 * reads the same calendar date back out regardless of the viewer's zone.
 */
export function formatDueDate(iso: string): string {
  return new Date(iso).toLocaleDateString(undefined, { timeZone: 'UTC' });
}
