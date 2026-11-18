import { newSpecPage } from '@stencil/core/testing';
import { AppLayout } from './app-layout';

const mount = (attrs = '') =>
  newSpecPage({
    components: [AppLayout],
    html: `<app-layout ${attrs}><b slot="header">H</b><p>body</p><i slot="footer">F</i></app-layout>`,
  });

const assigned = (spec: any, selector: string) =>
  (spec.root.shadowRoot.querySelector(selector) as HTMLSlotElement).assignedElements().map((e) => e.tagName);

describe('app-layout', () => {
  it('reflects the default layout as an attribute (CSS keys on it)', async () => {
    const spec = await mount();
    expect(spec.root.getAttribute('layout')).toBe('stacked');
  });

  it('reflects a changed layout', async () => {
    const spec = await mount();
    spec.root.layout = 'rail';
    await spec.waitForChanges();
    expect(spec.root.getAttribute('layout')).toBe('rail');
    expect(spec.root.getAttribute('layout')).not.toBe('stacked');
  });

  // reflect: true is load-bearing -- app-layout.css keys on :host([bare]).
  it('reflects the bare prop as an attribute', async () => {
    const spec = await mount('bare');
    expect(spec.root.hasAttribute('bare')).toBe(true);

    spec.root.bare = false;
    await spec.waitForChanges();
    expect(spec.root.hasAttribute('bare')).toBe(false);

    spec.root.bare = true;
    await spec.waitForChanges();
    expect(spec.root.hasAttribute('bare')).toBe(true);
  });

  it('projects header, page and footer into their slots', async () => {
    const spec = await mount();
    expect(assigned(spec, 'slot[name="header"]')).toEqual(['B']);
    expect(assigned(spec, 'main > slot:not([name])')).toEqual(['P']);
    expect(assigned(spec, 'slot[name="footer"]')).toEqual(['I']);
  });

  it('wraps the page in a <main> landmark', async () => {
    const spec = await mount();
    // app-root used to own <main>; it moves here so both layouts keep it.
    expect(spec.root.shadowRoot.querySelector('main > slot:not([name])')).not.toBeNull();
  });
});

describe('app-layout slots', () => {
  it('has the banner slot first among the shell\'s slots (after the skip link), and assigns a slot="banner" child to it', async () => {
    const page = await newSpecPage({
      components: [AppLayout],
      html: '<app-layout><div slot="banner" id="b"></div><div slot="header" id="h"></div><p id="p"></p></app-layout>',
    });
    const shell = page.root.shadowRoot.querySelector('.shell')!;
    const first = shell.querySelector('slot') as HTMLSlotElement;
    expect(first.previousElementSibling.classList.contains('skip')).toBe(true);
    expect(first.getAttribute('name')).toBe('banner');
    expect(first.assignedElements().map((el) => el.id)).toEqual(['b']);
  });

  it('opens with a skip link that hands focus to the page content', async () => {
    const spec = await mount('layout="rail"');
    const root = spec.root.shadowRoot;
    const skip = root.querySelector('a.skip') as HTMLAnchorElement;
    const main = root.querySelector('main') as HTMLElement;

    expect(root.querySelector('.shell').firstElementChild).toBe(skip);
    expect(skip.textContent).toBe('Skip to content');
    expect(main.getAttribute('tabindex')).toBe('-1');
    main.focus = jest.fn();
    skip.click();
    expect(main.focus).toHaveBeenCalled();
  });

  it('focuses the page content on request, without scrolling', async () => {
    const spec = await mount();
    const main = spec.root.shadowRoot.querySelector('main') as HTMLElement;
    main.focus = jest.fn();
    await spec.root.focusMain();
    expect(main.focus).toHaveBeenCalledWith({ preventScroll: true });
  });
});
