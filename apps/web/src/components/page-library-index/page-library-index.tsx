import { Component, h } from '@stencil/core';
import { LIBRARY_SECTIONS } from '../../services/library-sections';
import { navIcon } from '../../services/nav-icons';
import { navigate } from '../../services/navigate';

/** /library: an index of the library's shelves, one card each. */
@Component({ tag: 'page-library-index', styleUrl: 'page-library-index.css', shadow: true })
export class PageLibraryIndex {
  render() {
    return (
      <section>
        <h1>Library</h1>
        <p class="lede">Everything teachers have shared publicly, free to browse.</p>
        <ul class="cards">
          {LIBRARY_SECTIONS.map((s) => (
            <li>
              <a href={s.path} onClick={(e) => { e.preventDefault(); navigate(s.path); }}>
                <span class="icon-wrap">{navIcon(s.icon)}</span>
                <span class="title">{s.title}</span>
                <span class="description">{s.description}</span>
              </a>
            </li>
          ))}
        </ul>
      </section>
    );
  }
}
