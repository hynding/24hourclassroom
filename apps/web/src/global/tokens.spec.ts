import { readFileSync } from 'fs';
import { join } from 'path';
import { COLOR_TOKENS, FONT_TOKENS } from './token-names';

const read = (rel: string) => readFileSync(join(__dirname, rel), 'utf8');

describe('tokens.css is the default preset', () => {
  const tokens = read('tokens.css');
  const rootBlock = tokens.match(/:root\s*\{([\s\S]*?)\}/)?.[1] ?? '';

  it('defines every colour and font token in :root', () => {
    for (const name of [...COLOR_TOKENS, ...FONT_TOKENS]) {
      // A token missing here has no default: an unknown palette would render
      // that property as `initial` instead of Noon.
      expect(rootBlock).toContain(`${name}:`);
    }
  });

  it('declares the light color-scheme in :root (Noon is the base, noon.css is empty)', () => {
    expect(rootBlock).toMatch(/color-scheme:\s*light/);
  });

  it("keeps Noon's danger equal to the literal the old .error rule used", () => {
    // The .error conversion is the one provably neutral migration; if this
    // value drifts, that claim is false.
    expect(rootBlock).toMatch(/--color-danger:\s*#b3261e/);
  });
});

describe('index.html delivers the stylesheet', () => {
  const html = read('../index.html');

  it('links /build/app.css root-absolute with no media attribute', () => {
    const link = html.match(/<link[^>]*rel="stylesheet"[^>]*>/)?.[0];
    expect(link).toBeDefined();
    expect(link).toContain('href="/build/app.css"');
    // Stencil's inliner silently skips a link with `media`.
    expect(link).not.toContain('media=');
  });
});
