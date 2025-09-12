# 📚 Laravel Eloquent ORM - Consultas e Funções de Agregação

Este projeto demonstra o uso avançado do **Laravel Eloquent ORM** para realizar consultas condicionais, tratamento de erros e funções de agregação.

## 🎯 Funcionalidades Implementadas

### 1. 🔍 **Consultas Condicionais com WHERE**

#### Busca com Condição + First

```php
// Busca o primeiro produto com preço >= 60
$result = Product::where('price', '>=', 60)->first();
```

#### Método Alternativo: firstWhere

```php
// Forma mais direta de fazer WHERE + FIRST
$result = Product::firstWhere('price', '>=', 60);
```

#### Manipulação dos Dados

```php
// Acessando propriedades do modelo
$name = strtoupper($result->product_name);
$price = strtoupper($result->price);
echo "Nome do produto <b>$name</b> e o preço é <b>$price</b>";
```

---

### 2. 🛡️ **Tratamento de Erros em Consultas**

#### findOr() - Fallback Personalizado

```php
// Se não encontrar ID 10, executa função de fallback
$result = Product::findOr(10, function () {
    return "NÃO FOI ENCONTRADO!";
});

// Verificação de tipo para tratamento seguro
if ($result instanceof Product) {
    $name = strtoupper($result->product_name);
    $price = strtoupper($result->price);
    echo "Nome do produto <b>$name</b> e o preço é <b>$price</b>";
} else {
    echo $result; // Mensagem de erro
}
```

#### findOrFail() - Exception Automática

```php
// Lança exception se não encontrar o ID 110
$result = Product::findOrFail(110);
$name = strtoupper($result->product_name);
$price = strtoupper($result->price);
echo "Nome do produto <b>$name</b> e o preço é <b>$price</b>";
```

---

### 3. 📊 **Funções de Agregação**

#### Implementação Completa

```php
// Coletando todas as estatísticas dos produtos
$count = Product::count();        // Total de produtos
$min = Product::min('price');     // Menor preço
$max = Product::max('price');     // Maior preço
$avg = Product::avg('price');     // Preço médio
$sum = Product::sum('price');     // Soma total dos preços

// Organizando em array para exibição
$result = [
    'count' => $count,
    'min' => $min,
    'max' => $max,
    'avg' => $avg,
    'sum' => $sum,
];

$this->show_data($result);
```

---

## 📋 Métodos Eloquent Utilizados

| Método         | Descrição                | Exemplo                                  |
| -------------- | ------------------------ | ---------------------------------------- |
| `where()`      | Filtro com condições     | `Product::where('price', '>=', 60)`      |
| `first()`      | Primeiro resultado       | `->first()`                              |
| `firstWhere()` | WHERE + FIRST combinados | `Product::firstWhere('price', '>=', 60)` |
| `find()`       | Busca por ID             | `Product::find(10)`                      |
| `findOr()`     | Busca com fallback       | `Product::findOr(10, $callback)`         |
| `findOrFail()` | Busca com exception      | `Product::findOrFail(110)`               |
| `count()`      | Conta registros          | `Product::count()`                       |
| `min()`        | Valor mínimo             | `Product::min('price')`                  |
| `max()`        | Valor máximo             | `Product::max('price')`                  |
| `avg()`        | Média aritmética         | `Product::avg('price')`                  |
| `sum()`        | Soma total               | `Product::sum('price')`                  |

---

## 🎓 Conceitos Demonstrados

### ✅ **Tratamento Seguro de Dados**

-   Verificação de tipos com `instanceof`
-   Uso de `findOr()` para fallbacks
-   Exception handling com `findOrFail()`

### ✅ **Consultas Otimizadas**

-   `firstWhere()` como alternativa mais limpa
-   Funções de agregação diretas no banco
-   Uso eficiente de WHERE conditions

### ✅ **Manipulação de Resultados**

-   Acesso direto às propriedades do modelo
-   Formatação de dados com `strtoupper()`
-   Organização de dados em arrays estruturados

---

## 🚀 Vantagens do Eloquent ORM

1. **Sintaxe Intuitiva**: Código mais legível e expressivo
2. **Tratamento de Erros**: Métodos específicos para diferentes cenários
3. **Funções de Agregação**: Cálculos diretos no banco de dados
4. **Type Safety**: Verificação de tipos nativos do PHP
5. **Performance**: Consultas otimizadas automaticamente

---

## 💡 Boas Práticas Implementadas

-   ✅ Sempre verificar tipos antes de acessar propriedades
-   ✅ Usar `findOrFail()` quando o registro deve existir obrigatoriamente
-   ✅ Usar `findOr()` quando há necessidade de fallback personalizado
-   ✅ Organizar dados de agregação em arrays estruturados
-   ✅ Utilizar `firstWhere()` para consultas WHERE + FIRST

---

**Desenvolvido durante:** Laravel 11/12 - Framework, Ecossistema e Projetos Web (Udemy)  
**Seção:** 13 - Laravel Eloquent ORM
