Este projeto foi desenvolvido durante o curso de Laravel 11/12 da Udemy, focando no aprendizado do framework Laravel e suas funcionalidades, especialmente o Laravel Query Builder para execução de queries no banco de dados.

## 🎯 Objetivo do Projeto

Demonstrar o uso prático do **Laravel Query Builder** através de exemplos de consultas SQL utilizando a facade `DB`, explorando diferentes métodos de busca, filtros e manipulação de dados.

## 🏗️ Arquitetura do Projeto

### Modelos (Models)

O projeto conta com 4 modelos principais que representam um sistema de pedidos:

#### 1. **Client** (`app/Models/Client.php`)

-   **Campos**: `client_name`, `email`, `active`
-   **Recursos**: Soft Deletes habilitado
-   **Relacionamentos**: Possui telefones e pedidos

#### 2. **Phone** (`app/Models/Phone.php`)

-   **Campos**: `client_id`, `phone_number`
-   **Relacionamentos**: Pertence a um cliente

#### 3. **Products** (`app/Models/Products.php`)

-   **Campos**: `product_name`, `price`
-   **Recursos**: Soft Deletes habilitado

#### 4. **Order** (`app/Models/Order.php`)

-   **Campos**: `order_number`, `client_id`, `product_id`, `quantity`
-   **Relacionamentos**: Pertence a um cliente e a um produto

### Banco de Dados

O projeto utiliza **SQLite** como banco de dados (`database/curso_laravel.sqlite3`).

#### Estrutura das Tabelas:

```sql
-- Tabela clients
id, client_name, email, active, deleted_at, created_at, updated_at

-- Tabela phones
id, client_id, phone_number, deleted_at, created_at, updated_at

-- Tabela products
id, product_name, price, deleted_at, created_at, updated_at

-- Tabela orders
id, order_number, client_id, product_id, quantity, deleted_at, created_at, updated_at
```

### Migrations

4 migrations foram criadas para estruturar o banco:

1. `2025_09_03_162416_create_clients_table.php`
2. `2025_09_03_162438_create_phones_table.php`
3. `2025_09_03_162447_create_products_table.php`
4. `2025_09_03_162512_create_orders_table.php`

### Factories & Seeders

**Factories configuradas:**

-   `ClientFactory`: Gera 500 clientes com dados fake
-   `PhoneFactory`: Gera telefones para os clientes
-   `ProductsFactory`: Gera produtos com preços aleatórios
-   `OrderFactory`: Gera pedidos relacionando clientes e produtos

**Seeders implementados:**

-   `clientSeedersTable`: Popula tabela clients
-   `ProductsSeeder`: Popula tabela products
-   `OrderSeeder`: Popula tabela orders
-   `PhoneSeeder`: Popula tabela phones

## 🔍 Laravel Query Builder - Exemplos Implementados

### Controller Principal (`app/Http/Controllers/MainController.php`)

O controller contém diversos exemplos de uso do Laravel Query Builder:

#### 📊 Consultas Básicas

```php
// Buscar todos os registros
DB::table('clients')->get();

// Buscar colunas específicas
DB::table('clients')->get(['client_name', 'email']);

// Buscar primeiro/último registro
DB::table('clients')->first();
DB::table('clients')->last();

// Buscar por ID
DB::table('clients')->find(10);
```

#### 🔎 Filtros e Condições

```php
// Where simples
DB::table('clients')->where('id', 10)->get();

// Múltiplas condições (AND)
DB::table('clients')
    ->where('id', '>', 10)
    ->where('client_name', 'like', 'a%')
    ->get();

// Condições OR
DB::table('clients')
    ->where('id', '>', 450)
    ->orWhere('client_name', 'like', 'a%')
    ->get();

// Where com array (equivale ao AND)
DB::table('clients')->where([
    ['id', '>', 400],
    ['client_name', 'like', 'a%']
])->get();
```

#### 🔍 Consultas Avançadas

