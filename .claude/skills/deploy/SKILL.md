---
name: deploy
description: Ship 24 Hour Classroom to staging or production, and diagnose why a change isn't live. Use whenever the user says "deploy", "push to staging", "release", "ship it", "why isn't this on the site", "the live site looks wrong/old", or asks what is currently deployed. A push to `dev` or `master` IS the deploy — there is no separate trigger — so treat any request to push either branch as a deploy request and follow this skill.
---

# Deploying 24 Hour Classroom

Pushing is the deploy. `.github/workflows/ci.yml` runs on
`push: branches: [dev, master]` — `dev` -> staging, `master` -> production —
and there is no manual dispatch. So a push to either branch is an outward-facing
action against a live environment, not a routine git operation.

## Before you push anything

**Deploys have been on hold by standing instruction.** Confirm with the user
before pushing or merging into either branch, every time. Approval to deploy
`dev` is not approval to deploy `master`.

## How a change reaches each environment

- **Staging:** a feature branch (cut from `origin/dev`) is merged into `dev`
  through a PR. The merge is the deploy.
- **Production:** a PR from `dev` into `master`, merged with **"Create a merge
  commit"** — never squash. A squash gives `master` commits `dev` doesn't have,
  and the next dev -> master PR then reports conflicts on identical trees.

Production lags staging in large batches, so a "small change" can carry a great
deal with it. Look at what you'd actually be shipping:

```bash
git fetch origin --prune
git log --oneline origin/master..origin/dev     # what production is missing
git diff --name-only --diff-filter=A <base>..<head> -- apps/api/database/migrations/
```

`<base>..<head>` is `origin/dev..<feature-branch>` for staging and
`origin/master..origin/dev` for production. Migrations run automatically with
`--force`, so that diff is what tells you whether this deploy touches the
database.

Never force-push `dev` or `master`. If a dev -> master PR reports conflicts,
stop and tell the user rather than resolving it on `master`.

## Watch the run

```bash
gh run list --branch dev --limit 3
gh run watch <run-id> --exit-status
```

`deploy` needs `[api, web]`, so test failures stop it before anything touches
the server. Historically green runs take ~2 minutes for CI plus the deploy job.

Two steps deserve attention:

- **`storage:link --force`** — this recreates the `public/storage` symlink that
  the deploy's own `rsync --delete` removes each time. It used to be masked with
  `|| true`; that mask was removed deliberately, because a permissions failure
  here 404s every avatar behind an otherwise green deploy.
- **`migrate --force`** — cross-check what ran against the migration list you
  pulled above.

## Verify the deploy, don't trust the checkmark

A green run means the commands exited 0, not that the site is right.

```bash
curl -sS -o /dev/null -w "%{http_code}\n" https://dev.24hourclassroom.com/
curl -sS https://api-dev.24hourclassroom.com/api/site        # proves new code + migrations
curl -sS -o /dev/null -w "%{http_code}\n" https://api-dev.24hourclassroom.com/up
```

Then load it in a browser and look at it (see the `run-local` skill for the
driving recipe). A 200 proves the server answered; only the pixels prove the
build is the one you shipped.

**Don't fingerprint a deploy by grepping the HTML for `app.css` or component
names.** The dev server and the production build differ: `stencil build`
content-hashes the global stylesheet (`/build/p-<hash>.css`) and moves the
component manifest into an external bundle, so both greps return zero on a
perfectly good production deploy. Grep for something stable instead — the
inline theme boot script (`24hc.theme.v1`) is present in every build — or just
fetch `/build/app.css` and check for a 200.

## Diagnosing "it's not live"

Check in this order; the first is almost always the answer.

1. **Was it pushed?** `git log --oneline origin/<branch>..<branch>`. If the
   remote branch is behind, nothing failed — nothing was attempted.
2. **Did a run happen?** `gh run list --limit 10`. An empty list looks nothing
   like a red X: no push means no run at all.
3. **Did the run fail?** `gh run view <id> --log-failed`.
4. **Is the served build stale?** Compare the live HTML against a local
   production build, using a stable marker as above.

## Environment configuration

The server paths, hosts, database names, and the `ENV_FILE` / `PHP_BIN` details
are deliberately not recorded in this repo — it is public. They live in the
user's own notes. If a deploy fails on configuration rather than code, ask
rather than guessing, and never paste those values into a tracked file.
