# 24hourclassroom Monorepo Restructure — Design

**Date:** 2026-09-08
**Status:** Approved
**Scope:** Infrastructure/restructure only. Domain features (profiles, lesson plans, materials) are follow-up projects.

## Goal

Restructure the project so that:

- Applications live in a root `apps/` directory; isolated and shared code lives in root `packages/`.
- MySQL is the database everywhere (local Docker or externally hosted, selected by environment config).
- A new Stencil.js web app is the user-facing frontend.
- The project runs locally via Docker.
- GitHub Actions deploys the `dev` and `master` branches to a Dreamhost shared server.

Product vision (context for follow-ups): teachers connect with other teachers and students to create and share lesson plans, homework, study materials, practice tests, and reports.

## Decisions made

1. **App lineup:** Laravel stays as the backend API; the new Stencil app is the web frontend; the Next.js starter is deleted (Node servers cannot run on Dreamhost shared hosting; Stencil builds to static files which can).
2. **Laravel role — hybrid:** Laravel keeps its Inertia+React UI for auth (login/register/password reset) and admin/dashboard/settings screens. Stencil owns the public and teacher/student-facing product surface.
3. **Deploy map — subdomain staging:** `master` → production domain, `dev` → staging subdomain, each with its own Dreamhost MySQL database. Deploys via SSH/rsync from GitHub Actions.
4. **Sequencing:** structure first (this spec); then, as separate spec/plan cycles: (1) profiles + connections, (2) lesson plans, (3) study materials + homework.

## Monorepo layout

```
apps/
  api/          Laravel 12 (moved from packages/laravel) — REST API + Inertia auth/admin UI
  web/          NEW Stencil.js app — public + teacher/student product surface
packages/
  api-client/   Typed TypeScript client for the Laravel API (used by apps/web)
  shared/       Shared TS types/constants (User, roles, visibility enums, …)
docker/         Dockerfiles + related config
.github/workflows/
```

- Root `package.json` declares npm workspaces: `apps/web`, `packages/*`. No Turborepo/Nx (unneeded at this scale).
- `apps/api` is **intentionally outside the npm workspaces**: its `package.json` only serves the Laravel Vite/Inertia build, whose dependency tree stays self-contained (`npm ci` inside `apps/api`) rather than hoisted into the root.
- `packages/nextjs` is deleted.
- The existing root `Dockerfile` and `docker-compose.yml` are replaced.

## MySQL & runtime services (queues, mail)

- Compose service `mysql` (image `mysql:8.4`) under compose **profile** `localdb` with a named volume.
  - Local DB: `docker compose --profile localdb up`
  - External DB: plain `docker compose up`; `DB_HOST` points at the external host (e.g. Dreamhost MySQL hostname).
- Laravel reads `DB_*` vars from env. Committed `.env.example` documents both modes.
- SQLite database file and the Postgres/Redis services are removed. Cache and sessions use the `database` drivers.
- **Queues:** `QUEUE_CONNECTION=sync` in all environments for now — Dreamhost shared hosting cannot run a persistent `queue:work` daemon, and nothing in scope needs background jobs. Revisit (cron-driven `queue:work --stop-when-empty`) when a feature actually queues work.
- **Mail:** password-reset emails need a working mailer. Staging/local use `MAIL_MAILER=log`; production uses SMTP credentials (Dreamhost mail or a transactional provider) supplied via the environment `.env` secret.
- Existing migrations are DB-agnostic and carry over unchanged.
- External-DB mode from a local machine requires allowlisting your IP for remote MySQL access in the Dreamhost panel — documented alongside the `.env.example` external-DB block.

## Stencil app (`apps/web`)

- Scaffolded from Stencil's app starter: TypeScript SPA with stencil-router, builds static output to `www/`.
- Initial surface: landing page, app shell (header/nav/footer), and a "Sign in" link that hands off to the Laravel-hosted auth pages.
- Authenticated API calls go through `packages/api-client` using Laravel Sanctum cookie (SPA) auth. The client owns the Sanctum handshake: it requests `GET /sanctum/csrf-cookie` before the first mutating call, sends every request with `credentials: 'include'`, and echoes the `XSRF-TOKEN` cookie back as the `X-XSRF-TOKEN` header.
- An `.htaccess` with rewrite-to-`index.html` enables SPA routing on Dreamhost's Apache. It lives in the repo (`apps/web/src/assets/.htaccess`, listed in Stencil's `copy` config) so every build emits it into `www/` and the deploy rsyncs it with the rest of the output.

## Domains & hybrid split

| Branch | Web (Stencil, static) | API + auth/admin (Laravel) |
|--------|----------------------|---------------------------|
| master | `24hourclassroom.com` | `api.24hourclassroom.com` |
| dev    | `dev.24hourclassroom.com` | `api-dev.24hourclassroom.com` |

