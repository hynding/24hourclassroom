import { readFileSync } from 'fs';
import { join } from 'path';

// A spec page cannot see computed CSS (mock-doc has no cascade), and a parent
// spec cannot reach into app-layout's shadow root anyway -- so, like
// breakpoint.spec.ts, this reads the stylesheet as text.
const css = readFileSync(join(__dirname, '../components/app-layout/app-layout.css'), 'utf8');

/** The declaration body of the first rule whose selector text starts at
 * `needle`. Comments are stripped first so a `{` inside a rationale comment
 * cannot be mistaken for the start of the block. */
function ruleBody(needle: string): string {
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  const at = stripped.indexOf(needle);
  if (at === -1) return '';
  const openAt = stripped.indexOf('{', at);
  return stripped.slice(openAt + 1, stripped.indexOf('}', openAt));
}

function declarations(body: string): Record<string, string> {
  const out: Record<string, string> = {};
  for (const m of body.matchAll(/([\w-]+)\s*:\s*([^;]+);/g)) out[m[1]] = m[2].trim();
  return out;
}

describe('app-layout print (bare) shell', () => {
  it('the screen shell fills the viewport', () => {
    // Pins the declaration the bare rule below has to undo -- if this ever
    // stops being 100vh, the reset is no longer load-bearing.
    expect(declarations(ruleBody('.shell {'))['min-height']).toBe('100vh');
  });

  it('resets min-height under [bare] so print gets no trailing blank sheet', () => {
    const bare = declarations(ruleBody(':host([bare]) .shell'));
    expect(bare.display).toBe('block');
    // 100vh of filler on a printed page is a whole extra sheet.
    expect(bare['min-height']).toBe('auto');
  });
});
