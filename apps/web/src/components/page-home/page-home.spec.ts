import { newSpecPage } from '@stencil/core/testing';
import { PageHome } from './page-home';

describe('page-home', () => {
  it('renders the landing headline', async () => {
    const page = await newSpecPage({
      components: [PageHome],
      html: '<page-home></page-home>',
    });
    expect(page.root.shadowRoot.textContent).toContain('24 Hour Classroom');
  });
});
