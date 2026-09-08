# 24hourclassroom Monorepo Restructure Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Restructure the repo into `apps/` + `packages/`, switch to MySQL, add a Stencil web app with a typed API client, run everything locally via Docker (local or external DB), and deploy `dev`/`master` to Dreamhost via GitHub Actions.

**Architecture:** Laravel 12 (`apps/api`) is a hybrid API + Inertia auth/admin app using Sanctum SPA cookie auth. A hand-scaffolded Stencil 4 SPA (`apps/web`) consumes it through `packages/api-client` (which owns the CSRF handshake) with shared types in `packages/shared`. Docker Compose runs api/web plus an opt-in `localdb` MySQL profile. CI tests both stacks; deploys rsync CI-built artifacts to Dreamhost (no server-side builds).

**Tech Stack:** PHP 8.3, Laravel 12, Sanctum, Pest, MySQL 8.4, Stencil 4, TypeScript 5, Vitest, npm workspaces, Docker Compose, GitHub Actions, rsync/SSH.

**Spec:** `docs/superpowers/specs/2026-09-08-monorepo-restructure-design.md`

## Global Constraints

- PHP is pinned to **8.3** in Docker and CI (Dreamhost must run 8.3 to match rsynced `vendor/`).
- Node **22** everywhere (Docker, CI).
- MySQL **8.4**; databases `24hourclassroom` (dev) and `24hourclassroom_test` (tests). MySQL DB names starting with digits must be backtick-quoted in raw SQL.
- `QUEUE_CONNECTION=sync` in every environment. Cache and sessions use `database` drivers.
- No closures in any route file (route:cache must succeed).
- Composer/npm never run on the Dreamhost server.
- Deploy rsync of the Laravel app always excludes `.env` and `storage/`.
- Workspace package names use the `@24hc/` scope. `apps/api` stays OUTSIDE npm workspaces.
- Working directory for all commands is the repo root unless the step says otherwise.
- The old top-level `packages/laravel` and `packages/nextjs` are untracked (never committed), so moves are plain `mv`, not `git mv`.

---

### Task 1: Repo layout — apps/, workspaces, delete Next.js

**Files:**
- Move: `packages/laravel` → `apps/api`
- Delete: `packages/nextjs/`, `Dockerfile`, `docker-compose.yml`, `.env` (empty file at root)
- Create: `package.json` (root)
- Modify: `.gitignore` (root)

**Interfaces:**
- Produces: `apps/api/` (the Laravel app; all later Laravel tasks run inside it), root npm workspaces covering `apps/web` and `packages/*`.

- [ ] **Step 1: Move Laravel, delete Next.js and stale root files**

```bash
mkdir -p apps
mv packages/laravel apps/api
rm -rf packages/nextjs
rm -f Dockerfile docker-compose.yml .env
```

- [ ] **Step 2: Create root package.json with workspaces**

Create `package.json`:

```json
{
  "name": "24hourclassroom",
  "private": true,
  "workspaces": [
    "apps/web",
    "packages/*"
  ],
  "scripts": {
    "build": "npm run build -w @24hc/shared && npm run build -w @24hc/api-client && npm run build -w @24hc/web",
    "test": "npm run test -w @24hc/api-client && npm run test -w @24hc/web"
  }
}
```

