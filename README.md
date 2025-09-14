# 🗑️ Laravel Eloquent ORM - Operações de DELETE

Este projeto demonstra as diferentes formas de deletar dados no **Laravel Eloquent ORM**, incluindo **hard delete** (exclusão permanente) e **soft delete** (exclusão lógica).

## 📂 Estrutura do Projeto

### Models

-   **Product**: Model principal com soft delete habilitado
-   **TestModel**: Demonstra configurações avançadas do Eloquent

### Controllers

-   **MainController**: Implementa exemplos de todas as operações de delete

## 🗑️ Hard Delete - Exclusão Permanente

### 1. **Delete por ID**

```php
// Busca e exclui um registro específico
$product = Product::find(10);
$product->delete();
```

### 2. **Truncate - Limpar Tabela Completamente**

```php
// Remove todos os registros e reinicia o auto-increment
Product::truncate();
```

### 3. **Destroy - Multiple Delete**

```php
// Método 1: Passando IDs individuais
Product::destroy(1, 3, 5);

// Método 2: Usando array de IDs
$ids = [8, 9, 10];
Product::destroy($ids);
```

### 4. **Delete com Condições**

```php
// Exclui registros baseado em condições
Product::where('price', '>', 70)->delete();
```

### 5. **Soft Delete Manual com Update**

```php
// Simulando soft delete manualmente
Product::where('id', 12)
    ->update([
        'deleted_at' => Carbon::now()
    ]);

// Ou usando save()
$product = Product::find(18);
$product->deleted_at = Carbon::now();
$product->save();
```

## 🧹 Soft Delete - Exclusão Lógica

### Configuração no Model

```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'price'
    ];
}
```

### 1. **Soft Delete Básico**

```php
// Marca como deletado (seta deleted_at)
$delete = Product::find(22);
$delete->delete();
```

### 2. **Consultar Registros Deletados**

```php
// Busca incluindo registros com soft delete
$product = Product::withTrashed()->find(22);
```

### 3. **Restaurar Registro Deletado**

```php
// Remove o deleted_at, "ressuscitando" o registro
$product->restore();
```

## 📊 Comparação: Hard Delete vs Soft Delete

| Aspecto             | Hard Delete         | Soft Delete               |
| ------------------- | ------------------- | ------------------------- |
| **Recuperação**     | ❌ Impossível       | ✅ Totalmente recuperável |
| **Performance**     | ✅ Melhor           | ⚠️ Consultas extras       |
| **Espaço em Disco** | ✅ Libera espaço    | ❌ Mantém dados           |
| **Auditoria**       | ❌ Perde histórico  | ✅ Mantém histórico       |
| **Integridade**     | ⚠️ Pode quebrar FKs | ✅ Preserva relações      |

## 🎯 Quando Usar Cada Método

### ✅ **Use Hard Delete quando:**

-   Dados são temporários (logs, cache)
-   LGPD/GDPR exigem exclusão definitiva
-   Performance é crítica
-   Espaço em disco é limitado

### ✅ **Use Soft Delete quando:**

-   Dados têm valor histórico
-   Usuários podem "desfazer" exclusões
-   Auditoria é necessária
-   Relações são complexas

## 💡 Boas Práticas

### 🔒 **Segurança**

```php
// ✅ Sempre validar propriedade antes de deletar
if ($user->canDelete($product)) {
    $product->delete();
}

// ✅ Usar transações para operações críticas
DB::transaction(function () use ($product) {
    $product->orders()->delete();
    $product->delete();
});
```

### ⚡ **Performance**

```php
// ✅ Para múltiplos registros, use operações em massa
Product::whereIn('id', $ids)->delete();

// ❌ Evitar loops com delete individual
foreach ($products as $product) {
    $product->delete(); // Lento!
}
```

### 🔍 **Consultas com Soft Delete**

```php
// Apenas registros ativos (padrão)
$products = Product::all();

// Incluindo deletados
$products = Product::withTrashed()->get();

// Apenas deletados
$products = Product::onlyTrashed()->get();
```

## 🛠️ Configurações Avançadas (TestModel)

O projeto também demonstra configurações avançadas do Eloquent:

```php
class TestModel extends Model
{
    protected $table = 'phones';           // Tabela customizada
    protected $primaryKey = 'id';          // Chave primária customizada
    public $incrementing = false;          // Desativa auto-increment
    protected $keyType = 'string';         // Tipo da chave primária
    public $timestamps = false;            // Desativa timestamps automáticos
    protected $dateFormat = 'Y-m-d H:i:s'; // Formato de data customizado

    // Nomes customizados para timestamps
    const CREATED_AT = 'criado em';
    const UPDATED_AT = 'atualizado em';

    protected $connection = 'mysql';       // Conexão específica
}
```

---

**📚 Projeto desenvolvido durante:** Laravel 11/12 - Framework, Ecossistema e Projetos Web (Udemy)  
**📖 Seção:** 13 - Laravel Eloquent ORM - Operações de Delete
