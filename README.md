# 🚀 Laravel Eloquent ORM - Relacionamentos Completos

### 4️⃣ **Many-to-Many (BelongsToMany)**

**Rota**: `/belong-to-many`

```php
// Estrutura implementada com tabela pivot 'orders':

// Cliente → Produtos comprados:
$result = Client::with('products')->find(10);

// Produto → Clientes que compraram:
$result = Product::with('clients')->find(10);
```

**Configuração da tabela pivot:**

-   **Tabela**: `orders`
-   **Chaves**: `client_id` ↔ `product_id`
-   **Relacionamento bidirecional** implementado

### 🔗 **Configuração da Pivot Table nos Models**

#### 📋 **Client Model - BelongsToMany**

```php
public function products(): BelongsToMany
{
    return $this->belongsToMany(
        Product::class,      // Model relacionado
        'orders',           // Nome da tabela pivot
        'client_id',        // Foreign key do model atual (Client) na pivot
        'product_id'        // Foreign key do model relacionado (Product) na pivot
    );
}
```

#### 📦 **Product Model - BelongsToMany**

```php
public function clients(): BelongsToMany
{
    return $this->belongsToMany(
        Client::class,       // Model relacionado
        'orders',           // Nome da tabela pivot
        'product_id',       // Foreign key do model atual (Product) na pivot
        'client_id'         // Foreign key do model relacionado (Client) na pivot
    );
}
```

#### 🏗️ **Estrutura da Tabela Pivot `orders`**

```sql
CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_id BIGINT UNSIGNED NOT NULL,     -- FK para clients.id
    product_id BIGINT UNSIGNED NOT NULL,    -- FK para products.id
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,

    UNIQUE KEY unique_client_product (client_id, product_id)
);
```

#### 💡 **Explicação dos Parâmetros**

| Parâmetro              | Descrição                                          | Exemplo          |
| ---------------------- | -------------------------------------------------- | ---------------- |
| **Model relacionado**  | Classe do model que será relacionado               | `Product::class` |
| **Tabela pivot**       | Nome da tabela intermediária                       | `'orders'`       |
| **Foreign key local**  | Coluna na pivot que referencia o model atual       | `'client_id'`    |
| **Foreign key remota** | Coluna na pivot que referencia o model relacionado | `'product_id'`   |

#### 🔄 **Como Funciona na Prática**

```php
// Buscar produtos de um cliente específico:
$client = Client::with('products')->find(10);
foreach ($client->products as $product) {
    echo $product->product_name;
}

// Buscar clientes que compraram um produto específico:
$product = Product::with('clients')->find(5);
foreach ($product->clients as $client) {
    echo $client->client_name;
}

// Laravel automaticamente monta as queries:
// SELECT * FROM clients WHERE id = 10
// SELECT products.*, orders.client_id, orders.product_id
// FROM products
// INNER JOIN orders ON products.id = orders.product_id
// WHERE orders.client_id = 10
```

## 🔧 Métodos Helper Implementados

### `showDataWithHTML($client)` ✅

```php
// Renderização ativa de dados:
// - ID e nome do cliente
// - Lista numerada de telefones
// - Separadores visuais <hr>
// - Contadores automáticos
```

### Métodos Herdados (Controller Base)

```php
show_data($data)           // Debug formatado com print_r
array_of_object($data)     // Conversão de arrays para objetos
```

## 💾 Estrutura do Banco de Dados

### Tabelas Principais

-   **clients** - Dados dos clientes
-   **phones** - Telefones dos clientes
-   **products** - Catálogo de produtos
-   **orders** - Tabela pivot (clientes ↔ produtos)

### Relacionamentos

```sql
clients (1) ←→ (1) phones     -- One-to-One
clients (1) ←→ (N) phones     -- One-to-Many
phones  (N) ←→ (1) clients    -- BelongsTo
clients (N) ←→ (N) products   -- Many-to-Many via orders
```

## 🚀 Como Executar

```bash
# Instalação completa
composer install && npm install

# Configuração do ambiente
cp .env.example .env
php artisan key:generate

# Database SQLite
touch database/database.sqlite
php artisan migrate

# Desenvolvimento com 4 processos simultâneos
composer run dev
```

## 🌐 URLs de Demonstração

-   🏠 **Home**: http://localhost:8000  
    _"ELOQUENT RELATIONSHIPS"_

-   📱 **One-to-One**: http://localhost:8000/one-to-one  
    _Exemplos comentados para estudo_

-   📞 **One-to-Many**: http://localhost:8000/one-to-many  
    _✅ Demonstração ativa - clientes e telefones_

-   🔄 **BelongsTo**: http://localhost:8000/belong-to  
    _✅ Relacionamento inverso ativo_

-   🔗 **Many-to-Many**: http://localhost:8000/belong-to-many  
    _Estrutura de clientes ↔ produtos_

## 🎯 Status das Implementações

### ✅ **Totalmente Funcionais**

-   [x] **HasMany**: Cliente → Múltiplos telefones (com interface)
-   [x] **BelongsTo**: Telefone → Cliente (com formatação HTML)
-   [x] **Models**: Todos os relacionamentos definidos
-   [x] **Eager Loading**: Otimização em todos os métodos ativos
-   [x] **Helper Methods**: Renderização e utilitários

### 📚 **Documentadas para Estudo**

-   [x] **HasOne**: Cliente → Telefone único (código comentado)
-   [x] **BelongsToMany**: Cliente ↔ Produtos (estrutura pronta)
-   [x] **Query Examples**: Múltiplas abordagens demonstradas
-   [x] **Best Practices**: Tratamento de nulos e validações

### 🔧 **Estrutura Técnica**

-   [x] **Tabela Pivot**: orders configurada para Many-to-Many
-   [x] **Foreign Keys**: Relacionamentos bem definidos
-   [x] **Namespace Organization**: Models organizados
-   [x] **Route Structure**: URLs semânticas e claras

## 💡 Conceitos Demonstrados

### 🔄 **Tipos de Relacionamentos**

1. **HasOne/HasMany**: Relacionamentos diretos
2. **BelongsTo**: Relacionamentos inversos
3. **BelongsToMany**: Relacionamentos muitos-para-muitos

### ⚡ **Performance e Otimização**

-   **Eager Loading**: `with()` em todas as consultas ativas
-   **Query Optimization**: Prevenção do problema N+1
-   **Lazy Loading**: Exemplos de carregamento sob demanda

### 🎨 **Interface e Apresentação**

-   **HTML nativo**: Renderização direta no navegador
-   **Formatação visual**: `<hr>`, contadores, estrutura clara
-   **Dados relacionais**: Exibição de informações conectadas

## 📋 Scripts de Desenvolvimento

```bash
composer run dev    # Laravel Server + Queue + Logs + Vite
composer run test   # Testes automatizados
```

---

**Repositório**: Laravel-11-12-Framework-Ecossistema-e-Projetos-Web  
**Desenvolvedor**: MLS467  
**Objetivo**: Estudo completo do Laravel Eloquent ORM e seus relacionamentos
