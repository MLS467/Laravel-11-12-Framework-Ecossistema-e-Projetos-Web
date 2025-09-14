# Laravel 11 - Eloquent ORM Relationships

Este projeto é parte do curso de Laravel na Udemy, focado no estudo do framework Laravel 11, seu ecossistema e desenvolvimento de projetos web, especificamente na seção sobre **Laravel Eloquent ORM**.

## 📋 Sobre o Projeto

Este projeto demonstra a implementação de relacionamentos no Laravel Eloquent ORM, especificamente explorando relacionamentos One-to-One (um para um) entre entidades.

## 🚀 Tecnologias Utilizadas

-   **PHP**: ^8.2
-   **Laravel Framework**: ^12.0
-   **Laravel Tinker**: ^2.10.1
-   **SQLite**: Banco de dados padrão
-   **Composer**: Gerenciador de dependências PHP
-   **NPM**: Gerenciador de pacotes Node.js
-   **Vite**: Build tool para assets

### Dependências de Desenvolvimento

-   **Faker**: ^1.23 - Geração de dados fictícios
-   **Laravel Pail**: ^1.2.2 - Logs em tempo real
-   **Laravel Pint**: ^1.13 - Code style fixer
-   **Laravel Sail**: ^1.41 - Ambiente Docker
-   **PHPUnit**: ^11.5.3 - Testes unitários
-   **Mockery**: ^1.6 - Mocking para testes

## 🏗️ Estrutura do Projeto

### Models (Eloquent)

O projeto conta com 4 modelos principais:

#### 1. Client (`app/Models/Client.php`)

-   **Relacionamento**: HasOne com Phone
-   **Funcionalidade**: Representa clientes do sistema
-   **Relacionamento implementado**: `phone()` - relacionamento um-para-um com telefone

```php
public function phone(): HasOne
{
    return $this->hasOne(Phone::class, 'client_id');
}
```

#### 2. Phone (`app/Models/Phone.php`)

-   **Funcionalidade**: Armazena números de telefone dos clientes
-   **Relacionamento**: Pertence a um Cliente (Client)

#### 3. Product (`app/Models/Product.php`)

-   **Funcionalidade**: Representa produtos do sistema
-   **Status**: Modelo básico preparado para expansões futuras

#### 4. Order (`app/Models/Order.php`)

-   **Funcionalidade**: Representa pedidos do sistema
-   **Status**: Modelo básico preparado para expansões futuras

### Controllers

#### MainController (`app/Http/Controllers/MainController.php`)

**Métodos implementados:**

1. **`__invoke()`**

    - Método principal do controlador
    - Exibe: "ELOQUENT RELATIONSHIPS"

2. **`one_to_one()`**
    - Demonstra relacionamentos One-to-One
    - **Funcionalidades**:
        - Busca todos os clientes com seus respectivos telefones usando `with('phone')`
        - Exibe dados formatados de clientes e telefones
        - Trata casos onde cliente não possui telefone cadastrado
        - Mostra ID, nome do cliente, número do telefone e ID de relacionamento

**Exemplos de uso no método `one_to_one()`:**

```php
// Busca clientes com telefones (Eager Loading)
$result = Client::with('phone')->get();

// Iteração e exibição de dados com tratamento de nulos
foreach ($result as $value) {
    $phone = $value->phone != '' ? $value->phone->phone_number : '<b> Não informado </b>';
    $client_id = $value->phone != '' ? $value->phone->client_id : '<b> Não informado </b>';

    echo "id => {$value->id} Nome => {$value->client_name} Telefone => {$phone}";
}
```

### Rotas (`routes/web.php`)

| Método | Rota          | Controller     | Ação           | Descrição                                        |
| ------ | ------------- | -------------- | -------------- | ------------------------------------------------ |
| GET    | `/`           | MainController | `__invoke()`   | Página inicial - mostra "ELOQUENT RELATIONSHIPS" |
| GET    | `/one-to-one` | MainController | `one_to_one()` | Demonstração de relacionamento One-to-One        |

## 🔧 Comandos de Desenvolvimento

### Scripts Composer Personalizados

```bash
# Executar ambiente de desenvolvimento completo
composer run dev

# Executar testes
composer run test
```

O comando `composer run dev` executa simultaneamente:

-   **Servidor Laravel**: `php artisan serve`
-   **Queue Worker**: `php artisan queue:listen --tries=1`
-   **Log Viewer**: `php artisan pail --timeout=0`
-   **Vite Dev Server**: `npm run dev`

## 📚 Conceitos Demonstrados

### 1. Relacionamentos Eloquent

-   **One-to-One (HasOne)**: Implementado entre Client e Phone
-   **Eager Loading**: Uso de `with()` para otimizar consultas
-   **Tratamento de Relacionamentos Nulos**: Verificação de existência antes de acessar propriedades

### 2. Boas Práticas

-   **Namespace organizado**: Modelos em `App\Models`
-   **Controladores RESTful**: Uso de métodos descritivos
-   **Rotas nomeadas**: Organização clara de endpoints
-   **Tratamento de erros**: Verificação de dados antes da exibição

## 🎯 Funcionalidades Implementadas

### ✅ Relacionamentos Eloquent

-   [x] One-to-One entre Client e Phone
-   [x] Eager Loading para otimização de queries
-   [x] Tratamento de relacionamentos opcionais

### ✅ Estrutura MVC

-   [x] Models com relacionamentos
-   [x] Controllers com lógica de negócio
-   [x] Views básicas (template de teste)
-   [x] Rotas organizadas

### ✅ Ambiente de Desenvolvimento

-   [x] Configuração completa do Laravel 12
-   [x] Scripts de desenvolvimento automatizados
-   [x] Ferramentas de qualidade de código (Pint)
-   [x] Sistema de logs em tempo real (Pail)

## 🚦 Como Executar

1. **Instalar dependências:**

```bash
composer install
npm install
```

2. **Configurar ambiente:**

```bash
cp .env.example .env
php artisan key:generate
```

3. **Executar migrações:**

```bash
php artisan migrate
```

4. **Iniciar ambiente de desenvolvimento:**

```bash
composer run dev
```

5. **Acessar aplicação:**

-   **Home**: http://localhost:8000 - Exibe "ELOQUENT RELATIONSHIPS"
-   **One-to-One Demo**: http://localhost:8000/one-to-one - Demonstração de relacionamentos

## 📖 Aprendizados

Este projeto demonstra:

1. **Relacionamentos Eloquent**: Como implementar e utilizar relacionamentos One-to-One
2. **Eager Loading**: Otimização de consultas ao banco de dados
3. **Tratamento de Dados**: Como lidar com relacionamentos opcionais
4. **Estrutura MVC**: Organização adequada de código Laravel
5. **Ambiente de Desenvolvimento**: Configuração de ferramentas modernas de desenvolvimento

## 🔄 Branch Atual

**Branch**: `secao-13-laravel-eloquent-ORM`

Esta branch foca especificamente no estudo e implementação do Laravel Eloquent ORM, fazendo parte da Seção 13 do curso.

---

_Este projeto faz parte do curso "Laravel 11-12 Framework, Ecossistema e Projetos Web" e serve como base prática para o aprendizado de relacionamentos no Laravel Eloquent ORM._
