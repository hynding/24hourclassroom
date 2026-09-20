import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { GRADE_LEVELS, MaterialView, SUBJECTS } from '@24hc/shared';
import { materialsStore } from '../../services/materials-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';
import { fileTypeLabel, formatBytes } from '../../services/format';

/**
 * download_url is signed for 15 minutes from the moment the payload was
 * built. Intercept the click a little before that so a page left open does
 * not hand the browser a URL that 403s on arrival.
 */
const STALE_AFTER_MS = 10 * 60 * 1000;

@Component({ tag: 'page-material', styleUrl: 'page-material.css', shadow: true })
export class PageMaterial {
  @Prop() materialId?: number;

  @State() material: MaterialView | null = null;
  @State() notFound = false;
  @State() loadError = false;
  @State() busy = false;
  @State() actionError = '';

  /**
   * When the current payload arrived. A plain field, not @State: it drives
   * no rendering, and specs set it directly to age the payload (fake timers
   * cannot be enabled before mount, and waitForChanges needs real ones).
   */
  fetchedAt = 0;

  async componentWillLoad() {
    // No authStore.load() here: every branch on this page reads a payload
    // field (is_author, shared_with_me), never the viewer's role.
    await this.load();
  }

  private async load() {
    if (!this.materialId) {
      this.notFound = true;
      return;
    }
    try {
      this.material = await materialsStore.getMaterial(this.materialId);
      this.fetchedAt = Date.now();
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.loadError = true;
      }
    }
  }

  /**
   * Inside the freshness window this does nothing and the browser follows
   * the href. Past it, re-fetch (visibility may have changed too) and send
   * the browser to the new URL by assigning window.location.href -- never
   * navigate(), which would push the API host's URL onto the SPA history and
   * resolve to the home page.
   */
  async download(event: MouseEvent) {
    if (Date.now() - this.fetchedAt <= STALE_AFTER_MS) {
      return;
    }
    event.preventDefault();
    this.actionError = '';
    try {
      const fresh = await materialsStore.getMaterial(this.material.id);
      this.material = fresh;
      this.fetchedAt = Date.now();
      window.location.href = fresh.download_url;
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        // Unpublished, unshared, disconnected or deleted since the load.
        this.material = null;
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.actionError = 'That download link expired and we could not refresh it.';
      }
    }
  }

  private async run(action: () => Promise<void>) {
    this.busy = true;
    this.actionError = '';
    try {
      await action();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.actionError = e instanceof ApiError ? e.message : 'Something went wrong.';
      }
    } finally {
      this.busy = false;
    }
  }

  private togglePublish = () => this.run(async () => {
    const updated = this.material.visibility === 'public'
      ? await materialsStore.unpublishMaterial(this.material.id)
      : await materialsStore.publishMaterial(this.material.id);
    // Every single-material write returns the whole MaterialView, including
    // a fresh download_url, so this spread cannot drop the link.
    this.material = { ...this.material, ...updated };
    this.fetchedAt = Date.now();
  });

  private remove = () => {
    // Ask BEFORE run(): entering run() flips `busy` (disabling every button)
    // for a dialog the teacher may still cancel. And it has to be
    // `window.confirm`, not the bare global -- newSpecPage resets the mock
    // window, so a spec can only stub the property after mount.
    if (!window.confirm('Delete this material? Everyone it is shared with loses access and the file is removed. This cannot be undone.')) {
      return;
    }
    return this.run(async () => {
      await materialsStore.deleteMaterial(this.material.id);
      navigate('/materials');
    });
  };

  private link(path: string, text: string) {
    return <a href={path} onClick={(e) => { e.preventDefault(); navigate(path); }}>{text}</a>;
  }

  private label(list: { value: string; label: string }[], value: string) {
    return list.find((o) => o.value === value)?.label ?? value;
  }

  render() {
    if (this.notFound) {
      return <section><h1>Material not found</h1><p>This material does not exist or is not available to you.</p></section>;
    }
    if (this.loadError) {
      return <section><h1>Material</h1><p>We could not load this material. Please try again.</p></section>;
    }
    if (!this.material) {
      return <section><p>Loading…</p></section>;
    }
    const m = this.material;
    return (
      <section>
        <header>
          <h1>{m.title}</h1>
          <p class="meta">
            {this.label(SUBJECTS, m.subject)} · {this.label(GRADE_LEVELS, m.grade_level)} · {fileTypeLabel(m.original_name)} · {formatBytes(m.size_bytes)} · by {this.link(`/teachers/${m.author.id}`, m.author.name)}
            {m.visibility === 'public' ? ' · Public' : ' · Private'}
          </p>
          {m.description && <p>{m.description}</p>}
          {!m.is_author && m.shared_with_me && <p class="meta">Shared with you</p>}
        </header>

        {this.actionError && <p class="error">{this.actionError}</p>}

        <div class="actions">
          <a class="btn" data-testid="download" href={m.download_url} onClick={(e) => this.download(e)}>
            Download {m.original_name}
          </a>
          {m.is_author && [
            this.link(`/materials/${m.id}/edit`, 'Edit'),
            this.link(`/materials/${m.id}/share`, 'Share'),
            <button type="button" class="btn" disabled={this.busy} onClick={this.togglePublish}>
              {m.visibility === 'public' ? 'Unpublish' : 'Publish to library'}
            </button>,
            <button type="button" class="btn" disabled={this.busy} onClick={this.remove}>Delete</button>,
          ]}
        </div>

        {this.link('/materials', 'Back to materials')}
      </section>
    );
  }
}
