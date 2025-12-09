# API Laravel – CRUD de Usuários + Soft Delete + Permissões (Spatie)

Este projeto implementa um sistema de gerenciamento de usuários com CRUD completo, validação robusta via FormRequest, Soft Deletes, arquitetura em camadas (Controller → Service → Repository → DTO), integração com Spatie Permissions, testes automatizados e execução via Docker.

---

## 🚀 Como rodar o projeto

---

## 🐳 Rodando com Docker (recomendado)

**1. Crie o arquivo `.env` baseado no `.env.example`**

**2. Altere o host do banco no `.env`:**

DB_HOST=db


**3. Suba os containers:**

docker-compose up -d


**4. Instale dependências (se necessário):**

docker exec -it app composer install


**5. Execute as migrations:**

docker exec -it app php artisan migrate


---

## 💻 Rodando localmente (sem Docker)

**1. Instalar dependências:**

composer install


**2. Configurar arquivo `.env`**

**3. Gerar chave da aplicação:**

php artisan key:generate


**4. Executar migrations:**

php artisan migrate


**5. Iniciar o servidor:**

php artisan serve


---

## 🧩 Resumo da Arquitetura

O projeto foi estruturado seguindo princípios de **SOLID**, **separação de responsabilidades** e organização em módulos.

### 📁 **Controllers**
- Mantidos enxutos.  
- Responsáveis apenas pelo fluxo HTTP.  
- Delegam regras de negócio aos Services.

### ⚙️ **Services**
- Contêm a lógica de negócio.  
- Fazem a ponte entre Controllers e Repositories.

### 🗄️ **Repositories**
- Lidam diretamente com o banco (Eloquent).  
- Encapsulam consultas e persistência.  
- Utilizam **interfaces** para permitir inversão de dependência.

### 📦 **DTOs**
- Padronizam dados trafegados entre camadas.  
- Evitam acoplamento da request com as regras internas.

### 🛡️ **Form Requests**
- Validação centralizada.  
- Retorno automático de erros `422` em JSON.

### 🧹 **Soft Deletes**
- Implementado com `SoftDeletes`.  
- Usuários removidos não aparecem em listagens.

### 🔐 **Permissões e Roles (Spatie)**
- Atribuição dinâmica de roles e permissões.  
- Suporte a `assignRole()` e `givePermissionTo()`.  
- Role padrão atribuída automaticamente (ex.: *admin*).

### 🧪 **Testes Automatizados**
Testes Feature cobrindo os principais fluxos:
- `test_store_user_requires_fields`
- `test_store_user_success`
- `test_soft_delete_user`

Validam campos, persistência e funcionamento do soft delete.

---

## 📡 Endpoints (resumo básico)

| Método | Rota                          | Descrição                         |
|--------|-------------------------------|-----------------------------------|
| POST   | `/api/users`                  | Criar usuário                     |
| GET    | `/api/users/{user}`             | Buscar usuário                    |
| PUT    | `/api/users/{user}`             | Atualizar usuário                 |
| DELETE | `/api/users/{user}`             | Soft delete                       |
| POST   | `/api/users/{user}/permission`  | Atribuir role/permissão           |

---

## 🧪 Rodando os Testes

php artisan test --filter=UserCrudTest

---

## 📄 Considerações Finais

Mesmo com o tempo reduzido, o projeto foi desenvolvido mantendo:

- Arquitetura limpa e modular  
- Princípios SOLID  
- Separação clara entre camadas  
- Padrões consistentes de DTOs  
- Controle de erros centralizado via Exceptions no bootstrap  
- Integração com Spatie para controle de permissões  
- Testes garantindo funcionamento do CRUD

A API está pronta para evoluir, escalável e fácil de manter.
