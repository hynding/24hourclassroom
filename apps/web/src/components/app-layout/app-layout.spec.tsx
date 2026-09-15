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
