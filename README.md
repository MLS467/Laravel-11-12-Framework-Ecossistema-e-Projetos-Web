# 📚 Curso Laravel - Usando o Query Builder nas Relações

## 🎯 Aula: Usando o Query Builder nas Relações

Este projeto demonstra como utilizar o Query Builder do Laravel em conjunto com relacionamentos Eloquent para criar consultas mais específicas e otimizadas.

## 🔧 Funcionalidades Implementadas

### 📋 **MainController - Query Builder com Relacionamentos**

#### **Método: `moreQueryBuilder()`**

Implementação de consultas avançadas usando Query Builder em relacionamentos many-to-many:

```php
public function moreQueryBuilder()
{
    $client = Client::find(10);

    $products = $client->products()
        ->where('products.id', '>', 10)
        ->distinct()
        ->orderBy('products.id')
        ->get();

    $this->showArrayLoop($products);
}
```

### 🎯 **Principais Conceitos Aplicados:**

#### **1. Query Builder em Relacionamentos**

-   Uso de `->where()` em relacionamentos
-   Especificação de tabelas para evitar ambiguidade (`products.id`)
-   Aplicação de `distinct()` para evitar duplicatas
-   Ordenação com `orderBy()`

#### **2. Tratamento de Ambiguidade de Colunas**

**Problema Comum:**

```sql
SQLSTATE[23000]: Integrity constraint violation: 1052 Column 'id' in where clause is ambiguous
```

**Solução Aplicada:**

```php
->where('products.id', '>', 10)  // Especifica a tabela
```

#### **3. Métodos de Consulta Utilizados:**

-   **`distinct()`** - Remove registros duplicados
-   **`where('table.column', operator, value)`** - Filtragem específica
-   **`orderBy('column')`** - Ordenação dos resultados
-   **`get()`** - Execução da consulta

### 🛠️ **Método de Exibição: `showArrayLoop()`**

Método helper para renderizar dados em formato de tabela HTML:

```php
private function showArrayLoop($datas)
{
    echo '<table border="2">';
    echo '<thead>';
    echo "<tr>";

    // Cabeçalhos da tabela
    foreach ($datas->toArray()[0] as $key => $data) {
        echo "<th>{$key}</th>";
    }

    echo "</tr>";
    echo "<tbody>";

    // Dados da tabela
    foreach ($datas as $value) {
        echo "<tr>";
        foreach ($value->toArray() as $key => $v) {
            echo "<td>{$value[$key]}</td>";
        }
        echo "</tr>";
    }

    echo "</tbody>";
    echo '</table>';
}
```

## 🚀 **Como Executar**

### **Requisitos:**

-   Laravel 12
-   PHP 8.2+
-   MySQL

### **Testando a Funcionalidade:**

1. **Acesse a rota do controller:**

```bash
php artisan serve
```

2. **Chame o método específico:**

```php
Route::get('/query-builder', [MainController::class, 'moreQueryBuilder']);
```

## 📊 **Casos de Uso Demonstrados**

### **1. Consulta Básica com Filtro**

```php
$products = $client->products()
    ->where('products.id', '>', 10)
    ->get();
```

### **2. Consulta com Múltiplos Modificadores**

```php
$products = $client->products()
    ->where('products.id', '>', 10)
    ->distinct()
    ->orderBy('products.id')
    ->get();
```

### **3. Alternativas para Evitar Ambiguidade**

**Opção 1 - Especificar tabela:**

```php
->where('products.id', '>', 10)
```

**Opção 2 - Usar wherePivot:**

```php
->wherePivot('product_id', '>', 10)
```

## 🎯 **Conceitos Importantes Aprendidos**

1. **Ambiguidade de Colunas**: Como resolver conflitos de nomes de colunas em JOINs
2. **Query Builder em Relacionamentos**: Aplicar filtros específicos em dados relacionados
3. **Otimização de Consultas**: Uso de `distinct()` e `orderBy()`
4. **Renderização de Dados**: Métodos helper para exibição formatada

## 📈 **Benefícios da Implementação**

-   ✅ **Consultas Otimizadas**: Filtros específicos reduzem dados desnecessários
-   ✅ **Código Limpo**: Métodos bem estruturados e reutilizáveis
-   ✅ **Flexibilidade**: Query Builder permite consultas complexas
-   ✅ **Performance**: Uso adequado de `distinct()` e ordenação

---

**Desenvolvido durante o Curso de Laravel - Udemy** 🚀
