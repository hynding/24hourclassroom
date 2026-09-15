import { existsSync, readdirSync, readFileSync, statSync } from 'fs';
import { join } from 'path';
import { PALETTES, TYPESETS } from '@24hc/shared';
import { COLOR_TOKENS, FONT_TOKENS } from './token-names';

const G = (rel: string) => join(__dirname, rel);
const read = (abs: string) => readFileSync(abs, 'utf8');

/** `--name: value;` pairs inside the first `{…}` block of a file. Comments
 * are stripped first -- otherwise a colon inside a rationale comment (e.g.
 * "on purpose: it has to hit 4.5:1") reads as a bogus `word: value;` pair
 * whose greedy capture swallows the real declaration that follows it. */
export function declarations(css: string): Record<string, string> {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  const body = stripped.match(/\{([\s\S]*?)\}/)?.[1] ?? '';
  const out: Record<string, string> = {};
  for (const m of body.matchAll(/([\w-]+)\s*:\s*([^;]+);/g)) out[m[1]] = m[2].trim();
  return out;
}

/** `--name: value;` pairs inside an arbitrary block body string (as opposed
 * to `declarations()`, which always takes the FIRST `{…}` block of a whole
 * file -- needed for typeset files, whose FIRST block is `@font-face`, not
 * the `:root[data-typeset=...]` override). */
function declarationsInBody(body: string): Record<string, string> {
  const out: Record<string, string> = {};
  for (const m of body.matchAll(/([\w-]+)\s*:\s*([^;]+);/g)) out[m[1]] = m[2].trim();
  return out;
}

/** The selector text before the first `{` in a file, comments stripped and
 * trimmed. Palette files have exactly one block, so this is their selector;
 * typeset files are handled separately below (see `overrideSelector`). */
export function firstSelector(css: string): string {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  return stripped.slice(0, stripped.indexOf('{')).trim();
}

/** The selector of the `:root[data-typeset=...]` override block, wherever it
 * falls in the file (Modern's is the SECOND block, after `@font-face`).
 * `undefined` when the file has no such block (Editorial). */
function overrideSelector(css: string): string | undefined {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  return stripped.match(/(:root\[[^{]*)\{/)?.[1].trim();
}

/** The body of the `:root[data-typeset=...]` override block. Empty string
 * when there is no such block. */
function overrideBody(css: string): string {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  const at = stripped.search(/:root\[/);
  if (at === -1) return '';
  const openAt = stripped.indexOf('{', at);
  const closeAt = stripped.indexOf('}', openAt);
  return stripped.slice(openAt + 1, closeAt);
}

function fontFaceFamily(css: string): string | undefined {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  return stripped.match(/@font-face\s*\{[^}]*font-family:\s*'([^']+)'/)?.[1];
}

function fontUrl(css: string): string | undefined {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  return stripped.match(/url\('\/assets\/fonts\/([^']+)'\)/)?.[1];
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

describe('declarations()', () => {
  it('ignores a colon inside a comment and still parses the declaration that follows it', () => {
    // Mirrors the shape that actually broke evening.css/slate.css/afternoon.css:
    // a rationale comment containing "word: ..." sitting between two real
    // declarations, with no semicolon of its own before the real one's.
    const css = [
      ":root[data-palette='x'] {",
      '  --color-ink-muted: #111111;',
      '  /* on purpose: it has to hit 4.5:1 on a near-black surface */',
      '  --color-accent: #123456;',
      '}',
    ].join('\n');
    const v = declarations(css);
    expect(v['--color-accent']).toBe('#123456');
    expect(v['--color-ink-muted']).toBe('#111111');
    expect(Object.keys(v)).not.toContain('purpose');
  });
});

const TEXT_TOKENS = ['--color-ink', '--color-ink-muted', '--color-accent', '--color-link', '--color-danger', '--color-success'];

/** Every palette file's values, layered over the tokens.css base -- Noon
 * included, so its (empty) file is actually read rather than assumed empty. */
function paletteValues(name: string): Record<string, string> {
  const base = declarations(read(G('tokens.css')));
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

      it(`has the selector :root[data-palette='${option.value}']`, () => {
        // The contrast/token/mirror checks above all parse the block BODY
        // and never look at what selects it -- a misspelled selector here
        // would still pass every one of them while matching nothing at
        // runtime, silently rendering as Noon.
        expect(firstSelector(read(G(`palettes/${option.value}.css`)))).toBe(`:root[data-palette='${option.value}']`);
      });
    });
  }
});

