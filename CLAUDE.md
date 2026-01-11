# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Build and Development Commands

### Development
```bash
composer dev          # Starts all services concurrently (server, queue, logs, vite)
composer dev:ssr      # Same as above but with SSR enabled
```

### Testing
```bash
composer test         # Run PHP tests with PHPUnit
php artisan test --filter=TestName  # Run a single test
```

### Code Quality
```bash
npm run lint          # ESLint with auto-fix
npm run format        # Prettier formatting for resources/
npm run format:check  # Check formatting without changes
npm run types         # TypeScript type checking
composer lint         # Run Pint, PHPStan, and Rector (dry-run)
composer lint:fix     # Run Pint and Rector with fixes applied
```

### Build
```bash
npm run build         # Production build
npm run build:ssr     # Build with SSR
```

## Architecture Overview

This is a Laravel 12 + React 19 application using Inertia.js for server-side rendering.

### Stack
- **Backend**: Laravel 12, PHP 8.5
- **Frontend**: React 19, TypeScript, Tailwind CSS 4
- **Authentication**: WorkOS via `laravel/workos`
- **Build**: Vite with SSR support
- **UI Components**: shadcn/ui (Radix primitives)

### Key Directories
- `app/Http/Controllers/` - Laravel controllers
- `resources/js/pages/` - Inertia page components (maps to routes)
- `resources/js/components/` - Reusable React components
- `resources/js/components/ui/` - shadcn/ui base components
- `resources/js/layouts/` - Page layout wrappers
- `resources/js/hooks/` - Custom React hooks
- `resources/js/wayfinder/` - Auto-generated Wayfinder TypeScript (do not edit)

### Wayfinder Integration
This project uses `laravel/wayfinder` (next branch) to generate TypeScript bindings for Laravel routes, controllers, and more. The files in `resources/js/wayfinder/` are auto-generated and should not be manually edited.

```bash
php artisan wayfinder:generate         # Regenerate TypeScript bindings
php artisan wayfinder:generate --fresh # Clear and regenerate everything
```

Run these commands when you add/change routes, controllers, or models and encounter TypeScript errors.

### Path Aliases
TypeScript uses `@/*` to alias `resources/js/*` (configured in tsconfig.json and components.json).

### Authentication Flow
Authentication is handled via WorkOS AuthKit. Routes are protected with the `auth` middleware and `ValidateSessionWithWorkOS` middleware.

### Database Conventions
- **No foreign key constraints**: Do not use `->constrained()`, `->cascadeOnDelete()`, or similar. Handle referential integrity in application code.
- **No default values**: Do not use `->default()` in migrations. Set defaults in application code (models, factories, etc.).
- **ULIDs for primary keys**: Use `$table->ulid('id')->primary()` instead of `$table->id()`.

### Model Conventions
- **PHPDoc for properties**: Add `@property` annotations to models for all database columns.
- **Generic types for relations**: Use `@return HasMany<User, $this>` style annotations on relationship methods.
- **Final classes**: All classes should be `final` unless designed for extension.
