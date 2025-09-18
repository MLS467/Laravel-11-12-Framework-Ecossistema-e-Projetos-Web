# Laravel Testing com PestPHP - Seção 27

## 📋 Documentação de Testes Funcionais e Unitários

### **HookOneTest.php - Hooks no PestPHP**

Este arquivo demonstra o uso de **hooks** no PestPHP para configuração e limpeza de dados nos testes.

---

## 🪝 **Hooks Implementados:**

### **1. `beforeEach()` - Configuração Pré-Teste**

```php
beforeEach(function () {
    $this->value = 10;
    $this->value_two = 20;
});
```

-   **Funcionalidade:** Executado ANTES de cada teste
-   **Uso:** Inicialização de variáveis e configuração de estado
-   **Implementação:**
    -   `$this->value = 10`: Variável de teste
    -   `$this->value_two = 20`: Segunda variável de teste
-   **Vantagem:** Garante estado consistente para todos os testes

### **2. `describe()` - Agrupamento de Testes**

```php
describe('Testes com hooks', function () {
    it('test one', function () {
        expect($this->value)->toBe(10);
    });
});
```

-   **Funcionalidade:** Agrupa testes relacionados em um contexto
-   **Estrutura:** Organização hierárquica de testes
-   **Teste implementado:** Verifica se `$this->value` é igual a 10
-   **Assertion:** `expect($this->value)->toBe(10)`

### **3. `afterEach()` - Limpeza Pós-Teste**

```php
afterEach(function () {
    unset($this->value);
    unset($this->value_two);
});
```

-   **Funcionalidade:** Executado APÓS cada teste
-   **Uso:** Limpeza de dados e reset de estado
-   **Implementação:** Remove variáveis definidas no `beforeEach()`
-   **Vantagem:** Evita vazamento de dados entre testes

---

## 🔄 **Fluxo de Execução:**

```
1. beforeEach() → Inicializa $this->value = 10, $this->value_two = 20
2. it('test one') → Executa teste: expect($this->value)->toBe(10)
3. afterEach() → Limpa: unset($this->value), unset($this->value_two)
```

---

## 📊 **Estrutura dos Hooks:**

| Hook           | Momento             | Finalidade   | Uso Comum          |
| -------------- | ------------------- | ------------ | ------------------ |
| `beforeEach()` | Antes de cada teste | Configuração | Inicializar dados  |
| `afterEach()`  | Após cada teste     | Limpeza      | Reset de estado    |
| `describe()`   | Agrupamento         | Organização  | Contexto de testes |

---

## 🎯 **Vantagens dos Hooks:**

-   ✅ **Reutilização:** Configuração única para múltiplos testes
-   ✅ **Consistência:** Estado inicial garantido
-   ✅ **Organização:** Código limpo e estruturado
-   ✅ **Isolamento:** Cada teste começa com estado limpo
-   ✅ **Manutenibilidade:** Fácil modificação de configurações

---

## 🧪 **Boas Práticas Demonstradas:**

### **Inicialização Controlada:**

```php
// ✅ Definir valores no beforeEach
$this->value = 10;
```

### **Limpeza Adequada:**

```php
// ✅ Limpar no afterEach
unset($this->value);
```

### **Testes Simples e Diretos:**

```php
// ✅ Assertions claras
expect($this->value)->toBe(10);
```

---

## 🚀 **Executando os Testes:**

```bash
./vendor/bin/pest tests/Unit/HookOneTest.php
```

**Tecnologias:** Laravel 11/12, PestPHP, Testes Unitários, Hooks
