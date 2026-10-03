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
`/admin/site-theme`. Stored in a single-row `site_settings` table beside the
site name, tagline, registration switch and announcement banner (edited at
`/admin/site`, which also holds the per-teacher material file cap — kept out
of the public config), all served as one config by `GET /api/site` (throttle-only —
no `auth`, no `active`). The SPA caches the theme under `24hc.theme.v1` (read
by the inline boot script) and the whole config under `24hc.site.v1`;
`applyTheme` is the only writer of the first. The SPA applies it via
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

The admin UI is Inertia on the **API host** (`/admin/users`,
`/admin/users/{user}`, `/admin/site-theme`, `/admin/site`, `/admin/tests`,
`/admin/materials`, `/admin/generations`), not the Stencil SPA. Log in there,
not on the SPA host.

Middleware order in `bootstrap/app.php` is load-bearing: `EnsureUserIsAdmin` is
prepended ahead of `SubstituteBindings` so `/admin/users/{user}` isn't an
existence oracle, and `active` ahead of `admin` so a deactivated non-admin is
redirected rather than told 403. Don't add admin routes that bypass those aliases.

**Registration can be closed** from `/admin/site`. Every path that creates a
`users` row goes through `App\Support\Registration` (`assertOpen()` on the
JSON entry points, `isOpen()` + redirect on the web register page, the OAuth
callback's new-account branch); `RegistrationGateTest` scans `app/` for
`User::create(` and fails until a new creator is gated. Shell commands,
seeders and factories are deliberately ungated.

## Seeded AP Biology course

`php artisan db:seed --class=ApBiologySeeder` (also called from `DatabaseSeeder`)
builds a full-year course from YAML under
`apps/api/database/seeders/data/ap-biology/` (`course.yaml` = week → unit → CED
topic map; `unit-NN-*/week-NN.yaml` = guide path + flashcards + quiz;
`unit-exam.yaml`, `unit-summary.md`; `review/` = practice exam and prep guide).
`Database\Seeders\ApBiology\Course` loads it and composes every title and slug
(`AP Biology · Week 07 · Quiz · …`) so the library's `sort=title` reads in course
order. Idempotent through nullable `slug` columns on `tests`, `questions` and
`materials`: a re-run updates in place and questions keep their ids. By default
it creates `apbio@example.com` / `apbio-student@example.com`, connects them, and
assigns every test to the student with a due date from `start_date` (null = no
due dates). Those demo accounts get the password `password` only in `local` and
`testing`; anywhere else they get a random one, printed once.

On a real server, attach the course to your own account instead. Deploys run
migrations, never seeders, so this is a one-off shell step per environment:

```bash
php artisan course:seed-ap-biology --teacher=you@example.com --no-student --force
```

`--teacher` must name an existing, verified, active teacher; the command never
creates, verifies or re-passwords an account you name, and checks the owner's
material quota before writing anything. The course is 73 files against the
per-teacher file cap. An admin sets that cap under Materials at `/admin/site`
(stored in `site_settings`, read through `MaterialQuota::maxFiles()`); while it
is blank the server default applies: `MATERIALS_MAX_FILES_PER_TEACHER`, else
100. The deploy runs `config:cache`, so a changed env default needs a redeploy
or a fresh `config:cache`; the admin setting takes effect immediately. `--student=EMAIL`
assigns the course to an existing student; `--no-student` skips the student,
connection and assignments. Re-running with a different `--teacher` moves every
course test and material to that account. Plain `db:seed` also seeds the course
with the demo accounts and creates `test@example.com`: never run it on a server. `ApBiologyContentTest` lints the data
directory (provenance, rationales, spiral review, duplicates, attribution) and
`ApBiologySeederTest` proves idempotency on `tests/Fixtures/course`.

Content contract the lint enforces: every option carries an
`option_explanations` entry; `fill_blank` prompts contain `____` and `answer` is a
list of accepted strings (`auto_grade: false` hands the item to the teacher);
`long_answer` is 4–10 points and its `explanation` is the point-by-point
acceptable-answer summary; a `stimulus` repeated verbatim across consecutive
items renders once. Flashcard decks are materials named `*.flashcards.md`
(`## front`, body back, trailing `Hint:`/`Topic:` lines); `page-material` reads
any small `.md`/`.txt` in-app through `rich-text`, a vnode-only markdown subset
with no HTML and no `innerHTML`. `MaterialWriter` is the one path that puts a
file on the materials disk, for uploads and the seeder alike.

## Gotchas

**Denylist over the `Role` enum — the recurring defect class.** Writing
`role === Student ? … : public` has broken three times, twice *after* the lesson
was applied elsewhere; `Role::Admin` is what grew the enum. **Always allowlist.**
Regression tests iterate `Role::cases()` so a fourth role is invalid-by-default.

**Both `throttle:60,1` groups share one limiter bucket.** `ThrottleRequests`
keys an authenticated request on `sha1(user id)` alone, so a signed-in user has
a single 60/min budget spanning the public directory *and* the authenticated
endpoints. Tuning either number tunes both.

**All guest requests share one per-IP throttle bucket.** `ThrottleRequests`
keys a guest on `sha1(domain|ip)` with no route component, and the limit is
not part of the key, so `GET /api/site` (60/min) and the four `throttle:6,1`
auth routes (`/api/auth/register`, `forgot-password`, `reset-password`,
`oauth/complete`) increment one counter: six page loads can spend the
registration budget. The web `POST /register` and `POST /login` carry no
throttle middleware. In Pest, keep any one test under six guest requests
through throttled routes.

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
