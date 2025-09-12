# 🎯 Seção 13: Laravel Eloquent ORM

Esta seção do curso introduz o **Laravel Eloquent ORM** (Object-Relational Mapping), demonstrando como configurar e customizar modelos para trabalhar com diferentes tabelas e bancos de dados.

## 🔧 Configuração de Modelos Eloquent

### Modelo de Teste: `TestModel`

Foi criado um modelo de exemplo (`app/Models/TestModel.php`) para demonstrar as principais configurações disponíveis no Eloquent:

#### 🏗️ **Configurações Implementadas**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    // Define qual tabela o modelo vai usar (se diferente do padrão)
    protected $table = 'phones';

    // Define qual coluna é a chave primária (padrão é 'id')
    protected $primaryKey = 'id';

    // Desativa o autoincrement (útil para UUIDs ou chaves manuais)
    public $incrementing = false;

    // Define o tipo da chave primária (padrão é 'int')
    protected $keyType = 'string';

    // Desativa os timestamps automáticos (created_at, updated_at)
    public $timestamps = false;

    // Customiza o formato de data/hora dos timestamps
    protected $dateFormat = 'Y-m-d H:i:s';

    // Define nomes personalizados para os campos de timestamp
    const CREATED_AT = 'criado em';
    const UPDATED_AT = 'atualizado em';

    // Define conexão específica (para múltiplos bancos)
    protected $connection = 'mysql_new';
}
```

#### 📋 **Detalhamento das Configurações**

| Propriedade     | Descrição                    | Exemplo                |
| --------------- | ---------------------------- | ---------------------- |
| `$table`        | Nome da tabela no banco      | `'phones'`             |
| `$primaryKey`   | Campo da chave primária      | `'id'`                 |
| `$incrementing` | Se a chave é auto-incremento | `false` para UUIDs     |
| `$keyType`      | Tipo da chave primária       | `'string'` ou `'int'`  |
| `$timestamps`   | Se usa created_at/updated_at | `false` para desativar |
| `$dateFormat`   | Formato das datas            | `'Y-m-d H:i:s'`        |
| `CREATED_AT`    | Nome customizado do campo    | `'criado em'`          |
| `UPDATED_AT`    | Nome customizado do campo    | `'atualizado em'`      |
| `$connection`   | Conexão de banco específica  | `'mysql_new'`          |

## 🚀 Uso Básico do Eloquent

### Controller Principal: `MainController`

O controller demonstra o uso básico do Eloquent para buscar dados:

```php
<?php

namespace App\Http\Controllers;

use App\Models\TestModel;

class MainController extends Controller
{
    public function __invoke()
    {
        // Busca todos os registros e converte para array
        $products = TestModel::all()->toArray();

        $this->show_data($products);
    }
}
```

#### 🔍 **Métodos Básicos do Eloquent**

```php
// Buscar todos os registros
TestModel::all();

// Buscar todos e converter para array
TestModel::all()->toArray();

// Buscar por ID
TestModel::find(1);

// Buscar com condições
TestModel::where('active', true)->get();

// Buscar primeiro registro
TestModel::first();

// Contar registros
TestModel::count();
```

## 🎓 Conceitos Aprendidos - Eloquent ORM

-   **Configuração de Modelos**: Customização completa de propriedades do modelo
-   **Mapeamento de Tabelas**: Definição de tabela específica para o modelo
-   **Chaves Primárias**: Configuração de chaves não-padrão (UUIDs, strings)
-   **Timestamps**: Controle de campos de data automáticos
-   **Conexões Múltiplas**: Uso de diferentes bancos de dados
-   **Consultas Básicas**: Métodos fundamentais do Eloquent (all, find, where)
-   **Conversão de Dados**: Transformação de coleções em arrays

## 🔗 Rota de Teste

```php
// routes/web.php
Route::get('/', MainController::class);
```

## 💡 Vantagens do Eloquent ORM

1. **Sintaxe Intuitiva**: Código mais legível e orientado a objetos
2. **Flexibilidade**: Configurações personalizáveis para diferentes cenários
3. **Produtividade**: Menos código SQL manual
4. **Segurança**: Proteção automática contra SQL injection
5. **Relacionamentos**: Facilita trabalho com dados relacionados
6. **Eventos**: Sistema de eventos para hooks automáticos

---

**Desenvolvido durante o curso:** Laravel 11/12 - Framework, Ecossistema e Projetos Web (Udemy)  
**Seção Atual:** 13 - Laravel Eloquent ORM

## 📊 Exemplos Práticos de Eloquent ORM

### 🔍 **Consultas Básicas com Eloquent**

#### 1. **Buscar Todos os Registros**

```php
// Retorna Eloquent\Collection Object
$result = Product::all();

// Convertendo para array
$result = Product::all()->toArray();
```

#### 2. **Conversão de Dados**

```php
// Convertendo Collection para Array de Objetos stdClass
$result = $this->array_of_object(Product::all()->toArray());
```

#### 3. **Ordenação de Resultados**

```php
// Ordenando produtos pelo nome (A-Z)
$result = Product::orderBy('product_name', 'asc')
    ->get()
    ->toArray();
```

#### 4. **Limitação de Resultados**

```php
// Pegando apenas os 3 primeiros produtos
$result = Product::limit(3)
    ->get()
    ->toArray();
```

#### 5. **Busca por ID Específico**

```php
// Buscando produto por ID
$result = Product::find(10)->toArray();
```

### 🎯 **Conceitos Demonstrados**

-   **Eloquent Collections**: Objetos nativos do Laravel para manipulação de dados
-   **Method Chaining**: Encadeamento de métodos para consultas mais fluidas
-   **Conversão de Dados**: Transformação entre Collection, Array e stdClass
-   **Consultas Otimizadas**: Uso de `orderBy()`, `limit()`, `find()`
-   **Flexibilidade**: Diferentes formas de obter e manipular os mesmos dados

### 💡 **Diferenças entre Query Builder e Eloquent**

| Aspecto         | Query Builder            | Eloquent ORM                    |
| --------------- | ------------------------ | ------------------------------- |
| **Sintaxe**     | `DB::table('products')`  | `Product::`                     |
| **Retorno**     | Array/Collection simples | Eloquent Collection             |
| **Recursos**    | Consultas SQL diretas    | Relacionamentos, Mutators, etc. |
| **Performance** | Mais rápido              | Ligeiramente mais lento         |
| **Facilidade**  | Sintaxe SQL              | Orientado a objetos             |

### 🚀 **Vantagens do Eloquent Demonstradas**

1. **Sintaxe Mais Limpa**: `Product::all()` vs `DB::table('products')->get()`
2. **Orientação a Objetos**: Trabalha diretamente com modelos
3. **Collections Poderosas**: Métodos como `toArray()` para conversão
4. **Method Chaining**: Encadeamento natural de métodos
5. **Facilidade de Manutenção**: Código mais legível e organizado

---
