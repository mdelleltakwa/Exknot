# Exknot

**Verified Expertise Marketplace** — B2B platform connecting clients with audited expert firms.

Stack: Laravel 11 · Blade · Tailwind CSS · Alpine.js

---

## Setup

```bash
composer create-project laravel/laravel exknot
cd exknot

composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev
```

Copy project files into the Laravel structure (replace `app/`, `database/`, `resources/views/`, `routes/web.php`), then configure `.env`:

```env
DB_CONNECTION=mysql
DB_DATABASE=exknot
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log
```

Run migrations and seed demo data:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

**Manual registration steps** (one-time):

In `bootstrap/app.php`, inside `withMiddleware()`:
```php
$middleware->alias(['role' => \App\Http\Middleware\RoleMiddleware::class]);
```

In `AppServiceProvider::boot()`:
```php
Gate::policy(Product::class, ProductPolicy::class);
Gate::policy(Order::class, OrderPolicy::class);
Gate::policy(Review::class, ReviewPolicy::class);
```

Start the server:
```bash
php artisan serve
```

---

## Demo Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@exknot.com | password |
| Firm | contact@alvarez-mercer.com | password |
| Firm | info@nexora-audit.com | password |
| Firm | ops@techprobe.ae | password |
| Client | sophie@globalcorp.fr | password |
| Client | omar@gulf-energy.com | password |

---

## Architecture

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── ProductController.php    # Service CRUD
│   │   ├── CartController.php       # Session-based cart
│   │   ├── OrderController.php      # Order lifecycle
│   │   ├── ReviewController.php     # Ratings + comments
│   │   └── DashboardController.php  # Role-specific dashboards
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── User.php        # Roles: client / firm / admin
│   ├── Product.php     # Services listed by firms
│   ├── Category.php
│   ├── Order.php       # Statuses: pending / validated / cancelled
│   ├── OrderItem.php
│   └── Review.php      # Rating (1–5) + comment
└── Policies/
    ├── ProductPolicy.php
    ├── OrderPolicy.php
    └── ReviewPolicy.php

database/
├── migrations/         # 6 tables
└── seeders/
    └── DatabaseSeeder.php

resources/views/
├── layouts/app.blade.php
├── welcome.blade.php
├── services/           # Catalogue, detail, create, edit
├── cart/
├── orders/
└── dashboard/          # Client / firm / admin views

routes/web.php          # Grouped by role
```

---

## Features

**Core**
- Auth: register, login, logout, email verification, password reset
- Profile management
- Services CRUD with image upload (firm accounts)
- Public catalogue: search, category filter, sort by price/date
- Cart: add, update quantity, remove
- Orders: placement, history, status tracking
- Reviews: per-service rating and comment

**Multi-role (Bonus)**
- Three distinct roles: Client, Expert Firm, Admin
- Admin panel: user management, role changes, account deletion
- Pagination across catalogue and user lists

**Security**
- CSRF protection (Laravel default)
- XSS protection (Blade `{{ }}` auto-escaping)
- SQL injection protection (Eloquent parameterized queries)

---

## Brand

**Exknot** — *Tie the right knot.*

| Token | Value |
|-------|-------|
| Background | `#0A0D12` |
| Accent | `#1D9E75` |
| Text | `#E8EDF2` |
| Font | DM Sans (Google Fonts) |
