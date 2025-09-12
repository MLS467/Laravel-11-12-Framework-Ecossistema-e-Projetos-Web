# 📚 Laravel Eloquent ORM - Operações CRUD

Este projeto demonstra as diferentes formas de realizar operações CRUD (Create, Read, Update, Delete) usando o **Laravel Eloquent ORM**.

## 🎯 Operações de Inserção (CREATE)

### 1. 📝 **Inserção Individual com save()**

#### Método 1: Instanciação e save()

```php
// Criando nova instância do modelo
$product = new Product();
$product->price = 50;
$product->product_name = 'produto 1';
$product->save(); // Salva no banco de dados
```

**Características:**

-   ✅ Controle total sobre cada propriedade
-   ✅ Permite validações antes do save()
-   ✅ Retorna boolean (true/false)
-   ✅ Ideal para dados dinâmicos ou condicionais

---

### 2. 🚀 **Inserção com create()**

#### Método 2: Mass Assignment

```php
// Inserção direta com array de dados
Product::create([
    'product_name' => 'Fogão',
    'price' => 500
]);
```

**Características:**

-   ✅ Sintaxe mais limpa e concisa
-   ✅ Inserção em uma única linha
-   ✅ Retorna a instância criada
-   ⚠️ Requer configuração de `$fillable` no modelo

---

### 3. ⚡ **Inserção Múltipla com insert()**

#### Método 3: Bulk Insert

```php
// Inserindo múltiplos registros de uma vez
Product::insert([
    [
        'product_name' => 'product 500',
        'price' => 500
    ],
    [
        'product_name' => 'product 600',
        'price' => 600
    ],
    [
        'product_name' => 'product 700',
        'price' => 700
    ]
]);
```

**Características:**

-   ✅ Performance otimizada para múltiplos registros
-   ✅ Uma única query SQL para todos os registros
-   ✅ Ideal para imports ou seeders
-   ⚠️ Não dispara eventos do Eloquent
-   ⚠️ Não retorna instâncias dos modelos criados

---

## 📊 Comparação dos Métodos

| Método     | Performance | Eventos Eloquent | Retorno        | Uso Ideal          |
| ---------- | ----------- | ---------------- | -------------- | ------------------ |
| `save()`   | ⭐⭐        | ✅               | Boolean        | Dados condicionais |
| `create()` | ⭐⭐⭐      | ✅               | Model Instance | Inserção simples   |
| `insert()` | ⭐⭐⭐⭐⭐  | ❌               | Boolean        | Bulk operations    |

---

## 🔧 Configuração Necessária

### Model Product

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Campos permitidos para mass assignment
    protected $fillable = [
        'product_name',
        'price'
    ];

    // Ou desabilitar proteção (não recomendado)
    // protected $guarded = [];
}
```

---

## 💡 Boas Práticas

### ✅ **Quando usar cada método:**

#### Use `save()` quando:

-   Precisar de validação complexa
-   Houver lógica condicional
-   Necessitar de controle granular

#### Use `create()` quando:

-   Inserir um registro simples
-   Quiser aproveitar eventos do Eloquent
-   Precisar da instância retornada

#### Use `insert()` quando:

-   Inserir muitos registros
-   Performance for prioridade
-   Não precisar de eventos do Eloquent

### ⚠️ **Importantes considerações:**

-   `create()` requer configuração de `$fillable` no modelo
-   `insert()` não dispara eventos como `creating`, `created`
-   `insert()` não atualiza `timestamps` automaticamente
-   Sempre validar dados antes da inserção

---

## 🎓 Conceitos Demonstrados

-   **Mass Assignment**: Inserção com arrays de dados
-   **Eloquent Events**: Diferenças entre métodos que disparam eventos
-   **Bulk Operations**: Operações em lote para performance
-   **Model Instantiation**: Criação manual de instâncias
-   **Fillable Protection**: Segurança contra mass assignment vulnerabilities

---

**Desenvolvido durante:** Laravel 11/12 - Framework, Ecossistema e Projetos Web (Udemy)  
**Seção:** 13 - Laravel Eloquent ORM - Operações CRUD
