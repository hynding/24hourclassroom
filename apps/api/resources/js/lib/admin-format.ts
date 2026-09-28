/** Dollars from cents. Null is unknown, never $0.00 (spec decision 8). */
export function formatCents(cents: number | null): string {
    return cents === null ? '—' : `$${(cents / 100).toFixed(2)}`;
}

/** "1m 30s" / "45s"; empty while a run has no duration yet. */
export function formatDuration(seconds: number | null): string {
    if (seconds === null) return '';
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return m > 0 ? `${m}m ${s}s` : `${s}s`;
}

export function formatWhen(iso: string | null): string {
    return iso ? new Date(iso).toLocaleString() : '—';
}
