# Laravel Testing Project - Seção 27

## Testes Unitários Implementados

Este projeto demonstra a implementação de testes unitários usando **PestPHP** no Laravel 12. Os testes foram criados para validar as funcionalidades desenvolvidas na **Seção 27 - Testes Funcionais e Unitários com PestPHP**.

### 📁 Estrutura dos Testes Unitários (`tests/Unit/`)

#### 1. **ExpectationAPITest.php**

Demonstra o uso da API de expectativas do PestPHP com diversos métodos de validação:

-   `toBe()` - Validação de valores exatos e tipos
-   `toBeTrue()` / `toBeFalse()` - Validação de valores booleanos
-   `toBeNull()` - Validação de valores nulos
-   `toBeEmpty()` - Validação de valores vazios
-   `toBeArray()` - Validação de arrays
-   `toBeIn()` - Validação se valor está contido em array
-   `toBeJson()` - Validação de formato JSON
-   `toMatch()` - Validação com expressões regulares
-   `toBeUppercase()` - Validação de strings em maiúsculo

#### 2. **MainControllerTest.php**

Testa o controller principal da aplicação:

-   Validação do método `index()` do `MainController`
-   Verifica se retorna uma string
-   Valida o conteúdo exato da resposta ("Hello World Test")

#### 3. **MainOperatorHashGeneratorTest.php**

Testa a funcionalidade de geração de hash:

-   Valida se o hash gerado tem 32 caracteres por padrão
-   Testa geração de hash com 64 caracteres
-   Testa geração de hash com 80 caracteres
-   Utiliza o serviço `MainOperations::hash_generation()`

#### 4. **MathOperationTest.php**

Suite completa de testes para operações matemáticas usando `describe()`:

-   **Soma (`add`)**: Testa adição de dois números
-   **Subtração (`subtract`)**: Testa subtração de dois números
-   **Multiplicação (`multiply`)**: Testa multiplicação de dois números
-   **Divisão (`divide`)**: Testa divisão normal
-   **Divisão por zero**: Valida tratamento especial (divisor 0 vira 1)
-   **Operação inválida**: Testa retorno de mensagem de erro para operações inexistentes

### 🛠️ Tecnologias Utilizadas

-   **Laravel 12**: Framework PHP
-   **PestPHP 4.1**: Framework de testes moderno
-   **PHP 8.2+**: Linguagem base

### 📋 Serviços Testados

#### `MainOperations` Service

Localizado em `app/Services/MainOperations.php`, contém:

1. **`hash_generation($num = 32)`**: Gera hash hexadecimal
2. **`MathOperation($valueOne, $valueTwo, $operation)`**: Executa operações matemáticas básicas

### 🚀 Como Executar os Testes

```bash
# Executar todos os testes
php artisan test

# Executar apenas testes unitários
./vendor/bin/pest tests/Unit

# Executar teste específico
./vendor/bin/pest tests/Unit/MathOperationTest.php
```

### 📊 Cobertura de Testes

Os testes cobrem:

-   ✅ Geração de hash com diferentes tamanhos
-   ✅ Operações matemáticas básicas (+ - \* /)
-   ✅ Tratamento de divisão por zero
-   ✅ Validação de operações inválidas
-   ✅ Testes de controller
-   ✅ API de expectativas do PestPHP

### 📝 Padrões de Teste Utilizados

-   **Arrange-Act-Assert**: Estrutura clara dos testes
-   **Describe/It**: Agrupamento lógico de testes relacionados
-   **Expectation API**: Uso das expectativas modernas do PestPHP
-   **Edge Cases**: Testes de casos extremos como divisão por zero
