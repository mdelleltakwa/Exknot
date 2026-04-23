# Exknot — Verified Expertise Marketplace
### B2B Platform · Laravel 11 · Blade · Tailwind CSS · Alpine.js

---

## Quick Setup (5 minutes)

```bash
# 1. Create Laravel project
composer create-project laravel/laravel exknot
cd exknot

# 2. Install Breeze (auth scaffolding)
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev

# 3. Copy all project files into the Laravel structure
# (replace app/, database/, resources/views/, routes/web.php)

# 4. Configure .env
DB_CONNECTION=mysql
DB_DATABASE=exknot
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log  # for local email verification testing

# 5. Run migrations + seeders
php artisan migrate:fresh --seed

# 6. Create storage link (for image uploads)
php artisan storage:link

# 7. Register RoleMiddleware in bootstrap/app.php
# Add inside withMiddleware():
# $middleware->alias(['role' => \App\Http\Middleware\RoleMiddleware::class]);

# 8. Register Policies in AppServiceProvider
# Add in boot():
# Gate::policy(Product::class, ProductPolicy::class);
# Gate::policy(Order::class, OrderPolicy::class);
# Gate::policy(Review::class, ReviewPolicy::class);

# 9. Start the server
php artisan serve
```

---

## Test Accounts (after seeding)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@exknot.com | password |
| Firm 1 | contact@alvarez-mercer.com | password |
| Firm 2 | info@nexora-audit.com | password |
| Firm 3 | ops@techprobe.ae | password |
| Client 1 | sophie@globalcorp.fr | password |
| Client 2 | omar@gulf-energy.com | password |

---

## Architecture

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── ProductController.php   # CRUD services
│   │   ├── CartController.php      # Session cart
│   │   ├── OrderController.php     # Orders workflow
│   │   ├── ReviewController.php    # Ratings & comments
│   │   └── DashboardController.php # 3 role dashboards
│   └── Middleware/
│       └── RoleMiddleware.php      # Role-based access
├── Models/
│   ├── User.php        # roles: client / firm / admin
│   ├── Product.php     # services published by firms
│   ├── Category.php
│   ├── Order.php       # status: pending/validated/cancelled
│   ├── OrderItem.php
│   └── Review.php      # rating 1-5 + comment
└── Policies/
    ├── ProductPolicy.php
    ├── OrderPolicy.php
    └── ReviewPolicy.php

database/
├── migrations/         # 6 tables
└── seeders/
    └── DatabaseSeeder.php  # realistic Exknot demo data

resources/views/
├── layouts/app.blade.php   # main layout with Exknot brand
├── welcome.blade.php        # homepage
├── services/               # catalogue, show, create, edit
├── cart/                   # cart index
├── orders/                 # orders list
└── dashboard/              # client / firm / admin

routes/web.php              # grouped by role
```

---

## Features Checklist

### Mandatory ✅
- [x] Auth: register, login, logout, email verification, password reset
- [x] Profile management
- [x] Services CRUD (firm) with image upload
- [x] Public catalogue with search, filter by category, sort by price/date
- [x] Cart: add, update quantity, remove
- [x] Orders: place, history, statuses (pending/validated/cancelled)
- [x] Reviews: rate + comment a service
- [x] MVC architecture, Eloquent ORM, Migrations, Seeders, Blade
- [x] CSRF protection (automatic Laravel)
- [x] XSS protection (Blade {{ }} auto-escapes)
- [x] SQL injection protection (Eloquent parameterized queries)

### Bonus Level 3 — +3 points ✅
- [x] Multi-role management: Client / Expert Firm / Admin
- [x] Admin panel: manage users, change roles, delete accounts
- [x] Pagination on catalogue and user list
- [x] Image upload with storage

---

## Brand

**Name:** Exknot
**Tagline:** Tie the right knot.
**Colors:** #0A0D12 (bg) · #1D9E75 (teal accent) · #E8EDF2 (text)
**Font:** DM Sans (Google Fonts)
