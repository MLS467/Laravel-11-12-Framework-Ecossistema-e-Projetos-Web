# Laravel Eloquent ORM - Serialization

## 📋 MainController - Documentação do Método `Serialization()`

### **Serialização de Dados com Eloquent**

Este método demonstra diferentes formas de **serializar dados** do Eloquent ORM para formatos como Array e JSON, essencial para desenvolvimento de APIs.

---

## 🔧 **Métodos de Serialização Implementados:**

### **1. `toArray()` - Conversão para Array**

```php
$clients = Client::take(10)->get()->toArray();
$this->show_data($clients);
```

-   **Funcionalidade:** Converte Collection/Model para array PHP
-   **Uso:** Manipulação de dados, processamento interno
-   **Resultado:** Array associativo com todos os campos

### **2. `toJson()` - Conversão para JSON**

```php
$clients = Client::take(10)->get()->toJson(JSON_PRETTY_PRINT);
$this->show_data($clients);
```

-   **Funcionalidade:** Converte Collection/Model para JSON
-   **Parâmetro:** `JSON_PRETTY_PRINT` para formatação legível
-   **Uso:** APIs, resposta HTTP, armazenamento JSON

### **3. `setHidden()` + JSON - Ocultar Campos em APIs**

```php
$clients = Client::take(10)
    ->get()
    ->setHidden(['active', 'created_at', 'deleted_at', 'updated_at'])
    ->toJson(JSON_PRETTY_PRINT);
$this->show_data($clients);
```

-   **Funcionalidade:** Remove campos específicos da serialização
-   **Campos ocultos:** `active`, `created_at`, `deleted_at`, `updated_at`
-   **Uso:** Segurança em APIs, controle de dados expostos
-   **Vantagem:** Campos permanecem no objeto, apenas ocultos na saída

### **4. `setVisible()` + JSON - Mostrar Apenas Campos Específicos**

```php
$clients = Client::take(10)
    ->get()
    ->setVisible(['client_name', 'email'])
    ->toJson(JSON_PRETTY_PRINT);
$this->show_data($clients);
```

-   **Funcionalidade:** Mostra APENAS os campos especificados
-   **Campos visíveis:** `client_name`, `email`
-   **Uso:** APIs minimalistas, dados públicos
-   **Vantagem:** Controle total sobre dados expostos

---

## 📊 **Comparação dos Métodos:**

| Método                    | Formato   | Controle de Campos | Uso Principal         |
| ------------------------- | --------- | ------------------ | --------------------- |
| `toArray()`               | Array PHP | Todos os campos    | Processamento interno |
| `toJson()`                | JSON      | Todos os campos    | APIs completas        |
| `setHidden() + toJson()`  | JSON      | Oculta específicos | APIs com segurança    |
| `setVisible() + toJson()` | JSON      | Mostra específicos | APIs minimalistas     |

---

## 🛡️ **Segurança e Boas Práticas:**

### **Para APIs Públicas:**

-   ✅ Use `setVisible()` para expor apenas dados necessários
-   ✅ Oculte timestamps com `setHidden()` se desnecessários
-   ✅ Nunca exponha campos sensíveis (senhas, tokens)

### **Para Processamento Interno:**

-   ✅ Use `toArray()` para manipulação de dados
-   ✅ Mantenha todos os campos para processamento completo

---

## 🎯 **Casos de Uso Práticos:**

### **API REST Response:**

```php
// Para listagem pública de clientes
$clients->setVisible(['client_name', 'email'])->toJson();
```

### **API Admin Response:**

```php
// Para admin, com controle de timestamps
$clients->setHidden(['created_at', 'updated_at'])->toJson();
```

### **Processamento de Dados:**

```php
// Para manipulação interna
$clientsArray = $clients->toArray();
```

---

## 🔗 **Rota Configurada:**

```php
Route::get('/serialization', [MainController::class, 'Serialization']);
```

**Tecnologias:** Laravel 11/12, Eloquent ORM, JSON Serialization API
