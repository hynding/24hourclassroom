import type { Gradebook } from '@24hc/shared';

/**
 * One CSV cell (RFC 4180): quoted when it holds a comma, quote or line
 * break. Text that a spreadsheet would read as a formula (=, +, -, @, tab,
 * carriage return first) gets a leading apostrophe, because student names
 * are typed by students. Numbers are written as they are.
 */
export function csvCell(value: string | number | null | undefined): string {
  if (value === null || value === undefined) {
    return '';
  }
  if (typeof value === 'number') {
    return Number.isFinite(value) ? String(value) : '';
  }
  const text = /^[=+\-@\t\r]/.test(value) ? `'${value}` : value;
  return /[",\r\n]/.test(text) ? `"${text.replace(/"/g, '""')}"` : text;
}

/** CRLF lines and a byte-order mark, so Excel opens accented names as UTF-8. */
export function toCsv(book: Gradebook): string {
  const lines = [book.columns, ...book.rows].map((row) => row.map(csvCell).join(','));
  return `﻿${lines.join('\r\n')}\r\n`;
}

/** A file name from a title: letters, digits and dashes, plus the date. */
export function csvFileName(title: string, today: Date = new Date()): string {
  const slug = title.normalize('NFKD').replace(/[̀-ͯ]/g, '').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '').slice(0, 60) || 'gradebook';
  const pad = (n: number) => String(n).padStart(2, '0');
  return `${slug}-scores-${today.getFullYear()}-${pad(today.getMonth() + 1)}-${pad(today.getDate())}.csv`;
}

/** Hands the browser a file to save. */
export function saveCsv(book: Gradebook): void {
  const url = URL.createObjectURL(new Blob([toCsv(book)], { type: 'text/csv;charset=utf-8' }));
  const a = document.createElement('a');
  a.href = url;
  a.download = csvFileName(book.title);
  document.body.appendChild(a);
  a.click();
  a.remove();
  setTimeout(() => URL.revokeObjectURL(url), 0);
}