(The workspaces it names are created in Tasks 6–8; `npm install` tolerates the scripts referencing not-yet-existing workspaces as long as we don't run them yet.)

- [ ] **Step 3: Append monorepo entries to root .gitignore**

Append to `.gitignore`:

```gitignore

# Monorepo build output
apps/web/www/
apps/web/.stencil/
packages/*/dist/
apps/api/vendor/
apps/api/node_modules/
apps/api/public/build/
apps/api/.env
```

(`apps/api` has its own `.gitignore` too; the root entries make intent visible at the top level.)

- [ ] **Step 4: Verify Laravel still runs from its new home**

Run: `cd apps/api && php artisan --version`
Expected: prints `Laravel Framework 12.x`.

Run: `ls packages/ 2>/dev/null || echo "packages empty"`
Expected: no `laravel`/`nextjs` directories remain.

- [ ] **Step 5: Commit**

```bash
git add -A
git commit -m "refactor: move Laravel to apps/api, drop Next.js starter, add npm workspaces root"
```

---

### Task 2: MySQL everywhere (env, phpunit, tests green on MySQL)

**Files:**
- Modify: `apps/api/.env.example`, `apps/api/phpunit.xml`
- Delete: `apps/api/database/database.sqlite`

**Interfaces:**
- Produces: env contract `DB_CONNECTION=mysql`, `DB_HOST/DB_PORT/DB_DATABASE/DB_USERNAME/DB_PASSWORD`; test DB `24hourclassroom_test` reachable at `127.0.0.1:3306` (root/secret) for local + CI test runs.

- [ ] **Step 1: Update apps/api/.env.example database + env-mode docs**

In `apps/api/.env.example`, replace the block

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

with

```env
# --- Database (MySQL everywhere) ---
# Local Docker DB:   docker compose --profile localdb up   → DB_HOST=mysql (inside compose) or 127.0.0.1 (from the host)
# External DB:       point DB_HOST at your hosted MySQL (e.g. mysql.example.dreamhosters.com).
#                    Dreamhost external access requires allowlisting your IP:
#                    Panel → MySQL Databases → user → "Allowable Hosts".
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=24hourclassroom
DB_USERNAME=root
DB_PASSWORD=secret
```

Also in `apps/api/.env.example`: change `QUEUE_CONNECTION=database` to `QUEUE_CONNECTION=sync`, and append after the `VITE_APP_NAME` line:

```env

# Comma-separated origins allowed for CORS + post-login redirects (no trailing slashes)
FRONTEND_URLS=http://localhost:3333
SANCTUM_STATEFUL_DOMAINS=localhost:3333,localhost:8000
# Production only: SESSION_DOMAIN=.24hourclassroom.com  SESSION_COOKIE=24hc_session  SESSION_SECURE_COOKIE=true
```

- [ ] **Step 2: Point the test suite at MySQL**

In `apps/api/phpunit.xml`, replace

```xml
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
```

with

```xml
        <env name="DB_CONNECTION" value="mysql"/>
        <env name="DB_HOST" value="127.0.0.1"/>
        <env name="DB_PORT" value="3306"/>
        <env name="DB_DATABASE" value="24hourclassroom_test"/>
        <env name="DB_USERNAME" value="root"/>
        <env name="DB_PASSWORD" value="secret"/>
```

- [ ] **Step 3: Delete the SQLite file and sync local .env**

```bash
rm -f apps/api/database/database.sqlite
cd apps/api && cp .env.example .env && php artisan key:generate
```

- [ ] **Step 4: Start a throwaway MySQL and run the full test suite against it**

```bash
docker run -d --name 24hc-mysql -e MYSQL_ROOT_PASSWORD=secret \
  -e MYSQL_DATABASE=24hourclassroom_test -p 3306:3306 mysql:8.4
until docker exec 24hc-mysql mysqladmin ping -psecret --silent 2>/dev/null; do sleep 2; done
docker exec 24hc-mysql mysql -uroot -psecret -e 'CREATE DATABASE IF NOT EXISTS `24hourclassroom`;'
cd apps/api && npm ci && npm run build && php artisan test
```

Expected: all existing Pest tests PASS (auth, dashboard, settings) with `RefreshDatabase` migrating into MySQL. (Leave the container running — Tasks 3–5 reuse it. Assets are built because the Inertia pages reference the Vite manifest.)

- [ ] **Step 5: Commit**

```bash
git add -A
git commit -m "feat: switch database to MySQL for app and test suite"
```

---

### Task 3: Route cacheability (no closures in route files)

**Files:**
- Modify: `apps/api/routes/web.php`, `apps/api/routes/settings.php`

**Interfaces:**
- Consumes: route names `home`, `dashboard`, `appearance` (used by Inertia pages and tests — names must not change).
- Produces: `php artisan route:cache` succeeds; CI (Task 10) runs it as a gate.

- [ ] **Step 1: Replace closures with Route::inertia**

Replace the whole of `apps/api/routes/web.php` with:

```php
<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
```

In `apps/api/routes/settings.php`, replace

```php
    Route::get('settings/appearance', function () {
        return Inertia::render('settings/appearance');
    })->name('appearance');
```

with

```php
    Route::inertia('settings/appearance', 'settings/appearance')->name('appearance');
```

and delete the now-unused `use Inertia\Inertia;` import line from `settings.php`.

(The `->middleware(['auth','verified'])` group wrapper still applies; `Route::inertia` registers a cacheable controller route. `routes/auth.php` is already all controller references.)

- [ ] **Step 2: Verify route cache round-trips and tests still pass**

Run (in `apps/api`): `php artisan route:cache && php artisan route:clear && php artisan test`
Expected: `route:cache` prints "Routes cached successfully", tests PASS.

- [ ] **Step 3: Commit**

```bash
git add -A
git commit -m "refactor: make all routes cacheable (no closures)"
```

---

### Task 4: Sanctum SPA auth, CORS, /api/user endpoint

**Files:**
- Create: `apps/api/config/cors.php`, `apps/api/app/Http/Controllers/Api/UserController.php`, `apps/api/tests/Feature/Api/UserEndpointTest.php`
- Modify: `apps/api/composer.json` (via artisan install:api), `apps/api/bootstrap/app.php`, `apps/api/routes/api.php`, `apps/api/config/app.php`

**Interfaces:**
- Consumes: env vars `FRONTEND_URLS`, `SANCTUM_STATEFUL_DOMAINS` from Task 2.
- Produces: `GET /api/user` → JSON of the authenticated user (401 otherwise); `GET /sanctum/csrf-cookie`; `config('app.frontend_urls')` (comma-separated string) used again in Task 5.

- [ ] **Step 1: Write the failing feature test**

Create `apps/api/tests/Feature/Api/UserEndpointTest.php`:

```php
<?php

use App\Models\User;

test('guests get 401 from /api/user', function () {
    $this->getJson('/api/user')->assertUnauthorized();
});

test('authenticated users get their profile from /api/user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->getJson('/api/user')
        ->assertOk()
        ->assertJsonPath('email', $user->email);
});
```

- [ ] **Step 2: Run it to make sure it fails**

Run (in `apps/api`): `php artisan test --filter=UserEndpointTest`
Expected: FAIL — `/api/user` returns 404 (no api routes yet).

- [ ] **Step 3: Install Sanctum + API routing**

Run (in `apps/api`): `php artisan install:api --no-interaction`
This composer-requires `laravel/sanctum`, publishes its migration, creates `routes/api.php`, and registers `api:` routing in `bootstrap/app.php`.

Then replace the contents of `apps/api/routes/api.php` with (no closures — cacheability):

```php
<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', UserController::class);
```

Create `apps/api/app/Http/Controllers/Api/UserController.php`:

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user();
    }
}
```

- [ ] **Step 4: Enable stateful SPA auth**

In `apps/api/bootstrap/app.php`, inside `->withMiddleware(function (Middleware $middleware) {`, add as the first line of the closure:

```php
        $middleware->statefulApi();
```

- [ ] **Step 5: CORS config + frontend_urls config key**

Create `apps/api/config/cors.php`:

```php
<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => array_filter(explode(',', (string) env('FRONTEND_URLS', ''))),
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
```

In `apps/api/config/app.php`, add to the returned array (after the `'url' => env('APP_URL', ...)` entry):

```php
    'frontend_urls' => env('FRONTEND_URLS', ''),
```

- [ ] **Step 6: Run tests and route:cache gate**

Run (in `apps/api`): `php artisan test --filter=UserEndpointTest && php artisan route:cache && php artisan route:clear`
Expected: both tests PASS; route cache still succeeds.

- [ ] **Step 7: Run the whole suite, then commit**

Run (in `apps/api`): `php artisan test`
Expected: PASS.

```bash
git add -A
git commit -m "feat: Sanctum SPA auth with CORS and /api/user endpoint"
```

---

### Task 5: Allowlisted post-login redirect back to the SPA

**Files:**
- Create: `apps/api/app/Support/FrontendRedirect.php`, `apps/api/tests/Unit/FrontendRedirectTest.php`, `apps/api/tests/Feature/Auth/FrontendRedirectFlowTest.php`
- Modify: `apps/api/app/Http/Controllers/Auth/AuthenticatedSessionController.php`

**Interfaces:**
- Consumes: `config('app.frontend_urls')` (Task 4); existing `redirect()->intended(...)` in the login controller.
- Produces: `FrontendRedirect::validate(?string $url): ?string` — returns the URL when its origin is allowlisted, else `null`. GET `/login?redirect=<url>` primes Laravel's `url.intended` session key.

- [ ] **Step 1: Write the failing unit test**

Create `apps/api/tests/Unit/FrontendRedirectTest.php`:

```php
<?php

use App\Support\FrontendRedirect;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com,http://localhost:3333']);
});

