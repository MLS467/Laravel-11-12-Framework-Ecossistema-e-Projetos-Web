# Laravel Eloquent ORM - Collections

## 📋 MainController - Documentação de Collections

### **Método `collection()` - Eloquent Collections Parte 1**

Este método demonstra o uso de **Laravel Collections** com Eloquent ORM, explorando métodos poderosos para manipulação de dados.

---

## 🔧 **Métodos de Collections Implementados:**

### **1. `take()` - Limitação de Resultados**

```php
$client = Client::take(5)->get();

foreach ($client as $key => $value) {
    echo "chave: {$key} name: {$value->client_name} <br>";
}
```

-   **Funcionalidade:** Pega os primeiros 5 clientes da base de dados
-   **Uso:** Limitação de resultados para performance e paginação

### **2. `append()` - Campos Virtuais na Coleção**

```php
$clients = Client::take(5)->get();
$clients->each->append(['name_upper', 'domain_email']);

foreach ($clients as $key => $value) {
    $value->name_upper = strtoupper($value->client_name);
    $value->domain_email = explode('@', $value->email)[1];
}

foreach ($clients as $key => $value) {
    echo "nome -> {$value->name_upper} | domínio de email -> {$value->domain_email}<br>";
}
```

-   **Funcionalidade:** Adiciona campos virtuais que existem apenas na coleção (não no BD)
-   **Implementação:**
    -   `name_upper`: Converte nome para maiúsculas
    -   `domain_email`: Extrai domínio do email
-   **Vantagem:** Manipulação de dados sem alterar estrutura do banco

### **3. `contains()` - Verificação de Existência**

```php
$name = 'Mirela Alice Lopes';
$clients = Client::take(5)->get();
$result = $clients->contains('client_name', $name);
echo $result; // true ou false
```

-   **Funcionalidade:** Verifica se um valor específico existe na coleção
-   **Retorno:** Boolean (true/false)
-   **Uso:** Validação rápida de existência de dados

### **4. `diff()` - Diferença Entre Coleções**

```php
$clients1 = Client::take(5)->get();
$clients2 = Client::take(3)->get();

$result = $clients1->diff($clients2);
$this->show_data($result->toArray());
```

-   **Funcionalidade:** Retorna elementos que existem na primeira coleção mas não na segunda
-   **Resultado:** Coleção com as diferenças encontradas
-   **Uso:** Comparação e análise de datasets

### **5. `intersect()` - Interseção Entre Coleções**

```php
$client1 = Client::take(5)->get();
$client2 = Client::where('id', '>', 3)->take(5)->get();

$result = $client1->intersect($client2);
$this->show_data($result->toArray());
```

-   **Funcionalidade:** Retorna elementos que existem em AMBAS as coleções
-   **Implementação:**
    -   `$client1`: Primeiros 5 clientes
    -   `$client2`: 5 clientes com ID > 3
-   **Resultado:** Coleção com elementos comuns entre as duas
-   **Uso:** Encontrar dados compartilhados entre datasets

### **6. `makeHidden()` - Ocultar Colunas na Saída**

```php
$client1 = Client::take(5)->get();
$client1->makeHidden('created_at');
// ou array: ['created_at', 'updated_at', 'deleted_at']
$this->show_data($client1->toArray());
```

-   **Funcionalidade:** Oculta colunas específicas na serialização
-   **Parâmetros:** String única ou array de colunas
-   **Uso:** Controle de dados expostos em APIs/responses
-   **Vantagem:** Não remove dados do objeto, apenas da saída

---

## 🛠 **Métodos Auxiliares Utilizados:**

### **`show_data()`** (Controller Base)

```php
public function show_data($data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
```

-   **Localização:** `Controller.php` (classe base)
-   **Funcionalidade:** Exibe dados formatados com `<pre>` para debug
-   **Uso:** Visualização estruturada de arrays e objetos

---

## 📊 **Conceitos Demonstrados:**

| Método         | Funcionalidade            | Retorno    | Uso Principal         |
| -------------- | ------------------------- | ---------- | --------------------- |
| `take()`       | Limita resultados         | Collection | Performance/Paginação |
| `append()`     | Campos virtuais           | Collection | Manipulação de dados  |
| `contains()`   | Verifica existência       | Boolean    | Validação             |
| `diff()`       | Diferença entre coleções  | Collection | Comparação            |
| `intersect()`  | Interseção entre coleções | Collection | Dados compartilhados  |
| `makeHidden()` | Oculta colunas            | Collection | Controle de saída     |

---

## ⭐ **Novos Métodos Adicionados:**

### **`intersect()` vs `diff()`**

-   **`intersect()`:** Encontra elementos **comuns** entre coleções
-   **`diff()`:** Encontra elementos **únicos** da primeira coleção

### **`makeHidden()` - Controle de Dados Sensíveis**

-   **Uso comum:** Ocultar timestamps (`created_at`, `updated_at`)
-   **Segurança:** Esconder campos sensíveis em APIs
-   **Flexibilidade:** Aceita string única ou array de campos

---

## 🎯 **Vantagens das Collections:**

-   ✅ **Performance:** Manipulação eficiente de conjuntos de dados
-   ✅ **Flexibilidade:** Métodos encadeáveis e funcionais
-   ✅ **Legibilidade:** Código mais limpo e expressivo
-   ✅ **Funcional:** Programação funcional com PHP
-   ✅ **Integração:** Perfeita integração com Eloquent ORM

---

## 🔗 **Rota Configurada:**

```php
Route::get('/collection', [MainController::class, 'collection']);
```

**Tecnologias:** Laravel 11/12, Eloquent ORM, Collections API
