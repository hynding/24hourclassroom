import { newSpecPage } from '@stencil/core/testing';
import { RichText } from './rich-text';

async function mount(text: string, blocks = false) {
  const page = await newSpecPage({ components: [RichText], template: () => <rich-text text={text} blocks={blocks}></rich-text> });
  return page.root.shadowRoot.querySelector('.rich') as HTMLElement;
}
import { h } from '@stencil/core';

describe('rich-text', () => {
  it('renders paragraphs with line breaks and inline marks', async () => {
    const el = await mount('First **bold** and *em* and `code`\nsecond line\n\nNext paragraph');
    const ps = el.querySelectorAll('p');
    expect(ps.length).toBe(2);
    expect(ps[0].querySelector('strong').textContent).toBe('bold');
    expect(ps[0].querySelector('em').textContent).toBe('em');
    expect(ps[0].querySelector('code').textContent).toBe('code');
    expect(ps[0].querySelectorAll('br').length).toBe(1);
    expect(ps[1].textContent).toBe('Next paragraph');
  });

  it('renders a pipe table with a header row', async () => {
    const el = await mount('Data:\n\n| Trial | O₂ (mL) |\n|---|---:|\n| 1 | 4 |\n| 2 | **8** |\n\nAfter');
    const table = el.querySelector('table');
    expect(table.querySelectorAll('th').length).toBe(2);
    expect(table.querySelectorAll('tbody tr').length).toBe(2);
    expect(table.querySelector('tbody td:nth-child(2)').textContent).toBe('4');
    expect(table.querySelector('tbody tr:nth-child(2) strong').textContent).toBe('8');
    expect(el.querySelectorAll('p').length).toBe(2);
  });

  it('never turns author text into markup', async () => {
    const el = await mount('<script>alert(1)</script> <b>x</b> &amp;');
    expect(el.querySelector('script')).toBeNull();
    expect(el.querySelector('b')).toBeNull();
    expect(el.textContent).toBe('<script>alert(1)</script> <b>x</b> &amp;');
  });

  it('leaves a fill-in-the-blank marker and lone asterisks alone', async () => {
    const el = await mount('Water is a ____ molecule; 2 * 3 = 6; _not_ emphasis');
    expect(el.textContent).toBe('Water is a ____ molecule; 2 * 3 = 6; _not_ emphasis');
    expect(el.querySelector('em')).toBeNull();
  });

  it('treats block syntax as plain text unless blocks are on', async () => {
    const off = await mount('# Heading\n- item\n[link](https://example.org)');
    expect(off.querySelector('h2')).toBeNull();
    expect(off.querySelector('ul')).toBeNull();
    expect(off.querySelector('a')).toBeNull();
    expect(off.textContent).toContain('# Heading');
    expect(off.textContent).toContain('link');
  });

  it('renders headings, lists, quotes, fences, rules and safe links in block mode', async () => {
    const el = await mount([
      '# Title', '## Section', '### Sub', '', 'Para', '', '- one', '- two', '', '1. first', '2) second', '',
      '> quoted', '> more', '', '```', 'x = 1', '```', '', '---', '',
      'See [OpenStax](https://openstax.org/x) and [bad](javascript:alert(1)) and ![fig](https://img/x.png).',
    ].join('\n'), true);
    expect(el.querySelector('h2').textContent).toBe('Title');
    expect(el.querySelector('h3').textContent).toBe('Section');
    expect(el.querySelector('h4').textContent).toBe('Sub');
    expect(el.querySelectorAll('ul li').length).toBe(2);
    expect(el.querySelectorAll('ol li').length).toBe(2);
    expect(el.querySelector('blockquote p').textContent).toBe('quotedmore');
    expect(el.querySelector('pre code').textContent).toBe('x = 1');
    expect(el.querySelector('hr')).not.toBeNull();
    const links = el.querySelectorAll('a');
    expect(links.length).toBe(1);
    expect(links[0].getAttribute('href')).toBe('https://openstax.org/x');
    expect(links[0].getAttribute('rel')).toBe('noopener noreferrer');
    expect(el.textContent).toContain('bad');
    expect(el.textContent).toContain('fig');
    expect(el.querySelector('img')).toBeNull();
  });

  it('renders nothing for empty text', async () => {
    const el = await mount('');
    expect(el.children.length).toBe(0);
  });
});
