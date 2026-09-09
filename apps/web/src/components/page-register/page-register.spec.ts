import { newSpecPage } from '@stencil/core/testing';
import { PageRegister } from './page-register';

describe('page-register', () => {
  it('renders name, email, password fields and both role options', async () => {
    const page = await newSpecPage({ components: [PageRegister], html: '<page-register></page-register>' });
    const root = page.root.shadowRoot;
    expect(root.querySelector('input[type="email"]')).not.toBeNull();
    expect(root.querySelectorAll('input[type="password"]').length).toBe(2);
    expect(root.textContent).toContain('Teacher');
    expect(root.textContent).toContain('Student');
  });
});
