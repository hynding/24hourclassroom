import { readFileSync } from 'fs';
import { join } from 'path';

const FILES = ['../components/app-layout/app-layout.css', '../components/app-header/app-header.css'];

/** Every `@media (max-width: NNNpx)` value in a file, in source order. A
 * `.match()` (first occurrence only) would miss a second, differing
 * breakpoint added to just one file -- exactly the drift this spec exists
 * to catch. */
function breakpoints(rel: string): string[] {
  const css = readFileSync(join(__dirname, rel), 'utf8');
  return [...css.matchAll(/@media \(max-width: (\d+)px\)/g)].map((m) => m[1]);
}

describe('app-layout.css and app-header.css collapse the rail at the same breakpoint(s)', () => {
  const [layoutBreakpoints, headerBreakpoints] = FILES.map(breakpoints);

  it('each file declares exactly one distinct max-width value', () => {
    expect(layoutBreakpoints.length).toBeGreaterThan(0);
    expect(new Set(layoutBreakpoints).size).toBe(1);
    expect(new Set(headerBreakpoints).size).toBe(1);
  });

  it('the two files agree on every breakpoint value', () => {
    // Custom properties cannot drive media queries, so the literal lives in
    // both files; editing one -- or adding a second, differing breakpoint to
    // only one -- fails here.
    expect(headerBreakpoints).toEqual(layoutBreakpoints);
  });
});
