#API Laravel – CRUD de Usuários + Soft Delete + Permissões (Spatie)

Este projeto implementa um sistema de gerenciamento de usuários com CRUD completo, validação robusta via FormRequest, Soft Deletes, arquitetura em camadas (Controller → Service → Repository → DTO), integração com Spatie Permissions, testes automatizados e execução via Docker.

🚀 Como rodar o projeto
🐳 Rodando com Docker (recomendado)

Crie o arquivo .env baseado no .env.example

Altere o host do banco no .env:

DB_HOST=db


Suba os containers:

docker-compose up -d


Instale dependências dentro do container (se necessário):

docker exec -it app composer install


Execute as migrations:

docker exec -it app php artisan migrate

💻 Rodando localmente (sem Docker)

Instalar dependências:

composer install


Configurar .env

Gerar key:

php artisan key:generate


Executar migrations:

php artisan migrate


Iniciar o servidor:

php artisan serve

🧩 Resumo da Arquitetura

O projeto foi estruturado seguindo princípios de SOLID, separação de responsabilidades e organização em camadas:

📁 Controllers

Mantidos enxutos.

Responsáveis apenas pelo fluxo HTTP.

Chamam Services para lógica de negócio.

⚙️ Services

Contêm regras de negócio.

Intermediários entre controllers e repositories.

🗄️ Repositories

Implementam acesso ao banco de dados.

Ocultam detalhes do Eloquent.

Seguem inversão de dependência via interfaces.

📦 DTOs

Utilizados para padronizar os dados recebidos.

Ajudam na separação entre transporte e lógica interna.

🛡️ Form Requests

Validação centralizada.

Retorno automático de erros 422.

🧹 Soft Deletes

Implementados com SoftDeletes.

Usuários excluídos não aparecem em consultas comuns.

🔐 Permissões e Roles (Spatie)

Atribuição dinâmica de permissões e roles.

Suporte a assignRole e givePermissionTo.

Role padrão atribuída automaticamente (ex.: admin).

🧪 Testes Automatizados

Testes Feature implementados e passando:

test_store_user_requires_fields

test_store_user_success

test_soft_delete_user

Incluem validação, persistência e comportamento do soft delete.

⚙️ Funcionalidades Principais
✔️ Cadastro de usuário
✔️ Listagem e consulta
✔️ Atualização
✔️ Exclusão com Soft Delete
✔️ Atribuição de permissões e roles
✔️ Validação completa
✔️ Testes automatizados
✔️ Arquitetura limpa
📡 Endpoints (resumo básico)
Método	Rota	Descrição
POST	/api/users	Criar usuário
GET	/api/users/{id}	Buscar usuário
DELETE	/api/users/{id}	Soft delete
POST	/api/users/{id}/permission	Atribuir role/permissão

🧪 Rodando os Testes

php artisan test --filter=UserCrudTest

📄 Considerações Finais

Mesmo com limitações de tempo, o projeto foi desenvolvido mantendo organização modular, responsabilidade única em cada camada e atenção às melhores práticas. A integração com Spatie, o controle de erros, e o fluxo de validação garantem uma API consistente e pronta para evolução.
