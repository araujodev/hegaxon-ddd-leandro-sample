# Hexagon DDD Sample

Projeto de exemplo em PHP aplicando **Arquitetura Hexagonal** (Ports & Adapters) e **Domain-Driven Design (DDD)** para o domínio de pedidos (Order).

## Requisitos

- PHP 8.3+
- Docker e Docker Compose
- Composer

## Estrutura do Projeto

```
src/
├── Application/          # Casos de uso (Application Layer)
│   └── Order/
│       └── UseCase/
│           └── CreateOrderUseCase.php
├── Domain/              # Regras de negócio (Domain Layer)
│   └── Order/
│       ├── Entity/
│       │   └── Order.php
│       ├── Repository/
│       │   └── OrderRepository.php
│       └── ValueObject/
│           └── OrderId.php
├── Infrastructure/      # Implementações concretas (Adapters)
│   └── Persistence/
│       └── MySQLOrderRepository.php
└── Interface/           # Entrada da aplicação (Adapters)
    └── Http/
        └── CreateOrderController.php
```

- **Domain**: entidades, value objects e contratos (portas) do domínio.
- **Application**: orquestração dos casos de uso.
- **Infrastructure**: persistência em MySQL (implementação do repositório).
- **Interface**: controladores HTTP que recebem requisições e delegam aos use cases.

## Como executar

### Com Docker

1. Suba os containers:

```bash
docker compose up -d
```

2. Instale as dependências (dentro do container ou localmente):

```bash
composer install
```

3. Execute as migrations (com o MySQL já rodando):

```bash
./vendor/bin/phinx migrate -e development
```

4. A API estará disponível em **http://localhost:8080**.

### Sem Docker

Certifique-se de ter PHP 8.3, extensão PDO e um MySQL com o banco `app_db` e credenciais compatíveis com `phinx.php` (ambiente `development`). Ajuste a conexão em `public/index.php` se necessário (host, usuário, senha).

## API

### Criar pedido

**POST** `/orders`

**Body (JSON):**

```json
{
  "reference": "REF-001",
  "email": "cliente@exemplo.com"
}
```

**Resposta de sucesso (201):**

```json
{
  "created": true
}
```

**Resposta de erro (500):**

```json
{
  "error": "Mensagem de erro"
}
```

## Scripts

| Comando            | Descrição                    |
|--------------------|------------------------------|
| `composer test`    | Executa os testes (PHPUnit)  |
| `composer cs-fix`  | Formata o código (PHP-CS-Fixer) |
| `composer stan`    | Análise estática (PHPStan)   |

## Migrations

As migrations são gerenciadas pelo [Phinx](https://book.cakephp.org/phinx/0/en/index.html).

- Criar nova migration: `./vendor/bin/phinx create NomeDaMigration`
- Rodar migrations: `./vendor/bin/phinx migrate -e development`
- Reverter última: `./vendor/bin/phinx rollback -e development`

## Licença

MIT