# Laravel Eloquent ORM - Seção 13

## 📋 MainController - Documentação das Mudanças Implementadas

### **Novos Métodos Adicionados:**

#### 1. **`moreQueryBuilder()`**

-   **Funcionalidade:** Demonstra consultas avançadas com Query Builder no relacionamento many-to-many
-   **Implementação:**
    -   Busca produtos de um cliente específico (ID 10)
    -   Aplica filtros: `where('products.id', '>', 10)`
    -   Usa `distinct()` para evitar duplicatas
    -   Ordena por `products.id`
-   **Saída:** Chama `showArrayLoop()` para exibir em formato de tabela

#### 2. **`sameResult()`** ⭐

-   **Funcionalidade:** Demonstra como obter os mesmos resultados usando Eloquent ORM vs Query Builder
-   **Implementação Eloquent ORM:**
    ```php
    $client = Client::find(2);
    $this->show_data($client->phones->toArray());
    ```
-   **Implementação Query Builder:**
    ```php
    $client_qb = DB::table('clients')->find(2);
    $result = DB::table('phones')->where('client_id', $client_qb->id)->get();
    $this->show_data($result->toArray());
    ```
-   **Objetivo:** Comparar performance e sintaxe entre as duas abordagens
-   **Uso:** Educacional para entender diferenças entre ORM e Query Builder

#### 3. **`showArrayLoop()`** (Método Privado)

-   **Funcionalidade:** Renderiza dados em formato de tabela HTML
-   **Características:**
    -   Cria tabela com bordas (`border="2"`)
    -   Gera cabeçalho dinamicamente baseado nas chaves do primeiro registro
    -   Itera pelos dados criando linhas da tabela
-   **Uso:** Método auxiliar para formatação de saída

#### 4. **`showDataWithHTML()`** (Método Privado)

-   **Funcionalidade:** Formata dados de clientes e telefones em HTML
-   **Características:**
    -   Exibe ID e nome do cliente
    -   Lista todos os telefones associados numerados
    -   Adiciona separadores visuais (`<hr>`)

### **Melhorias no Código Existente:**

-   No método `one_to_many()`: adicionada chamada para `showDataWithHTML()` para melhor visualização
-   No método `belongsTo()`: implementado loop para exibir todos os telefones com seus respectivos clientes

### **Padrões de Implementação:**

-   ✅ Uso de métodos privados para organização
-   ✅ Separação de responsabilidades (lógica vs apresentação)
-   ✅ Demonstração prática de relacionamentos Eloquent
-   ✅ Comparação entre diferentes abordagens de consulta

### **Relacionamentos Demonstrados:**

-   **One to One:** Cliente → Telefone
-   **One to Many:** Cliente → Múltiplos Telefones
-   **Belongs To:** Telefone → Cliente (relação inversa)
-   **Many to Many:** Cliente ↔ Produtos

### **Tecnologias Utilizadas:**

-   Laravel 11/12
-   Eloquent ORM
-   Query Builder
-   Relacionamentos de Banco de Dados

---

## 🔍 **Destaque: Método `sameResult()`**

Este método é fundamental para entender as **diferenças entre Eloquent ORM e Query Builder**:

### **Eloquent ORM (Abordagem Orientada a Objetos):**

```php
$client = Client::find(2);
$this->show_data($client->phones->toArray());
```

-   ✅ **Vantagens:** Sintaxe mais limpa, relacionamentos automáticos
-   ⚠️ **Considerações:** Pode ser mais lento em consultas complexas

### **Query Builder (Abordagem SQL Direta):**

```php
$client_qb = DB::table('clients')->find(2);
$result = DB::table('phones')->where('client_id', $client_qb->id)->get();
$this->show_data($result->toArray());
```

-   ✅ **Vantagens:** Performance otimizada, controle total sobre SQL
-   ⚠️ **Considerações:** Sintaxe mais verbosa, relacionamentos manuais

### **Resultado:** Ambos retornam **exatamente os mesmos dados**