test('allows urls on an allowlisted origin', function () {
    expect(FrontendRedirect::validate('https://24hourclassroom.com/lesson-plans'))
        ->toBe('https://24hourclassroom.com/lesson-plans');
    expect(FrontendRedirect::validate('http://localhost:3333/'))
        ->toBe('http://localhost:3333/');
});

test('rejects foreign, malformed, and empty urls', function () {
    expect(FrontendRedirect::validate('https://evil.example/phish'))->toBeNull();
    expect(FrontendRedirect::validate('https://24hourclassroom.com.evil.example/'))->toBeNull();
    expect(FrontendRedirect::validate('javascript:alert(1)'))->toBeNull();
    expect(FrontendRedirect::validate('/relative/path'))->toBeNull();
    expect(FrontendRedirect::validate(null))->toBeNull();
    expect(FrontendRedirect::validate(''))->toBeNull();
});
```

Note: Pest `Unit` tests in this starter don't boot Laravel by default — `tests/Pest.php` applies `TestCase` to `Feature` only. Check `apps/api/tests/Pest.php`; if `config()` is unavailable in Unit tests, extend the `in('Feature')` line to also cover `Unit` (e.g. `->in('Feature', 'Unit')`).

- [ ] **Step 2: Run it to make sure it fails**

Run (in `apps/api`): `php artisan test --filter=FrontendRedirectTest`
Expected: FAIL — class `App\Support\FrontendRedirect` not found.

- [ ] **Step 3: Implement FrontendRedirect**

Create `apps/api/app/Support/FrontendRedirect.php`:

```php
<?php

namespace App\Support;

class FrontendRedirect
{
    /**
     * Return $url when its origin is on the FRONTEND_URLS allowlist, else null.
     */
    public static function validate(?string $url): ?string
    {
        if ($url === null || $url === '') {
            return null;
        }

        $origin = self::origin($url);

        if ($origin === null) {
            return null;
        }

        $allowed = array_filter(explode(',', (string) config('app.frontend_urls')));

        return in_array($origin, $allowed, true) ? $url : null;
    }

    private static function origin(string $url): ?string
    {
        $parts = parse_url($url);

        if (! isset($parts['scheme'], $parts['host']) || ! in_array($parts['scheme'], ['http', 'https'], true)) {
            return null;
        }

        $origin = $parts['scheme'].'://'.$parts['host'];

        if (isset($parts['port'])) {
            $origin .= ':'.$parts['port'];
        }

        return $origin;
    }
}
```

- [ ] **Step 4: Run the unit test — expect PASS**

Run (in `apps/api`): `php artisan test --filter=FrontendRedirectTest`
Expected: PASS.

- [ ] **Step 5: Write the failing feature test for the login flow**

Create `apps/api/tests/Feature/Auth/FrontendRedirectFlowTest.php`:

```php
<?php

use App\Models\User;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com']);
});

test('login redirects back to an allowlisted frontend url', function () {
    $user = User::factory()->create();

    $this->get('/login?redirect='.urlencode('https://24hourclassroom.com/plans'));

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect('https://24hourclassroom.com/plans');
});

