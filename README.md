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

| Método       | Funcionalidade           | Retorno    | Uso Principal         |
| ------------ | ------------------------ | ---------- | --------------------- |
| `take()`     | Limita resultados        | Collection | Performance/Paginação |
| `append()`   | Campos virtuais          | Collection | Manipulação de dados  |
| `contains()` | Verifica existência      | Boolean    | Validação             |
| `diff()`     | Diferença entre coleções | Collection | Comparação            |

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
