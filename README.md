# Laravel Testing com PestPHP - Seção 27

## 📋 Documentação de Testes Funcionais e Unitários

---

## 🗂️ **DataSetTest.php - Testes com DataSets**

Este arquivo demonstra o uso de **DataSets** no PestPHP para executar os mesmos testes com diferentes conjuntos de dados.

---

## 📊 **DataSet Implementado:**

### **Conjunto de Dados de Teste:**

```php
$data = [
    ["Ronaldo", 20],
    ["João", 18],
    ["Feijão", 19]
];
```

-   **Estrutura:** Array de arrays com `[nome, idade]`
-   **Dados de teste:** 3 registros de pessoas com nomes e idades
-   **Uso:** Alimenta múltiplos testes com dados variados

---

## 🧪 **Testes Implementados:**

### **1. Teste de Tipo String**

```php
it('test if is String', function ($name) {
    expect($name)->toBeString();
})->with($data);
```

-   **Funcionalidade:** Verifica se o primeiro parâmetro (`$name`) é uma string
-   **Execução:** Roda 3 vezes (uma para cada registro no dataset)
-   **Assertion:** `toBeString()` - valida tipo string
-   **Dados testados:**
    -   "Ronaldo" ✅ String
    -   "João" ✅ String
    -   "Feijão" ✅ String

### **2. Teste de Validação de Idade**

```php
it('test if greaterThan or equals', function ($name, $age) {
    expect($age)->toBeGreaterThanOrEqual(18);
})->with($data);
```

-   **Funcionalidade:** Verifica se a idade é maior ou igual a 18
-   **Parâmetros:** Recebe tanto `$name` quanto `$age`
-   **Assertion:** `toBeGreaterThanOrEqual(18)` - valida maioridade
-   **Dados testados:**
    -   Ronaldo, 20 ✅ >= 18
    -   João, 18 ✅ >= 18
    -   Feijão, 19 ✅ >= 18

---

## 🔄 **Fluxo de Execução com DataSets:**

```
Execução 1: $name = "Ronaldo", $age = 20
├── test if is String("Ronaldo") ✅
└── test if greaterThan or equals(20) ✅

Execução 2: $name = "João", $age = 18
├── test if is String("João") ✅
└── test if greaterThan or equals(18) ✅

Execução 3: $name = "Feijão", $age = 19
├── test if is String("Feijão") ✅
└── test if greaterThan or equals(19) ✅
```

---

## 📊 **Análise dos DataSets:**

| Teste                           | Dados            | Execuções       | Validações       |
| ------------------------------- | ---------------- | --------------- | ---------------- |
| `test if is String`             | 3 nomes          | 3x              | Tipo String      |
| `test if greaterThan or equals` | 3 idades         | 3x              | Idade >= 18      |
| **Total**                       | **6 parâmetros** | **6 execuções** | **6 assertions** |

---

## 🎯 **Vantagens dos DataSets:**

-   ✅ **Reutilização:** Mesmo teste com dados diferentes
-   ✅ **Cobertura:** Testa múltiplos cenários automaticamente
-   ✅ **Eficiência:** Reduz duplicação de código
-   ✅ **Escalabilidade:** Fácil adicionar novos dados
-   ✅ **Manutenibilidade:** Centraliza dados de teste

---

## 🔧 **Estrutura do Teste:**

### **Padrão DataSet:**

```php
// 1. Definir dados
$data = [/* array de dados */];

// 2. Criar teste
it('descrição do teste', function ($param1, $param2) {
    // assertions
})->with($data);
```

### **Sintaxe `->with()`:**

-   **Função:** Conecta o teste com o dataset
-   **Execução:** Roda o teste para cada item do array
-   **Parâmetros:** Descompacta arrays em parâmetros da função

---

## 🧩 **Casos de Uso Práticos:**

### **Validação de Entrada:**

```php
// Testar diferentes inputs
$userInputs = [["email@test.com"], ["user@domain.org"]];
```

### **Cenários de Negócio:**

```php
// Testar diferentes idades/status
$ageScenarios = [[17, false], [18, true], [25, true]];
```

### **Validação de Dados:**

```php
// Testar tipos diferentes
$typeTests = [["string"], [123], [true]];
```

---

## 🚀 **Executando os Testes:**

```bash
./vendor/bin/pest tests/Unit/DataSetTest.php
```

**Resultado esperado:** 6 testes passando (3 para cada assertion)

**Tecnologias:** Laravel 11/12, PestPHP, DataSets, Testes Unitários