```php
// Consultas complexas com closure
DB::table('clients')
    ->where('id', '>', 450)
    ->orWhere(function (Builder $item) {
        $item->where('client_name', 'like', 'a%');
    })->get();

// NOT LIKE
DB::table('products')
    ->where('product_name', 'not like', 'M%')
    ->get();

// whereNot
DB::table('products')
    ->whereNot('product_name', 'like', 'M%')
    ->get();

// whereAny - busca em múltiplas colunas
DB::table('clients')
    ->whereAny(['client_name', 'email'], 'like', '%tr%')
    ->get();

// whereBetween - valores dentro de um intervalo
DB::table('products')
    ->whereBetween('price', [60000, 100000])
    ->get();

// whereNotBetween - valores fora do intervalo
DB::table('products')
    ->whereNotBetween('price', [60000, 100000])
    ->get();
```

#### 📋 Métodos de Extração de Dados

```php
// pluck - extrair valores de uma coluna
DB::table('clients')
    ->where('id', '>', 400)
    ->pluck('email');

// select específico
DB::table('clients')
    ->select('client_name')
    ->where('id', 10)
    ->get();
```

#### 🛠️ Métodos Utilitários

```php
// Converter para array
DB::table('clients')->get()->toArray();

// Mapear resultados
DB::table('clients')->get()->map(function ($item) {
    return (array) $item;
});
```

#### 🆕 Consultas Adicionais Implementadas

```php
// whereIn - buscar por valores específicos em uma lista
// Equivale a: SELECT * FROM products WHERE id IN (1, 5, 3)
DB::table('products')
    ->whereIn('id', [1, 5, 3])
    ->get();

// whereNotIn - excluir valores específicos de uma lista
// Equivale a: SELECT * FROM products WHERE id NOT IN (1, 5, 3)
DB::table('products')
    ->whereNotIn('id', [1, 5, 3])
    ->limit(10)
    ->get();

// whereNotNull - buscar registros com valores não nulos
DB::table('clients')
    ->whereNotNull('deleted_at')
    ->limit(10)
    ->get();

// whereDate - buscar por data específica
DB::table('products')
    ->whereDate('created_at', '2025-09-05')
    ->limit(10)
    ->get();

// whereDay - buscar por dia específico do mês
DB::table('products')
    ->whereDay('created_at', '03')
    ->limit(10)
    ->get();
```

#### 📊 Funções de Agregação

```php
// Contar registros
$count = DB::table('products')->count('id');

// Valor máximo
$max = DB::table('products')->max('price');

// Valor médio
$avg = DB::table('products')->avg('price');

// Valor mínimo
$min = DB::table('products')->min('price');

// Soma de valores
$sum_price = DB::table('products')->sum('price');

// Exemplo de uso combinado das funções de agregação
$agregation = [
    'count' => $count,
    'max' => $max,
    'avg' => $avg,
    'min' => $min,
    'sum' => $sum_price,
];
```

#### 📋 Ordenação e Limitação de Resultados

```php
// Ordenar por preço (decrescente) e limitar a 10 registros
DB::table('products')
    ->orderBy('price', 'desc')
    ->limit(10)
    ->get();

// Ordenar por nome (crescente)
DB::table('clients')
    ->orderBy('client_name', 'asc')
    ->get();
```

#### 🗃️ Operações CRUD (Create, Read, Update, Delete)

##### 📝 CREATE - Inserção de Dados

```php
// Preparar dados com Carbon para timestamps
$data = [
    'client_name' => 'batata 5223',
    'email' => 'batata@frita.com',
    'active' => rand(0, 1),
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now()
];

// 1ª maneira - inserir usando variável
DB::table('clients')->insert($data);

// 2ª maneira - inserir dados diretamente
DB::table('clients')->insert([
    'client_name' => 'batata insert direto',
    'email' => 'batata66@frita.com',
    'active' => rand(0, 1),
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now()
]);

// 3ª maneira - inserir múltiplos registros
DB::table('clients')->insert([
    [
        'client_name' => 'batata insert primeiro',
        'email' => 'batata666@frita.com',
        'active' => rand(0, 1),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'client_name' => 'batata insert segundo',
        'email' => 'batat776@frita.com',
        'active' => rand(0, 1),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]
]);
```

##### ✏️ UPDATE - Atualização de Dados

