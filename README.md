# 24 Hour Classroom

Teachers connecting with teachers and students — creating and sharing lesson
plans, homework, study materials, practice tests, and reports.

## Layout

| Path | What it is |
|---|---|
| `apps/api` | Laravel 12 — REST API (Sanctum) + Inertia auth/admin UI |
| `apps/web` | Stencil SPA — public + teacher/student product surface |
| `packages/api-client` | Typed TS client for the API (owns the CSRF handshake) |
| `packages/shared` | Shared TS types |
| `docker/` | Local dev images |
| `docs/superpowers/specs` | Design docs |

## Local development

```bash
cp .env.example .env
cp apps/api/.env.example apps/api/.env
# Local bundled MySQL (set DB_HOST=mysql in apps/api/.env):
docker compose --profile localdb up --build
# ...or bring your own database (set DB_* in apps/api/.env accordingly):
docker compose up --build
```

- Web app: http://localhost:3333
- API + auth pages: http://localhost:8000 (health check at `/up`)

Run the API test suite (needs MySQL on 127.0.0.1:3306, e.g. the localdb container):

```bash
cd apps/api && php artisan test
```

Run JS tests: `npm test`

## Deploys

Pushes to `dev` → staging (`dev.`/`api-dev.` subdomains); pushes to `master` →
production. See `docs/deploying.md` for Dreamhost + GitHub setup.
