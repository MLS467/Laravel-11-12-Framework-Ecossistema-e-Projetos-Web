# 📚 Laravel Eloquent ORM - Operações CRUD Completas

Este projeto demonstra as operações CRUD (Create, Read, Update, Delete) usando o **Laravel Eloquent ORM**, com foco especial em diferentes métodos de atualização de dados.

## 🔄 Operações de Atualização (UPDATE)

### 1. ✏️ **Atualização com save()**

#### Método 1: Find + Modify + Save

```php
// Buscar o produto pelo ID
$product = Product::find(10);

// Modificar as propriedades
$product->product_name = "MELANCIA";
$product->price = 200;

// Salvar as alterações no banco
$product->save();
```

**Características:**

-   ✅ Controle total sobre cada campo alterado
-   ✅ Permite validações antes do save()
-   ✅ Dispara eventos do Eloquent (updating, updated)
-   ✅ Atualiza apenas campos modificados
-   ✅ Retorna boolean (true/false)

**Fluxo de Execução:**

1. `find()` - Busca o registro no banco
2. Modificação - Altera propriedades em memória
3. `save()` - Persiste mudanças no banco

---

### 2. 🔀 **Atualização Inteligente com updateOrCreate()**

#### Método 2: Update ou Create Condicional

```php
// Busca por ID 110, se não existir, cria novo registro
$product = Product::updateOrCreate(
    ['id' => '110'],              // Condição de busca
    ['product_name' => 'melancia'] // Dados para update/create
);
```

**Características:**

-   ✅ **Upsert Operation**: Update se existir, Create se não existir
-   ✅ Operação atômica (thread-safe)
-   ✅ Evita condições de corrida (race conditions)
-   ✅ Retorna a instância do modelo
-   ✅ Ideal para sincronização de dados

**Fluxo de Execução:**

1. Busca registro pela condição (`id = 110`)
2. **Se encontrar**: Atualiza com os novos dados
3. **Se não encontrar**: Cria novo registro com todos os dados

---

## 📊 Comparação dos Métodos de Atualização

| Método             | Flexibilidade | Performance | Caso de Uso              | Retorno        |
| ------------------ | ------------- | ----------- | ------------------------ | -------------- |
| `save()`           | ⭐⭐⭐⭐⭐    | ⭐⭐⭐      | Atualizações específicas | Boolean        |
| `updateOrCreate()` | ⭐⭐⭐        | ⭐⭐⭐⭐    | Sincronização de dados   | Model Instance |

---

## 🎯 Casos de Uso Práticos

### 💡 **Quando usar save():**

```php
// Cenário: Atualização de estoque baseada em condições
$product = Product::find($id);

if ($product->stock > 0) {
    $product->stock -= $quantity;
    $product->last_sold = now();
    $product->save();
}
```

### 💡 **Quando usar updateOrCreate():**

```php
// Cenário: Sincronização de dados externos (APIs, imports)
Product::updateOrCreate(
    ['external_id' => $apiData['id']], // Identificador único
    [
        'product_name' => $apiData['name'],
        'price' => $apiData['price'],
        'updated_from_api' => now()
    ]
);
```

---

## 🔧 Outros Métodos de Atualização

### 3. **update()** - Atualização em Massa

```php
// Atualizar múltiplos registros de uma vez
Product::where('category', 'electronics')
    ->update(['discount' => 10]);
```

### 4. **updateOrInsert()** - Versão Mais Baixo Nível

```php
// Similar ao updateOrCreate, mas retorna boolean
Product::updateOrInsert(
    ['id' => 110],
    ['product_name' => 'melancia', 'price' => 50]
);
```

---

## ⚡ Performance e Boas Práticas

### ✅ **Otimizações:**

#### Para Registro Único:

```php
// ✅ Bom: Busca específica
$product = Product::find($id);

// ❌ Evitar: Busca desnecessária
$product = Product::where('id', $id)->first();
```

#### Para Múltiplos Registros:

```php
// ✅ Melhor: Update em massa
Product::whereIn('id', $ids)->update(['status' => 'active']);

// ❌ Evitar: Loop com save()
foreach ($ids as $id) {
    $product = Product::find($id);
    $product->status = 'active';
    $product->save();
}
```

### 🛡️ **Segurança:**

-   Sempre validar dados antes da atualização
-   Usar `$fillable` ou `$guarded` nos modelos
-   Verificar se o registro existe antes de modificar

---

## 🎓 Conceitos Demonstrados

-   **Eloquent Models**: Manipulação orientada a objetos
-   **Upsert Operations**: updateOrCreate para operações atômicas
-   **Active Record Pattern**: Objetos que representam registros do banco
-   **Dirty Tracking**: Eloquent rastreia campos modificados
-   **Mass Assignment**: Proteção contra atribuição em massa
-   **Event System**: Eventos automáticos em operações do modelo

---

## 💡 Principais Vantagens do Eloquent

1. **Sintaxe Intuitiva**: Código mais legível que SQL puro
2. **Type Safety**: Trabalha com objetos tipados
3. **Event Hooks**: Sistema automático de eventos
4. **Dirty Tracking**: Só atualiza campos modificados
5. **Relationship Management**: Facilita trabalho com relacionamentos
6. **Query Optimization**: Otimizações automáticas de consultas

---

**Desenvolvido durante:** Laravel 11/12 - Framework, Ecossistema e Projetos Web (Udemy)  
**Seção:** 13 - Laravel Eloquent ORM - Operações de Atualização
