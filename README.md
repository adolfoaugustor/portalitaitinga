# Portal Itaitinga

Aplicacao Laravel 11 com autenticacao de sessao nativa do Laravel e painel administrativo em CoreUI.

## Stack atual

- PHP: `^8.4`
- Laravel: `^11`
- Node.js: `20.19+` (ou `22.12+` por causa do Vite 7)
- Banco: MySQL/MariaDB

## Rotas principais

- `/login` -> login do admin
- `/admin` -> dashboard (protegido por `auth`)
- `/logout` -> encerra sessao

## Desenvolvimento local

Voce pode rodar com Docker Sail (recomendado) ou ambiente nativo.

### 1) Com Docker Sail (recomendado)

Pre-requisitos:

- Docker Desktop rodando

Passos:

```bash
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

Em outro terminal, rode o servidor Laravel:

```bash
./vendor/bin/sail artisan serve --host=0.0.0.0 --port=8000
```

Acesso local:

- App: `http://localhost:8000`
- Login: `http://localhost:8000/login`
- Admin: `http://localhost:8000/admin`

### 2) Ambiente nativo (sem Docker)

Pre-requisitos:

- PHP 8.4 com extensoes comuns do Laravel
- Composer 2
- Node 20.19+ (ou 22.12+)
- MySQL/MariaDB

Passos:

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
```

## Credenciais iniciais (seeder)

O seeder cria um usuario administrativo padrao:

- Email: `adolfoaugustor@gmail.com`
- Senha: `senha123`

Altere a senha apos o primeiro login.

## Comandos uteis

```bash
php artisan optimize:clear
php artisan test
npm run build
```

## Build de producao

```bash
npm install
npm run build
```

Consulte o guia de deploy em [PRODUCAO-HOMOLOGACAO-HOSTINGER.md](./PRODUCAO-HOMOLOGACAO-HOSTINGER.md).


Se seu Laravel usa Vite e você vai puxar do GitHub, o fluxo é:

1 - No servidor, atualize o código: git pull
2 - Atualize dependências PHP: composer install --no-dev --optimize-autoloader
3 - Gere os assets do Vite: npm ci (ou npm install) e depois npm run build
Se no seu Business o npm/node não existir via SSH, faça localmente: npm ci + npm run build e suba apenas public/build (e commit esse diretório no Git, ou envie por upload após o pull).