- Four Dreamhost sites so the static SPA and the PHP app each own a docroot. Laravel sites point their web directory at the app's `public/` folder.
- Sanctum `stateful` domains configured so the session cookie spans the subdomains (`SESSION_DOMAIN=.24hourclassroom.com`).
- **Per-environment cookie names:** because staging and production share the parent cookie domain, each environment sets its own `SESSION_COOKIE` name (e.g. `24hc_session` vs `24hc_dev_session`) so a staging login can never clobber or shadow a production session.
- **CORS:** Laravel's CORS config allows exactly the web origins (`https://24hourclassroom.com`, `https://dev.24hourclassroom.com`, plus the localhost dev-server origin) with `supports_credentials: true`. Origins are env-driven so each environment allows only its own frontend.
- **Auth handoff and return:** the Stencil "Sign in" link points at the Laravel login page with a `redirect` query param naming the return URL. After authentication Laravel redirects there — but only if the URL's origin is on the same allowlist as CORS (otherwise it falls back to the Laravel dashboard), so the param can't be used as an open redirect.
- **HTTPS everywhere:** all four sites get Dreamhost Let's Encrypt certificates; `SESSION_SECURE_COOKIE=true` so the cross-subdomain session cookie is only sent over TLS. (Local dev runs on plain HTTP with this flag off.)
- Each environment has its own Dreamhost MySQL database created in the panel.

## Docker (local dev)

Three services (replacing the current five):

- **api** — PHP 8.3 + composer image running `php artisan serve` (dev convenience; production Apache belongs to Dreamhost). Code bind-mounted for live reload.
- **web** — `node:22` running the Stencil dev server with HMR. Code bind-mounted.
- **mysql** — profile `localdb`, `mysql:8.4`, named volume, with a healthcheck (`mysqladmin ping`).

Root `.env` (from `.env.example`) drives ports and DB settings for both modes.

The `api` service declares **no `depends_on: mysql`** — a hard dependency on a profile-gated service would make plain `docker compose up` (external-DB mode) fail. Instead the api container waits for its configured `DB_HOST` to accept connections at startup (simple wait loop in the entrypoint), which works identically for the local container and an external host.

## CI/CD (GitHub Actions → Dreamhost)

One workflow, using GitHub Environments `staging` (branch `dev`) and `production` (branch `master`) for secrets: SSH host/user/key, remote paths, and the full per-environment `.env` contents — including a **stable `APP_KEY`** generated once per environment and never rotated by deploys (rotating it would invalidate sessions and encrypted data).

1. **CI job** (pull requests and pushes): Laravel Pest tests against a MySQL service container; Stencil build + spec tests.
2. **Build job:** `composer install --no-dev --optimize-autoloader`, `npm ci && npm run build` for Laravel Vite assets and the Stencil `www/` output. Composer/npm never run on the Dreamhost server (limited shell/memory there).
3. **Deploy job:** rsync built artifacts over SSH to each site directory, then over SSH run `php artisan migrate --force`, `config:cache`, `route:cache`, `view:cache`.
   - `route:cache` cannot serialize closure routes, and the starter's route files use closures — part of this work is converting them to controllers or `Route::inertia()` so route caching succeeds.
   - The Laravel rsync uses `--delete` with explicit **exclusions for `.env` and `storage/`**, which are server-owned state; `.env` is written from the environment secret only when its content changes, and `storage/` directories are created (with a one-time `php artisan storage:link`) on first deploy.
   - The Stencil rsync is a plain `--delete` sync of `www/` into the site docroot.

## Error handling / operational notes

- Migrations run with `--force` after files land; a failed migration fails the workflow visibly.
- Deploys are direct rsync (no atomic release/symlink scheme yet — acceptable at this stage; revisit if traffic makes mid-deploy inconsistency a real problem).
- Vendor directory is rsynced from CI, so PHP version on Dreamhost must match the CI build (pin PHP 8.3 in both).

## Testing

- Existing Pest auth/settings tests must pass after the MySQL switch (locally and in CI).
- Stencil components get spec tests from the start; CI fails on test or build failure.
- Manual verification checklist: `docker compose --profile localdb up` serves web + api locally; external-DB mode works with a remote MySQL; a push to `dev` lands on the staging subdomains; and the full auth round-trip works on staging — register/login on the api host, get redirected back to the Stencil app, and see an authenticated API call succeed from it.

## Out of scope

- Domain features (profiles, connections, lesson plans, homework, materials, practice tests, reports).
- Redis, background queue processing (production runs `sync`), object storage, CDN.
- Zero-downtime/atomic deploys.
