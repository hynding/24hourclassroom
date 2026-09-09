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

const page = (results: unknown[]) => {
  searchTeachers.mockResolvedValue({ data: results, meta: { current_page: 1, last_page: 1, per_page: 15, total: results.length } });
  return newSpecPage({ components: [PageTeachers], html: '<page-teachers></page-teachers>' });
};

describe('page-teachers', () => {
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
});
