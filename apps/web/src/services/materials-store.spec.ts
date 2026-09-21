jest.mock('./profile-store', () => ({ apiClient: {} }));

import { MaterialsStore } from './materials-store';

describe('MaterialsStore', () => {
  it('forwards every call to the client with the same arguments', async () => {
    const client = {
      listMaterials: jest.fn().mockResolvedValue({ data: [], meta: {} }),
      sharedMaterials: jest.fn().mockResolvedValue({ data: [], meta: {} }),
      materialsLibrary: jest.fn().mockResolvedValue({ data: [], meta: {} }),
      uploadMaterial: jest.fn().mockResolvedValue({ id: 1 }),
      getMaterial: jest.fn().mockResolvedValue({ id: 1 }),
      updateMaterial: jest.fn().mockResolvedValue({ id: 1 }),
      deleteMaterial: jest.fn().mockResolvedValue(undefined),
      publishMaterial: jest.fn().mockResolvedValue({ id: 1 }),
      unpublishMaterial: jest.fn().mockResolvedValue({ id: 1 }),
      listMaterialShares: jest.fn().mockResolvedValue({ data: [] }),
      shareMaterial: jest.fn().mockResolvedValue({ results: [] }),
      unshareMaterial: jest.fn().mockResolvedValue(undefined),
    };
    const store = new MaterialsStore(client as never);
    const file = new File(['x'], 'w.pdf', { type: 'application/pdf' });

    await store.listMaterials(2);
    await store.sharedMaterials();
    await store.materialsLibrary({ subject: 'math' });
    await store.uploadMaterial({ file, subject: 'math', grade_level: 'k-2' });
    expect(await store.getMaterial(1)).toEqual({ id: 1 });
    await store.updateMaterial(1, { title: 'T', description: null, subject: 'math', grade_level: 'k-2' });
    await store.deleteMaterial(1);
    await store.publishMaterial(1);
    await store.unpublishMaterial(1);
    await store.listMaterialShares(1);
    await store.shareMaterial(1, [2, 3]);
    await store.unshareMaterial(1, 9);

    expect(client.listMaterials).toHaveBeenCalledWith(2);
    expect(client.sharedMaterials).toHaveBeenCalledWith(undefined);
    expect(client.materialsLibrary).toHaveBeenCalledWith({ subject: 'math' });
    expect(client.uploadMaterial).toHaveBeenCalledWith({ file, subject: 'math', grade_level: 'k-2' });
    expect(client.updateMaterial).toHaveBeenCalledWith(1, { title: 'T', description: null, subject: 'math', grade_level: 'k-2' });
    expect(client.deleteMaterial).toHaveBeenCalledWith(1);
    expect(client.publishMaterial).toHaveBeenCalledWith(1);
    expect(client.unpublishMaterial).toHaveBeenCalledWith(1);
    expect(client.listMaterialShares).toHaveBeenCalledWith(1);
    // The share call takes USER ids; unshare takes the SHARE id.
    expect(client.shareMaterial).toHaveBeenCalledWith(1, [2, 3]);
    expect(client.unshareMaterial).toHaveBeenCalledWith(1, 9);
  });

  it('defaults the library filters to an empty object', async () => {
    const client = { materialsLibrary: jest.fn().mockResolvedValue({ data: [], meta: {} }) };
    const store = new MaterialsStore(client as never);

    await store.materialsLibrary();

    expect(client.materialsLibrary).toHaveBeenCalledWith({});
  });
});