test('login ignores a non-allowlisted redirect and lands on the dashboard', function () {
    $user = User::factory()->create();

    $this->get('/login?redirect='.urlencode('https://evil.example/phish'));

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect(route('dashboard', absolute: false));
});
```

- [ ] **Step 6: Run it to make sure it fails**

Run (in `apps/api`): `php artisan test --filter=FrontendRedirectFlowTest`
Expected: the first test FAILS (redirects to `/dashboard`, not the frontend URL).

- [ ] **Step 7: Prime url.intended in the login controller**

In `apps/api/app/Http/Controllers/Auth/AuthenticatedSessionController.php`, add the import

```php
use App\Support\FrontendRedirect;
```

and change `create()` to:

```php
    public function create(Request $request): Response
    {
        if ($redirect = FrontendRedirect::validate($request->query('redirect'))) {
            $request->session()->put('url.intended', $redirect);
        }

        return Inertia::render('auth/login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }
```

(`store()` already calls `redirect()->intended(...)`, which consumes `url.intended` — no change needed there.)

- [ ] **Step 8: Run the full suite, then commit**

Run (in `apps/api`): `php artisan test`
Expected: PASS (including both new files).

```bash
git add -A
git commit -m "feat: allowlisted post-login redirect back to the SPA"
```

---

### Task 6: packages/shared — shared TypeScript types

**Files:**
- Create: `packages/shared/package.json`, `packages/shared/tsconfig.json`, `packages/shared/src/index.ts`

**Interfaces:**
- Produces: npm package `@24hc/shared` exporting `interface User { id, name, email, email_verified_at }`, `type Role = 'teacher' | 'student'`, `type Visibility = 'private' | 'connections' | 'public'`. Built to `dist/` by `npm run build -w @24hc/shared`.

- [ ] **Step 1: Create the package**

Create `packages/shared/package.json`:

```json
{
  "name": "@24hc/shared",
  "version": "0.1.0",
  "private": true,
  "type": "module",
  "main": "dist/index.js",
  "types": "dist/index.d.ts",
  "scripts": {
    "build": "tsc"
  },
  "devDependencies": {
    "typescript": "^5.7.2"
  }
}
```

Create `packages/shared/tsconfig.json`:

```json
{
  "compilerOptions": {
    "target": "es2020",
    "module": "esnext",
    "moduleResolution": "bundler",
    "declaration": true,
    "outDir": "dist",
    "strict": true,
    "skipLibCheck": true
  },
  "include": ["src"]
}
```

Create `packages/shared/src/index.ts`:

```ts
export type Role = 'teacher' | 'student';

export type Visibility = 'private' | 'connections' | 'public';

export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string | null;
}
```

- [ ] **Step 2: Install and build**

Run: `npm install && npm run build -w @24hc/shared`
Expected: `packages/shared/dist/index.js` and `index.d.ts` exist; no compiler errors.

- [ ] **Step 3: Commit**

```bash
git add -A
git commit -m "feat: add @24hc/shared types package"
```

---

### Task 7: packages/api-client — typed client with Sanctum handshake

**Files:**
- Create: `packages/api-client/package.json`, `packages/api-client/tsconfig.json`, `packages/api-client/src/index.ts`, `packages/api-client/test/api-client.test.ts`

**Interfaces:**
- Consumes: `@24hc/shared` `User` type; server endpoints `GET /sanctum/csrf-cookie`, `GET /api/user` (Task 4).
- Produces: `@24hc/api-client` exporting `class ApiClient { constructor(opts: { baseUrl: string; fetchFn?: typeof fetch }); get<T>(path): Promise<T>; post<T>(path, body?): Promise<T>; currentUser(): Promise<User | null> }` and `class ApiError extends Error { status: number }`.

- [ ] **Step 1: Create package scaffolding**

Create `packages/api-client/package.json`:

```json
{
  "name": "@24hc/api-client",
  "version": "0.1.0",
  "private": true,
  "type": "module",
  "main": "dist/index.js",
  "types": "dist/index.d.ts",
  "scripts": {
    "build": "tsc",
    "test": "vitest run"
  },
  "dependencies": {
    "@24hc/shared": "*"
  },
  "devDependencies": {
    "typescript": "^5.7.2",
    "vitest": "^3.0.0"
  }
}
```

Create `packages/api-client/tsconfig.json`:

```json
{
  "compilerOptions": {
    "target": "es2020",
    "module": "esnext",
    "moduleResolution": "bundler",
    "declaration": true,
    "outDir": "dist",
    "strict": true,
    "skipLibCheck": true,
    "lib": ["es2020", "dom"]
  },
  "include": ["src"]
}
```

- [ ] **Step 2: Write the failing tests**

Create `packages/api-client/test/api-client.test.ts`:

```ts
import { describe, expect, it, vi } from 'vitest';
import { ApiClient, ApiError } from '../src/index';

const jsonResponse = (status: number, body: unknown) =>
  new Response(JSON.stringify(body), {
    status,
    headers: { 'Content-Type': 'application/json' },
  });

describe('ApiClient', () => {
  it('GETs JSON with credentials included', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(200, { ok: true }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    const result = await client.get<{ ok: boolean }>('/api/ping');

    expect(result).toEqual({ ok: true });
    expect(fetchFn).toHaveBeenCalledWith(
      'https://api.test/api/ping',
      expect.objectContaining({ method: 'GET', credentials: 'include' }),
    );
  });

  it('fetches the CSRF cookie exactly once before the first POST', async () => {
    const fetchFn = vi
      .fn()
      .mockResolvedValue(jsonResponse(200, {}));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await client.post('/api/a', { x: 1 });
    await client.post('/api/b', { x: 2 });

    const urls = fetchFn.mock.calls.map((c) => c[0]);
    expect(urls.filter((u) => u === 'https://api.test/sanctum/csrf-cookie')).toHaveLength(1);
    expect(urls[0]).toBe('https://api.test/sanctum/csrf-cookie');
  });

  it('throws ApiError with the status on failure', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(422, { message: 'nope' }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });

    await expect(client.get('/api/thing')).rejects.toSatisfy(
      (e: unknown) => e instanceof ApiError && e.status === 422,
    );
  });

  it('currentUser returns null on 401 and the user on 200', async () => {
    const fetchFn = vi.fn().mockResolvedValue(jsonResponse(401, { message: 'unauthenticated' }));
    const client = new ApiClient({ baseUrl: 'https://api.test', fetchFn });
    expect(await client.currentUser()).toBeNull();

    const user = { id: 1, name: 'T', email: 't@example.com', email_verified_at: null };
    const fetchFn2 = vi.fn().mockResolvedValue(jsonResponse(200, user));
    const client2 = new ApiClient({ baseUrl: 'https://api.test', fetchFn: fetchFn2 });
    expect(await client2.currentUser()).toEqual(user);
  });
});
```

- [ ] **Step 3: Run tests to verify they fail**

Run: `npm install && npm run test -w @24hc/api-client`
Expected: FAIL — `../src/index` doesn't exist.

- [ ] **Step 4: Implement the client**

Create `packages/api-client/src/index.ts`:

```ts
import type { User } from '@24hc/shared';

