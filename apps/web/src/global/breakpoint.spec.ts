import { readdirSync, readFileSync, statSync } from 'fs';
import { join } from 'path';

const SRC = join(__dirname, '..');

/** Every .css file under src/, recursively. */
function cssFiles(dir: string): string[] {
  return readdirSync(dir).flatMap((name) => {
    const full = join(dir, name);
    if (statSync(full).isDirectory()) return cssFiles(full);
    return name.endsWith('.css') ? [full] : [];
  });
}

/** Every `@media (max-width: NNNpx)` value in a file, in source order. A
 * `.match()` (first occurrence only) would miss a second, differing
 * breakpoint added to just one file -- exactly the drift this spec exists
 * to catch. */
function breakpoints(file: string): string[] {
  return [...readFileSync(file, 'utf8').matchAll(/@media \(max-width: (\d+)px\)/g)].map((m) => m[1]);
}

describe('every stylesheet collapses to the narrow layout at the same breakpoint', () => {
  const layout = breakpoints(join(SRC, 'components/app-layout/app-layout.css'));
  const header = breakpoints(join(SRC, 'components/app-header/app-header.css'));

  it('app-layout.css and app-header.css each declare exactly one distinct max-width value', () => {
    expect(layout.length).toBeGreaterThan(0);
    expect(new Set(layout).size).toBe(1);
    expect(header.length).toBeGreaterThan(0);
    expect(new Set(header).size).toBe(1);
  });

  it('no stylesheet under src/ uses a different max-width breakpoint', () => {
    // Custom properties cannot drive media queries, so the literal lives in
    // every file that needs it; editing one -- or adding a second, differing
    // breakpoint to any one -- fails here.
    const value = layout[0];
    for (const file of cssFiles(SRC)) {
      for (const found of breakpoints(file)) {
        expect(`${file}: ${found}`).toBe(`${file}: ${value}`);
      }
    }
  });

  it('app-header.tsx closes the drawer against the same query', () => {
    // The header asks matchMedia whether the drawer still applies after a
    // resize; a query that drifted from the stylesheet would close it on
    // the wrong screens.
    const tsx = readFileSync(join(SRC, 'components/app-header/app-header.tsx'), 'utf8');
    const m = /NARROW_SCREEN = '\(max-width: (\d+)px\)'/.exec(tsx);
    expect(m).not.toBeNull();
    expect(m![1]).toBe(layout[0]);
  });
});
