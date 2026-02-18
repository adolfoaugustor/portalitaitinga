<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🚀 Portal Itaitinga - Guia de Iniciação

Este projeto utiliza **Laravel 11/12**, **Filament v4**, e é orquestrado via **Docker (Laravel Sail)**.

## 📋 Pré-requisitos

* **Docker Desktop** instalado e a correr.
* Nenhum serviço local (como MySQL ou Apache) a ocupar as portas **80** e **3306**.

---

## 🛠️ Iniciar o Projeto (Primeira Vez)

Se acabaste de clonar o projeto ou resetar o ambiente, segue esta ordem:

1. **Subir os Containers (Modo Detached):**
```bash
./vendor/bin/sail up -d
```


2. **Instalar Dependências (Caso a pasta vendor esteja ausente):**
```bash
./vendor/bin/sail composer install
```


3. **Configurar Variáveis de Ambiente:**
```bash
cp .env.example .env
./vendor/bin/sail artisan key:generate
```


4. **Executar Migrações (Estrutura da Base de Dados):**
```bash
./vendor/bin/sail artisan migrate
```

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

5. **Criar Usuário Administrador (Para acessar o painel):**
```bash
./vendor/bin/sail artisan make:filament-user
```


---

## 🚦 Comandos de Manutenção Diária

### Ligar/Desligar

* **Iniciar aplicação:** `./vendor/bin/sail up -d`
* **Parar aplicação:** `./vendor/bin/sail stop`
* **Derrubar tudo (limpeza):** `./vendor/bin/sail down`

### Base de Dados e Cache

* **Atualizar tabelas (novas migrations):** `./vendor/bin/sail artisan migrate`
* **Limpar cache de rotas/configuração:** `./vendor/bin/sail artisan optimize:clear`
* **Aceder ao banco de dados (Tinker):** `./vendor/bin/sail artisan tinker`

### Plugins e Permissões (Filament Shield)

* **Gerar/Atualizar Permissões:** `./vendor/bin/sail artisan shield:generate`
* **Limpar cache de permissões:** `./vendor/bin/sail artisan permission:cache-reset`

---

## 🌐 Endereços Úteis (Localhost)

* **Frontend:** [http://localhost]()
* **Painel Administrativo:** [http://localhost/admin/portal]()
* **Mailpit (Testes de Email):** [http://localhost:8025]()

---

## 📝 Notas de Desenvolvimento

* Sempre que adicionares um novo **Resource** no Filament, limpa o cache: `./vendor/bin/sail artisan config:clear`.
* O acesso multi-tenant exige um `slug` válido na URL (ex: `/admin/portal`).

---

**O que achas deste guia?** Se estiver tudo certo, o próximo passo que posso fazer por ti é criar o **CompanyResource** com os campos de GPS e Logotipo para começares a povoar o portal!