describe('typeset files', () => {
  for (const option of TYPESETS) {
    describe(option.value, () => {
      const css = read(G(`typesets/${option.value}.css`));
      const family = fontFaceFamily(css);

      if (option.value === 'editorial') {
        it('has no :root[ override block -- editorial IS the tokens.css base', () => {
          expect(css).not.toMatch(/:root\[/);
        });

        it("the @font-face family appears in tokens.css's --font-heading and --font-body", () => {
          const v = declarations(read(G('tokens.css')));
          expect(family).toBeDefined();
          expect(v['--font-heading']).toContain(family);
          expect(v['--font-body']).toContain(family);
        });
      } else {
        it(`overrides :root[data-typeset='${option.value}']`, () => {
          expect(overrideSelector(css)).toBe(`:root[data-typeset='${option.value}']`);
        });

        it('defines all four font tokens', () => {
          const v = declarationsInBody(overrideBody(css));
          for (const t of FONT_TOKENS) expect(v[t]).toBeDefined();
        });

        it('the @font-face family appears in --font-heading and --font-body', () => {
          const v = declarationsInBody(overrideBody(css));
          expect(family).toBeDefined();
          expect(v['--font-heading']).toContain(family);
          expect(v['--font-body']).toContain(family);
        });
      }

      it('the referenced font file exists on disk', () => {
        const file = fontUrl(css);
        expect(file).toBeDefined();
        expect(existsSync(G(`../assets/fonts/${file}`))).toBe(true);
      });
    });
  }
});

// Matches every colour/font-bearing longhand and shorthand, not just the
// handful the branch happened to ship first: border-top/-right/-bottom/
// -left and their -color variants, border-inline-*, box-shadow,
// background-image, the font shorthand, text-decoration-color,
// caret-color, accent-color and stroke all fall under this.
const GUARDED_PROP = /^(color|background|border|outline|fill|stroke|box-shadow|font|font-family|text-decoration-color|caret-color|accent-color)/;
const ALLOWED = /^(var\(--[\w-]+\)|transparent|currentColor|inherit|none|solid|dashed|auto|[\d.]+(px|rem|em|%)?)$/;

/** Every literal piece of every colour/font-bearing declaration in `css`
 * that is not a token reference or a bare keyword/length. */
export function offendingPieces(css: string): string[] {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  const out: string[] = [];
  for (const m of stripped.matchAll(/([\w-]+)\s*:\s*([^;{}]+);/g)) {
    if (!GUARDED_PROP.test(m[1])) continue;
    for (const piece of m[2].trim().split(/[\s,]+/)) {
      if (!ALLOWED.test(piece)) out.push(piece);
    }
  }
  return out;
}

describe('no literal colours or fonts outside tokens.css, palettes/, typesets/', () => {
  describe('offendingPieces()', () => {
    it('reports a literal colour in a border longhand the old PROPS list never looked at', () => {
      expect(offendingPieces("li { border-bottom: 1px solid #ff0000; }")).toContain('#ff0000');
    });

    it('does not report a token in the same property', () => {
      expect(offendingPieces("li { border-bottom: 1px solid var(--color-line); }")).toEqual([]);
    });
  });

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
      expect(offendingPieces(read(file))).toEqual([]);
    });
  }
});
