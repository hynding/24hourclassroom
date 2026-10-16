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

**Theming.** The site owner picks layout (`rail`, the default: a left side
panel; or `stacked`, a top header), palette
(`noon|evening|slate|afternoon`), and typeset (`editorial|modern`) at
`/admin/site-theme`. Stored in a single-row `site_settings` table beside the
site name, tagline, registration switch and announcement banner (edited at
`/admin/site`, which also holds the per-teacher material file cap — kept out
of the public config), all served as one config by `GET /api/site` (throttle-only —
no `auth`, no `active`). The SPA caches the theme under `24hc.theme.v1` (read
by the inline boot script) and the whole config under `24hc.site.v1`;
`applyTheme` is the only writer of the first. The SPA applies it via
`data-palette`/`data-typeset` on `<html>`, an inline pre-paint boot script in
`index.html`, and one `app-layout` component switched by a reflected prop. In
`rail`, `app-header` (orientation `vertical`) is the side panel: icons from
`services/nav-icons.tsx`, collapsible to icons on wide screens (reflected
`collapsed`, remembered per browser under `24hc.nav.collapsed.v1`). Both
orientations render the same markup; at or below the 767px breakpoint either
one becomes a slim top bar plus drawer (reflected `open`). The breakpoint
literal lives in `app-layout.css`, `app-header.css`, `app.css` (narrow-screen
form controls fill their line) and `app-header.tsx`; `breakpoint.spec.ts`
asserts every `max-width` query under `src/` agrees.

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
entry points allowlist `Role::selfAssignable()` (teacher, student, tutor,
assistant, guardian) — SPA registration, web registration, OAuth completion,
*and the admin UI's own role editor*. That is
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
`/admin/materials`, `/admin/courses`, `/admin/generations`), not the Stencil SPA. Log in there,
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

## Roles

`App\Enums\Role` holds every capability as an allowlist method; branch on those,
never on a role literal. `packages/shared` mirrors each list (`AUTHOR_ROLES`,
`PUBLIC_ROLES`, …) and `RoleMirrorTest` asserts both directions.

- `authors()` — teacher, tutor: tests, materials, courses, assigning, grading,
  integrations. A tutor is a teacher in every gate.
- `isPublic()` — teacher, tutor: directory, public profile, follow, avatar.
- `supportsStudents()` — tutor, assistant (teacher assistant), guardian
  (parent or guardian): `GET /api/students/{id}/assignments`, read-only scores
  for a student they hold an accepted connection with. 404 for anything else.
- `receivesShares()` — teacher, student, tutor, assistant.
- `comments()` — everyone but admin; `moderatesComments()` — admin (see Comments).
- `Role::canConnect($a, $b)` — the symmetric pair matrix (no admin, no
  student↔student, guardian/assistant only with teacher, tutor, student).

Non-public roles are reached through **connect codes** (`users.connect_code`,
hidden, minted on first `GET /api/connections/code`, rotated by `PUT`):
`POST /api/connections/code/{code}` sends a request; every miss is one 404.

## Courses

A course (`courses` + `course_items`) is a teacher's ordered list of their
**own** tests and materials, each under an optional `section` heading (repeated
per item and collapsed by the views, like a stimulus). New courses are private.
A public course's answers are public by design: there is no hide-answers switch.
`App\Support\CourseAccess` holds every rule:

- Private: author only, 404 to everyone else. Public: anyone, logged out
  included, while the author is active.
- A visitor sees only items that are **themselves public**. Publishing a course
  (`CourseWriter::publishContents`) publishes everything in it; saving a public
  course publishes only what was *added*, never an item its author unpublished
  since. An admin unpublishing a test/material therefore drops it from every
  course too. Unpublishing a course leaves its items' visibility alone.
- **Practice mode** (`/api/courses/{course}/tests/{test}`, SPA
  `/courses/:id/tests/:testId`) returns the test *with answers* — the reveal
  button needs no round trip — to anyone who can see the course, but only for a
  public test (the author can preview anything). `POST …/check` grades a run
  with `AttemptGrader::score` and writes nothing, so guests can use it. Nothing
  else ever returns answers to a non-author; an assigned student cannot reach a
  private test's answers through a course.

Publishing a course exposes its answers, including to students the teacher has
assigned those tests to; the SPA's publish confirm says so.

