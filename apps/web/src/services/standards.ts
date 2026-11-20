/**
 * Curriculum standard codes as a teacher types them: "3.NF.A.1, 3.NF.A.2".
 * Commas, semicolons or whitespace separate codes; the server uppercases
 * and de-duplicates too (App\Support\Standards), so this only splits.
 */
export function parseStandards(text: string): string[] {
  const out: string[] = [];
  for (const raw of text.split(/[\s,;]+/)) {
    const code = raw.trim().toUpperCase();
    if (code && !out.includes(code)) out.push(code);
  }
  return out;
}

export function formatStandards(codes: string[] | null | undefined): string {
  return (codes ?? []).join(', ');
}

/** The first server error under `standards` or any `standards.N`. */
export function standardsError(errors: Record<string, string[]>): string | null {
  const key = Object.keys(errors).find((k) => k === 'standards' || k.startsWith('standards.'));
  return key ? errors[key][0] : null;
}

/** " · 3.NF.A.1, 3.NF.A.2" for a meta line, or "" when untagged. */
export function standardsSuffix(codes: string[] | null | undefined): string {
  return codes && codes.length ? ` · ${formatStandards(codes)}` : '';
}
