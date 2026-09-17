# 24 Hour Classroom

Teachers and students sharing lesson plans, homework, study materials, practice
tests, and reports.

npm-workspaces monorepo: a Laravel API, a Stencil SPA, and two shared packages
that keep types aligned between them.

| Path | What |
|---|---|
| `apps/api` | Laravel 12 API + auth pages. Tests: Pest. |
| `apps/web` | Stencil SPA (web components). Tests: Jest via `stencil test`. |
| `packages/shared` | `@24hc/shared` — types/constants mirrored from PHP enums. |
| `packages/api-client` | `@24hc/api-client` — typed fetch wrapper for the API. |
| `docker/` | Local dev images. |
| `docs/` | Design docs. **Gitignored — local-only, absent from a fresh clone.** |

## Commands

```bash
# Local dev (see README for the docker-compose variants)
docker compose --profile localdb up --build   # bundled MySQL
docker compose up --build                     # bring your own DB

# Web only, no API — fastest loop for UI work. Serves http://localhost:3333
npm run dev -w @24hc/web

# Tests
cd apps/api && php artisan test    # Pest; needs MySQL on 127.0.0.1:3306
npm test                           # api-client + web

# Build everything (shared -> api-client -> web, in order)
npm run build
```

`packages/*/dist/` is gitignored but **required** by `apps/web` — run
`npm run build` before `npm run dev -w @24hc/web` on a fresh clone.

## Architecture

**Enums are mirrored PHP <-> TS.** `apps/api/app/Enums/*.php` and
`packages/shared/src/index.ts` must agree; tests assert the mirror in both
directions. Add a case to one, add it to the other.

**Theming.** The site owner picks layout (`stacked|rail`), palette
(`noon|evening|slate|afternoon`), and typeset (`editorial|modern`) at
`/admin/site-theme`. Stored in a single-row `site_settings` table, served by
`GET /api/site` (throttle-only — no `auth`, no `active`). The SPA applies it via
`data-palette`/`data-typeset` on `<html>`, an inline pre-paint boot script in
`index.html`, and one `app-layout` component switched by a reflected prop.

**Shadow DOM.** Components use `shadow: true`. `app.css` is delivered twice —
linked from `index.html` (so `:root`/`body`/`@font-face` work) and adopted into
every shadow root by Stencil (so element and class rules reach components).
`app-layout` lives inside `app-root`'s shadow root, so a top-level
`document.querySelector('app-layout')` finds nothing — pierce `.shadowRoot`.

## Styling contract (`apps/web`)

Enforced by specs in `src/global/`. These fail CI, not review:

- **No literal colour or font outside** `tokens.css`, `palettes/`, `typesets/`.
  Use `var(--…)`. The whitelist spec scans every colour-bearing property,
  including `border-*` longhands.
- Control borders use `--color-ink-muted`, never `--color-line` (WCAG 1.4.11
  wants 3:1; `--color-line` is ~1.3:1 by design).
- **No `:visited` rule. No `!important`.**
- Any `@Prop` a stylesheet keys on must be `reflect: true`.
- Palette/typeset selectors must be exactly `:root[data-palette='<name>']` /
  `:root[data-typeset='<name>']`; contrast >= 4.5 on both surfaces is recomputed
  from the files.
- `theme-store` has no module-scope side effects; `applyTheme` always writes
  both attributes.
- Page layout lives in each component's CSS. Keep `app.css` to base styles and
  shared variants — every rule in it is evaluated inside every shadow root.

## Admin accounts

**Nothing in the application can create an admin.** All four role-accepting
entry points allowlist teacher/student only — SPA registration, web
registration, OAuth completion, *and the admin UI's own role editor*. That is
deliberate: a stolen admin session cannot mint persistent admins. It also means
provisioning always needs shell access.

```bash
php artisan user:promote you@example.com --verify
```

`--verify` also sets `email_verified_at` and clears `deactivated_at`, because
the admin surface is gated on `['auth','verified','active','admin']` and the
role alone won't get you in. Without the flag those gates are left untouched and
the command warns you which one is still closed.

The admin UI is Inertia on the **API host** (`/admin/users`, `/admin/site-theme`),
not the Stencil SPA. Log in there, not on the SPA host.

Middleware order in `bootstrap/app.php` is load-bearing: `EnsureUserIsAdmin` is
prepended ahead of `SubstituteBindings` so `/admin/users/{user}` isn't an
existence oracle, and `active` ahead of `admin` so a deactivated non-admin is
redirected rather than told 403. Don't add admin routes that bypass those aliases.

## Gotchas

**Denylist over the `Role` enum — the recurring defect class.** Writing
`role === Student ? … : public` has broken three times, twice *after* the lesson
was applied elsewhere; `Role::Admin` is what grew the enum. **Always allowlist.**
Regression tests iterate `Role::cases()` so a fourth role is invalid-by-default.

**Both `throttle:60,1` groups share one limiter bucket.** `ThrottleRequests`
keys an authenticated request on `sha1(user id)` alone, so a signed-in user has
a single 60/min budget spanning the public directory *and* the authenticated
endpoints. Tuning either number tunes both.

**Notification payloads are frozen at write time.** Redaction is read-time, not
retroactive — a promoted teacher's old `ConnectionRequested` still carries
`role: teacher`. Matters before any feature re-renders historical payloads.

**404, not 422/403, for student<->student and deactivated connection targets.** A
distinguishable 422 let a caller walk the id space.

## Conventions

- Conventional commits with optional scope: `feat(web):`, `fix:`, `test(api):`.
- **`master` has no merge commits** — milestones land fast-forward.
- Don't commit into `docs/` or `.superpowers/` expecting them to travel; both
  are gitignored.

## Deploys

Push to `dev` -> staging, push to `master` -> production. Both gated on CI
(`needs: [api, web]` in the single `.github/workflows/ci.yml`). There is no
manual trigger — a push is the only way to deploy.

The deploy runs migrations (`migrate --force`) and recreates the
`public/storage` symlink (`storage:link --force`, deliberately not `|| true` —
a permissions failure there 404s every avatar behind an otherwise green deploy).

**Deploys have been on hold by standing instruction. Confirm with the user
before pushing either branch.** Check `git log origin/master..master` first —
unpushed work has accumulated in large batches before.