export interface ApiClientOptions {
  baseUrl: string;
  fetchFn?: typeof fetch;
}

export class ApiError extends Error {
  constructor(
    public readonly status: number,
    message: string,
  ) {
    super(message);
    this.name = 'ApiError';
  }
}

export class ApiClient {
  private csrfReady = false;

  constructor(private readonly opts: ApiClientOptions) {}

  private get fetchFn(): typeof fetch {
    return this.opts.fetchFn ?? fetch.bind(globalThis);
  }

  async get<T>(path: string): Promise<T> {
    return this.request<T>('GET', path);
  }

  async post<T>(path: string, body?: unknown): Promise<T> {
    await this.ensureCsrf();
    return this.request<T>('POST', path, body);
  }

  async currentUser(): Promise<User | null> {
    try {
      return await this.get<User>('/api/user');
    } catch (e) {
      if (e instanceof ApiError && (e.status === 401 || e.status === 419)) {
        return null;
      }
      throw e;
    }
  }

  private async ensureCsrf(): Promise<void> {
    if (this.csrfReady) {
      return;
    }
    await this.fetchFn(`${this.opts.baseUrl}/sanctum/csrf-cookie`, { credentials: 'include' });
    this.csrfReady = true;
  }

  private readXsrfToken(): string | null {
    if (typeof document === 'undefined') {
      return null;
    }
    const match = document.cookie.match(/(?:^|;\s*)XSRF-TOKEN=([^;]+)/);
    return match ? decodeURIComponent(match[1]) : null;
  }

  private async request<T>(method: string, path: string, body?: unknown): Promise<T> {
    const headers: Record<string, string> = { Accept: 'application/json' };
    if (body !== undefined) {
      headers['Content-Type'] = 'application/json';
    }
    const token = this.readXsrfToken();
    if (token) {
      headers['X-XSRF-TOKEN'] = token;
    }

    const res = await this.fetchFn(`${this.opts.baseUrl}${path}`, {
      method,
      credentials: 'include',
      headers,
      body: body === undefined ? undefined : JSON.stringify(body),
    });

    if (!res.ok) {
      throw new ApiError(res.status, `${method} ${path} failed with status ${res.status}`);
    }

    return res.status === 204 ? (undefined as T) : ((await res.json()) as T);
  }
}
```

- [ ] **Step 5: Run tests to verify they pass, and build**

Run: `npm run test -w @24hc/api-client && npm run build -w @24hc/api-client`
Expected: 4 tests PASS; `packages/api-client/dist/` produced.

- [ ] **Step 6: Commit**

```bash
git add -A
git commit -m "feat: add @24hc/api-client with Sanctum CSRF handshake"
```

---

### Task 8: apps/web — Stencil SPA shell

**Files:**
- Create: `apps/web/package.json`, `apps/web/stencil.config.ts`, `apps/web/tsconfig.json`, `apps/web/src/index.html`, `apps/web/src/global/app.css`, `apps/web/src/assets/.htaccess`, `apps/web/src/components/app-root/app-root.tsx`, `apps/web/src/components/app-header/app-header.tsx`, `apps/web/src/components/app-footer/app-footer.tsx`, `apps/web/src/components/page-home/page-home.tsx`, `apps/web/src/components/page-home/page-home.spec.ts`

**Interfaces:**
- Consumes: `Env.apiBaseUrl` (build-time, from `API_BASE_URL` env var, default `http://localhost:8000`); Laravel `GET /login?redirect=` (Task 5).
- Produces: static build in `apps/web/www/` (deployed as the site docroot), `npm run dev -w @24hc/web` dev server on port 3333.

- [ ] **Step 1: Package + config**

Create `apps/web/package.json`:

```json
{
  "name": "@24hc/web",
  "version": "0.1.0",
  "private": true,
  "scripts": {
    "build": "stencil build",
    "dev": "stencil build --dev --watch --serve",
    "test": "stencil test --spec"
  },
  "dependencies": {
    "@24hc/api-client": "*",
    "@24hc/shared": "*",
    "@stencil/core": "^4.27.0"
  },
  "devDependencies": {
    "@types/jest": "^29.5.14",
    "jest": "^29.7.0",
    "jest-cli": "^29.7.0"
  }
}
```

Create `apps/web/stencil.config.ts`:

```ts
import { Config } from '@stencil/core';

export const config: Config = {
  namespace: 'app',
  globalStyle: 'src/global/app.css',
  env: {
    apiBaseUrl: process.env.API_BASE_URL ?? 'http://localhost:8000',
  },
  devServer: {
    // 0.0.0.0 so the dev server is reachable from outside its Docker container
    address: '0.0.0.0',
    port: 3333,
  },
  outputTargets: [
    {
      type: 'www',
      serviceWorker: null,
      copy: [{ src: 'assets/.htaccess', dest: '.htaccess' }],
    },
  ],
};
```

