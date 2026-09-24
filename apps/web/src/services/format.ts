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

/** One decimal, with a bare integer kept bare: 10 renders "10", not "10.0". */
function oneDecimal(value: number): string {
  return String(Math.round(value * 10) / 10);
}

/**
 * Binary units under the familiar labels: 1 KB = 1024 bytes, 1 MB = 1,048,576.
 * That is what makes the 10,485,760-byte cap read "10 MB" and match the
 * server's "Choose a file under 10 MB." message; decimal units would print
 * the identical cap as "10.5 MB" beside it.
 */
export function formatBytes(bytes: number): string {
  if (bytes < 1024) {
    return `${bytes} B`;
  }
  const kb = bytes / 1024;
  if (kb < 1024) {
    return `${oneDecimal(kb)} KB`;
  }
  return `${oneDecimal(kb / 1024)} MB`;
}

/**
 * A short, readable type for a size/type cell, taken from the client
 * filename's last extension. `mime_type` is server-detected and correct but
 * unreadable ("application/vnd.oasis.opendocument.text"), and for .docx/.odt
 * it is often just "application/zip".
 */
export function fileTypeLabel(originalName: string): string {
  const dot = originalName.lastIndexOf('.');
  const ext = dot > 0 ? originalName.slice(dot + 1) : '';
  return ext ? ext.toUpperCase() : 'File';
}

/**
 * Cents to a dollar string: 123 -> "$1.23". Generation costs and the budget
 * are integer cents on both sides of the wire (Anthropic reports list cost as
 * an integer string of cents), so this is the only place the SPA divides --
 * unlike attempt scores, which arrive as decimal strings already.
 */
export function formatCents(cents: number): string {
  return `$${(cents / 100).toFixed(2)}`;
}
