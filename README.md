# Laravel React Inertia

A modern Laravel starter kit with React 19, Inertia.js, TypeScript, and WorkOS authentication.

## Stack

- **Backend:** Laravel 12, PHP 8.5
- **Frontend:** React 19, TypeScript, Tailwind CSS 4
- **Routing:** Inertia.js with SSR support
- **Authentication:** WorkOS AuthKit
- **UI Components:** shadcn/ui (Base UI primitives)
- **Build:** Vite
- **Database:** PostgreSQL

## Requirements

- PHP 8.5+
- Node.js 24+
- PostgreSQL
- Composer

## Installation

```bash
# Clone the repository
git clone https://github.com/prashank/laravel-react-inertia.git
cd laravel-react-inertia

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Set up database
php artisan migrate

# Build assets
npm run build
```

## Configuration

### WorkOS Authentication

1. Create a [WorkOS](https://workos.com) account
2. Set up an AuthKit application
3. Add your credentials to `.env`:

```env
WORKOS_CLIENT_ID=your_client_id
WORKOS_API_KEY=your_api_key
WORKOS_REDIRECT_URL="${APP_URL}/authenticate"
```

### Database

The starter uses PostgreSQL by default. Update `.env` with your database credentials:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

## Development

```bash
# Start all services (server, queue, logs, vite)
composer dev

# With SSR enabled
composer dev:ssr
```

## Commands

### Code Quality

```bash
npm run lint          # ESLint with auto-fix
npm run format        # Prettier formatting
npm run types         # TypeScript type checking
composer lint         # Pint, PHPStan, and Rector (dry-run)
composer lint:fix     # Pint and Rector with fixes
```

### Testing

```bash
composer test                              # Run all tests
php artisan test --filter=TestName         # Run a single test
```

### Build

```bash
npm run build         # Production build
npm run build:ssr     # Build with SSR
```

## Project Structure

```
app/
├── Http/Controllers/     # Laravel controllers
├── Models/               # Eloquent models
└── Providers/            # Service providers

resources/js/
├── components/           # React components
│   └── ui/               # shadcn/ui base components
├── hooks/                # Custom React hooks
├── layouts/              # Page layout wrappers
├── pages/                # Inertia page components
└── wayfinder/            # Auto-generated route bindings (do not edit)
```

## Wayfinder

This project uses [Laravel Wayfinder](https://github.com/laravel/wayfinder) to generate TypeScript bindings for routes and controllers.

```bash
php artisan wayfinder:generate         # Regenerate bindings
php artisan wayfinder:generate --fresh # Clear and regenerate
```

Run these commands when you add or change routes, controllers, or models.

## License

MIT
