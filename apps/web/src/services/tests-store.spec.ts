jest.mock('./profile-store', () => ({ apiClient: {} }));

import { TestsStore } from './tests-store';

describe('TestsStore', () => {
  it('forwards every call to the client with the same arguments', async () => {
    const client = {
      getTest: jest.fn().mockResolvedValue({ id: 1 }),
      assignTest: jest.fn().mockResolvedValue({ results: [] }),
      saveAttempt: jest.fn().mockResolvedValue({ id: 2 }),
    };
    const store = new TestsStore(client as never);

    expect(await store.getTest(1)).toEqual({ id: 1 });
    await store.assignTest(1, [2, 3], null);
    await store.saveAttempt(2, { 5: 'x' });

    expect(client.getTest).toHaveBeenCalledWith(1);
    expect(client.assignTest).toHaveBeenCalledWith(1, [2, 3], null);
    expect(client.saveAttempt).toHaveBeenCalledWith(2, { 5: 'x' });
  });
});
