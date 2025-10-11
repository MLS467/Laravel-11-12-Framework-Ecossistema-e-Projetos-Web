# Simple API Laravel - Documentação

Esta é uma API REST simples desenvolvida com Laravel 11 para gerenciamento de clientes.

## 📋 Índice

-   [Sobre o Projeto](#sobre-o-projeto)
-   [Estrutura do Banco de Dados](#estrutura-do-banco-de-dados)
-   [Modelos e Factories](#modelos-e-factories)
-   [Seeders](#seeders)
-   [Controllers](#controllers)
-   [Instalação e Configuração](#instalação-e-configuração)
-   [Uso da API](#uso-da-api)

## 🚀 Sobre o Projeto

Esta API foi desenvolvida como parte do curso de Laravel, focando na criação de uma API REST simples para gerenciamento de clientes. O projeto demonstra conceitos fundamentais do Laravel como migrations, models, factories, seeders e controllers.

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

## 🎮 Controllers

### ClientController

**Arquivo:** `app/Http/Controllers/ClientController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Métodos da API serão implementados aqui
}
```

_Nota: O controller está preparado para receber os métodos CRUD da API._

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

## 🔧 Próximos Passos para Completar a API

Para tornar esta uma API REST completa, os seguintes endpoints precisam ser implementados no `ClientController`:

-   `GET /api/clients` - Listar todos os clientes
-   `GET /api/clients/{id}` - Buscar cliente específico
-   `POST /api/clients` - Criar novo cliente
-   `PUT /api/clients/{id}` - Atualizar cliente
-   `DELETE /api/clients/{id}` - Deletar cliente

## 📝 Observações Técnicas

### Problemas Resolvidos Durante o Desenvolvimento

1. **Erro no Seeder**: Foi corrigido um erro onde a Collection retornada pela factory estava sendo passada incorretamente para o método `call()`.

2. **Estrutura do Banco**: A tabela foi otimizada com limites de caracteres apropriados para melhor performance.

3. **Factory Configuration**: Configuração adequada do Factory para gerar dados realistas de teste.

## 🤝 Contribuição

Este projeto faz parte de um curso educacional. Sugestões e melhorias são bem-vindas!

## 📄 Licença

Este projeto é desenvolvido para fins educacionais como parte do curso de Laravel na Udemy.
