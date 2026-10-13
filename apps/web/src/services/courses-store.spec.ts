jest.mock('./profile-store', () => ({ apiClient: {} }));

import { CoursesStore } from './courses-store';

describe('CoursesStore', () => {
  it('forwards every call to the client with the same arguments', async () => {
    const client = {
      getCourse: jest.fn().mockResolvedValue({ id: 1 }),
      updateCourse: jest.fn().mockResolvedValue({ id: 1 }),
      getPracticeTest: jest.fn().mockResolvedValue({ id: 9 }),
      checkPractice: jest.fn().mockResolvedValue({ score: 1 }),
    };
    const store = new CoursesStore(client as never);
    const body = { title: 'Bio', subject: 'science' as const, grade_level: '9-12' as const, items: [] };

    expect(await store.getCourse(1)).toEqual({ id: 1 });
    await store.updateCourse(1, body);
    await store.getPracticeTest(1, 9);
    await store.checkPractice(1, 9, { 5: 'x' });

    expect(client.getCourse).toHaveBeenCalledWith(1);
    expect(client.updateCourse).toHaveBeenCalledWith(1, body);
    expect(client.getPracticeTest).toHaveBeenCalledWith(1, 9);
    expect(client.checkPractice).toHaveBeenCalledWith(1, 9, { 5: 'x' });
  });
});
