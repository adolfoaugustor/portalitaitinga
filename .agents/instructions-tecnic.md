# Technical Instructions - CMS Vertical Architecture

## Objective

This project now runs as a CMS with 4 clear verticals:

1. Agenda Cultural
2. Guia Local
3. Vagas de Emprego
4. Marketplace/Classificados

## Public route design

Public links were implemented as:

- `/agenda-cultural/{date}/{slug}`
  - Example: `/agenda-cultural/2026-03-13/show-da-praca`
  - `date` is `Y-m-d`
  - The page also loads other events for the same day.

- `/guia-local/{category}`
  - Allowed categories: `empresas`, `lojas`, `servicos`, `autonomo`

- `/vagas-de-emprego/{slug}`
  - Example: `/vagas-de-emprego/loja-centro`

- `/classificados/{slug}`
  - Example: `/classificados/notebook-usado`

## Logged user portal

All authenticated users can access `/portal` and create content for all verticals:

- `/portal/agenda-cultural`
- `/portal/guia-local`
- `/portal/vagas-de-emprego`
- `/portal/classificados`

Each module has:

- GET index page with user-owned items
- POST create endpoint

## Super admin access

`/admin` is restricted by middleware alias `super.admin`.

Only users with `users.is_super_admin = true` can access this route.

## Organization model for users

All users are treated as organizations through:

- `users.organization_type`

Allowed organization types in seed data:

- `company`
- `informal_seller`
- `service_provider`

## Database changes

Created migrations:

- `add_organization_fields_to_users_table`
  - adds `organization_type`
  - adds `is_super_admin`

- `create_cultural_events_table`
- `create_local_listings_table`
- `create_job_vacancies_table`
- `create_classified_items_table`

## Seeder users

`DatabaseSeeder` creates/updates:

- Super admin: `adolfoaugustor@gmail.com` (`is_super_admin=true`)
- Organization company user
- Organization informal seller user
- Organization service provider user

## Key files

- Routing: `routes/web.php`
- Super middleware: `app/Http/Middleware/EnsureSuperAdmin.php`
- Middleware alias: `bootstrap/app.php`
- Auth redirect logic: `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- Models: `app/Models/*`
- Portal controllers: `app/Http/Controllers/Portal/*`
- Public controllers: `app/Http/Controllers/Frontend/*`
- Views: `resources/views/portal/*` and `resources/views/public/*`

## Expected next execution steps

1. `php artisan migrate`
2. `php artisan db:seed`
3. `php artisan route:list`
4. `npm run dev`

If route cache was previously generated:

- `php artisan optimize:clear`