**Branches** are how a teacher gets private answers from a public course.
`POST /api/courses/{course}/branch` (another teacher only, public course only)
runs `CourseBrancher`: a new **private** course (`branched_from_id`) whose
tests are private copies owned by the brancher (`TestCopier`, the same path as
"Copy to my tests") — theirs to rewrite, extend and assign — and whose
materials stay **references** to the original's public files rather than
copies (no answers in them, and a full course would eat the file cap). That
makes tests always the course author's own, while a material may be another
teacher's: shown only while it is public with an active author, keepable,
movable and removable in the editor, never newly addable. Later changes to the
original do not reach a branch. `page-course` watches `courseId`: a branch and
its original are the same tag, so Stencil reuses the element.

## Comments

Signed-in people discuss a test, any one of its questions, a material or a
course (`GET|POST /api/comments?target_type=&target_id=`, `PATCH|DELETE
/api/comments/{comment}`; SPA `comment-thread`, compact per question on
`page-test`). `App\Support\CommentAccess` holds every rule:

- A discussion is exactly as visible as its target (`TestAccess`,
  `MaterialAccess`, `CourseAccess`; a question goes through its test): 404
  otherwise. Guests read nothing: a discussion names people.
- Posting is `Role::comments()` (everyone but admin); `Role::moderatesComments()`
  (admin) deletes anything it can see; the target's author deletes anything on
  their own content; the writer edits and deletes their own.
- Names follow decision 5: a `Role::isPublic()` commenter is named to all,
  anyone else only to themselves, their accepted connections and admins;
  others see the role ("A student"). `CommentPosted` notifications apply the
  same rule per recipient at write time.
- One nullable FK per target type (`CommentTarget`), so a deleted target takes
  its discussion with it. Replies are one level deep; deleting a comment
  deletes its replies. Deactivated people's comments are hidden, not deleted.

## Seeded courses (AP Biology, AP U.S. History, Algebra 1, Geometry, Algebra 2)

Five full-year courses are seeded from YAML, each by a thin subclass of
`Database\Seeders\Curriculum\CurriculumSeeder` that names its data directory:

| Seeder | Command | Data | Slug | Demo accounts |
|---|---|---|---|---|
| `ApBiologySeeder` | `course:seed-ap-biology` | `data/ap-biology/` (adapted from CC BY OpenStax) | `apbio` | `apbio@`, `apbio-student@example.com` |
| `ApUsHistorySeeder` | `course:seed-ap-us-history` | `data/ap-us-history/` (original, public-domain quotations) | `apush` | `apush@`, `apush-student@example.com` |
| `Algebra1Seeder` | `course:seed-algebra-1` | `data/algebra-1/` (adapted from CC BY 4.0 IM 9–12 Math) | `alg1` | `algebra1@`, `algebra1-student@example.com` |
| `GeometrySeeder` | `course:seed-geometry` | `data/geometry/` (adapted from CC BY 4.0 IM 9–12 Math) | `geo` | `geometry@`, `geometry-student@example.com` |
| `Algebra2Seeder` | `course:seed-algebra-2` | `data/algebra-2/` (adapted from CC BY 4.0 IM 9–12 Math) | `alg2` | `algebra2@`, `algebra2-student@example.com` |

Everything below applies to all of them; AP Biology is the worked example.

`php artisan db:seed --class=ApBiologySeeder` (all five are also called from `DatabaseSeeder`)
builds a full-year course from YAML under
`apps/api/database/seeders/data/ap-biology/` (`course.yaml` = week → unit → CED
topic map, plus the course's title `prefix`, its `slug` and its `attribution_markers`;
`unit-NN-*/week-NN.yaml` = guide path + flashcards + quiz;
`unit-exam.yaml`, `unit-summary.md`; `review/` = practice exam and prep guide).
`Database\Seeders\Curriculum\Course` loads it and composes every title and slug
(`AP Biology · Week 07 · Quiz · …`, `apbio-w07-quiz`) so the library's `sort=title` reads in course
order and two courses never collide. Idempotent through nullable `slug` columns on `tests`, `questions` and
`materials`: a re-run updates in place and questions keep their ids. By default
it creates `apbio@example.com` / `apbio-student@example.com`, connects them, and
assigns every test to the student with a due date from `start_date` (null = no
due dates). Those demo accounts get the password `password` only in `local` and
`testing`; anywhere else they get a random one, printed once. It also builds the
`Course` row (slug `apbio`): every item in teaching order under one section per
unit, created **private** — publishing it exposes answers, so that is the
owner's call — and a re-run keeps whatever visibility the owner chose since.

On a real server, attach the course to your own account instead. Deploys run
migrations, never seeders, so this is a one-off shell step per environment:

```bash
php artisan course:seed-ap-biology --teacher=you@example.com --no-student --force
php artisan course:seed-ap-us-history --teacher=you@example.com --no-student --force
php artisan course:seed-algebra-1 --teacher=you@example.com --no-student --force
php artisan course:seed-geometry --teacher=you@example.com --no-student --force
php artisan course:seed-algebra-2 --teacher=you@example.com --no-student --force
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
with the demo accounts and creates `test@example.com`: never run it on a server. `CurriculumContentTest` runs
`Curriculum\ContentLint` over every course's data directory (provenance, rationales,
spiral review, duplicates, attribution) and `ApBiologySeederTest` proves idempotency
on `tests/Fixtures/course`. A new course is a `course.yaml`, its data, a
`CurriculumSeeder` subclass, a `SeedCurriculum` command and a row in the lint's
dataset.

AP U.S. History is **original writing**, not adapted: OpenStax *U.S. History* is
now CC BY-NC-SA and bars LLM ingestion, so it is only linked as further reading.
Its quotations are limited to public-domain texts (federal government works,
pre-1931 publications); never quote copyrighted 20th-century private writing
into it. Its guides end with the CED name and `public domain` (its
`attribution_markers`). Each course is 72–74 files: one teacher owning more than
one needs the file cap raised at `/admin/site` (about 75 per course).

The three math courses (Algebra 1, Geometry, Algebra 2) are **adapted** from
IM 9–12 Math by Illustrative Mathematics, © 2019, CC BY 4.0, rewritten in our
own words with original examples and items; their topic codes are IM lesson
numbers (`"2.14"` = Unit 2, Lesson 14) and their guides end with
`Illustrative Mathematics` and `CC BY 4.0`. The IM name and logo are excluded
from that licence: credit IM in attribution text only, never as branding.
OpenStax is no longer usable for new courses (every book is now CC BY-NC-SA
with a no-LLM clause). Math is written in plain Unicode (x², √, π, ≤) because
`rich-text` renders no LaTeX and no HTML; figures are described in words.

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

## Seeded AP Literature course

`php artisan db:seed --class=ApLiteratureSeeder` (also called from
`DatabaseSeeder`) and `php artisan course:seed-ap-literature --teacher=EMAIL
[--student=EMAIL|--no-student] --force` work exactly like their AP Biology
twins (same owner checks, quota check, idempotent slugs, private course row,
slug `aplit`, demo accounts `aplit@example.com` / `aplit-student@example.com`).
The code is a sibling of the Curriculum classes above, not a subclass (it was
written alongside them): `Database\Seeders\ApLiterature\Course`,
`ApLiteratureSeeder`, `SeedApLiterature`, its own lint, and its own row in
`DatabaseSeeder`'s call list. Data lives under
`apps/api/database/seeders/data/ap-literature/`, same layout as AP Biology,
nine units in the CED order (Short Fiction / Poetry / Longer Fiction or Drama,
three times) over 32 weeks plus an exam-prep guide (week 33) and a practice
exam shaped like the real one (55 MC in five passage sets, then three 6-point
essays). It is 74 files against the per-teacher cap, so one teacher owning
it and another seeded course needs the cap raised accordingly (147 with AP
Biology).

Two differences from biology. The literature CED has skills, not numbered
topics, so a `topic_code` is a CED skill code (`1.A` ... `7.E`, listed once
under `skills` in `course.yaml`; each unit lists the skills the CED gives it;
each week's `topics` are its focus skills). And every quoted text must be in
the US public domain: week files list their `texts` with year and a link, an
item's `source` carries the work's year in parentheses (or is `general
knowledge`), and the lint rejects anything after
`Lint::PUBLIC_DOMAIN_THROUGH` (1930; bump it each January). The lint lives in
`Database\Seeders\ApLiterature\Lint`, not the test, so it can run on one
unit (`(new Lint($course))->run([3])`); `ApLiteratureContentTest` runs it over
everything.

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
- Feature branches start from `dev` and PR into `dev`; `master` only ever
  receives `dev`, through a dev -> master PR merged with **a merge commit, never
  squash** — a squash leaves `master` with commits `dev` lacks, and the next
  dev -> master PR reports conflicts on identical trees.
- Don't commit into `docs/` or `.superpowers/` expecting them to travel; both
  are gitignored.

## Deploys

Push to `dev` -> staging, push to `master` -> production. Both gated on CI
(`needs: [api, web]` in the single `.github/workflows/ci.yml`). There is no
manual trigger — a push is the only way to deploy, and merging a PR into either
branch is a push.

The deploy runs migrations (`migrate --force`) and recreates the
`public/storage` symlink (`storage:link --force`, deliberately not `|| true` —
a permissions failure there 404s every avatar behind an otherwise green deploy).

**Deploys have been on hold by standing instruction. Confirm with the user
before pushing or merging into either branch.** Check `git log
origin/master..origin/dev` first — that is what production is missing, and it
has accumulated in large batches before.
