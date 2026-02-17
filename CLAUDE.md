# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## About MockForge

MockForge is a Laravel 12 TALL stack app (Tailwind, AlpineJS, Livewire, Laravel) that lets developers spin up mock API endpoints for testing and frontend development. Users create endpoints with custom JSON payloads, simulated delays, optional bearer-token auth, and configurable HTTP status codes.

## Development Commands

Start all services concurrently (recommended):
```bash
composer run dev
```

Or individually in separate terminals:
```bash
npm run dev          # Vite asset bundler
php artisan serve    # Laravel dev server
php artisan queue:work  # Queue worker (required for endpoint history logging)
```

Build assets for production:
```bash
npm run build
```

Run tests:
```bash
composer run test
# or directly:
php artisan test
./vendor/bin/phpunit
# Single test file:
php artisan test tests/Feature/DashboardTest.php
```

Lint PHP (Laravel Pint):
```bash
vendor/bin/pint
```

## Architecture

### Request Flow for Mock API Calls

Public mock endpoints are accessed at `GET /api/{user_id}/{slug}` (no auth required). The `ApiController@show` method:
1. Looks up the endpoint by user ID + slug
2. Applies any configured delay via `usleep()`
3. Validates bearer token if `require_auth` is true
4. Runs the JSON payload through `modifyWithFakerData()` which replaces `{{name}}`, `{{email}}`, `{{number}}`, `{{string}}` templates with Faker-generated values
5. Dispatches `CreateEndpointHistory` job to queue (async logging of status, response time, payload size)
6. Increments `request_count` on the endpoint

### Endpoint Lifecycle

- Endpoints use **soft deletes** (`SoftDeletes` trait). Hard deletion happens via the `DeleteExpiredEndpoints` job, scheduled daily, which force-deletes records soft-deleted for 5+ days.
- Endpoints expire after 7 days (`Endpoint::isExpired()`), though expiry enforcement is separate from deletion.
- Slug uniqueness is per-user and ignores soft-deleted records.

### Livewire Component Structure

The UI is built with Livewire components + Flux UI component library (`livewire/flux`). Key components:
- `CreateEndpointForm` / `app\Livewire\Forms\EndpointForm` — form object pattern; validation lives in `EndpointForm`
- `JsonEditor` — wraps a CodeMirror 6 editor for JSON payload editing
- `TestEndpointModal` — lets users test their endpoint from the UI
- `EndpointHistoryModal` — displays request history per endpoint
- `DashboardEndpointList` / `DashboardCard` — dashboard views

Volt (single-file Livewire components) is used for settings pages (`settings/profile`, `settings/password`, `settings/appearance`).

### Jobs / Queues

Two queued jobs:
- `CreateEndpointHistory` — dispatched on every API hit; records status code, response time (ms), and payload size
- `DeleteExpiredEndpoints` — runs on a daily schedule via `routes/console.php`

The queue **must be running** during development (`php artisan queue:work`) for endpoint history to be recorded.

### Frontend

- **Vite** with `laravel-vite-plugin` for asset bundling
- **Tailwind CSS v4** (`@tailwindcss/vite` plugin)
- **CodeMirror 6** used for the JSON payload editor (`resources/js/codemirroreditor.js`) and endpoint test editor (`resources/js/endpointTestEditor.js`)

### Testing

Tests use SQLite in-memory (`DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:`). Queue is set to `sync` in test environment so jobs run synchronously. Factories exist for `User`, `Endpoint`, and `EndpointHistory`.

### Flux UI

The project uses `livewire/flux` (a paid Livewire UI component library). Flux credentials must be configured via `composer config http-basic.composer.fluxui.dev` before `composer install` will work in CI or fresh environments.
