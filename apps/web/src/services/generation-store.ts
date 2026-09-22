import type { ApiClient } from '@24hc/api-client';
import type { GenerationInput } from '@24hc/shared';
import { apiClient } from './profile-store';

/**
 * Thin, stateless pass-through so pages mock ONE module -- the same reason
 * tests-store.ts and materials-store.ts exist. Nothing is cached, and
 * deliberately: a generation's status changes under the viewer on every poll,
 * and the one-time MCP token must not be held anywhere it could be re-read.
 */
export class GenerationStore {
  constructor(private readonly client: ApiClient) {}

  getIntegrations() { return this.client.getIntegrations(); }
  createMcpToken(name: string) { return this.client.createMcpToken(name); }
  revokeMcpToken(id: number) { return this.client.revokeMcpToken(id); }
  setAnthropicKey(apiKey: string) { return this.client.setAnthropicKey(apiKey); }
  removeAnthropicKey() { return this.client.removeAnthropicKey(); }
  listGenerations(page?: number) { return this.client.listGenerations(page); }
  createGeneration(data: GenerationInput) { return this.client.createGeneration(data); }
  getGeneration(id: number) { return this.client.getGeneration(id); }
  cancelGeneration(id: number) { return this.client.cancelGeneration(id); }
}

export const generationStore = new GenerationStore(apiClient);
