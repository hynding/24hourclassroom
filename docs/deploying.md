# Deploying to Dreamhost

## One-time Dreamhost setup

1. **Sites** (Panel → Manage Websites), all with HTTPS via Let's Encrypt:
   - `24hourclassroom.com` — web dir set to the Stencil deploy path (e.g. `~/sites/24hourclassroom.com`)
   - `api.24hourclassroom.com` — web dir set to `<API_PATH>/public`
   - `dev.24hourclassroom.com` and `api-dev.24hourclassroom.com` — same pattern for staging
2. **PHP version**: set every api site to PHP 8.3 (matches CI-built `vendor/`). If the
   shell's default `php` differs, set the `PHP_BIN` variable below to e.g.
   `/usr/local/php83/bin/php`.
3. **MySQL** (Panel → MySQL Databases): create `24hc_prod` and `24hc_staging`
   databases with their own users. For local external-DB development, add your IP
   under the DB user's "Allowable Hosts".
4. **SSH**: create a shell user, add a dedicated deploy keypair; the private key
   becomes the `DEPLOY_SSH_KEY` secret.

## GitHub configuration

Create environments `staging` (deploys `dev`) and `production` (deploys `master`).

Secrets per environment:

| Secret | Example (staging) |
|---|---|
| `DEPLOY_HOST` | `iad1-shared-x.dreamhost.com` |
| `DEPLOY_USER` | `deployuser` |
| `DEPLOY_SSH_KEY` | private key content |
| `API_PATH` | `/home/deployuser/sites/api-dev.24hourclassroom.com/app` |
| `WEB_PATH` | `/home/deployuser/sites/dev.24hourclassroom.com` |
| `ENV_FILE` | full Laravel `.env` content (see below) |

Variables per environment: `API_BASE_URL` (e.g. `https://api-dev.24hourclassroom.com`),
`PHP_BIN` (optional, default `php`).

## ENV_FILE contents

Base it on `apps/api/.env.example` with per-environment values. Critical entries:

- `APP_KEY` — generate ONCE per environment (`php artisan key:generate --show`) and never rotate in deploys.
- `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://api.24hourclassroom.com`
- `DB_*` — the Dreamhost MySQL hostname/database/user for that environment.
- `SESSION_DOMAIN=.24hourclassroom.com`, `SESSION_SECURE_COOKIE=true`
- `SESSION_COOKIE=24hc_session` (production) / `24hc_dev_session` (staging) — prevents
  staging/production cookie collisions on the shared parent domain.
- `FRONTEND_URLS=https://24hourclassroom.com` (staging: `https://dev.24hourclassroom.com`)
- `SANCTUM_STATEFUL_DOMAINS=24hourclassroom.com` (staging: `dev.24hourclassroom.com`)
- `QUEUE_CONNECTION=sync`
- `MAIL_*` — production: real SMTP (Dreamhost mail or transactional provider); staging: `MAIL_MAILER=log`.

## Google OAuth + SMTP (added with SPA-native auth)

1. **Google Cloud Console** → Credentials → OAuth 2.0 Client ID (Web application) with authorized
   redirect URIs:
   - `http://localhost:8000/auth/google/callback`
   - `https://api-dev.24hourclassroom.com/auth/google/callback`
   - `https://api.24hourclassroom.com/auth/google/callback`
   Put the client id/secret into `apps/api/.env` (local) and both deployment env files.
2. **Dreamhost mailbox**: create `no-reply@24hourclassroom.com` (Panel → Mail). Its SMTP password
   goes into `apps/api/.env.production`.
3. Re-upload both secrets after filling values:
   `gh secret set ENV_FILE --env staging < apps/api/.env.staging`
   `gh secret set ENV_FILE --env production < apps/api/.env.production`
