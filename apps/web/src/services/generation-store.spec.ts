jest.mock('./profile-store', () => ({ apiClient: {} }));

import { GenerationStore } from './generation-store';

describe('GenerationStore', () => {
  it('forwards every call to the client with the same arguments', async () => {
    const client = {
      getIntegrations: jest.fn().mockResolvedValue({ mcp_tokens: [], anthropic: { configured: false, hint: null, verified_at: null } }),
      createMcpToken: jest.fn().mockResolvedValue({ id: 1, name: 'Laptop', token: '1|x' }),
      revokeMcpToken: jest.fn().mockResolvedValue(undefined),
      setAnthropicKey: jest.fn().mockResolvedValue({ configured: true, hint: '6789', verified_at: null }),
      removeAnthropicKey: jest.fn().mockResolvedValue(undefined),
      listGenerations: jest.fn().mockResolvedValue({ data: [], meta: {} }),
      createGeneration: jest.fn().mockResolvedValue({ id: 7 }),
      getGeneration: jest.fn().mockResolvedValue({ id: 7 }),
      cancelGeneration: jest.fn().mockResolvedValue({ id: 7, status: 'cancelled' }),
    };
    const store = new GenerationStore(client as never);
    const input = { title: 'Cells', subject: 'science' as const, grade_level: '6-8' as const, question_count: 10, material_ids: [3] };

    expect(await store.getIntegrations()).toEqual({ mcp_tokens: [], anthropic: { configured: false, hint: null, verified_at: null } });
    expect(await store.createMcpToken('Laptop')).toEqual({ id: 1, name: 'Laptop', token: '1|x' });
    await store.revokeMcpToken(9);
    expect(await store.setAnthropicKey('sk-ant-0123456789abcdef')).toEqual({ configured: true, hint: '6789', verified_at: null });
    await store.removeAnthropicKey();
    await store.listGenerations(2);
    expect(await store.createGeneration(input)).toEqual({ id: 7 });
    expect(await store.getGeneration(7)).toEqual({ id: 7 });
    expect(await store.cancelGeneration(7)).toEqual({ id: 7, status: 'cancelled' });

    expect(client.createMcpToken).toHaveBeenCalledWith('Laptop');
    expect(client.revokeMcpToken).toHaveBeenCalledWith(9);
    expect(client.setAnthropicKey).toHaveBeenCalledWith('sk-ant-0123456789abcdef');
    expect(client.removeAnthropicKey).toHaveBeenCalledWith();
    expect(client.listGenerations).toHaveBeenCalledWith(2);
    expect(client.createGeneration).toHaveBeenCalledWith(input);
    expect(client.getGeneration).toHaveBeenCalledWith(7);
    expect(client.cancelGeneration).toHaveBeenCalledWith(7);
  });
});
