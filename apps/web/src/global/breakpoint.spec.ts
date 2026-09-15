import { readFileSync } from 'fs';
import { join } from 'path';

it('app-layout.css and app-header.css collapse the rail at the same breakpoint', () => {
  const files = ['../components/app-layout/app-layout.css', '../components/app-header/app-header.css'];
  const breakpoints = files.map((f) => readFileSync(join(__dirname, f), 'utf8').match(/@media \(max-width: (\d+)px\)/)?.[1]);

  expect(breakpoints[0]).toBeDefined();
  // Custom properties cannot drive media queries, so the literal lives in
  // both files; editing one without the other fails here.
  expect(breakpoints[1]).toBe(breakpoints[0]);
});
