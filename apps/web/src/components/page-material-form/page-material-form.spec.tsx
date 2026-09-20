import { newSpecPage } from '@stencil/core/testing';
import { ApiError } from '@24hc/api-client';
import { MAX_MATERIAL_BYTES } from '@24hc/shared';

const getMaterial = jest.fn();
const uploadMaterial = jest.fn();
const updateMaterial = jest.fn();
const navigate = jest.fn();
jest.mock('../../services/materials-store', () => ({
  materialsStore: {
    getMaterial: (...a: unknown[]) => getMaterial(...a),
    uploadMaterial: (...a: unknown[]) => uploadMaterial(...a),
    updateMaterial: (...a: unknown[]) => updateMaterial(...a),
  },
}));
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));
jest.mock('../../services/session-recovery', () => ({ recoverFromExpiredSession: () => false }));

import { PageMaterialForm } from './page-material-form';

const view = (extra: Record<string, unknown> = {}) => ({
  id: 7, title: 'Cell diagram', description: 'Week 1', subject: 'science', grade_level: '6-8',
  visibility: 'private', published_at: null, original_name: 'cells.pdf', mime_type: 'application/pdf',
  size_bytes: 1536, author: { id: 1, name: 'Me' }, created_at: '', updated_at: '',
  is_author: true, shared_with_me: false, download_url: 'https://api.test/api/materials/7/file?signature=x', ...extra,
});

// mock-doc has no settable input.files, so the change handler is called
// directly with the shape a real change event carries.
const pick = (bytes: number, name = 'cells.pdf') => {
  const file = new File(['x'], name, { type: 'application/pdf' });
  // A File's size is read-only and derived from its parts; define it so the
  // pre-flight check can be exercised without allocating 10 MB.
  Object.defineProperty(file, 'size', { value: bytes });
  return { file, event: { target: { files: [file] } } as unknown as Event };
};

const mountNew = () => newSpecPage({ components: [PageMaterialForm], html: '<page-material-form></page-material-form>' });
const mountEdit = () => newSpecPage({ components: [PageMaterialForm], html: '<page-material-form material-id="7"></page-material-form>' });

