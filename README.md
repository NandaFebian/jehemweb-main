# Jehem Meadolan

Marketplace for UMKM (small business) products from Desa Jehem, Bangli, Bali.

- **Public site** (`/`, `/about`, `/contact`, `/detail-product/{id}`, `/register`): Blade views rendered by plain controllers.
- **Admin panel** (`/admin`): Filament 3. Shop owners manage their product; admins approve products and activate accounts.

Stack: Laravel 10, Filament 3.2, spatie/laravel-permission, Tailwind + daisyUI, Vite.

## Roles

| Role          | Can do                                                                             |
| ------------- | ---------------------------------------------------------------------------------- |
| `USER`        | Shop owner. Registers on `/register`, waits for activation, then manages one product. |
| `ADMIN`       | Activates users, approves products, manages categories.                            |
| `SUPER_ADMIN` | Everything above, plus creating users and changing roles/passwords.               |

A product is visible on the public site only when it is **approved** by an admin **and** **active**.

## Local setup

Requirements: PHP 8.1+ (with `pdo_mysql` or `pdo_sqlite`, `intl`, `gd`, `fileinfo`, `zip`), Composer, Node 18+.

```bash
composer install
cp .env.example .env
php artisan key:generate

# Configure DB_* in .env (MySQL), or use SQLite:
#   DB_CONNECTION=sqlite  (and remove the other DB_* lines), then create database/database.sqlite
php artisan migrate
php artisan db:seed --class=DevSeeder   # roles + demo accounts and products
php artisan storage:link                 # uploaded images are served from /storage

npm install
npm run build        # or `npm run dev` while working on the front-end

php artisan serve
```

Demo accounts created by `DevSeeder` (password `password*123`, log in with the phone number at `/admin/login`):

| Phone | Role        |
| ----- | ----------- |
| `123` | Super admin |
| `678` | Admin       |
| `345` | User        |

## Production

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan db:seed --force                       # roles
php artisan db:seed --class=ProdSeeder --force    # super admin from SUPER_ADMIN_PHONE / SUPER_ADMIN_PASSWORD
php artisan storage:link
npm ci && npm run build
php artisan optimize
```

## Tests

```bash
php artisan test
```

Tests run against an in-memory SQLite database (see `phpunit.xml`).

## Project layout

```
app/Http/Controllers/        Public site: Home, Page (about/contact), Product, ProductComment, RegisteredUser
app/Http/Controllers/API/V1  JSON API: GET /api/v1/comments, POST /api/v1/auth/registration
app/Filament/                Admin panel resources, widgets and the phone-number login page
app/Services/                AuthService (registration), CommentService, VisitorService (daily visit counter)
resources/views/layouts/     Shared public layout
resources/views/components/  navbar, footer, product-card, rating-stars, testimonials, carousel buttons
resources/views/pages/       One view per public page
resources/js/app.js          Splide carousels (data-carousel="cards|chips|gallery") and the product gallery
```
