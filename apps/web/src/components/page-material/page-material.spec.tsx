import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';

const getMaterial = jest.fn();
const publishMaterial = jest.fn();
const unpublishMaterial = jest.fn();
const deleteMaterial = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/materials-store', () => ({
  materialsStore: {
    getMaterial: (...a: unknown[]) => getMaterial(...a),
    publishMaterial: (...a: unknown[]) => publishMaterial(...a),
    unpublishMaterial: (...a: unknown[]) => unpublishMaterial(...a),
    deleteMaterial: (...a: unknown[]) => deleteMaterial(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageMaterial } from './page-material';
import { RichText } from '../rich-text/rich-text';
import { FlashcardDeck } from '../flashcard-deck/flashcard-deck';

const fetchMock = jest.fn();

const URL_ONE = 'https://api.test/api/materials/7/file?expires=1&signature=one';
const URL_TWO = 'https://api.test/api/materials/7/file?expires=2&signature=two';

const view = (extra: Record<string, unknown> = {}) => ({
  id: 7, title: 'Cell diagram', description: 'Week 1 handout', subject: 'science', grade_level: '6-8',
  visibility: 'private', published_at: null, original_name: 'cells.pdf', mime_type: 'application/pdf',
  size_bytes: 1536, author: { id: 2, name: 'Ms K' }, created_at: '', updated_at: '',
  is_author: false, shared_with_me: false, download_url: URL_ONE, ...extra,
});

const mount = async (payload: unknown) => {
  getMaterial.mockResolvedValue(payload);
  const page = await newSpecPage({ components: [PageMaterial, RichText, FlashcardDeck], html: '<page-material material-id="7"></page-material>' });
  await page.waitForChanges();
  return page;
};

/** The body fetch is not awaited by componentWillLoad: give it a tick, then let Stencil render. */
const settle = async (page: Awaited<ReturnType<typeof mount>>) => {
  await Promise.resolve();
  await Promise.resolve();
  await page.waitForChanges();
  await page.waitForChanges();
};

const textResponse = (text: string, ok = true) => ({ ok, status: ok ? 200 : 403, text: async () => text });

const clickDownload = async (page: Awaited<ReturnType<typeof mount>>) => {
  const link = page.root.shadowRoot.querySelector('a[data-testid="download"]') as HTMLAnchorElement;
  expect(link).toBeTruthy();
  link.click();
  // One tick for the handler's promise chain, one for the render Stencil
  // schedules when state changes.
  await Promise.resolve();
  await page.waitForChanges();
  await page.waitForChanges();
};

const clickButton = async (page: Awaited<ReturnType<typeof mount>>, label: string) => {
  const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.includes(label));
  expect(button).toBeTruthy();
  button.click();
  await page.waitForChanges();
  await page.waitForChanges();
};