describe('page-material-form', () => {
  beforeEach(() => {
    getMaterial.mockReset().mockResolvedValue(view());
    uploadMaterial.mockReset().mockResolvedValue(view({ id: 12 }));
    updateMaterial.mockReset().mockResolvedValue(view());
    navigate.mockReset();
  });

  it('offers a file input when creating and none when editing', async () => {
    const create = await mountNew();
    await create.waitForChanges();
    expect(create.root.shadowRoot.querySelector('input[type="file"]')).not.toBeNull();
    expect(create.root.shadowRoot.textContent).toContain('Upload a material');
    expect(getMaterial).not.toHaveBeenCalled();

    const edit = await mountEdit();
    await edit.waitForChanges();
    // The file is never replaceable: to change it, delete and upload again.
    expect(edit.root.shadowRoot.querySelector('input[type="file"]')).toBeNull();
    expect(edit.root.shadowRoot.textContent).toContain('Edit material');
  });

  it('prefills the metadata when editing', async () => {
    const page = await mountEdit();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;

    expect(getMaterial).toHaveBeenCalledWith(7);
    expect(cmp.title).toBe('Cell diagram');
    expect(cmp.description).toBe('Week 1');
    expect(cmp.subject).toBe('science');
    expect(cmp.grade).toBe('6-8');
  });

  it('uploads the chosen file with the metadata and goes to the new material', async () => {
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    const { file, event } = pick(2048);

    page.rootInstance.onFile(event);
    cmp.title = 'Cell diagram';
    cmp.subject = 'science';
    cmp.grade = '6-8';
    await cmp.save();

    expect(uploadMaterial).toHaveBeenCalledWith({ file, title: 'Cell diagram', subject: 'science', grade_level: '6-8' });
    expect(navigate).toHaveBeenCalledWith('/materials/12');
  });

  it('omits an empty title so the server can default it to the filename stem', async () => {
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    const { file, event } = pick(2048);

    page.rootInstance.onFile(event);
    cmp.subject = 'science';
    cmp.grade = '6-8';
    await cmp.save();

    expect(uploadMaterial).toHaveBeenCalledWith({ file, subject: 'science', grade_level: '6-8' });
  });

  it('rejects an oversized file before making any request', async () => {
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    const { event } = pick(MAX_MATERIAL_BYTES + 1);

    page.rootInstance.onFile(event);
    cmp.subject = 'science';
    cmp.grade = '6-8';
    await cmp.save();
    await page.waitForChanges();

    expect(uploadMaterial).not.toHaveBeenCalled();
    expect(page.root.shadowRoot.textContent).toContain('Choose a file under 10 MB.');
  });

  it('accepts a file exactly at the cap', async () => {
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    const { event } = pick(MAX_MATERIAL_BYTES);

    page.rootInstance.onFile(event);
    cmp.subject = 'science';
    cmp.grade = '6-8';
    await cmp.save();

    expect(uploadMaterial).toHaveBeenCalled();
  });

  it('asks for a file when none was chosen, without calling the API', async () => {
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    cmp.subject = 'science';
    cmp.grade = '6-8';

    await cmp.save();
    await page.waitForChanges();

    expect(uploadMaterial).not.toHaveBeenCalled();
    expect(page.root.shadowRoot.textContent).toContain('Choose a file under 10 MB.');
  });

  it('renders the server field error from a 422 under the file input', async () => {
    uploadMaterial.mockRejectedValue(new ApiError(422, 'The given data was invalid.', { file: ['You have reached the limit of 100 materials.'] }));
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    const { event } = pick(2048);

    page.rootInstance.onFile(event);
    cmp.subject = 'science';
    cmp.grade = '6-8';
    await cmp.save();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('You have reached the limit of 100 materials.');
  });

  it('keeps a pending title error when a new file is chosen to clear the file error', async () => {
    uploadMaterial.mockRejectedValue(new ApiError(422, 'The given data was invalid.', { title: ['Required'], file: ['Too big'] }));
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    const big = pick(2048);

    page.rootInstance.onFile(big.event);
    cmp.subject = 'science';
    cmp.grade = '6-8';
    await cmp.save();
    await page.waitForChanges();
    expect(page.root.shadowRoot.textContent).toContain('Required');
    expect(page.root.shadowRoot.textContent).toContain('Too big');

    const small = pick(1024, 'smaller.pdf');
    page.rootInstance.onFile(small.event);
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Required');
    expect(text).not.toContain('Too big');
  });

  it('maps a 413 to the cap copy rather than the generic message', async () => {
    // A body over post_max_size is rejected before validation, so the error
    // carries no `errors` and only a generic message -- the 413 branch has
    // to come BEFORE any e.message fallback.
    uploadMaterial.mockRejectedValue(new ApiError(413, 'POST /api/materials failed with status 413'));
    const page = await mountNew();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    const { event } = pick(2048);

    page.rootInstance.onFile(event);
    cmp.subject = 'science';
    cmp.grade = '6-8';
    await cmp.save();
    await page.waitForChanges();
    const text = page.root.shadowRoot.textContent;

    expect(text).toContain('Choose a file under 10 MB.');
    expect(text).not.toContain('failed with status 413');
  });

  it('updates metadata only and returns to the material', async () => {
    const page = await mountEdit();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    cmp.title = 'Renamed';

    await cmp.save();

    expect(updateMaterial).toHaveBeenCalledWith(7, { title: 'Renamed', description: 'Week 1', subject: 'science', grade_level: '6-8' });
    expect(uploadMaterial).not.toHaveBeenCalled();
    expect(navigate).toHaveBeenCalledWith('/materials/7');
  });

  it('sends an emptied description as null rather than an empty string', async () => {
    const page = await mountEdit();
    await page.waitForChanges();
    const cmp = page.rootInstance as PageMaterialForm;
    cmp.description = '';

    await cmp.save();

    expect(updateMaterial).toHaveBeenCalledWith(7, { title: 'Cell diagram', description: null, subject: 'science', grade_level: '6-8' });
  });

  it('bounces a non-author without ever painting the form', async () => {
    // C1's test editor flashes its form for a frame because its `finally`
    // clears `loading` regardless; the `bounced` flag is what avoids that.
    getMaterial.mockResolvedValue(view({ is_author: false }));

    const page = await mountEdit();
    await page.waitForChanges();

    expect(navigate).toHaveBeenCalledWith('/materials/7');
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
    expect(page.root.shadowRoot.textContent).toBe('');
  });

  it('renders not found on a 404', async () => {
    getMaterial.mockRejectedValue(new ApiError(404, 'nope'));

    const page = await mountEdit();
    await page.waitForChanges();

    expect(page.root.shadowRoot.textContent).toContain('Material not found');
    expect(page.root.shadowRoot.querySelector('form')).toBeNull();
  });

  it('links Cancel back to the material being edited', async () => {
    const page = await mountEdit();
    await page.waitForChanges();

    expect(page.root.shadowRoot.querySelector('a[href="/materials/7"]')).not.toBeNull();
  });
});
