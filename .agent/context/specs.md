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


## Update - Sidebar nav-group and extended forms

### Portal sidebar style

Portal sidebar now follows CoreUI `nav-group` style with 4 grouped sections:

- `agenda-cultural`
- `guia-local`
- `vagas-de-empregos`
- `classificados`

Each section uses `cil-sitemap` icon and contains its own `Cadastro` entry.

### Guia local form fields

Portal form `/portal/guia-local` now includes:

- nome
- categoria
- foto/logo (image upload)
- telefone/WhatsApp
- endereco/bairro
- horario
- link (instagram/whatsapp)
- cidade
- descricao

Database additions in `local_listings`:

- `logo_path`
- `phone_whatsapp`
- `address_neighborhood`
- `opening_hours`
- `contact_link`

### Agenda cultural form fields and public filters

Portal form `/portal/agenda-cultural` now includes:

- data (`event_date`)
- bairro (`neighborhood`)
- tipo de evento (`event_type`)
- gratuito/pago (`pricing_type`)
- publico infantil/familia/geral (`audience_type`)
- organizador (`organizer_name`)
- local (`location`)

Public page `/agenda-cultural` now supports filters via query string:

- `data`
- `bairro`
- `tipo`
- `preco`
- `publico`
- `organizador`

Database additions in `cultural_events`:

- `neighborhood`
- `event_type`
- `pricing_type`
- `audience_type`
- `organizer_name`

### Classificados form fields

Portal form `/portal/classificados` now includes:

- foto principal (image upload)
- titulo
- categoria
- tipo (`item/produto/servico`)
- preco
- bairro
- nome do anunciante
- WhatsApp
- descricao

Public list/detail now show advertiser data and WhatsApp action.

Database additions in `classified_items`:

- `main_photo_path`
- `category`
- `neighborhood`
- `advertiser_name`
- `whatsapp_number`

### Migration added for these updates

- `2026_03_13_110000_add_vertical_fields_to_content_tables.php`

### Required commands after pull

1. `php artisan migrate`
2. `php artisan storage:link` (for uploaded images)
3. `php artisan optimize:clear`

---

## Update - Company e Marketplace

### Fluxo de cadastro

Quando o usuário cadastra um CNPJ, ele passa a ser tratado como **empresa** no sistema:

1. Cria-se um registro na tabela `companies` vinculado ao `user_id`
2. A partir daí, o usuário pode ativar seu **Marketplace** (cardápio virtual)
3. O registro em `marketplaces` é criado com `user_id` + `company_id`

Usuário sem CNPJ = autônomo/informal. Usuário com CNPJ = empresa com acesso ao Marketplace.

### Novas migrations

- `2026_03_13_100500_create_companies_table.php`
  - `id`
  - `user_id` (FK → users)
  - `cnpj` (único)
  - `razao_social`, `nome_fantasia`
  - `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`
  - `telefone`, `whatsapp`, `email`, `website`
  - `created_at` / `updated_at` (data/hora do cadastro via CNPJ)

- `2026_03_13_100600_create_marketplaces_table.php`
  - `id`
  - `user_id` (FK → users)
  - `company_id` (FK → companies)
  - `nome`, `slug`, `descricao`
  - `logo_path`, `banner_path`
  - `categoria`, `whatsapp`
  - `ativo` (boolean)
  - `created_at` / `updated_at`

### Novos models

- `app/Models/Company.php` — belongsTo(User), hasOne(Marketplace)
- `app/Models/Marketplace.php` — belongsTo(User), belongsTo(Company)

### Atualização no User model

- `hasOne(Company::class)` → `company()`
- `hasOne(Marketplace::class)` → `marketplace()`
- `isCompany(): bool` → verifica se o usuário já possui empresa cadastrada
