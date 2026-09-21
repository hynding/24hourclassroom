import type { ApiClient } from '@24hc/api-client';
import type { LibraryFilters, MaterialUpdate, MaterialUpload } from '@24hc/shared';
import { apiClient } from './profile-store';

/**
 * Thin, stateless pass-through so pages mock ONE module (the same reason
 * tests-store.ts exists). Nothing is cached: a material's download_url is a
 * 15-minute signed link and its visibility can change under the viewer, so
 * every page re-fetches on load.
 */
export class MaterialsStore {
  constructor(private readonly client: ApiClient) {}

  listMaterials(page?: number) { return this.client.listMaterials(page); }
  sharedMaterials(page?: number) { return this.client.sharedMaterials(page); }
  materialsLibrary(filters: LibraryFilters = {}) { return this.client.materialsLibrary(filters); }
  uploadMaterial(input: MaterialUpload) { return this.client.uploadMaterial(input); }
  getMaterial(id: number) { return this.client.getMaterial(id); }
  updateMaterial(id: number, data: MaterialUpdate) { return this.client.updateMaterial(id, data); }
  deleteMaterial(id: number) { return this.client.deleteMaterial(id); }
  publishMaterial(id: number) { return this.client.publishMaterial(id); }
  unpublishMaterial(id: number) { return this.client.unpublishMaterial(id); }
  listMaterialShares(id: number) { return this.client.listMaterialShares(id); }
  /** Takes USER ids. */
  shareMaterial(id: number, userIds: number[]) { return this.client.shareMaterial(id, userIds); }
  /** Takes the SHARE id. */
  unshareMaterial(id: number, shareId: number) { return this.client.unshareMaterial(id, shareId); }
}

export const materialsStore = new MaterialsStore(apiClient);
