import { readdirSync, readFileSync, statSync } from 'fs';
import { join } from 'path';
import { PALETTES } from '@24hc/shared';
import { COLOR_TOKENS } from './token-names';

const G = (rel: string) => join(__dirname, rel);
const read = (abs: string) => readFileSync(abs, 'utf8');

/** `--name: value;` pairs inside the first `{…}` block of a file. */
function declarations(css: string): Record<string, string> {
  const body = css.match(/\{([\s\S]*?)\}/)?.[1] ?? '';
  const out: Record<string, string> = {};
  for (const m of body.matchAll(/([\w-]+)\s*:\s*([^;]+);/g)) out[m[1]] = m[2].trim();
  return out;
}

// WCAG 2.x relative luminance and contrast ratio.
function luminance(hex: string): number {
  const c = hex.replace('#', '');
  const [r, g, b] = [0, 2, 4].map((i) => parseInt(c.slice(i, i + 2), 16) / 255);
  const lin = (v: number) => (v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4);
  return 0.2126 * lin(r) + 0.7152 * lin(g) + 0.0722 * lin(b);
}
export function contrast(a: string, b: string): number {
  const [hi, lo] = [luminance(a), luminance(b)].sort((x, y) => y - x);
  return (hi + 0.05) / (lo + 0.05);
}

const TEXT_TOKENS = ['--color-ink', '--color-ink-muted', '--color-accent', '--color-link', '--color-danger', '--color-success'];

/** Noon's values are the base; every other palette is its own file. */
function paletteValues(name: string): Record<string, string> {
  const base = declarations(read(G('tokens.css')));
  if (name === 'noon') return base;
  return { ...base, ...declarations(read(G(`palettes/${name}.css`))) };
}

describe('palette files', () => {
  for (const option of PALETTES) {
    describe(option.value, () => {
      const v = paletteValues(option.value);

      it('defines every colour token (noon inherits the base)', () => {
        for (const t of COLOR_TOKENS) expect(v[t]).toMatch(/^#[0-9a-f]{6}$/);
      });

      it('passes WCAG AA for every text token on both surfaces', () => {
        for (const t of TEXT_TOKENS) {
          for (const surface of ['--color-surface', '--color-surface-raised']) {
            const ratio = contrast(v[t], v[surface]);
            // Afternoon's original accent failed on raised at 4.40; this is
            // what caught it.
            expect(ratio).toBeGreaterThanOrEqual(4.5);
          }
        }
        expect(contrast(v['--color-on-accent'], v['--color-accent'])).toBeGreaterThanOrEqual(4.5);
      });

      it('matches the PALETTES metadata the boot script paints from', () => {
        expect(v['--color-surface']).toBe(option.surface);
        expect(v['color-scheme']).toBe(option.scheme);
      });
    });
  }
});

describe('no literal colours or fonts outside tokens.css, palettes/, typesets/', () => {
  const PROPS = ['color', 'background', 'background-color', 'border', 'border-color', 'outline', 'outline-color', 'fill', 'font-family'];
  const ALLOWED = /^(var\(--[\w-]+\)|transparent|currentColor|inherit|none|solid|dashed|auto|[\d.]+(px|rem|em|%)?)$/;

  function cssFiles(dir: string): string[] {
    return readdirSync(dir).flatMap((name) => {
      const abs = join(dir, name);
      return statSync(abs).isDirectory() ? cssFiles(abs) : name.endsWith('.css') ? [abs] : [];
    });
  }

  const exempt = (abs: string) => /\/global\/(tokens\.css|palettes\/|typesets\/)/.test(abs);
  const files = cssFiles(join(__dirname, '..')).filter((f) => !exempt(f));

  it('scans at least app.css', () => {
    expect(files.some((f) => f.endsWith('/global/app.css'))).toBe(true);
  });

  for (const file of files) {
    it(`${file.split('/src/')[1]} uses tokens only`, () => {
      // Strip comments, then check each guarded declaration token by token.
      const css = read(file).replace(/\/\*[\s\S]*?\*\//g, '');
      for (const m of css.matchAll(/([\w-]+)\s*:\s*([^;{}]+);/g)) {
        if (!PROPS.includes(m[1])) continue;
        for (const piece of m[2].trim().split(/[\s,]+/)) {
          expect({ file, declaration: m[0], piece }).toEqual(expect.objectContaining({ piece: expect.stringMatching(ALLOWED) }));
        }
      }
    });
  }
});