Create `apps/web/tsconfig.json`:

```json
{
  "compilerOptions": {
    "allowSyntheticDefaultImports": true,
    "experimentalDecorators": true,
    "lib": ["dom", "es2020"],
    "module": "esnext",
    "moduleResolution": "node",
    "target": "es2020",
    "jsx": "react",
    "jsxFactory": "h",
    "jsxFragmentFactory": "Fragment"
  },
  "include": ["src"],
  "exclude": ["node_modules"]
}
```

- [ ] **Step 2: Static shell files**

Create `apps/web/src/index.html`:

```html
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>24 Hour Classroom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Teachers and students creating and sharing lesson plans, homework, study materials, and more." />
    <script type="module" src="/build/app.esm.js"></script>
  </head>
  <body>
    <app-root></app-root>
  </body>
</html>
```

Create `apps/web/src/global/app.css`:

```css
:root {
  --color-ink: #1c2733;
  --color-paper: #fdfcf8;
  --color-accent: #1f6f54;
  font-family: Georgia, 'Times New Roman', serif;
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  color: var(--color-ink);
  background: var(--color-paper);
}
```

Create `apps/web/src/assets/.htaccess`:

```apacheconf
Options -MultiViews
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.html [QSA,L]
```

- [ ] **Step 3: Write the failing spec test**

Create `apps/web/src/components/page-home/page-home.spec.ts`:

```ts
import { newSpecPage } from '@stencil/core/testing';
import { PageHome } from './page-home';

describe('page-home', () => {
  it('renders the landing headline', async () => {
    const page = await newSpecPage({
      components: [PageHome],
      html: '<page-home></page-home>',
    });
    expect(page.root.textContent).toContain('24 Hour Classroom');
  });
});
```

- [ ] **Step 4: Run it to make sure it fails**

Run: `npm install && npm run test -w @24hc/web`
Expected: FAIL — `./page-home` module not found.

- [ ] **Step 5: Implement the components**

Create `apps/web/src/components/page-home/page-home.tsx`:

```tsx
import { Component, h } from '@stencil/core';

@Component({ tag: 'page-home', shadow: true })
export class PageHome {
  render() {
    return (
      <section>
        <h1>24 Hour Classroom</h1>
        <p>
          A place for teachers to connect with other teachers and students — creating and sharing
          lesson plans, homework, study materials, practice tests, and reports.
        </p>
      </section>
    );
  }
}
```

Create `apps/web/src/components/app-header/app-header.tsx`:

```tsx
import { Component, Env, h } from '@stencil/core';

@Component({ tag: 'app-header', shadow: true })
export class AppHeader {
  private get signInUrl(): string {
    const redirect = encodeURIComponent(window.location.origin);
    return `${Env.apiBaseUrl}/login?redirect=${redirect}`;
  }

  render() {
    return (
      <header>
        <a href="/">24 Hour Classroom</a>
        <nav>
          <a href={this.signInUrl}>Sign in</a>
        </nav>
      </header>
    );
  }
}
```

Create `apps/web/src/components/app-footer/app-footer.tsx`:

```tsx
import { Component, h } from '@stencil/core';

@Component({ tag: 'app-footer', shadow: true })
export class AppFooter {
  render() {
    return (
      <footer>
        <p>© 24 Hour Classroom</p>
      </footer>
    );
  }
}
```

Create `apps/web/src/components/app-root/app-root.tsx` (minimal History-API router — the spec deliberately avoids the deprecated stencil-router):

```tsx
import { Component, h, State } from '@stencil/core';

@Component({ tag: 'app-root', shadow: true })
export class AppRoot {
  @State() path: string = window.location.pathname;

  private onPopState = () => {
    this.path = window.location.pathname;
  };

  connectedCallback() {
    window.addEventListener('popstate', this.onPopState);
  }

  disconnectedCallback() {
    window.removeEventListener('popstate', this.onPopState);
  }

  render() {
    return (
      <div>
        <app-header></app-header>
        <main>{this.renderPage()}</main>
        <app-footer></app-footer>
      </div>
    );
  }

  private renderPage() {
    switch (this.path) {
      default:
        return <page-home></page-home>;
    }
  }
}
```

- [ ] **Step 6: Run spec test and production build**

Run: `npm run test -w @24hc/web && npm run build -w @24hc/web`
Expected: spec test PASSES; `apps/web/www/index.html` and `apps/web/www/.htaccess` exist after the build.

- [ ] **Step 7: Commit**

```bash
git add -A
git commit -m "feat: add Stencil web app shell with landing page and auth handoff link"
```

---

### Task 9: Docker Compose — api, web, opt-in localdb

**Files:**
- Create: `docker-compose.yml`, `docker/php/Dockerfile`, `docker/php/entrypoint.sh`, `docker/web/Dockerfile`, `docker/mysql/init.sql`, `.env.example` (root)

**Interfaces:**
- Consumes: `apps/api/.env` (Laravel env; `DB_HOST=mysql` for localdb mode), root `.env` for host port mapping.
- Produces: `docker compose --profile localdb up` (bundled DB) and `docker compose up` (external DB) both work; api on `http://localhost:8000`, web on `http://localhost:3333`.

- [ ] **Step 1: PHP image + entrypoint**

Create `docker/php/Dockerfile`:

```dockerfile
FROM php:8.3-cli-alpine

RUN docker-php-ext-install pdo_mysql bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY docker/php/entrypoint.sh /usr/local/bin/app-entrypoint.sh
RUN chmod +x /usr/local/bin/app-entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["app-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
```

Create `docker/php/entrypoint.sh`:

