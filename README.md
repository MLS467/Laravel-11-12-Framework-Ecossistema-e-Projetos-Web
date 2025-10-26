# API Laravel com Autenticação Sanctum

## Sobre o Projeto

Este projeto implementa uma API RESTful para gerenciamento de clientes com sistema de autenticação usando Laravel Sanctum. A API foi desenvolvida seguindo boas práticas de estruturação e segurança.

## 📚 Lista de Aulas do Curso

### Seção 1: Fundamentos do Laravel

-   **Aula 01**: Introdução ao Laravel 11 e preparação do ambiente
-   **Aula 02**: Estrutura de pastas e arquivos do Laravel
-   **Aula 03**: Configuração inicial e variáveis de ambiente
-   **Aula 04**: Conceitos básicos de rotas e controllers

### Seção 2: Banco de Dados e Models

-   **Aula 05**: Configuração do banco de dados MySQL
-   **Aula 06**: Criação e configuração do Model User
-   **Aula 07**: Implementação do Model Client
-   **Aula 08**: Migrations - estruturação das tabelas
-   **Aula 09**: Seeders e Factories para popular dados

### Seção 3: Laravel Sanctum - Autenticação

-   **Aula 10**: Instalação e configuração do Laravel Sanctum
-   **Aula 11**: Conceitos de autenticação com tokens
-   **Aula 12**: Implementação do sistema de login
-   **Aula 13**: Middleware de autenticação e proteção de rotas
-   **Aula 14**: Sistema de logout e invalidação de tokens

### Seção 4: API RESTful - Controllers

-   **Aula 15**: Criação do AuthController
-   **Aula 16**: Implementação dos métodos de autenticação
-   **Aula 17**: Criação do ClientController
-   **Aula 18**: Implementação do CRUD de clientes
-   **Aula 19**: Estruturação das rotas da API

### Seção 5: Validações e Tratamento de Erros

-   **Aula 20**: Validação de dados no login
-   **Aula 21**: Validação de dados dos clientes
-   **Aula 22**: Mensagens de erro personalizadas
-   **Aula 23**: Tratamento de exceções e erros da API

### Seção 6: Sistema de Permissões (Abilities)

-   **Aula 24**: Introdução às abilities do Sanctum
-   **Aula 25**: Implementação de permissões granulares
-   **Aula 26**: Controle de acesso por funcionalidade
-   **Aula 27**: Limitações das abilities no Laravel 11

### Seção 7: Padronização e Boas Práticas

-   **Aula 28**: Criação do Service ApiResponse
-   **Aula 29**: Padronização de retornos JSON
-   **Aula 30**: Organização de código em Services
-   **Aula 31**: Testes da API com Postman/Insomnia

### Seção 8: Finalização e Deploy

-   **Aula 32**: Documentação da API
-   **Aula 33**: Boas práticas de segurança
-   **Aula 34**: Preparação para deploy
-   **Aula 35**: Considerações finais e próximos passos

## O que foi Implementado

### 🔐 Sistema de Autenticação (AuthController)

**Arquivo**: `app/Http/Controllers/Api/auth/AuthController.php`

#### Login (`POST /api/login`)

-   Validação de email e senha
-   Geração de token com abilities específicas
-   Token com expiração de 1 hora
-   Retorno padronizado com token e dados do usuário

```php
// Abilities configuradas no token
$abilits = ['client:list', 'client:details', 'client:store', 'client:destroy'];
$token = $user->createToken($user->name, $abilits, now()->addHour())->plainTextToken;
```

#### Logout (`POST /api/logout`)

-   Invalidação de todos os tokens do usuário
-   Retorno de confirmação de logout

### 👥 CRUD de Clientes (ClientController)

**Arquivo**: `app/Http/Controllers/Api/client/ClientController.php`

#### Funcionalidades Implementadas:

1. **Listar Clientes** (`GET /api/client`)

    - Verificação de permissão `client:list`
    - Retorna todos os clientes

2. **Criar Cliente** (`POST /api/client`)

    - Verificação de permissão `client:store`
    - Validação de dados (nome, email, telefone)
    - Criação do cliente no banco

