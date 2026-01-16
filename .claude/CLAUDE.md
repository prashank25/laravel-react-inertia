# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Testing
composer test                            # Run PHP tests
php artisan test --filter=TestName       # Run specific test

# Code Quality
npm run lint                             # ESLint with auto-fix
npm run format                           # Prettier formatting
npm run types                            # TypeScript type checking
composer lint                            # Pint, PHPStan, Rector (dry-run)
composer lint:fix                        # Pint and Rector with fixes
```

## Architecture Overview

This is a Laravel 12 + React 19 application using Inertia.js for server-side rendering.

### Stack
- **Backend**: Laravel 12, PHP 8.5
- **Frontend**: React 19, TypeScript, Tailwind CSS 4
- **Authentication**: WorkOS via `laravel/workos`
- **Build**: Vite with SSR support
- **UI Components**: shadcn/ui-style components (Base UI primitives)

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

### Authentication Flow
Authentication is handled via WorkOS AuthKit. Routes are protected with the `auth` middleware and `ValidateSessionWithWorkOS` middleware.
