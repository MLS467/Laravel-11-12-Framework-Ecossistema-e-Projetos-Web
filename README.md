## 🔍 Consultas Avançadas com Eloquent ORM

### 🎯 **Filtros com WHERE**

#### 1. **Filtro com Condição Simples**

```php
// Buscando produtos com preço >= 70
$result = Product::where('price', '>=', 70)
    ->get()
    ->toArray();
```

#### 2. **Primeiro Resultado com WHERE**

```php
// Pegando apenas o primeiro produto que atende a condição
$result = Product::where('price', '>=', 70)
    ->first()
    ->toArray();
```

### 🛡️ **Tratamento de Resultados Vazios**

#### 3. **firstOr() - Tratamento de Resultado Vazio**

```php
// Se não encontrar nenhum produto, executa uma função de fallback
$result = Product::where('price', '>=', 170)
    ->firstOr(function () {
        return []; // Retorna array vazio se não encontrar
    });

// Verificando e convertendo o resultado
$result = !is_array($result) ? $result->toArray() : $result;
```

### 🔄 **Manipulação de Dados em Memória**

#### 4. **Modificação Temporária com refresh()**

```php
// Busca o produto
$result = Product::find(10);
echo $result->price; // Preço original do BD

// Modifica o preço apenas na memória (não salva no BD)
$result->price = 200;
echo $result->price; // Novo preço (200)

// Refresh recarrega os dados originais do BD
$result->refresh();
echo $result->price; // Preço original novamente
```

### 📋 **Conceitos Demonstrados**

| Método          | Funcionalidade                  | Quando Usar                                |
| --------------- | ------------------------------- | ------------------------------------------ |
| **`where()`**   | Filtro com condições            | Buscar registros específicos               |
| **`first()`**   | Primeiro resultado              | Quando espera apenas 1 resultado           |
| **`firstOr()`** | Primeiro resultado com fallback | Tratar casos onde pode não haver resultado |
| **`refresh()`** | Recarrega dados do BD           | Desfazer mudanças temporárias              |

### 💡 **Importantes Observações**

#### **Diferença entre `first()` e `firstOr()`**

-   **`first()`**: Pode retornar `null` se não encontrar
-   **`firstOr()`**: Executa uma função se não encontrar (mais seguro)

#### **Modificações em Memória**

-   Alterações diretas nas propriedades **NÃO** salvam automaticamente
-   Use `refresh()` para desfazer mudanças temporárias
-   Para salvar: use `save()` após as modificações

#### **Tratamento de Tipos**

```php
// Verificação para garantir conversão correta
$result = !is_array($result) ? $result->toArray() : $result;
```

### 🎓 **Novos Conceitos Aprendidos**

-   **Consultas Condicionais**: Filtros com operadores de comparação
-   **Fallback Methods**: Métodos que tratam resultados vazios
-   **Manipulação Temporária**: Modificar dados sem persistir
-   **Refresh de Modelos**: Recarregar dados originais do banco
-   **Verificação de Tipos**: Tratamento seguro de diferentes tipos de retorno

### 🚀 **Vantagens do Eloquent Demonstradas**

1. **Sintaxe Expressiva**: `where('price', '>=', 70)` é mais legível
2. **Métodos de Segurança**: `firstOr()` evita erros de null
3. **Manipulação Flexível**: Modificar dados temporariamente
4. **Controle de Estado**: `refresh()` para reverter mudanças
5. **Conversão Inteligente**: Facilidade para converter tipos

---
