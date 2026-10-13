import { newSpecPage } from '@stencil/core/testing';

const navigate = jest.fn();
jest.mock('../../services/navigate', () => ({ navigate: (...a: unknown[]) => navigate(...a) }));

import { PageLibraryIndex } from './page-library-index';

describe('page-library-index', () => {
  beforeEach(() => navigate.mockReset());

  it('renders one card per shelf with a title, a description and an icon', async () => {
    const page = await newSpecPage({ components: [PageLibraryIndex], html: '<page-library-index></page-library-index>' });
    const cards = Array.from(page.root.shadowRoot.querySelectorAll('.cards a'));
    expect(cards.map((a) => a.getAttribute('href'))).toEqual(['/library/tests', '/library/materials', '/library/courses']);
    expect(cards.map((a) => a.querySelector('.title').textContent)).toEqual(['Tests', 'Materials', 'Courses']);
    for (const card of cards) {
      expect(card.querySelector('.description').textContent.length).toBeGreaterThan(0);
      expect(card.querySelector('svg.icon')).not.toBeNull();
    }
  });

  it('navigates in-app when a card is clicked', async () => {
    const page = await newSpecPage({ components: [PageLibraryIndex], html: '<page-library-index></page-library-index>' });
    (page.root.shadowRoot.querySelector('a[href="/library/courses"]') as HTMLAnchorElement).click();
    expect(navigate).toHaveBeenCalledWith('/library/courses');
  });
});
