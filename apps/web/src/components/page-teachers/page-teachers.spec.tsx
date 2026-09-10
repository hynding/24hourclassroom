import { newSpecPage } from '@stencil/core/testing';

const searchTeachers = jest.fn();

jest.mock('../../services/profile-store', () => ({
  profileStore: {
    searchTeachers: (...args: unknown[]) => searchTeachers(...args),
  },
}));

// Imported after jest.mock(): Stencil's Jest preprocessor transpiles via the
// TypeScript compiler, not babel-jest, so jest.mock() calls are not hoisted
// above static imports the way they are under babel-jest. Without this
// ordering, './page-teachers' (and its real profile-store import) resolves
// before the mock is registered, and the component hits the real ApiClient.
import { PageTeachers } from './page-teachers';

const page = (results: unknown[], lastPage = 1) => {
  searchTeachers.mockResolvedValue({
    data: results,
    meta: { current_page: 1, last_page: lastPage, per_page: 15, total: results.length },
  });
  return newSpecPage({ components: [PageTeachers], html: '<page-teachers></page-teachers>' });
};

const teacher = (id: number, name: string) => ({
  id, name, school: null, subjects: [], grade_levels: [], avatar_url: null,
});

describe('page-teachers', () => {
  // searchTeachers is module-level and shared across every test here, and this
  // project sets no global clearMocks. Without this, call-count assertions
  // count every prior test's calls too. mockClear() drops call history only --
  // the resolved value each test sets via page() survives.
  beforeEach(() => {
    searchTeachers.mockClear();
  });

  it('renders a row per teacher', async () => {
    const spec = await page([
      { id: 1, name: 'Ada Teacher', school: 'Rivet High', subjects: ['math'], grade_levels: ['9-12'], avatar_url: null },
      { id: 2, name: 'Grace Hopper', school: null, subjects: [], grade_levels: [], avatar_url: null },
    ]);
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('Ada Teacher');
    expect(spec.root.shadowRoot.textContent).toContain('Grace Hopper');
  });

  it('shows an empty state when nothing matches', async () => {
    const spec = await page([]);
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).toContain('No teachers match');
  });

  it('passes the chosen subject filter to the store', async () => {
    const spec = await page([]);
    await spec.waitForChanges();

    spec.rootInstance.subject = 'math';
    await spec.rootInstance.search();

    expect(searchTeachers).toHaveBeenLastCalledWith({ subject: 'math' });
  });

  it('shows a distinct error state on failure instead of claiming no matches', async () => {
    searchTeachers.mockRejectedValue(new Error('network down'));

    const spec = await newSpecPage({ components: [PageTeachers], html: '<page-teachers></page-teachers>' });
    await spec.waitForChanges();

    const text = spec.root.shadowRoot.textContent;
    expect(text).toContain('We could not load teachers.');
    expect(text).not.toContain('No teachers match');
  });

  it('requests the next page and keeps the active filters', async () => {
    const spec = await page([teacher(1, 'Ada')], 3);
    await spec.waitForChanges();
    spec.rootInstance.subject = 'math';

    await spec.rootInstance.nextPage();

    expect(searchTeachers).toHaveBeenLastCalledWith({ subject: 'math', page: 2 });
  });

  it('resets to the first page when the filters change', async () => {
    const spec = await page([teacher(1, 'Ada')], 3);
    await spec.waitForChanges();
    await spec.rootInstance.nextPage();
    expect(spec.rootInstance.page).toBe(2);

    // Searching with a new filter from page 2 must not ask for page 2 of the
    // new result set -- that is usually out of range and renders as an empty
    // directory, which reads exactly like "no teachers match".
    spec.rootInstance.q = 'hopper';
    await spec.rootInstance.submitSearch();

    expect(spec.rootInstance.page).toBe(1);
    expect(searchTeachers).toHaveBeenLastCalledWith({ q: 'hopper' });
  });

  it('does not page past the last page or before the first', async () => {
    const spec = await page([teacher(1, 'Ada')], 1);
    await spec.waitForChanges();

    await spec.rootInstance.nextPage();
    expect(spec.rootInstance.page).toBe(1);

    await spec.rootInstance.previousPage();
    expect(spec.rootInstance.page).toBe(1);
    expect(searchTeachers).toHaveBeenCalledTimes(1);
  });

  it('hides the pager when there is only one page', async () => {
    const spec = await page([teacher(1, 'Ada')], 1);
    await spec.waitForChanges();

    expect(spec.root.shadowRoot.textContent).not.toContain('Page 1 of');
  });
});
