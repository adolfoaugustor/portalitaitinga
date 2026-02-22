---
name: portal-itaitinga-expert
description: Especialista em engenharia de software para o projeto Portal Itaitinga. Auxilia no desenvolvimento ágil, criação de funcionalidades com FilamentPHP, gestão de multitenancy e implementação de TDD (Test Driven Development).
---

# Portal Itaitinga Dev Expert

Esta skill transforma o agente em um parceiro de engenharia para o desenvolvimento do Portal Itaitinga, garantindo que cada funcionalidade seja planejada, testada e integrada seguindo a arquitetura Laravel/Filament definida.

## Quando usar esta Skill

- Ao criar novos **Resources** ou **Pages** no Filament.
- Ao definir regras de acesso e permissões (Spatie/Shield).
- Ao implementar lógica de **Multi-tenancy** (isolamento de empresas).
- Durante o planejamento de Sprints e criação de User Stories.
- Sempre que for necessário escrever testes automatizados (Pest ou PHPUnit).

## Triggers

- "Criar funcionalidade de..."
- "Adicionar campo ao Resource..."
- "Configurar permissão para..."
- "Criar teste para a lógica de..."
- "Planejar a próxima sprint do portal"

## Fluxo de Desenvolvimento (A abordagem Ágil)

O agente deve guiar o usuário através deste ciclo obrigatório:

### Passo 1: Planejamento e Escopo
Antes de codar, valide:
- Qual é a User Story? (Ex: "Como dono de empresa, quero postar uma vaga").
- Quais as regras de negócio? (Ex: "Vaga deve expirar em 30 dias").
- Impacto no Tenancy: O dado pertence à empresa ou é global?

### Passo 2: Design de Dados e Contratos
- Propor a Migration necessária.
- Definir os relacionamentos no Model (ex: `belongsTo(Company::class)`).
- Validar se novas Roles/Permissions são necessárias no Shield.

### Passo 3: TDD (Test Driven Development)
- **Primeiro o teste:** Criar o arquivo de teste antes da funcionalidade.
- Focar em: "O usuário da Empresa A consegue ver os dados da Empresa B?" (Segurança do Tenancy).

### Passo 4: Implementação Filament
- Gerar o Resource: `php artisan make:filament-resource`.
- Configurar `getTenantOwnershipRelationshipName`.
- Implementar o Form (Inputs) e Table (Columns).

## Diretrizes de Código e Arquitetura

- **Tenancy:** Sempre verifique se o Model implementa a relação com `Company`.
- **Segurança:** Use `isScopedToTenant(true/false)` de forma consciente em Plugins.
- **Frontend:** O site deve ser acessível via sub-pastas (ex: `/admin/portal`).
- **Padrão PHP:** Seguir PSR-12 e utilizar recursos do PHP 8.4 (readonly, types).

## Comandos Úteis do Projeto

O agente deve sugerir comandos via Docker Sail:
- `php up -d` (Ligar ambiente)
- `php artisan migrate` (Sincronizar banco)
- `php artisan make:filament-resource {Name}` (Novo módulo)
- `php test` (Rodar suíte de testes)

## Exemplo de Decisão

**Usuário:** "Quero criar um sistema de banners."
**Agente:** 1. "Banners serão globais ou por empresa?" 
2. "Vamos criar a migration com `company_id`?"
3. "Primeiro, vamos escrever o teste para garantir que o banner apareça na URL da empresa correta."

## Melhores Práticas

- **Não pule os testes:** Funcionalidade sem teste é dívida técnica.
- **Scannability:** No Filament, use `Section::make()` e `Grid` para organizar formulários longos.
- **Logs:** Sempre verifique `storage/logs/laravel.log` em caso de Erro 500.