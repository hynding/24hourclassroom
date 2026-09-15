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
before pushing either branch, every time. Approval to push `dev` is not
approval to push `master`.

Unpushed work accumulates here in large batches — at one point `master` sat 115
commits ahead across four days — so a "small change" can carry a great deal with
it. Always look at what you'd actually be shipping:

```bash
git fetch origin --prune
git log --oneline origin/master..master | wc -l
git diff --name-only --diff-filter=A origin/<branch>..<branch> -- apps/api/database/migrations/
```

Migrations run automatically with `--force`, so that second command is the one
that tells you whether this deploy touches the database.

## Verify the push is a fast-forward

Local `dev` has been stale and behind `origin/dev` before. Check that moving it
loses nothing and that the push won't need a force:

```bash
git log --oneline master..dev            # expect empty: no unique work on dev
git merge-base --is-ancestor origin/dev master && echo "ff-safe"
```

Only when both pass:

```bash
git branch -f dev master
git push origin dev
```

If either check fails, stop and tell the user — never reach for `--force` to
get past it.

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
