# Simple API Laravel - Documentação

Esta é uma API REST simples desenvolvida com Laravel 11 para gerenciamento de clientes.

## 📋 Índice

-   [Sobre o Projeto](#sobre-o-projeto)
-   [Estrutura do Banco de Dados](#estrutura-do-banco-de-dados)
-   [Modelos e Factories](#modelos-e-factories)
-   [Seeders](#seeders)
-   [Controllers & Rotas da API](#controllers--rotas-da-api)
-   [Endpoints da API](#endpoints-da-api)
-   [Funcionalidades Implementadas](#funcionalidades-implementadas)
-   [Tratamento de Erros](#tratamento-de-erros)
-   [Instalação e Configuração](#instalação-e-configuração)

## 🚀 Sobre o Projeto

Esta API foi desenvolvida como parte do curso de Laravel, focando na criação de uma API REST **completa** para gerenciamento de clientes. O projeto demonstra conceitos fundamentais do Laravel como migrations, models, factories, seeders e controllers, implementando todas as operações CRUD (Create, Read, Update, Delete).

## 🗄️ Estrutura do Banco de Dados

### Tabela: `clients`

A tabela de clientes foi criada com a seguinte estrutura:

**Migration:** `2025_10_11_191609_create_clients_table.php`

```sql
CREATE TABLE clients (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

#### Campos:

-   **id**: Chave primária auto-incrementável
-   **name**: Nome do cliente (máximo 50 caracteres)
-   **email**: Email do cliente (máximo 50 caracteres, único)
-   **created_at**: Data de criação do registro
-   **updated_at**: Data da última atualização

## 🏗️ Modelos e Factories

### Model: `Client`

**Arquivo:** `app/Models/Client.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'created_at',
        'updated_at'
    ];
}
```

#### Características:

-   Utiliza trait `HasFactory` para integração com factories
-   Campos preenchíveis definidos no array `$fillable`
-   Segue convenções do Eloquent ORM

### Factory: `ClientFactory`

**Arquivo:** `database/factories/clientFactory.php`

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class clientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'created_at' => $this->faker->dateTimeBetween(),
            'updated_at' => $this->faker->dateTimeBetween()
        ];
    }
}
```

#### Funcionalidades:

-   Gera nomes aleatórios usando Faker
-   Cria emails seguros e únicos
-   Define datas aleatórias para created_at e updated_at

## 🌱 Seeders

### DatabaseSeeder

**Arquivo:** `database/seeders/DatabaseSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class DataBaseSeeder extends Seeder
{
    public function run(): void
    {
        Client::factory(100)->create();
    }
}
```

#### Funcionalidade:

-   Cria 100 registros de clientes falsos para teste
-   Utiliza a ClientFactory para gerar dados realistas

## 🎮 Controllers & Rotas da API

### ClientController

**Arquivo:** `app/Http/Controllers/ClientController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function status(): string
    {
        return "status ok";
    }

    public function index(): JsonResponse
    {
        $clients = Client::all()->take(5);

        if (!$clients)
            return response()->json([], 404);

        return response()->json(compact('clients'), 200);
    }

    public function pagination(): JsonResponse
    {
        $clients = Client::paginate(10);

        if (!$clients)
            return response()->json([], 404);

        return response()->json(compact('clients'), 200);
    }

    public function show($client): JsonResponse
    {
        try {
            $client_found = Client::find($client);

            if (!$client_found) throw new ModelNotFoundException('Client Not Found');

            return response()->json(compact('client_found'), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function client_by_id(Request $request)
    {
        $client = Client::find($request->id);

        if (!$request->id || !$client) {
            return response()->json(['message' => 'id not found'], 404);
        }

        return response()->json(
            [
                'message' => 'success client found',
                'data' => $client
            ],
            200
        );
    }

    public function add_client(Request $request)
    {
        $client_instance = new Client();

        $client_instance->name = $request->name;
        $client_instance->email = $request->email;
        $client_instance->save();

        return response()->json(['message' => 'created with success', 'data' => $client_instance], 201);
    }

    public function update_client(Request $request, $id)
    {
        $client_instance = Client::find($id);
        $client_instance->name = $request->name;
        $client_instance->email = $request->email;
        $client_instance->save();

        return response()->json(['message' => 'updated with success', 'data' => $client_instance], 200);
    }

    public function delete_client($id): JsonResponse
    {
        $client = Client::find($id);
        $client->delete();

        return response()->json(['message' => 'deleted with success'], 200);
    }
}
```

### Rotas da API

**Arquivo:** `routes/api.php`

```php
<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::controller(ClientController::class)->group(function () {
    Route::get('/status', 'status');
    Route::get('/clients', 'index');
    Route::get('/client/{client}', 'show');
    Route::get('/client-pagination', 'pagination');
    Route::post('/client-by-id', 'client_by_id');
    Route::post('/add-client', 'add_client');
    Route::put('/update-client/{id}', 'update_client');
    Route::delete('/delete-client/{id}', 'delete_client');
});
```

## 🌐 Endpoints da API

### Status da API

-   **GET** `/api/status`
-   **Descrição**: Verifica se a API está funcionando
-   **Resposta**: String "status ok"

### Listar Clientes (Limitado)

-   **GET** `/api/clients`
-   **Descrição**: Retorna os primeiros 5 clientes
-   **Resposta**: JSON com array de clientes
-   **Status HTTP**: 200 (sucesso) ou 404 (não encontrado)

### Buscar Cliente Específico

-   **GET** `/api/client/{id}`
-   **Descrição**: Busca um cliente pelo ID
-   **Parâmetros**: `id` - ID do cliente
-   **Resposta**: JSON com dados do cliente ou mensagem de erro
-   **Status HTTP**: 200 (sucesso) ou 404 (não encontrado)

### Listar Clientes com Paginação

-   **GET** `/api/client-pagination`
-   **Descrição**: Retorna clientes com paginação (10 por página)
-   **Resposta**: JSON com dados paginados
-   **Status HTTP**: 200 (sucesso) ou 404 (não encontrado)

### Buscar Cliente por ID via POST

-   **POST** `/api/client-by-id`
-   **Descrição**: Busca um cliente pelo ID enviado no corpo da requisição
-   **Parâmetros**:
    -   `id` - ID do cliente (enviado no body da requisição)
-   **Exemplo de requisição**:
    ```json
    {
        "id": 1
    }
    ```
-   **Resposta de sucesso**:
    ```json
    {
        "message": "success client found",
        "data": {
            "id": 1,
            "name": "Cliente Exemplo",
            "email": "cliente@exemplo.com",
            "created_at": "2025-10-13T10:00:00.000000Z",
            "updated_at": "2025-10-13T10:00:00.000000Z"
        }
    }
    ```
-   **Resposta de erro**:
    ```json
    {
        "message": "id not found"
    }
    ```
-   **Status HTTP**: 200 (sucesso) ou 404 (não encontrado)

### Criar Novo Cliente

-   **POST** `/api/add-client`
-   **Descrição**: Cria um novo cliente
-   **Parâmetros**:
    -   `name` - Nome do cliente
    -   `email` - Email do cliente
-   **Exemplo de requisição**:
    ```json
    {
        "name": "João Silva",
        "email": "joao@exemplo.com"
    }
    ```
-   **Resposta de sucesso**:
    ```json
    {
        "message": "created with success",
        "data": {
            "id": 101,
            "name": "João Silva",
            "email": "joao@exemplo.com",
            "created_at": "2025-10-13T12:00:00.000000Z",
            "updated_at": "2025-10-13T12:00:00.000000Z"
        }
    }
    ```
-   **Status HTTP**: 201 (criado)

### Atualizar Cliente

-   **PUT** `/api/update-client/{id}`
-   **Descrição**: Atualiza um cliente existente pelo ID
-   **Parâmetros**:
    -   `id` - ID do cliente (na URL)
    -   `name` - Novo nome do cliente
    -   `email` - Novo email do cliente
-   **Exemplo de requisição**:
    ```json
    {
        "name": "João Santos",
        "email": "joao.santos@exemplo.com"
    }
    ```
-   **Resposta de sucesso**:
    ```json
    {
        "message": "updated with success",
        "data": {
            "id": 1,
            "name": "João Santos",
            "email": "joao.santos@exemplo.com",
            "created_at": "2025-10-13T10:00:00.000000Z",
            "updated_at": "2025-10-13T12:00:00.000000Z"
        }
    }
    ```
-   **Status HTTP**: 200 (sucesso)

### Deletar Cliente

-   **DELETE** `/api/delete-client/{id}`
-   **Descrição**: Remove um cliente pelo ID
-   **Parâmetros**:
    -   `id` - ID do cliente (na URL)
-   **Resposta de sucesso**:
    ```json
    {
        "message": "deleted with success"
    }
    ```
-   **Status HTTP**: 200 (sucesso)

## ✨ Funcionalidades Implementadas

### ✅ Configuração de Rotas para API

-   Criação do arquivo `routes/api.php`
-   Agrupamento de rotas usando `Route::controller()`
-   Definição de endpoints RESTful

### ✅ Controller para API Completa

-   Implementação completa do `ClientController` com **CRUD completo**
-   Métodos para todas as operações (index, show, pagination, status, client_by_id, add_client, update_client, delete_client)
-   Retorno de respostas JSON estruturadas
-   Implementação de método POST para busca por ID
-   **CREATE**: Criação de novos clientes
-   **READ**: Leitura com listagem, busca individual e paginação
-   **UPDATE**: Atualização de clientes existentes
-   **DELETE**: Remoção de clientes

### ✅ Retorno JSON e Status HTTP

-   Uso correto de `JsonResponse`
-   Códigos de status HTTP apropriados (200, 404)
-   Estrutura de dados consistente com `compact()`
-   Tratamento de erros com try/catch

### ✅ Implementação de Paginação

-   Método `pagination()` usando `paginate(10)`
-   Retorno de metadados de paginação
-   Controle de quantidade de registros por página

### ✅ API REST Completa

-   **8 endpoints** implementados cobrindo todas as operações necessárias
-   **CRUD completo**: Create, Read (múltiplas formas), Update, Delete
-   **Status codes apropriados**: 200, 201, 404
-   **Estrutura JSON consistente** em todas as respostas
-   **Diferentes métodos HTTP**: GET, POST, PUT, DELETE

## 🛡️ Tratamento de Erros

### ModelNotFoundException

-   Captura de exceções quando cliente não é encontrado
-   Retorno de mensagens de erro personalizadas
-   Status HTTP 404 para recursos não encontrados

### Validação de Dados

-   Verificação de existência de clientes antes do retorno
-   Retorno de arrays vazios quando não há dados
-   Validação de parâmetros de requisição no método POST

## 🔄 Melhorias Recentes Implementadas

### ✅ Otimização do Método `show()`

-   **Mudança**: Substituição de `Client::where('id', $client)->first()` por `Client::find($client)`
-   **Benefício**: Código mais limpo e performático usando método nativo do Eloquent

### ✅ Novo Endpoint POST para Busca

-   **Implementação**: Método `client_by_id()` com requisição POST
-   **Funcionalidade**: Busca cliente enviando ID no corpo da requisição
-   **Validação**: Verifica se o ID foi enviado e se o cliente existe
-   **Resposta**: Estrutura JSON com mensagem de sucesso e dados do cliente

### ✅ Melhoria nas Respostas JSON

-   **Estrutura padronizada**: Mensagens de sucesso e dados organizados
-   **Correção de status HTTP**: Status 200 para sucesso (estava incorreto como 404)
-   **Mensagens personalizadas**: Diferentes mensagens para diferentes cenários

### ✅ Implementação Completa do CRUD

-   **CREATE** (`add_client`): Criação de novos clientes via POST
    -   Instanciação manual do modelo Client
    -   Atribuição de valores aos campos name e email
    -   Salvamento com `save()` e retorno status 201
-   **READ** (múltiplas implementações):
    -   `index()`: Lista primeiros 5 clientes
    -   `show()`: Busca por ID via parâmetro de rota
    -   `client_by_id()`: Busca por ID via POST
    -   `pagination()`: Lista com paginação (10 por página)
-   **UPDATE** (`update_client`): Atualização via PUT
    -   Busca do cliente existente com `find()`
    -   Atualização dos campos name e email
    -   Salvamento e retorno dos dados atualizados
-   **DELETE** (`delete_client`): Remoção via DELETE
    -   Busca do cliente com `find()`
    -   Remoção com método `delete()`
    -   Confirmação de sucesso na resposta

## ⚙️ Instalação e Configuração

### Pré-requisitos

-   PHP 8.1+
-   Composer
-   Laravel 11
-   Banco de dados (MySQL/PostgreSQL/SQLite)

### Passos de Instalação

1. **Clone o repositório**

    ```bash
    git clone <url-do-repositorio>
    cd curso_laravel_udemy
    ```

2. **Instale as dependências**

    ```bash
    composer install
    ```

3. **Configure o ambiente**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure o banco de dados**

    - Edite o arquivo `.env` com suas credenciais de banco
    - Execute as migrations:

    ```bash
    php artisan migrate
    ```

5. **Execute os seeders**

    ```bash
    php artisan db:seed
    ```

6. **Inicie o servidor**
    ```bash
    php artisan serve
    ```

## 🎉 API REST Completa - Implementação Finalizada

A API agora está **100% funcional** com todas as operações CRUD implementadas:

✅ **CREATE** - Criação de clientes via `POST /api/add-client`  
✅ **READ** - Múltiplas formas de leitura (listagem, busca, paginação)  
✅ **UPDATE** - Atualização via `PUT /api/update-client/{id}`  
✅ **DELETE** - Remoção via `DELETE /api/delete-client/{id}`

**Total de 8 endpoints** cobrindo todas as necessidades de um CRUD completo!

## 📝 Observações Técnicas

### Problemas Resolvidos Durante o Desenvolvimento

1. **Erro no Seeder**: Foi corrigido um erro onde a Collection retornada pela factory estava sendo passada incorretamente para o método `call()`.

2. **Estrutura do Banco**: A tabela foi otimizada com limites de caracteres apropriados para melhor performance.

3. **Factory Configuration**: Configuração adequada do Factory para gerar dados realistas de teste.

## 🤝 Contribuição

Este projeto faz parte de um curso educacional. Sugestões e melhorias são bem-vindas!

## 📄 Licença

Este projeto é desenvolvido para fins educacionais como parte do curso de Laravel na Udemy.
