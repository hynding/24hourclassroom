import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';
import { GENERATION_MAX_QUESTIONS, GENERATION_MIN_QUESTIONS } from '@24hc/shared';

const listMaterials = jest.fn();
const sharedMaterials = jest.fn();
const getGeneration = jest.fn();
const createGeneration = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/materials-store', () => ({
  materialsStore: {
    listMaterials: (...a: unknown[]) => listMaterials(...a),
    sharedMaterials: (...a: unknown[]) => sharedMaterials(...a),
  },
}));
jest.mock('../../services/generation-store', () => ({
  generationStore: {
    getGeneration: (...a: unknown[]) => getGeneration(...a),
    createGeneration: (...a: unknown[]) => createGeneration(...a),
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

import { PageTestGenerate } from './page-test-generate';

const material = (id: number) => ({
  id, title: `Material ${id}`, subject: 'science', grade_level: '6-8', visibility: 'private',
  published_at: null, original_name: `m${id}.pdf`, mime_type: 'application/pdf', size_bytes: 1024,
  author: { id: 1, name: 'Me' },
});

const materialPage = (count: number) => ({
  data: Array.from({ length: count }, (_, i) => material(i + 1)),
  meta: { current_page: 1, last_page: 1, per_page: 15, total: count },
});

// mock-doc backs `min`/`max` with attributes, but read whichever landed
// rather than pinning the mechanism (the app-root spec's propOf rationale).
const attrOf = (el: Element | null, name: string) => {
  const value = (el as any)?.[name] ?? el?.getAttribute(name);
  return value == null ? null : String(value);
};

const mount = async (url = 'http://testing.stenciljs.com/tests/generate') => {
  const page = await newSpecPage({ components: [PageTestGenerate], html: '<page-test-generate></page-test-generate>', url });
  await page.waitForChanges();
  return page;
};

describe('page-test-generate', () => {
  beforeEach(() => {
    listMaterials.mockReset().mockResolvedValue(materialPage(2));
    sharedMaterials.mockReset();
    getGeneration.mockReset();
    createGeneration.mockReset();
    navigate.mockReset();
    authLoad.mockClear();
    currentUser = null;
    pending = { id: 1, role: 'teacher' };
  });

  it('renders the form for a teacher with the bounds from the shared literals', async () => {
    const page = await mount();
    const cmp = page.rootInstance as PageTestGenerate;
    const count = page.root.shadowRoot.querySelector('input[type="number"]');

    expect(page.root.shadowRoot.textContent).toContain('Generate a test');
    expect(attrOf(count, 'min')).toBe(String(GENERATION_MIN_QUESTIONS));
    expect(attrOf(count, 'max')).toBe(String(GENERATION_MAX_QUESTIONS));
    expect(cmp.questionCount).toBe(10);
    expect(authLoad).toHaveBeenCalled();
  });

  it('shows an empty state for every other role and for a signed-out visitor', async () => {
    // Allowlist: a fourth role must be invalid by default, and the server
    // answers a non-teacher with 403 anyway.
    for (const role of ['student', 'admin', null]) {
      pending = role === null ? null : { id: 1, role };
      const page = await mount();
      expect(page.root.shadowRoot.textContent).toContain('Only teachers can generate tests.');
      expect(listMaterials).not.toHaveBeenCalled();
    }
  });

  it('lists the teacher own materials only, first page', async () => {
    const page = await mount();

    expect(listMaterials).toHaveBeenCalledWith();
    // Shared-with-me materials belong to another teacher and are never
    // uploaded into this teacher's Anthropic organisation.
    expect(sharedMaterials).not.toHaveBeenCalled();
    expect(page.root.shadowRoot.textContent).toContain('Material 1');
    expect(page.root.shadowRoot.textContent).toContain('Material 2');
    expect(page.root.shadowRoot.textContent).toContain('0 of 5 selected');
  });

  it('caps the checklist at five and disables the unchecked rest', async () => {
    listMaterials.mockResolvedValue(materialPage(6));
    const page = await mount();
    const cmp = page.rootInstance as PageTestGenerate;

    for (const id of [1, 2, 3, 4, 5]) {
      cmp.toggleMaterial(id);
    }
    await page.waitForChanges();
    const boxes = Array.from(page.root.shadowRoot.querySelectorAll('input[type="checkbox"]'));

    expect(page.root.shadowRoot.textContent).toContain('5 of 5 selected');
    // The five that are checked stay clickable so the teacher can swap one out.
    expect(boxes[0].hasAttribute('disabled')).toBe(false);
    expect(boxes[5].hasAttribute('disabled')).toBe(true);
  });

  it('enforces the material cap in the toggle handler itself, not just the disabled attribute', async () => {
    listMaterials.mockResolvedValue(materialPage(6));
    const page = await mount();
    const cmp = page.rootInstance as PageTestGenerate;

    for (const id of [1, 2, 3, 4, 5]) {
      cmp.toggleMaterial(id);
    }
    cmp.toggleMaterial(6);
    await page.waitForChanges();

    expect(cmp.selected.length).toBe(5);
    expect(cmp.selected).not.toContain(6);

    cmp.toggleMaterial(1);
    cmp.toggleMaterial(6);
    await page.waitForChanges();

    expect(cmp.selected).toContain(6);
    expect(cmp.selected).not.toContain(1);
  });

  it('submits the exact input and navigates to the new generation', async () => {
    createGeneration.mockResolvedValue({ id: 12 });
    const page = await mount();
    const cmp = page.rootInstance as PageTestGenerate;
    cmp.title = 'Cells';
    cmp.subject = 'science';
    cmp.grade = '6-8';
    cmp.instructions = 'Focus on organelles.';
    cmp.questionCount = 12;
    cmp.toggleMaterial(1);

    await cmp.generate();

    expect(createGeneration).toHaveBeenCalledWith({
      title: 'Cells',
      subject: 'science',
      grade_level: '6-8',
      instructions: 'Focus on organelles.',
      question_count: 12,
      material_ids: [1],
    });
    expect(navigate).toHaveBeenCalledWith('/generations/12');
  });

  it('prefills from ?from= through getGeneration', async () => {
    getGeneration.mockResolvedValue({
      id: 9, title: 'Cells', subject: 'science', grade_level: '6-8',
      instructions: 'Focus on organelles.', question_count: 15, material_ids: [1, 2],
      status: 'failed', agent_note: null, error: 'It broke.', list_cost_cents: 40,
      test_id: null, started_at: null, finished_at: null, created_at: '2026-09-21T00:00:00Z',
    });
    const page = await mount('http://testing.stenciljs.com/tests/generate?from=9');
    const cmp = page.rootInstance as PageTestGenerate;

    expect(getGeneration).toHaveBeenCalledWith(9);
    expect(cmp.title).toBe('Cells');
    expect(cmp.subject).toBe('science');
    expect(cmp.grade).toBe('6-8');
    expect(cmp.instructions).toBe('Focus on organelles.');
    expect(cmp.questionCount).toBe(15);
    expect(cmp.selected).toEqual([1, 2]);
    // Both prefilled ids are in the first page of the checklist: no notice.
    expect(page.root.shadowRoot.textContent).not.toContain('not shown in this list.');
  });

  it('keeps a prefilled material that is not in the checklist and offers to deselect it', async () => {
    listMaterials.mockResolvedValue({
      data: [material(7)],
      meta: { current_page: 1, last_page: 1, per_page: 15, total: 1 },
    });
    getGeneration.mockResolvedValue({
      id: 9, title: 'Cells', subject: 'science', grade_level: '6-8',
      instructions: 'Focus on organelles.', question_count: 15, material_ids: [7, 99],
      status: 'failed', agent_note: null, error: 'It broke.', list_cost_cents: 40,
      test_id: null, started_at: null, finished_at: null, created_at: '2026-09-21T00:00:00Z',
    });
    const page = await mount('http://testing.stenciljs.com/tests/generate?from=9');
    const cmp = page.rootInstance as PageTestGenerate;
    const root = page.root.shadowRoot;

    // The id beyond the first page is kept, not silently dropped: it is
    // still a valid material the teacher asked for.
    expect(cmp.selected).toEqual([7, 99]);
    expect(root.textContent).toContain('1 selected material is not shown in this list.');
    expect(root.textContent).toContain('2 of 5 selected');

    const button = Array.from(root.querySelectorAll('button')).find((b) => b.textContent === 'Deselect it');
    expect(button).not.toBeUndefined();
    (button as HTMLButtonElement).click();
    await page.waitForChanges();

    expect(cmp.selected).toEqual([7]);
    expect(root.textContent).not.toContain('not shown in this list.');
  });

  it('renders a missing-key 422 as a link to the integrations page', async () => {
    createGeneration.mockRejectedValue(new ApiError(422, 'The given data was invalid.', {
      api_key: ['Add your Anthropic API key on the Integrations page first.'],
    }));
    const page = await mount();
    const cmp = page.rootInstance as PageTestGenerate;

    await cmp.generate();
    await page.waitForChanges();
    const root = page.root.shadowRoot;

    expect(root.textContent).toContain('Add your Anthropic API key on the Integrations page first.');
    const link = root.querySelector('a[href="/integrations"]');
    expect(link).not.toBeNull();
    expect(link.textContent).toBe('Add your Anthropic API key');
  });

  it('renders an ordinary 422 under its own field', async () => {
    createGeneration.mockRejectedValue(new ApiError(422, 'The given data was invalid.', {
      question_count: ['The question count must not be greater than 30.'],
    }));
    const page = await mount();
    const cmp = page.rootInstance as PageTestGenerate;

    await cmp.generate();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('The question count must not be greater than 30.');
    expect(page.root.shadowRoot.querySelector('a[href="/integrations"]')).toBeNull();
  });

  it('names a 404 on a material and a 403 by role', async () => {
    // 404, not 422 or 403, is what the server answers for a material id that
    // is not the teacher's own -- a distinguishable status would let a caller
    // walk the id space.
    createGeneration.mockRejectedValue(new ApiError(404, 'Not Found'));
    const missing = await mount();
    await (missing.rootInstance as PageTestGenerate).generate();
    await missing.waitForChanges();
    expect(missing.root.shadowRoot.textContent).toContain('One of the selected materials is not available.');

    createGeneration.mockRejectedValue(new ApiError(403, 'Forbidden'));
    const forbidden = await mount();
    await (forbidden.rootInstance as PageTestGenerate).generate();
    await forbidden.waitForChanges();
    expect(forbidden.root.shadowRoot.textContent).toContain('Only teachers can generate tests.');
  });
});
