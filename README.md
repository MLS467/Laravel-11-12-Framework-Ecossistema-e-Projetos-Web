-   exclui todas as pasta do phpunit
-   removi o phpunit com o comando composer remove phpunit/phpunit
-   adicionei o pestphp usando o comando composer composer require pestphp/pest --dev --with-all-dependencies
-   iniciar o pest usando o comando ./vendor/bin/pest --init
-   testar se está funcion ./vendor/bin/pest

---

# 🧪 Seção 27: Testes Funcionais e Unitários com Pest PHP

Esta seção documenta a migração do PHPUnit para o **Pest PHP** e a implementação de testes funcionais e unitários no projeto Laravel.

## 🔄 Migração do PHPUnit para Pest PHP

### 📋 **Passos da Migração**

#### 1. **Remoção do PHPUnit**

```bash
# Remover PHPUnit do projeto
composer remove phpunit/phpunit
```

#### 2. **Instalação do Pest PHP**

```bash
# Instalar Pest PHP com todas as dependências
composer require pestphp/pest --dev --with-all-dependencies
```

#### 3. **Inicialização do Pest**

```bash
# Configurar Pest no projeto
./vendor/bin/pest --init
```

#### 4. **Atualização das Dependências (IMPORTANTE)**

```bash
# Atualizar dependências para resolver conflitos de versão
composer update
```

#### 5. **Execução dos Testes**

```bash
# Executar todos os testes
./vendor/bin/pest
```

---

## 🏗️ Estrutura de Testes Implementada

### 📁 **Organização dos Arquivos**

```
tests/
├── Feature/
│   └── ExampleTest.php     # Testes funcionais (HTTP)
├── Unit/
│   └── ExampleTest.php     # Testes unitários
└── Pest.php               # Configuração do Pest
```

### ⚙️ **Configuração do Pest (`tests/Pest.php`)**

```php
<?php

// Extende a classe TestCase do Laravel para testes Feature
pest()->extend(Tests\TestCase::class)
    ->in('Feature');

// Configurações adicionais de expectations e funções globais
```

---

## 🧪 Testes Implementados

### 1. **Teste Unitário** (`tests/Unit/ExampleTest.php`)

```php
<?php

// Teste básico de unidade
test('that true is true', function () {
    expect(true)->toBeTrue();
});
```

**Características:**

-   ✅ Sintaxe limpa e expressiva
-   ✅ Usa `expect()` ao invés de `assert()`
-   ✅ Teste isolado (não depende do Laravel)

### 2. **Teste Funcional** (`tests/Feature/ExampleTest.php`)

```php
<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

// Teste de resposta HTTP
it('returns a successful response', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
```

**Características:**

-   ✅ Testa a aplicação completa (end-to-end)
-   ✅ Simula requisições HTTP reais
-   ✅ Verifica status codes e respostas

---

## 🎯 Rota Testada

### **Configuração da Rota** (`routes/web.php`)

```php
<?php

use Illuminate\Support\Facades\Route;

// Rota simples que retorna "ok"
Route::get('/', function () {
    echo "ok";
});
```

---

## 📊 Resultados dos Testes

### ✅ **Teste Unitário (Sucesso)**

```
PASS  Tests\Unit\ExampleTest
✓ that true is true    0.03s
```

### ❌ **Teste Funcional (Erro)**

```
FAIL  Tests\Feature\ExampleTest
⨯ it returns a successful response    0.44s
───────────────────────────────────────────────────
FAILED  Tests\Feature\ExampleTest > it returns a successful response
ArgumentCountError: Too few arguments to function PHPUnit\Runner\ErrorHandler::enable()
```

### 🔧 **Solução do Erro - Composer Update**

O erro `ArgumentCountError` foi causado por incompatibilidade de versões entre dependências. A solução foi executar:

```bash
# Atualizar todas as dependências após instalar o Pest
composer update
```

**Por que funcionou:**

-   ✅ Resolve conflitos de versão entre Pest e PHPUnit
-   ✅ Atualiza dependências para versões compatíveis
-   ✅ Sincroniza todas as bibliotecas de teste
-   ✅ Corrige problemas de ErrorHandler do PHPUnit

### ✅ **Resultado Após a Correção**

```
PASS  Tests\Unit\ExampleTest
✓ that true is true    0.03s

PASS  Tests\Feature\ExampleTest
✓ it returns a successful response    0.12s

Tests:    2 passed (2 assertions)
Duration: 0.35s
```

---

## 🔧 Principais Diferenças: PHPUnit vs Pest PHP

| Aspecto          | PHPUnit                | Pest PHP               |
| ---------------- | ---------------------- | ---------------------- |
| **Sintaxe**      | Classes e métodos      | Funções e closures     |
| **Legibilidade** | `$this->assertTrue()`  | `expect()->toBeTrue()` |
| **Configuração** | `phpunit.xml`          | `Pest.php`             |
| **Execução**     | `./vendor/bin/phpunit` | `./vendor/bin/pest`    |
| **Estrutura**    | Orientada a objetos    | Funcional              |

---

## 💡 Vantagens do Pest PHP

### ✅ **Sintaxe Moderna**

```php
// PHPUnit (verboso)
public function test_user_can_login()
{
    $this->assertTrue(true);
}

// Pest PHP (conciso)
test('user can login', function () {
    expect(true)->toBeTrue();
});
```

### ✅ **Expectations Expressivas**

```php
// Pest oferece expectations mais legíveis
expect($user->email)->toBe('test@example.com');
expect($products)->toHaveCount(5);
expect($response)->toBeJson();
```

### ✅ **Menos Boilerplate**

-   Não precisa de classes
-   Funções globais `test()` e `it()`
-   Configuração mais simples

---

## 🎓 Conceitos de Teste Demonstrados

-   **Testes Unitários**: Testam funções/métodos isoladamente
-   **Testes Funcionais**: Testam fluxos completos da aplicação
-   **HTTP Testing**: Simulação de requisições web
-   **Expectations**: Asserções expressivas do Pest
-   **Test Organization**: Separação entre Unit e Feature
-   **Framework Migration**: Transição entre ferramentas de teste

---

## 🚀 Próximos Passos

### 📝 **Testes a Implementar**

1. Testes de modelo (Eloquent)
2. Testes de validação de formulários
3. Testes de API endpoints
4. Testes de autenticação
5. Testes de banco de dados

### ✅ **Problemas Resolvidos**

-   ✅ Erro de `ArgumentCountError` resolvido com `composer update`
-   ✅ Compatibilidade entre Pest e Laravel estabelecida
-   ✅ Testes funcionais executando corretamente

---

**Desenvolvido durante:** Laravel 11/12 - Framework, Ecossistema e Projetos Web (Udemy)  
**Seção:** 27 - Testes Funcionais e Unitários com Pest PHP
