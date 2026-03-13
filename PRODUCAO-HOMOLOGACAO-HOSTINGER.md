# Producao/Homologacao em Hostinger (Hospedagem Compartilhada)

Este guia considera Laravel 11 em hospedagem compartilhada da Hostinger, sem acesso root.

## 1) Pre-requisitos no painel da Hostinger

- PHP 8.4 habilitado no dominio/subdominio
- Banco MySQL criado (host, database, user, password)
- SSH habilitado (se disponivel no seu plano)
- Pasta publica do site apontando para `public_html`

## 2) Estrutura recomendada na Hostinger

Em hospedagem compartilhada, mantenha o codigo fora da pasta publica e exponha apenas o conteudo de `public/`.

Exemplo:

- Codigo: `~/portalitaitinga`
- Pasta publica do dominio: `~/public_html`

## 3) Upload do projeto

Opcoes:

1. Via Git (recomendado): clonar no servidor em `~/portalitaitinga`
2. Via ZIP: compactar localmente e extrair em `~/portalitaitinga`

## 4) Configurar `.env`

No servidor, dentro de `~/portalitaitinga`:

```bash
cp .env.example .env
```

Ajuste no `.env`:

- `APP_ENV=production` (ou `staging` para homologacao)
- `APP_DEBUG=false`
- `APP_URL=https://seu-dominio.com`
- `DB_CONNECTION=mysql`
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

## 5) Instalar dependencias PHP

Dentro de `~/portalitaitinga`:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
```

## 6) Build dos assets

### Opcao A (recomendada): build local e upload

No seu computador:

```bash
npm install
npm run build
```

Envie a pasta `public/build` para `~/portalitaitinga/public/build` no servidor.

### Opcao B: build no servidor (se houver Node compativel)

```bash
npm install
npm run build
```

Node deve ser `20.19+` (ou `22.12+`).

## 7) Publicar em `public_html`

Copie o conteudo de `~/portalitaitinga/public/` para `~/public_html/`.

Importante: ajuste `index.php` em `public_html` para apontar para a pasta real do projeto.

Trecho esperado (exemplo):

```php
require __DIR__.'/../portalitaitinga/vendor/autoload.php';
$app = require_once __DIR__.'/../portalitaitinga/bootstrap/app.php';
```

Se sua estrutura for diferente, ajuste os caminhos.

## 8) Permissoes

Garanta escrita para web server em:

- `storage/`
- `bootstrap/cache/`

## 9) Otimizacoes finais

Dentro de `~/portalitaitinga`:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 10) Checklist de homologacao

- `/login` abre corretamente
- Login funciona com usuario valido
- `/admin` carrega com layout CoreUI
- Logout funciona
- Assets de `public/build` carregam sem 404
- `APP_DEBUG=false`

## 11) Atualizacao de deploy

Fluxo seguro para novas versoes:

1. Atualizar codigo (git pull ou novo upload)
2. `composer install --no-dev --optimize-autoloader`
3. Atualizar `public/build` com novo build
4. `php artisan migrate --force`
5. `php artisan optimize:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache`

## 12) Problemas comuns

- Erro 500 apos publicar:
  - caminhos errados no `public_html/index.php`
  - permissao em `storage`/`bootstrap/cache`
  - `.env` incompleto

- CSS/JS nao carregam:
  - pasta `public/build` ausente ou desatualizada
  - publicou arquivo antigo em cache do navegador/CDN

- Tela em branco no admin:
  - `APP_DEBUG=false` esconde erro; verifique logs em `storage/logs/laravel.log`

---

Se quiser, no proximo passo eu ja deixo um `index.php` pronto para seu caminho exato da Hostinger (com base no seu usuario/pasta real).