3. **Visualizar Cliente** (`GET /api/client/{id}`)

    - Verificação de permissão `client:details`
    - Busca cliente por ID
    - Tratamento de cliente não encontrado

4. **Atualizar Cliente** (`PUT /api/client/{id}`)

    - Verificação de permissão `client:update`
    - Validação diferenciada para update
    - Atualização e retorno dos dados atualizados

5. **Excluir Cliente** (`DELETE /api/client/{id}`)
    - Verificação de permissão `client:destroy`
    - Exclusão do cliente
    - Tratamento de erros na exclusão

### 🛡️ Sistema de Permissões

**Controle de Acesso Implementado:**

-   Verificação manual de abilities usando `tokenCan()`
-   Permissões granulares por operação
-   Retorno de erro 401 para acesso não autorizado

```php
if (!Auth()->user()->tokenCan("client:list"))
    return ApiResponse::error(401, 'Não autorizado para essa função');
```

> **⚠️ Nota Importante**: O sistema de abilities a nível de rota não funciona perfeitamente no Laravel 11, por isso foi implementado o controle manual nos controllers.

### 📊 Service de Resposta Padronizada

**Arquivo**: `app/Http/Services/ApiResponse.php`

Implementação de métodos estáticos para padronizar retornos:

-   `ApiResponse::success()` - Para respostas de sucesso
-   `ApiResponse::error()` - Para respostas de erro

Todas as respostas seguem o padrão:

```json
{
    "status_code": 200,
    "message": "Mensagem descritiva",
    "data": {} // apenas em caso de sucesso
}
```

### 🗄️ Models Configurados

#### User Model (`app/Models/User.php`)

-   Trait `HasApiTokens` para Sanctum
-   Campos fillable: name, email, password
-   Campo password oculto nas respostas

#### Client Model (`app/Models/Client.php`)

-   Trait `HasApiTokens` para Sanctum
-   Campos fillable: name, email, phone
-   Configuração para uso com factory

### 🛣️ Rotas da API

**Arquivo**: `routes/api.php`

#### Rotas Públicas (guest middleware):

-   `POST /api/login` - Autenticação

#### Rotas Protegidas (auth:sanctum middleware):

-   `GET /api/status` - Status da API
-   `POST /api/logout` - Logout
-   `Resource /api/client` - CRUD completo de clientes

### ✅ Validações Implementadas

#### Validação de Login:

-   Email: obrigatório e formato válido
-   Senha: obrigatória, mínimo 6 caracteres
-   Mensagens personalizadas em português

#### Validação de Cliente:

-   **Store**: Campos obrigatórios com validação completa
-   **Update**: Validação mais flexível, campos opcionais
-   Nome: 3-50 caracteres
-   Email: formato válido e único
-   Telefone: exatamente 10 caracteres (opcional)

### 🗃️ Estrutura do Banco

#### Migration de Clientes (`2025_10_25_001014_create_clients_table.php`)

-   Tabela `clients` com campos: id, name, email, phone, timestamps
-   Estrutura simples e eficiente

### 🏗️ Arquitetura Implementada

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── auth/AuthController.php
│   │       └── client/ClientController.php
│   └── Services/
│       └── ApiResponse.php
├── Models/
│   ├── User.php
│   └── Client.php
```

## Como Testar a API

1. **Login**:

    ```
    POST /api/login
    {
      "email": "email@exemplo.com",
      "password": "senha123"
    }
    ```

2. **Usar o token nos headers**:

    ```
    Authorization: Bearer {token_recebido}
    ```

3. **Testar endpoints de cliente conforme as permissões**

## Características Técnicas

-   **Laravel 11**: Framework atualizado
-   **Sanctum**: Autenticação simples e eficaz
-   **Validação**: Robusta com mensagens personalizadas
-   **Padronização**: Service centralizado para respostas
-   **Segurança**: Controle granular de permissões
-   **Estrutura**: Organização clara de controllers por domínio

---

_Esta API foi desenvolvida com foco em segurança, padronização e boas práticas do Laravel._
