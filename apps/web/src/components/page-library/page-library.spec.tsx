import { readFileSync } from 'fs';
import { join } from 'path';
import { newSpecPage } from '@stencil/core/testing';

const library = jest.fn();
const materialsLibrary = jest.fn();
jest.mock('../../services/tests-store', () => ({ testsStore: { library: (...a: unknown[]) => library(...a) } }));
jest.mock('../../services/materials-store', () => ({ materialsStore: { materialsLibrary: (...a: unknown[]) => materialsLibrary(...a) } }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageLibrary } from './page-library';

const test = (id: number, title: string) => ({
  id, title, subject: 'math', grade_level: 'k-2', visibility: 'public', published_at: '2026-09-01', question_count: 3, author: { id: 1, name: 'Ms K' },
});
const material = (id: number, title: string) => ({
  id, title, subject: 'math', grade_level: 'k-2', visibility: 'public', published_at: '2026-09-01',
  original_name: 'fractions.pdf', mime_type: 'application/pdf', size_bytes: 1572864, author: { id: 1, name: 'Ms K' },
});
const paginated = (data: unknown[], lastPage = 1) => ({ data, meta: { current_page: 1, last_page: lastPage, per_page: 15, total: data.length } });

const mount = (attrs = '') => newSpecPage({ components: [PageLibrary], html: `<page-library ${attrs}></page-library>` });

describe('page-library', () => {
  beforeEach(() => {
    library.mockReset().mockResolvedValue(paginated([]));
    materialsLibrary.mockReset().mockResolvedValue(paginated([]));
  });

  it('lists public tests with author and question count', async () => {
    library.mockResolvedValue(paginated([test(1, 'Fractions'), test(2, 'Cells')]));
    const page = await mount();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Test library');
    expect(text).toContain('Fractions');
    expect(text).toContain('Ms K');
    expect(text).toContain('3 questions');
    expect(page.root.shadowRoot.querySelector('a[href="/tests/2"]')).not.toBeNull();
    expect(materialsLibrary).not.toHaveBeenCalled();
  });

  it('shows an empty state and resets to page 1 on a new search', async () => {
    const page = await mount();
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('No tests match');
    const cmp = page.rootInstance as PageLibrary;
    cmp.page = 3;
    await cmp.submitSearch();
    expect(library).toHaveBeenLastCalledWith(expect.not.objectContaining({ page: 3 }));
  });

  it('lists public materials with type and size when kind is materials', async () => {
    materialsLibrary.mockResolvedValue(paginated([material(4, 'Fraction worksheet')]));
    const page = await mount('kind="materials"');
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Material library');
    expect(text).toContain('Fraction worksheet');
    expect(text).toContain('PDF');
    expect(text).toContain('1.5 MB');
    expect(text).toContain('Ms K');
    expect(page.root.shadowRoot.querySelector('a[href="/materials/4"]')).not.toBeNull();
    expect(library).not.toHaveBeenCalled();
  });

  it('switches its own empty-state copy with the kind', async () => {
    const page = await mount('kind="materials"');
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('No materials match');
    expect(page.root.shadowRoot.textContent).not.toContain('No tests match');
  });

  it('reflects kind as an attribute so page-library.css can key on it', async () => {
    const page = await mount();
    expect(page.root.getAttribute('kind')).toBe('tests');

    page.root.kind = 'materials';
    await page.waitForChanges();
    expect(page.root.getAttribute('kind')).toBe('materials');
    expect(page.root.getAttribute('kind')).not.toBe('tests');
  });

  it('re-searches and resets the page when kind changes, without touching the filters', async () => {
    // Both segments resolve to this same tag, so Stencil REUSES the element
    // and componentWillLoad does not run again -- the @Watch is the only
    // thing that reloads. subject/grade/q must survive: the <select>s are
    // uncontrolled, so clearing state would leave the DOM disagreeing with it.
    library.mockResolvedValue(paginated([test(1, 'Fractions')], 3));
    materialsLibrary.mockResolvedValue(paginated([material(4, 'Worksheet')]));
    const page = await mount();
    await page.waitForChanges();

    const cmp = page.rootInstance as PageLibrary;
    cmp.subject = 'science';
    cmp.q = 'cells';
    cmp.page = 3;

    page.root.kind = 'materials';
    await page.waitForChanges();
    await page.waitForChanges();

    expect(materialsLibrary).toHaveBeenCalledWith({ subject: 'science', q: 'cells' });
    expect(cmp.page).toBe(1);
    expect(cmp.subject).toBe('science');
    expect(cmp.q).toBe('cells');
    // The previous segment's results must not linger under the new heading.
    expect(page.root.shadowRoot.textContent).not.toContain('Fractions');
    expect(page.root.shadowRoot.textContent).toContain('Worksheet');
  });

  it('fetches nothing and renders the empty state for an unknown kind', async () => {
    // kind is a reflected string attribute, so its runtime value is not
    // type-constrained -- an unrecognised segment must not silently fall
    // back to fetching either library (the denylist-shaped defect CLAUDE.md
    // calls out).
    const page = await mount();
    await page.waitForChanges();
    library.mockClear();
    materialsLibrary.mockClear();

    page.root.kind = 'nope' as any;
    await page.waitForChanges();
    await page.waitForChanges();

    expect(library).not.toHaveBeenCalled();
    expect(materialsLibrary).not.toHaveBeenCalled();
    expect(page.root.shadowRoot.textContent).toContain('No tests match');
  });

  it('offers both segments as links', async () => {
    const page = await mount();
    await page.waitForChanges();
    expect(page.root.shadowRoot.querySelector('a[href="/library"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/library/materials"]')).not.toBeNull();
  });

  it('keys the wider materials grid off the reflected attribute', () => {
    // A spec page has no cascade (mock-doc computes nothing), so the pairing
    // of reflect: true with the CSS selector is asserted as text -- the same
    // approach print-layout.spec.ts uses.
    const css = readFileSync(join(__dirname, 'page-library.css'), 'utf8');
    expect(css).toContain(":host([kind='materials']) .cards");
  });
});