describe('page-material', () => {
  beforeEach(() => {
    getMaterial.mockReset();
    publishMaterial.mockReset();
    unpublishMaterial.mockReset();
    deleteMaterial.mockReset();
    navigate.mockReset();
    // The component calls the bare global, which jest shares across the
    // mock-window reset newSpecPage performs. Default: never called.
    fetchMock.mockReset();
    (global as any).fetch = fetchMock;
  });

  it('shows the author every control', async () => {
    const page = await mount(view({ is_author: true }));
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Cell diagram');
    expect(text).toContain('Week 1 handout');
    expect(text).toContain('PDF');
    expect(text).toContain('1.5 KB');
    expect(text).toContain('Private');
    expect(page.root.shadowRoot.querySelector('a[href="/materials/7/edit"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/materials/7/share"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[data-testid="download"]')).not.toBeNull();
    expect(Array.from(page.root.shadowRoot.querySelectorAll('button')).map((b) => b.textContent)).toEqual(
      expect.arrayContaining([expect.stringContaining('Publish'), expect.stringContaining('Delete')]),
    );
  });

  it('shows a recipient the material and a download, but no author controls', async () => {
    const page = await mount(view({ shared_with_me: true }));
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Cell diagram');
    expect(text).toContain('Ms K');
    expect(text).toContain('Shared with you');
    expect(page.root.shadowRoot.querySelector('a[data-testid="download"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/materials/7/edit"]')).toBeNull();
    expect(page.root.shadowRoot.querySelector('a[href="/materials/7/share"]')).toBeNull();
    expect(page.root.shadowRoot.querySelector('button')).toBeNull();
  });

  it('shows a public viewer the material and a download only', async () => {
    const page = await mount(view({ visibility: 'public', published_at: '2026-09-01' }));

    expect(page.root.shadowRoot.textContent).toContain('Public');
    expect(page.root.shadowRoot.querySelector('a[data-testid="download"]')).not.toBeNull();
    expect(page.root.shadowRoot.querySelector('button')).toBeNull();
  });

  it('links the author to their profile', async () => {
    const page = await mount(view({ visibility: 'public', published_at: '2026-09-01', author: { id: 42, name: 'Ada' } }));

    const link = Array.from(page.root.shadowRoot.querySelectorAll('a')).find((a) => a.textContent === 'Ada');
    expect(link).toBeTruthy();
    expect(link.getAttribute('href')).toMatch(/\/teachers\/42$/);
  });

  it('renders not found on a 404 and on a missing id', async () => {
    getMaterial.mockRejectedValue(new ApiError(404, 'nope'));
    const missing = await newSpecPage({ components: [PageMaterial], html: '<page-material material-id="7"></page-material>' });
    await missing.waitForChanges();
    expect(missing.root.shadowRoot.textContent).toContain('Material not found');

    getMaterial.mockReset();
    const noId = await newSpecPage({ components: [PageMaterial], html: '<page-material></page-material>' });
    await noId.waitForChanges();
    expect(noId.root.shadowRoot.textContent).toContain('Material not found');
    expect(getMaterial).not.toHaveBeenCalled();
  });

  it('publishes and unpublishes, keeping the fresh download url from the response', async () => {
    publishMaterial.mockResolvedValue(view({ is_author: true, visibility: 'public', published_at: '2026-09-19', download_url: URL_TWO }));
    const page = await mount(view({ is_author: true }));
    expect(page.root.shadowRoot.textContent).toContain('Private');

    await clickButton(page, 'Publish');

    expect(publishMaterial).toHaveBeenCalledWith(7);
    expect(page.root.shadowRoot.textContent).toContain('Public');
    expect(page.root.shadowRoot.querySelector('a[data-testid="download"]')?.getAttribute('href')).toBe(URL_TWO);

    unpublishMaterial.mockResolvedValue(view({ is_author: true, visibility: 'private', published_at: null, download_url: URL_TWO }));
    await clickButton(page, 'Unpublish');

    expect(unpublishMaterial).toHaveBeenCalledWith(7);
    expect(page.root.shadowRoot.textContent).toContain('Private');
  });

  it('deletes once confirmed and returns to the list', async () => {
    deleteMaterial.mockResolvedValue(undefined);
    const page = await mount(view({ is_author: true }));
    // newSpecPage resets the mock window, so the stub only lands after mount --
    // which is exactly why the component calls `window.confirm`, not `confirm`.
    window.confirm = () => true;

    await clickButton(page, 'Delete');

    expect(deleteMaterial).toHaveBeenCalledWith(7);
    expect(navigate).toHaveBeenCalledWith('/materials');
  });

  it('does not delete when the confirm dialog is cancelled', async () => {
    const page = await mount(view({ is_author: true }));
    window.confirm = () => false;

    await clickButton(page, 'Delete');

    expect(deleteMaterial).not.toHaveBeenCalled();
    expect(navigate).not.toHaveBeenCalled();
  });

  it('follows the link as-is while the signed url is fresh', async () => {
    const page = await mount(view());
    const before = page.win.location.href;

    await clickDownload(page);

    // A plain link inside the 15-minute window: no second request, and the
    // page did not navigate itself.
    expect(getMaterial).toHaveBeenCalledTimes(1);
    expect(page.win.location.href).toBe(before);
  });

  it('re-fetches and navigates to a fresh url once the payload is over ten minutes old', async () => {
    // The staleness rule is tested by setting the instance's fetchedAt
    // directly -- fake timers cannot be enabled before mount, and
    // waitForChanges() needs real ones.
    const page = await mount(view());
    const cmp = page.rootInstance as PageMaterial;
    cmp.fetchedAt = Date.now() - 11 * 60 * 1000;
    getMaterial.mockResolvedValue(view({ download_url: URL_TWO }));

    await clickDownload(page);

    expect(getMaterial).toHaveBeenCalledTimes(2);
    // window.location.href, never navigate(): navigate() would push the API
    // host's URL onto the SPA history and resolve to the home page.
    expect(page.win.location.href).toBe(URL_TWO);
    expect(navigate).not.toHaveBeenCalled();
  });

  it('renders the not-found state when the stale re-fetch 404s', async () => {
    // Unpublished or unshared since the page loaded.
    const page = await mount(view());
    const cmp = page.rootInstance as PageMaterial;
    cmp.fetchedAt = Date.now() - 11 * 60 * 1000;
    getMaterial.mockRejectedValue(new ApiError(404, 'nope'));

    await clickDownload(page);

    expect(page.root.shadowRoot.textContent).toContain('Material not found');
  });

  describe('inline reader', () => {
    it('never fetches the body of a non-text upload', async () => {
      const page = await mount(view());
      await settle(page);

      expect(fetchMock).not.toHaveBeenCalled();
      expect(page.root.shadowRoot.querySelector('.reader')).toBeNull();
      expect(page.root.shadowRoot.querySelector('a[data-testid="download"]')).not.toBeNull();
    });

    it('reads a small markdown upload through its signed url and renders it as blocks', async () => {
      fetchMock.mockResolvedValue(textResponse('# Guide\n\nHello **world**'));
      const page = await mount(view({ original_name: 'guide.md', mime_type: 'text/markdown', size_bytes: 400 }));
      await settle(page);

      expect(fetchMock).toHaveBeenCalledWith(URL_ONE, { credentials: 'omit' });
      const article = page.root.shadowRoot.querySelector('article.reader');
      expect(article).not.toBeNull();
      const rich = article.querySelector('rich-text').shadowRoot;
      expect(rich.querySelector('h2').textContent).toBe('Guide');
      expect(rich.querySelector('strong').textContent).toBe('world');
      expect(page.root.shadowRoot.querySelector('[data-testid="reading"]')).toBeNull();
      // The download stays regardless.
      expect(page.root.shadowRoot.querySelector('a[data-testid="download"]')).not.toBeNull();
    });

    it('plays a .flashcards.md upload as a deck instead of a document', async () => {
      fetchMock.mockResolvedValue(textResponse('# Deck\n## Q1\nA1\n## Q2\nA2'));
      const page = await mount(view({ original_name: 'unit.flashcards.md', mime_type: 'text/markdown', size_bytes: 400 }));
      await settle(page);

      const deck = page.root.shadowRoot.querySelector('section.reader flashcard-deck');
      expect(deck).not.toBeNull();
      expect(deck.shadowRoot.textContent).toContain('Q1');
      expect(deck.shadowRoot.textContent).toContain('1 / 2');
      expect(page.root.shadowRoot.querySelector('article.reader')).toBeNull();
    });

    it('keeps the student\'s place in the deck when the page re-renders', async () => {
      fetchMock.mockResolvedValue(textResponse('# Deck\n## Q1\nA1\n## Q2\nA2\n## Q3\nA3'));
      const page = await mount(view({ original_name: 'unit.flashcards.md', mime_type: 'text/markdown', size_bytes: 400 }));
      await settle(page);

      const deck = page.root.shadowRoot.querySelector('flashcard-deck');
      const next = Array.from(deck.shadowRoot.querySelectorAll('button')).find((b) => b.textContent === 'Next');
      next.click();
      await page.waitForChanges();
      expect(deck.shadowRoot.querySelector('.counter').textContent).toBe('2 / 3');

      // Any state change on the page (an action error, busy, a refreshed
      // payload) re-renders it; the deck must receive the same cards and
      // stay where the student left it.
      (page.rootInstance as PageMaterial).actionError = 'Something went wrong.';
      await page.waitForChanges();
      expect(page.root.shadowRoot.querySelector('flashcard-deck')).toBe(deck);
      expect(deck.shadowRoot.querySelector('.counter').textContent).toBe('2 / 3');
    });

    it('skips the fetch for text over the size cap', async () => {
      const page = await mount(view({ original_name: 'notes.txt', mime_type: 'text/plain', size_bytes: 262145 }));
      await settle(page);
      expect(fetchMock).not.toHaveBeenCalled();
    });

    it('stays download-only when the fetch fails or is refused', async () => {
      fetchMock.mockRejectedValue(new TypeError('Failed to fetch'));
      const failed = await mount(view({ original_name: 'notes.txt', mime_type: 'text/plain', size_bytes: 40 }));
      await settle(failed);
      expect(failed.root.shadowRoot.querySelector('.reader')).toBeNull();
      expect(failed.root.shadowRoot.querySelector('[data-testid="reading"]')).toBeNull();
      expect(failed.root.shadowRoot.querySelector('a[data-testid="download"]')?.getAttribute('href')).toBe(URL_ONE);
      expect(failed.root.shadowRoot.textContent).toContain('Cell diagram');

      fetchMock.mockResolvedValue(textResponse('forbidden', false));
      const refused = await mount(view({ original_name: 'notes.txt', mime_type: 'text/plain', size_bytes: 40 }));
      await settle(refused);
      expect(refused.root.shadowRoot.querySelector('.reader')).toBeNull();
      expect(refused.root.shadowRoot.querySelector('a[data-testid="download"]')).not.toBeNull();
    });
  });
});
