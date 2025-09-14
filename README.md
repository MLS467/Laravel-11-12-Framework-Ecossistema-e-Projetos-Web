# 🚀 Laravel Eloquent ORM - Relacionamentos

> **Curso**: Laravel 11-12 Framework, Ecossistema e Projetos Web  
> **Seção**: 13 - Laravel Eloquent ORM  
> **Foco**: Relacionamentos Between Models

## 📖 Sobre o Projeto

Este projeto demonstra a implementação prática de relacionamentos no Laravel Eloquent ORM, explorando conceitos fundamentais como **One-to-One** e **One-to-Many** através de exemplos reais com clientes e telefones.

## 🛠️ Stack Tecnológica

-   **PHP** `^8.2`
-   **Laravel Framework** `^12.0`
-   **SQLite** (Database)
-   **Tailwind CSS** `^4.0`
-   **Vite** `^7.0` (Build Tool)
-   **Concurrently** `^9.0` (Multi-process)

## 🏗️ Arquitetura do Projeto

### Models Implementados

#### 📱 Client Model

```php
// Relacionamentos implementados:
public function phone(): HasOne          // Um cliente tem um telefone
public function phones(): HasMany        // Um cliente tem vários telefones
```

#### 📞 Phone Model

```php
// Estrutura básica preparada para relacionamentos inversos
```

#### 📦 Product & Order Models

```php
// Models preparados para expansões futuras
```

### Controllers

#### 🎯 MainController

**Funcionalidades ativas:**

| Método          | Rota           | Funcionalidade           |
| --------------- | -------------- | ------------------------ |
| `__invoke()`    | `/`            | Página inicial           |
| `one_to_one()`  | `/one-to-one`  | Demonstração One-to-One  |
| `one_to_many()` | `/one-to-many` | Demonstração One-to-Many |

#### 🔧 Helper Methods

```php
show_data($data)           // Exibe dados formatados
array_of_object($data)     // Converte arrays em objetos
showDataWithHTML($client)  // Renderiza dados com HTML
```

## 📚 Relacionamentos Implementados

### 1️⃣ One-to-One (Um para Um)

```php
// Client::find(12)->phone
// Busca um cliente específico e seu telefone único
$client = Client::with('phone')->find(12);
```

**Características:**

-   ✅ Eager Loading com `with('phone')`
-   ✅ Tratamento de valores nulos
-   ✅ Acesso direto: `$client->phone->phone_number`

### 2️⃣ One-to-Many (Um para Muitos)

```php
// Client::find(15)->phones
// Busca um cliente e todos seus telefones
$clients = Client::with('phones')->get();
```

**Características:**

-   ✅ Múltiplos telefones por cliente
-   ✅ Listagem numerada automática
-   ✅ Interface HTML responsiva
-   ✅ Iteração otimizada com Eloquent

## 🌐 Rotas Disponíveis

| URL            | Método | Descrição                                 |
| -------------- | ------ | ----------------------------------------- |
| `/`            | GET    | Página inicial - "ELOQUENT RELATIONSHIPS" |
| `/one-to-one`  | GET    | Demo de relacionamento um-para-um         |
| `/one-to-many` | GET    | Demo de relacionamento um-para-muitos     |

## 💡 Conceitos Demonstrados

### ⚡ Performance

-   **Eager Loading**: Evita o problema N+1 com `with()`
-   **Query Optimization**: Reduz consultas ao banco

### 🛡️ Segurança

-   **Null Safety**: Verificação de dados antes do acesso
-   **Data Validation**: Tratamento de relacionamentos opcionais

### 🎨 Interface

-   **HTML Rendering**: Saída formatada para web
-   **Data Presentation**: Contadores automáticos e separadores

## 🚀 Como Executar

### Instalação Rápida

```bash
# Clone e configure
composer install && npm install

# Ambiente
cp .env.example .env
php artisan key:generate

# Database
touch database/database.sqlite
php artisan migrate

# Desenvolvimento (4 processos simultâneos)
composer run dev
```

### Acessar Demonstrações

-   🏠 **Home**: http://localhost:8000
-   📱 **One-to-One**: http://localhost:8000/one-to-one
-   📞 **One-to-Many**: http://localhost:8000/one-to-many

## 📋 Scripts Composer

```bash
composer run dev    # Servidor + Queue + Logs + Vite
composer run test   # Suite de testes completa
```

O comando `dev` executa simultaneamente:

-   **Laravel Server** (Port 8000)
-   **Queue Worker**
-   **Real-time Logs** (Pail)
-   **Vite Dev Server** (Assets)

## 🎯 Features Implementadas

### ✅ Relacionamentos Eloquent

-   [x] **HasOne**: Cliente → Telefone único
-   [x] **HasMany**: Cliente → Múltiplos telefones
-   [x] **Eager Loading**: Otimização de queries
-   [x] **Null Handling**: Tratamento seguro de dados

### ✅ Interface & UX

-   [x] **HTML Output**: Renderização web nativa
-   [x] **Data Formatting**: Contadores e separadores
-   [x] **Responsive**: Layout adaptável

### ✅ Development Experience

-   [x] **Hot Reload**: Vite + Laravel
-   [x] **Multi-process**: Concorrência automatizada
-   [x] **Code Quality**: Pint (Laravel's opinionated PHP CS Fixer)

## 📖 Aprendizados Principais

1. **Relacionamentos Eloquent**: Diferença prática entre HasOne e HasMany
2. **Performance**: Importância do Eager Loading para evitar N+1 queries
3. **Desenvolvimento**: Setup moderno com hot reload e múltiplos processos
4. **Arquitetura**: Separação clara entre Models, Controllers e apresentação

---

**Branch**: `secao-13-laravel-eloquent-ORM`  
**Repositório**: Laravel-11-12-Framework-Ecossistema-e-Projetos-Web

_Projeto desenvolvido como parte do estudo prático do Laravel Eloquent ORM_