```sh
#!/bin/sh
set -e

# Wait for whichever DB_HOST is configured (local container or external host).
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database at ${DB_HOST}:${DB_PORT:-3306}..."
  until php -r 'exit(@fsockopen(getenv("DB_HOST"), (int) (getenv("DB_PORT") ?: 3306)) ? 0 : 1);'; do
    sleep 2
  done
fi

composer install --no-interaction
php artisan migrate --force

exec "$@"
```

- [ ] **Step 2: Web image**

Create `docker/web/Dockerfile`:

```dockerfile
FROM node:22-alpine

WORKDIR /workspace

CMD ["sh", "-c", "npm install && npm run build -w @24hc/shared && npm run build -w @24hc/api-client && npm run dev -w @24hc/web"]
```

- [ ] **Step 3: MySQL init script (test database)**

Create `docker/mysql/init.sql`:

```sql
CREATE DATABASE IF NOT EXISTS `24hourclassroom_test`;
```

- [ ] **Step 4: Compose file + root .env.example**

Create `docker-compose.yml`:

```yaml
services:
  api:
    build:
      context: .
      dockerfile: docker/php/Dockerfile
    ports:
      - "${API_PORT:-8000}:8000"
    env_file:
      - apps/api/.env
    volumes:
      - ./apps/api:/var/www/html

  web:
    build:
      context: .
      dockerfile: docker/web/Dockerfile
    ports:
      - "${WEB_PORT:-3333}:3333"
    environment:
      - API_BASE_URL=${API_BASE_URL:-http://localhost:8000}
    volumes:
      - ./:/workspace

  # Opt-in local database: docker compose --profile localdb up
  # The api service has NO depends_on for mysql — in external-DB mode this
  # service doesn't exist, and the api entrypoint waits on DB_HOST instead.
  mysql:
    image: mysql:8.4
    profiles: [localdb]
    ports:
      - "${MYSQL_PORT:-3306}:3306"
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD:-secret}
      MYSQL_DATABASE: 24hourclassroom
    volumes:
      - mysql-data:/var/lib/mysql
      - ./docker/mysql/init.sql:/docker-entrypoint-initdb.d/init.sql:ro
    healthcheck:
      test: ["CMD-SHELL", "mysqladmin ping -h localhost -p$${MYSQL_ROOT_PASSWORD:-secret} --silent"]
      interval: 5s
      timeout: 3s
      retries: 20

volumes:
  mysql-data:
```

Create root `.env.example`:

```env
# Host port mappings for docker compose
API_PORT=8000
WEB_PORT=3333
MYSQL_PORT=3306
MYSQL_ROOT_PASSWORD=secret

# Build-time API origin baked into the Stencil dev build
API_BASE_URL=http://localhost:8000
```

- [ ] **Step 5: Validate both compose modes**

```bash
cp .env.example .env
docker compose config -q                     # external-DB mode parses, no mysql service required
docker compose --profile localdb config -q   # localdb mode parses
```

Expected: both commands exit 0.

- [ ] **Step 6: Smoke-test localdb mode end to end**

First stop the throwaway DB from Task 2 (`docker rm -f 24hc-mysql`), set `DB_HOST=mysql` in `apps/api/.env`, then:

```bash
docker compose --profile localdb up -d --build
# api: composer install + migrate; web: npm install + first Stencil build — allow several minutes cold
timeout 600 sh -c 'until curl -fsS http://localhost:8000/up >/dev/null; do sleep 5; done'
timeout 600 sh -c 'until curl -fsS http://localhost:3333 | grep -qi app-root; do sleep 5; done'
docker compose ps
```

Expected: `/up` returns 200; the web dev server serves the Stencil index; all containers Up. Then `docker compose down`.
(Afterwards set `DB_HOST` back to `127.0.0.1` in `apps/api/.env` if you want host-side `php artisan test` runs; with `MYSQL_PORT=3306` published, the localdb container also serves host-side tests.)

- [ ] **Step 7: Commit**

```bash
git add -A
git commit -m "feat: docker compose dev environment with opt-in localdb profile"
```

---

### Task 10: CI workflow (tests + builds on PRs and pushes)

**Files:**
- Create: `.github/workflows/ci.yml`

**Interfaces:**
- Consumes: phpunit MySQL env (Task 2: `24hourclassroom_test`, root/secret at 127.0.0.1), workspace build/test scripts (Tasks 6–8), route:cache gate (Task 3).
- Produces: required status checks `api` and `web` for PRs and pushes to `dev`/`master`.

- [ ] **Step 1: Write the workflow**

Create `.github/workflows/ci.yml`:

```yaml
name: CI

on:
  pull_request:
  push:
    branches: [dev, master]

jobs:
  api:
    runs-on: ubuntu-latest
    defaults:
      run:
        working-directory: apps/api
    services:
      mysql:
        image: mysql:8.4
        env:
          MYSQL_ROOT_PASSWORD: secret
          MYSQL_DATABASE: 24hourclassroom_test
        ports:
          - 3306:3306
        options: >-
          --health-cmd="mysqladmin ping -psecret --silent"
          --health-interval=5s
          --health-timeout=3s
          --health-retries=20
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
          extensions: pdo_mysql, mbstring, bcmath
      - uses: actions/setup-node@v4
        with:
          node-version: 22
      - run: composer install --prefer-dist --no-interaction
      - run: cp .env.example .env && php artisan key:generate
      - run: npm ci && npm run build
      - run: php artisan test
      - name: Route cache gate
        run: php artisan route:cache && php artisan route:clear

  web:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: actions/setup-node@v4
        with:
          node-version: 22
      - run: npm ci
      - run: npm run build
      - run: npm test
```

- [ ] **Step 2: Lint the workflow**

