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
- `packages/nextjs` is deleted.
- The existing root `Dockerfile` and `docker-compose.yml` are replaced.

## MySQL

- Compose service `mysql` (image `mysql:8.4`) under compose **profile** `localdb` with a named volume.
  - Local DB: `docker compose --profile localdb up`
  - External DB: plain `docker compose up`; `DB_HOST` points at the external host (e.g. Dreamhost MySQL hostname).
- Laravel reads `DB_*` vars from env. Committed `.env.example` documents both modes.
- SQLite database file and the Postgres/Redis services are removed. Cache/queue use the `database` drivers.
- Existing migrations are DB-agnostic and carry over unchanged.

## Stencil app (`apps/web`)

- Scaffolded from Stencil's app starter: TypeScript SPA with stencil-router, builds static output to `www/`.
- Initial surface: landing page, app shell (header/nav/footer), and a "Sign in" link that hands off to the Laravel-hosted auth pages.
- Authenticated API calls go through `packages/api-client` using Laravel Sanctum cookie (SPA) auth.
- An `.htaccess` with rewrite-to-`index.html` enables SPA routing on Dreamhost's Apache.

## Domains & hybrid split

| Branch | Web (Stencil, static) | API + auth/admin (Laravel) |
|--------|----------------------|---------------------------|
| master | `24hourclassroom.com` | `api.24hourclassroom.com` |
| dev    | `dev.24hourclassroom.com` | `api-dev.24hourclassroom.com` |

- Four Dreamhost sites so the static SPA and the PHP app each own a docroot. Laravel sites point their web directory at the app's `public/` folder.
- Sanctum `stateful` domains configured so the session cookie spans the subdomains (`SESSION_DOMAIN=.24hourclassroom.com`).
- Each environment has its own Dreamhost MySQL database created in the panel.

## Docker (local dev)

Three services (replacing the current five):

- **api** — PHP 8.3 + composer image running `php artisan serve` (dev convenience; production Apache belongs to Dreamhost). Code bind-mounted for live reload.
- **web** — `node:22` running the Stencil dev server with HMR. Code bind-mounted.
- **mysql** — profile `localdb`, `mysql:8.4`, named volume.

Root `.env` (from `.env.example`) drives ports and DB settings for both modes.

## CI/CD (GitHub Actions → Dreamhost)

One workflow, using GitHub Environments `staging` (branch `dev`) and `production` (branch `master`) for secrets: SSH host/user/key, remote paths, and production `.env` values.

1. **CI job** (pull requests and pushes): Laravel Pest tests against a MySQL service container; Stencil build + spec tests.
2. **Build job:** `composer install --no-dev --optimize-autoloader`, `npm ci && npm run build` for Laravel Vite assets and the Stencil `www/` output. Composer/npm never run on the Dreamhost server (limited shell/memory there).
3. **Deploy job:** rsync built artifacts over SSH to each site directory; write the environment `.env`; then over SSH run `php artisan migrate --force`, `config:cache`, `route:cache`, `view:cache`.

## Error handling / operational notes

- Migrations run with `--force` after files land; a failed migration fails the workflow visibly.
- Deploys are direct rsync (no atomic release/symlink scheme yet — acceptable at this stage; revisit if traffic makes mid-deploy inconsistency a real problem).
- Vendor directory is rsynced from CI, so PHP version on Dreamhost must match the CI build (pin PHP 8.3 in both).

## Testing

- Existing Pest auth/settings tests must pass after the MySQL switch (locally and in CI).
- Stencil components get spec tests from the start; CI fails on test or build failure.
- Manual verification checklist: `docker compose --profile localdb up` serves web + api locally; external-DB mode works with a remote MySQL; a push to `dev` lands on the staging subdomains.

## Out of scope

- Domain features (profiles, connections, lesson plans, homework, materials, practice tests, reports).
- Redis, queues beyond the database driver, object storage, CDN.
- Zero-downtime/atomic deploys.
