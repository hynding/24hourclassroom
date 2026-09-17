import { newSpecPage } from '@stencil/core/testing';

const library = jest.fn();
jest.mock('../../services/tests-store', () => ({ testsStore: { library: (...a: unknown[]) => library(...a) } }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageLibrary } from './page-library';

const item = (id: number, title: string) => ({
  id, title, subject: 'math', grade_level: 'k-2', visibility: 'public', published_at: '2026-09-01', question_count: 3, author: { id: 1, name: 'Ms K' },
});
const mount = (data: unknown[], lastPage = 1) => {
  library.mockResolvedValue({ data, meta: { current_page: 1, last_page: lastPage, per_page: 15, total: data.length } });
  return newSpecPage({ components: [PageLibrary], html: '<page-library></page-library>' });
};

describe('page-library', () => {
  beforeEach(() => library.mockClear());

  it('lists public tests with author and question count', async () => {
    const page = await mount([item(1, 'Fractions'), item(2, 'Cells')]);
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;
    expect(text).toContain('Fractions');
    expect(text).toContain('Ms K');
    expect(text).toContain('3 questions');
    expect(page.root.shadowRoot.querySelector('a[href="/tests/2"]')).not.toBeNull();
  });

  it('shows an empty state and resets to page 1 on a new search', async () => {
    const page = await mount([], 1);
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('No tests match');
    const cmp = page.rootInstance as PageLibrary;
    cmp.page = 3;
    await cmp.submitSearch();
    expect(library).toHaveBeenLastCalledWith(expect.not.objectContaining({ page: 3 }));
  });
});
