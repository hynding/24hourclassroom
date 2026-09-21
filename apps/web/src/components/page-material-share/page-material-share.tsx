import { Component, h, Prop, State } from '@stencil/core';
import { ApiError } from '@24hc/api-client';
import { Connection, MaterialShare, MaterialView, ShareResult } from '@24hc/shared';
import { materialsStore } from '../../services/materials-store';
import { profileStore } from '../../services/profile-store';
import { navigate } from '../../services/navigate';
import { recoverFromExpiredSession } from '../../services/session-recovery';

@Component({ tag: 'page-material-share', styleUrl: 'page-material-share.css', shadow: true })
export class PageMaterialShare {
  @Prop() materialId?: number;

  @State() material: MaterialView | null = null;
  @State() connections: Connection[] = [];
  @State() shares: MaterialShare[] = [];
  @State() selected: Set<number> = new Set();
  @State() results: ShareResult[] | null = null;
  @State() busy = false;
  @State() notFound = false;
  @State() error = '';
  /** Set when a non-author is being navigated away; render() paints nothing. */
  @State() bounced = false;

  async componentWillLoad() {
    if (!this.materialId) {
      this.notFound = true;
      return;
    }
    try {
      const material = await materialsStore.getMaterial(this.materialId);
      if (!material.is_author) {
        // Set bounced BEFORE assigning this.material and return immediately:
        // render() checks bounced first, so the share UI is never painted
        // even for a single frame.
        this.bounced = true;
        navigate(`/materials/${material.id}`);
        return;
      }
      this.material = material;
      const connections = await profileStore.connections();
      // Allowlist: a handout is as useful teacher-to-teacher as
      // teacher-to-student, but any other role is invalid by default.
      this.connections = connections.data.filter((c) => c.user.role === 'teacher' || c.user.role === 'student');
      await this.refresh();
    } catch (e) {
      if (e instanceof ApiError && e.status === 404) {
        this.notFound = true;
      } else if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not load this page.';
      }
    }
  }

  private async refresh() {
    this.shares = (await materialsStore.listMaterialShares(this.materialId)).data;
  }

  private get unsharedConnections(): Connection[] {
    const taken = new Set(this.shares.map((s) => s.user.id));
    return this.connections.filter((c) => !taken.has(c.user.id));
  }

  private toggle(id: number, on: boolean) {
    const next = new Set(this.selected);
    on ? next.add(id) : next.delete(id);
    this.selected = next;
  }

  async share() {
    if (this.selected.size === 0) {
      return;
    }
    this.busy = true;
    this.error = '';
    try {
      const res = await materialsStore.shareMaterial(this.materialId, Array.from(this.selected));
      this.results = res.results;
      this.selected = new Set();
      await this.refresh();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = e instanceof ApiError ? e.message : 'We could not share this material.';
      }
    } finally {
      this.busy = false;
    }
  }

  /** Takes the SHARE id, not the user id. */
  async remove(shareId: number) {
    this.busy = true;
    this.error = '';
    try {
      await materialsStore.unshareMaterial(this.materialId, shareId);
      await this.refresh();
    } catch (e) {
      if (!recoverFromExpiredSession(e)) {
        this.error = 'We could not remove that recipient.';
      }
    } finally {
      this.busy = false;
    }
  }

  /**
   * Allowlisted for the connection checklist, but NOT for the recipient
   * list below it: the API does not role-filter shares, so a recipient
   * promoted to admin after being shared with still appears there. Every
   * role must be named explicitly rather than defaulting to 'Student'.
   */
  private roleLabel(role: string): string {
    return role === 'teacher' ? 'Teacher' : role === 'student' ? 'Student' : 'Other';
  }

  private nameFor(userId: number): string {
    return this.connections.find((c) => c.user.id === userId)?.user.name ?? `User ${userId}`;
  }

  render() {
    if (this.bounced) {
      return null;
    }
    if (this.notFound) {
      return <section><h1>Material not found</h1><p>This material does not exist or is not available to you.</p></section>;
    }
    if (!this.material) {
      return <section><p>{this.error || 'Loading…'}</p></section>;
    }
    return (
      <section>
        <h1>Share "{this.material.title}"</h1>
        {this.error && <p class="error">{this.error}</p>}

        {this.results && (
          <ul class="results">
            {this.results.map((r) => (
              <li>{this.nameFor(r.id)}: {r.status === 'shared' ? 'shared' : 'could not be shared'}</li>
            ))}
          </ul>
        )}

        <form onSubmit={(e) => { e.preventDefault(); this.share(); }}>
          <fieldset>
            <legend>Connected teachers and students</legend>
            {this.connections.length === 0 && <p>You have no accepted connections to share with yet.</p>}
            {this.connections.length > 0 && this.unsharedConnections.length === 0 && <p>Everyone you are connected to already has this material.</p>}
            {this.unsharedConnections.map((c) => (
              <label class="row">
                <input type="checkbox" checked={this.selected.has(c.user.id)} onChange={(e) => this.toggle(c.user.id, (e.target as HTMLInputElement).checked)} />
                {c.user.name}
                <span class="pill">{this.roleLabel(c.user.role)}</span>
              </label>
            ))}
          </fieldset>
          <button type="submit" class="btn-primary" disabled={this.busy || this.selected.size === 0}>Share</button>
        </form>

        <h2>Shared with</h2>
        {this.shares.length === 0 && <p>Nobody yet.</p>}
        <ul class="rows">
          {this.shares.map((s) => (
            <li>
              <span>{s.user.name}</span>
              <span class="pill">{this.roleLabel(s.user.role)}</span>
              <button type="button" class="btn" disabled={this.busy} onClick={() => this.remove(s.id)}>Remove</button>
            </li>
          ))}
        </ul>
        <p class="meta">A share lasts only while you stay connected: disconnecting hides the material, and reconnecting brings it back.</p>

        <a href={`/materials/${this.material.id}`} onClick={(e) => { e.preventDefault(); navigate(`/materials/${this.material.id}`); }}>Back to material</a>
      </section>
    );
  }
}