Run: `docker run --rm -v "$PWD:/repo" -w /repo rhysd/actionlint:latest`
Expected: no findings (exit 0).

- [ ] **Step 3: Commit**

```bash
git add .github/workflows/ci.yml
git commit -m "ci: test and build both stacks on PRs and pushes"
```

---

### Task 11: Deploy workflow (dev/master → Dreamhost)

**Files:**
- Create: `.github/workflows/deploy.yml`, `docs/deploying.md`

**Interfaces:**
- Consumes: CI-proven build commands (Task 10), Stencil `API_BASE_URL` build env (Task 8).
- Produces: on push to `dev`/`master`, rsync deploy to Dreamhost + remote artisan migrate/cache. Requires GitHub Environments `staging` and `production`, each with secrets `DEPLOY_HOST`, `DEPLOY_USER`, `DEPLOY_SSH_KEY`, `API_PATH`, `WEB_PATH`, `ENV_FILE` and variables `API_BASE_URL`, `PHP_BIN`.

- [ ] **Step 1: Write the workflow**

Create `.github/workflows/deploy.yml`:

```yaml
name: Deploy

on:
  push:
    branches: [dev, master]

concurrency: deploy-${{ github.ref_name }}

jobs:
  deploy:
    runs-on: ubuntu-latest
    environment: ${{ github.ref_name == 'master' && 'production' || 'staging' }}
    env:
      PHP_BIN: ${{ vars.PHP_BIN || 'php' }}
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
          extensions: pdo_mysql, mbstring, bcmath
      - uses: actions/setup-node@v4
        with:
          node-version: 22

      - name: Build Laravel (vendor + Vite assets)
        working-directory: apps/api
        run: |
          composer install --no-dev --optimize-autoloader --no-interaction
          npm ci
          npm run build

      - name: Build Stencil app
        env:
          API_BASE_URL: ${{ vars.API_BASE_URL }}
        run: |
          npm ci
          npm run build

      - name: Set up SSH
        run: |
          mkdir -p ~/.ssh
          printf '%s\n' "${{ secrets.DEPLOY_SSH_KEY }}" > ~/.ssh/id_deploy
          chmod 600 ~/.ssh/id_deploy
          ssh-keyscan -H "${{ secrets.DEPLOY_HOST }}" >> ~/.ssh/known_hosts
          echo "SSH_TARGET=${{ secrets.DEPLOY_USER }}@${{ secrets.DEPLOY_HOST }}" >> "$GITHUB_ENV"

      - name: Deploy Laravel
        env:
          API_PATH: ${{ secrets.API_PATH }}
        run: |
          rsync -az --delete \
            -e "ssh -i ~/.ssh/id_deploy" \
            --exclude '.env' \
            --exclude 'storage/' \
            --exclude 'node_modules/' \
            --exclude 'tests/' \
            apps/api/ "$SSH_TARGET:$API_PATH/"

      - name: Write .env and run artisan
        env:
          API_PATH: ${{ secrets.API_PATH }}
          ENV_FILE: ${{ secrets.ENV_FILE }}
        run: |
          printf '%s' "$ENV_FILE" | \
            ssh -i ~/.ssh/id_deploy "$SSH_TARGET" "cat > '$API_PATH/.env'"
          ssh -i ~/.ssh/id_deploy "$SSH_TARGET" "
            set -e
            cd '$API_PATH'
            mkdir -p storage/logs storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views
            $PHP_BIN artisan storage:link || true
            $PHP_BIN artisan migrate --force
            $PHP_BIN artisan config:cache
            $PHP_BIN artisan route:cache
            $PHP_BIN artisan view:cache
          "

      - name: Deploy Stencil app
        env:
          WEB_PATH: ${{ secrets.WEB_PATH }}
        run: |
          rsync -az --delete \
            -e "ssh -i ~/.ssh/id_deploy" \
            apps/web/www/ "$SSH_TARGET:$WEB_PATH/"
```

- [ ] **Step 2: Document the one-time Dreamhost + GitHub setup**

Create `docs/deploying.md`:

```markdown
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
```

- [ ] **Step 3: Lint the workflow**

Run: `docker run --rm -v "$PWD:/repo" -w /repo rhysd/actionlint:latest`
Expected: exit 0.

- [ ] **Step 4: Commit**

```bash
git add .github/workflows/deploy.yml docs/deploying.md
git commit -m "ci: deploy dev/master to Dreamhost via rsync"
```

---

### Task 12: README + final verification sweep

**Files:**
- Modify: `README.md`

**Interfaces:**
- Consumes: everything above.
- Produces: accurate top-level docs; the spec's manual verification checklist executed as far as local tooling allows.

- [ ] **Step 1: Rewrite README.md**

Replace `README.md` contents with:

```markdown
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
```

- [ ] **Step 2: Full local verification sweep**

```bash
npm ci && npm run build && npm test
cd apps/api && php artisan test && cd ../..
docker compose config -q && docker compose --profile localdb config -q
docker run --rm -v "$PWD:/repo" -w /repo rhysd/actionlint:latest
```

Expected: everything green. (Requires MySQL running for the PHP tests, per Task 9 note.)

- [ ] **Step 3: Commit**

```bash
git add README.md
git commit -m "docs: document monorepo layout, local dev, and deploys"
```

- [ ] **Step 4: Report remaining human-only steps**

Tell the user what cannot be verified from this machine: creating the four Dreamhost sites/databases, adding the GitHub environments/secrets/variables, pushing a `dev` branch to trigger the first staging deploy, and clicking through the staging auth round-trip (login on `api-dev.*` → redirect back to `dev.*` → authenticated `/api/user` call).