```php
// Atualizar registro específico por ID
DB::table('clients')
    ->where('id', 1)
    ->update([
        'client_name' => 'ALTERADO',
        'email' => 'batatA776@frita.com',
        'active' => rand(0, 1),
        'updated_at' => Carbon::now()
    ]);
```

##### 🗑️ DELETE - Exclusão de Dados

```php
// DELETE HARD - Exclusão física (permanente)
$id = 2;

// Excluir registros relacionados primeiro
DB::table('phones')->where('client_id', $id)->delete();
DB::table('orders')->where('client_id', $id)->delete();

// Excluir o cliente
DB::table('clients')->where('id', $id)->delete();

// DELETE SOFT - Exclusão lógica (soft delete)
$id = 3;

DB::table('clients')
    ->where('id', $id)
    ->update(['deleted_at' => Carbon::now()]);

// Buscar registros soft deleted
$result = DB::table('clients')
    ->whereNotNull('deleted_at')
    ->get();
```

##### 🛡️ Tratamento de Erros

```php
// Usar try-catch para operações CRUD
try {
    DB::table('clients')->insert($data);

    // Outras operações...

} catch (Exception $error) {
    echo $error->getMessage();
}
```

## 🛠️ Configuração e Instalação

### Pré-requisitos

-   PHP 8.1+
-   Composer
-   SQLite

### Instalação

1. **Clone o repositório:**

```bash
git clone [repository-url]
cd curso_laravel_udemy
```

2. **Instale as dependências:**

```bash
composer install
```

3. **Configure o ambiente:**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Execute as migrations:**

```bash
php artisan migrate
```

5. **Execute os seeders:**

```bash
php artisan db:seed
```

6. **Inicie o servidor:**

```bash
php artisan serve
```

## 🚀 Como Usar

1. Acesse `http://localhost:8000` para ver a aplicação
2. Os exemplos de Query Builder estão comentados no `MainController`
3. Descomente as linhas que deseja testar
4. Utilize os métodos `showRawData()` ou `showRawTable()` para visualizar os resultados

## 📁 Estrutura de Arquivos Principais

```
curso_laravel_udemy/
├── app/
│   ├── Http/Controllers/
│   │   └── MainController.php        # Controller principal com exemplos
│   └── Models/                       # Modelos Eloquent
├── database/
│   ├── factories/                    # Factories para dados fake
│   ├── migrations/                   # Estrutura do banco
│   ├── seeders/                      # Populadores de dados
│   └── curso_laravel.sqlite3         # Banco SQLite
└── routes/
    └── web.php                       # Rotas da aplicação
```

## 🎓 Conceitos Aprendidos

-   **Laravel Query Builder**: Construção de queries SQL de forma fluente
-   **Migrations**: Controle de versão do banco de dados
-   **Seeders & Factories**: Geração de dados de teste
-   **Soft Deletes**: Exclusão lógica de registros
-   **Relacionamentos**: Chaves estrangeiras entre tabelas
-   **Métodos de Consulta**: get(), first(), last(), find(), pluck()
-   **Filtros Avançados**: where(), orWhere(), whereNot(), whereAny(), whereBetween()
-   **Filtros de Lista**: whereIn(), whereNotIn()
-   **Filtros de Nulidade**: whereNotNull(), whereNull()
-   **Filtros de Data**: whereDate(), whereDay(), whereMonth(), whereYear()
-   **Limitação de Resultados**: limit(), offset()
-   **Funções de Agregação**: count(), max(), min(), avg(), sum()
-   **Ordenação de Dados**: orderBy() com asc/desc
-   **Operações CRUD**: insert(), update(), delete()
-   **Gerenciamento de Timestamps**: Carbon::now()
-   **Tratamento de Erros**: try-catch com Exception
-   **Soft Delete Manual**: Atualização do campo deleted_at

## 📖 Recursos de Aprendizado

-   Documentação oficial do Laravel Query Builder
-   Exemplos práticos de consultas SQL
-   Padrões de desenvolvimento com Laravel
-   Boas práticas de estruturação de projetos

---

**Desenvolvido durante o curso:** Laravel 11/12 - Framework, Ecossistema e Projetos Web (Udemy)  
**Seção Atual:** Executando Queries com Laravel Query Builder
