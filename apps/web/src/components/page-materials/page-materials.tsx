import { Component, h, State } from '@stencil/core';
import { GRADE_LEVELS, MaterialSummary, SUBJECTS, SharedMaterial } from '@24hc/shared';
import { authStore } from '../../services/auth-store';
import { materialsStore } from '../../services/materials-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { fileTypeLabel, formatBytes } from '../../services/format';

@Component({ tag: 'page-materials', styleUrl: 'page-materials.css', shadow: true })
export class PageMaterials {
  @State() materials: MaterialSummary[] = [];
  @State() shared: SharedMaterial[] = [];
  @State() loaded = false;
  @State() error = false;
  @State() page = 1;
  @State() lastPage = 1;
  @State() sharedPage = 1;
  @State() sharedLastPage = 1;

  /** Allowlist: anything that is not exactly teacher or student gets the empty state. */
  private get role(): 'teacher' | 'student' | 'none' {
    const role = authStore.currentUser?.role;
    return role === 'teacher' || role === 'student' ? role : 'none';
  }

  async componentWillLoad() {
    // app-root renders the routed page before authStore.load() resolves, and
    // `role` is a plain getter, so reading it first would latch the
    // signed-out empty state on every hard load of /materials and never
    // recover. This is the only new materials page that needs the await --
    // the other three branch on payload fields instead.
    await authStore.load();
    await this.run(async () => {
      if (this.role === 'teacher') {
        await Promise.all([this.loadOwn(), this.loadShared()]);
      } else if (this.role === 'student') {
        await this.loadShared();
      }
      this.loaded = true;
    });
  }

  private async run(action: () => Promise<void>) {
    this.error = false;
    try {
      await action();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = true;
      }
    }
  }

  private async loadOwn() {
    const result = await materialsStore.listMaterials(this.page > 1 ? this.page : undefined);
    this.materials = result.data;
    this.lastPage = result.meta.last_page;
  }

  private async loadShared() {
    const result = await materialsStore.sharedMaterials(this.sharedPage > 1 ? this.sharedPage : undefined);
    this.shared = result.data;
    this.sharedLastPage = result.meta.last_page;
  }

  /** Public so the spec can drive the pager without clicking through render. */
  async goOwn(delta: -1 | 1) {
    const next = this.page + delta;
    if (next < 1 || next > this.lastPage) {
      return;
    }
    this.page = next;
    await this.run(() => this.loadOwn());
  }

  async goShared(delta: -1 | 1) {
    const next = this.sharedPage + delta;
    if (next < 1 || next > this.sharedLastPage) {
      return;
    }
    this.sharedPage = next;
    await this.run(() => this.loadShared());
  }

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  private facts(m: MaterialSummary): string {
    return `${this.label(SUBJECTS, m.subject)} · ${this.label(GRADE_LEVELS, m.grade_level)} · ${fileTypeLabel(m.original_name)} · ${formatBytes(m.size_bytes)}`;
  }

  private pager(label: string, page: number, lastPage: number, go: (delta: -1 | 1) => void) {
    if (lastPage <= 1) {
      return null;
    }
    return (
      <nav aria-label={label}>
        <button type="button" class="btn" disabled={page <= 1} onClick={() => go(-1)}>Previous</button>
        <span>Page {page} of {lastPage}</span>
        <button type="button" class="btn" disabled={page >= lastPage} onClick={() => go(1)}>Next</button>
      </nav>
    );
  }

  private renderShared() {
    return [
      <h2>Shared with me</h2>,
      this.loaded && this.shared.length === 0 && <p>Nothing has been shared with you yet.</p>,
      <ul class="rows">
        {this.shared.map((m) => (
          <li>
            {this.link(`/materials/${m.id}`, m.title)}
            <span class="meta">{this.facts(m)} · by {m.author.name}</span>
          </li>
        ))}
      </ul>,
      this.pager('Shared material pages', this.sharedPage, this.sharedLastPage, (d) => this.goShared(d)),
    ];
  }

  private renderTeacher() {
    return (
      <section>
        <h1>My materials</h1>
        <p>{this.link('/materials/new', 'Upload a material')}</p>
        {this.loaded && this.materials.length === 0 && <p>You have not uploaded any materials yet.</p>}
        <ul class="rows">
          {this.materials.map((m) => (
            <li>
              {this.link(`/materials/${m.id}`, m.title)}
              <span class="meta">
                {m.visibility === 'public' ? 'Public' : 'Private'} · {this.facts(m)}
              </span>
            </li>
          ))}
        </ul>
        {this.pager('My material pages', this.page, this.lastPage, (d) => this.goOwn(d))}
        {this.renderShared()}
      </section>
    );
  }

  render() {
    if (this.error) {
      return <section><h1>Materials</h1><p>We could not load your materials. Please try again.</p></section>;
    }
    switch (this.role) {
      case 'teacher':
        return this.renderTeacher();
      case 'student':
        return <section><h1>Materials</h1>{this.renderShared()}</section>;
      default:
        return <section><h1>Materials</h1><p>There are no materials for this account.</p></section>;
    }
  }
}
