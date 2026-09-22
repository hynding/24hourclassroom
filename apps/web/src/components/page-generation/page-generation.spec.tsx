import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';
import { GENERATION_STATUSES } from '@24hc/shared';

const getGeneration = jest.fn();
const cancelGeneration = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/generation-store', () => ({
  generationStore: {
    getGeneration: (...a: unknown[]) => getGeneration(...a),
    cancelGeneration: (...a: unknown[]) => cancelGeneration(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
let currentUser: unknown = null;
let pending: unknown = null;
const authLoad = jest.fn(async () => { currentUser = pending; return currentUser; });
jest.mock('../../services/auth-store', () => ({
  authStore: { get currentUser() { return currentUser; }, load: () => authLoad() },
}));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageGeneration } from './page-generation';

const gen = (extra: Record<string, unknown> = {}) => ({
  id: 7, title: 'Cells', subject: 'science', grade_level: '6-8',
  instructions: 'Focus on organelles.', question_count: 10, material_ids: [3],
  status: 'running', agent_note: null, error: null, list_cost_cents: null,
  test_id: null, started_at: '2026-09-21T00:00:00Z', finished_at: null,
  created_at: '2026-09-21T00:00:00Z', ...extra,
});

// Every mount that lands on a live row arms a real setTimeout; clear it so no
// spec leaks a pending handle into the next one. Fake timers are never
// enabled -- they cannot be turned on before mount, and waitForChanges needs
// real ones -- so the loop is driven by calling tick() directly instead.
let mounted: PageGeneration | null = null;

const mount = async (html = '<page-generation generation-id="7"></page-generation>') => {
  const page = await newSpecPage({ components: [PageGeneration], html });
  await page.waitForChanges();
  mounted = page.rootInstance as PageGeneration;
  return page;
};

const clickButton = async (page: Awaited<ReturnType<typeof mount>>, label: string) => {
  const button = Array.from(page.root.shadowRoot.querySelectorAll('button')).find((b) => b.textContent?.trim() === label);
  expect(button).toBeTruthy();
  button.click();
  await page.waitForChanges();
  await page.waitForChanges();
};

describe('page-generation', () => {
  beforeEach(() => {
    getGeneration.mockReset().mockResolvedValue(gen());
    cancelGeneration.mockReset();
    navigate.mockReset();
    authLoad.mockClear();
    currentUser = null;
    pending = { id: 1, role: 'teacher' };
    mounted = null;
  });

  afterEach(() => {
    mounted?.disconnectedCallback();
  });

  it('renders the label of every status in GENERATION_STATUSES', async () => {
    for (const option of GENERATION_STATUSES) {
      getGeneration.mockResolvedValue(gen({ status: option.value }));
      const page = await mount();

      const pill = page.root.shadowRoot.querySelector('.pill');
      expect(pill).not.toBeNull();
      expect(pill.textContent).toBe(option.label);

      (page.rootInstance as PageGeneration).disconnectedCallback();
    }
    expect(authLoad).toHaveBeenCalled();
  });

  it('renders the title, taxonomy labels and the agent note', async () => {
    getGeneration.mockResolvedValue(gen({ agent_note: 'Read two files.\nDrafting now.' }));
    const page = await mount();
    const root = page.root.shadowRoot;

    expect(root.textContent).toContain('Cells');
    expect(root.textContent).toContain('Science');
    expect(root.textContent).toContain('6-8');
    // A class, not an inline style: the pre-wrap lives in the component CSS
    // so the note keeps the agent's own line breaks.
    const note = root.querySelector('p.note');
    expect(note).not.toBeNull();
    expect(note.textContent).toContain('Read two files.\nDrafting now.');
  });

  it('renders the list cost when it is known and nothing when it is not', async () => {
    getGeneration.mockResolvedValue(gen({ status: 'done', test_id: 12, list_cost_cents: 123 }));
    const withCost = await mount();
    expect(withCost.root.shadowRoot.textContent).toContain('$1.23 at list price');
    (withCost.rootInstance as PageGeneration).disconnectedCallback();

    getGeneration.mockResolvedValue(gen({ status: 'done', test_id: 12, list_cost_cents: null }));
    const without = await mount();
    expect(without.root.shadowRoot.textContent).not.toContain('at list price');
  });

  it('renders the error text whenever the row carries one', async () => {
    getGeneration.mockResolvedValue(gen({ status: 'failed', error: 'The agent finished without saving a draft.' }));
    const page = await mount();

    expect(page.root.shadowRoot.textContent).toContain('The agent finished without saving a draft.');
  });

  it('cancels after the confirm dialog and replaces the payload', async () => {
    cancelGeneration.mockResolvedValue(gen({ status: 'cancelled', finished_at: '2026-09-21T01:00:00Z' }));
    const page = await mount();
    // newSpecPage resets the mock window, so the stub only lands after mount --
    // which is exactly why the component calls `window.confirm`, not `confirm`.
    const confirm = jest.fn().mockReturnValue(true);
    window.confirm = confirm;

    await clickButton(page, 'Cancel');

    expect(confirm).toHaveBeenCalledWith('Cancel this generation?');
    expect(cancelGeneration).toHaveBeenCalledWith(7);
    expect(page.root.shadowRoot.textContent).toContain('Cancelled');
    // A terminal row stops the loop.
    expect((page.rootInstance as PageGeneration).timer).toBeNull();
  });

  it('does not cancel when the dialog is dismissed', async () => {
    const page = await mount();
    window.confirm = () => false;

    await clickButton(page, 'Cancel');

    expect(cancelGeneration).not.toHaveBeenCalled();
  });

  it('retries a 409 cancel exactly once', async () => {
    // 409 means the advancer held the row's lock for up to five seconds.
    cancelGeneration
      .mockRejectedValueOnce(new ApiError(409, 'The generation is busy. Try again.'))
      .mockResolvedValue(gen({ status: 'cancelled' }));
    const page = await mount();
    window.confirm = () => true;

    await clickButton(page, 'Cancel');

    expect(cancelGeneration).toHaveBeenCalledTimes(2);
    expect(page.root.shadowRoot.textContent).toContain('Cancelled');
  });

  it('offers Open the draft whenever a draft was saved, whatever the final status', async () => {
    // A saved draft is a real private test in the teacher's account even when
    // the run was later cancelled at the cap, so the link keys on test_id.
    for (const status of ['done', 'cancelled'] as const) {
      getGeneration.mockResolvedValue(gen({ status, test_id: 12 }));
      const page = await mount();
      const link = page.root.shadowRoot.querySelector('a[href="/tests/12/edit"]');
      expect(link).not.toBeNull();
      expect(link.textContent).toBe('Open the draft');
      (page.rootInstance as PageGeneration).disconnectedCallback();
    }

    getGeneration.mockResolvedValue(gen({ status: 'running' }));
    const running = await mount();
    expect(running.root.shadowRoot.textContent).not.toContain('Open the draft');
    (running.rootInstance as PageGeneration).disconnectedCallback();
  });

  it('offers Try again when the run failed and when it hit the budget', async () => {
    for (const status of ['failed', 'budget_reached']) {
      getGeneration.mockResolvedValue(gen({ status, error: 'Stopped.' }));
      const page = await mount();
      const link = page.root.shadowRoot.querySelector('a[href="/tests/generate?from=7"]');

      expect(link).not.toBeNull();
      expect(link.textContent).toBe('Try again');
      (page.rootInstance as PageGeneration).disconnectedCallback();
    }
  });

  it('re-arms the poll while the run is live and stops on a terminal status', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageGeneration;
    expect(cmp.timer).not.toBeNull();

    getGeneration.mockResolvedValue(gen({ status: 'done', test_id: 12 }));
    await cmp.tick();

    expect(cmp.timer).toBeNull();
  });

  it('doubles the interval on a 429 up to 30 s and resets it on the next success', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageGeneration;
    expect(cmp.intervalMs).toBe(5000);

    getGeneration.mockRejectedValue(new ApiError(429, 'Too Many Requests'));
    await cmp.tick();
    expect(cmp.intervalMs).toBe(10000);
    await cmp.tick();
    expect(cmp.intervalMs).toBe(20000);
    await cmp.tick();
    expect(cmp.intervalMs).toBe(30000);
    await cmp.tick();
    // Clamped: the SPA shares one 60/min bucket across all its traffic, but
    // half-hourly polling would be useless.
    expect(cmp.intervalMs).toBe(30000);
    // The row is kept, not blanked, while backing off.
    expect(page.root.shadowRoot.textContent).toContain('Cells');

    getGeneration.mockResolvedValue(gen());
    await cmp.tick();
    expect(cmp.intervalMs).toBe(5000);
  });

  it('clears the poll handle on disconnect', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageGeneration;
    expect(cmp.timer).not.toBeNull();

    cmp.disconnectedCallback();

    expect(cmp.timer).toBeNull();
  });

  it('does not re-arm when a poll resolves after disconnect', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageGeneration;
    let resolve: (value: unknown) => void = () => undefined;
    getGeneration.mockReturnValue(new Promise((r) => { resolve = r; }));

    const pending = cmp.tick();
    cmp.disconnectedCallback();
    resolve(gen());
    await pending;

    // The fetch landed on a detached element: nothing may re-arm.
    expect(cmp.timer).toBeNull();
  });

  it('renders not found for a 404 and for a missing id', async () => {
    getGeneration.mockRejectedValue(new ApiError(404, 'Not Found'));
    const foreign = await mount();
    expect(foreign.root.shadowRoot.textContent).toContain('Generation not found');
    expect(foreign.rootInstance.timer).toBeNull();

    getGeneration.mockResolvedValue(gen());
    const missing = await mount('<page-generation></page-generation>');
    expect(missing.root.shadowRoot.textContent).toContain('Generation not found');
    expect(getGeneration).toHaveBeenCalledTimes(1);
  });

  it('shows an empty state for every other role and for a signed-out visitor', async () => {
    for (const role of ['student', 'admin', null]) {
      pending = role === null ? null : { id: 1, role };
      const page = await mount();
      expect(page.root.shadowRoot.textContent).toContain('Only teachers can generate tests.');
      expect(getGeneration).not.toHaveBeenCalled();
    }
  });
});
