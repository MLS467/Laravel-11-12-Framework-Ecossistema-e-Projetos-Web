# Curso Laravel - Testes com PestPHP

Este projeto é parte do curso de Laravel na Udemy, focando especialmente na **Seção 27: Testes Funcionais e Unitários com PestPHP**.

## 🧪 Sistema de Testes

### Configuração do PestPHP

O projeto foi configurado para utilizar o **PestPHP**, um framework de testes moderno e elegante para PHP que oferece uma sintaxe mais limpa e expressiva comparado ao PHPUnit tradicional.

### Estrutura de Testes

```
tests/
├── Feature/                              # Testes funcionais/integração (vazio)
├── Unit/
│   ├── MainControllerTest.php           # Teste unitário do MainController
│   └── MainOperatorHashGeneratorTest.php # Teste unitário do gerador de hash
├── Pest.php                             # Configurações globais do Pest
└── TestCase.php                         # Classe base para testes
```

## 🎯 Implementações Realizadas

### 1. Controller Principal

**Arquivo**: `app/Http/Controllers/MainController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Services\MainOperations;

class MainController extends Controller
{
    public function index(): string
    {
        return "Hello World Test";
    }

    public function showHash(): string
    {
        return MainOperations::hash_generation();
    }
}
```

**Características:**

-   Método `index()`: Retorna string "Hello World Test"
-   Método `showHash()`: Utiliza o serviço MainOperations para gerar hash
-   Tipagem de retorno explícita em ambos os métodos
-   Integração com a camada de serviços

### 2. Classe de Serviços

**Arquivo**: `app/Services/MainOperations.php`

```php
<?php

namespace App\Services;

class MainOperations
{
    public static function hash_generation(): string
    {
        // gera um valor com letras e algarismos com 32 caracteres
        return bin2hex(random_bytes(16));
    }
}
```

**Características:**

-   Método estático `hash_generation()`
-   Gera hash de 32 caracteres usando `bin2hex(random_bytes(16))`
-   Retorna string com letras e números aleatórios
-   Classe focada em operações utilitárias

## 🧪 Testes Implementados

### 1. Teste do MainController

**Arquivo**: `tests/Unit/MainControllerTest.php`

```php
<?php

use App\Http\Controllers\MainController;

test('class MainController | method index : return string', function () {
    $method_index = new MainController();

    $result = $method_index->index();

    expect($result)->toBeString();
    expect($result)->toEqual('Hello World Test');
});
```

**O que este teste verifica:**

-   ✅ **Instanciação**: Cria nova instância do `MainController`
-   ✅ **Execução**: Chama o método `index()`
-   ✅ **Tipo de Retorno**: Verifica se é string (`toBeString()`)
-   ✅ **Valor Específico**: Confirma o valor exato "Hello World Test"

### 2. Teste do Gerador de Hash

**Arquivo**: `tests/Unit/MainOperatorHashGeneratorTest.php`

```php
<?php

use App\Services\MainOperations;

test('Testando se tem 32 caracteres', function () {
    $tamanho_esperado = 32;

    $hash_gerada = MainOperations::hash_generation();

    $tamanho_da_hash = strlen($hash_gerada);

    expect($tamanho_da_hash)->toBe($tamanho_esperado);
});
```

**O que este teste verifica:**

-   ✅ **Geração de Hash**: Chama método estático `hash_generation()`
-   ✅ **Tamanho Correto**: Verifica se a hash tem exatamente 32 caracteres
-   ✅ **Funcionalidade**: Testa a operação matemática `strlen()`
-   ✅ **Expectativa Específica**: Usa `toBe()` para comparação exata

## 🚀 Como Executar os Testes

### Comandos Básicos

```bash
# Executar todos os testes
php artisan test

# Executar usando PestPHP diretamente
./vendor/bin/pest
```

### Executar por Tipo de Teste

```bash
# Executar somente testes unitários
php artisan test --testsuite=Unit

# Executar somente testes funcionais
php artisan test --testsuite=Feature
```

### Filtrar Testes Específicos

```bash
# Executar apenas o teste do MainController
php artisan test --testsuite=Unit --filter=MainControllerTest

# Executar apenas o teste do gerador de hash
php artisan test --testsuite=Unit --filter=MainOperatorHashGeneratorTest

# Filtrar por descrição
php artisan test --filter="Testando se tem 32 caracteres"
```

### Opções Avançadas

```bash
# Executar com relatório de cobertura
./vendor/bin/pest --coverage

# Executar com saída detalhada
php artisan test --verbose

# Executar e parar no primeiro erro
php artisan test --stop-on-failure
```

## 🛠️ Recursos do PestPHP Utilizados

### Sintaxe e Expectativas

-   ✅ **Sintaxe Funcional**: `test('descrição', function() {})`
-   ✅ **Expectativas Variadas**:
    -   `expect($value)->toBeString()` - Verificação de tipo
    -   `expect($value)->toEqual('expected')` - Comparação de valor
    -   `expect($value)->toBe($expected)` - Comparação exata
-   ✅ **Importações Diretas**: `use App\Http\Controllers\MainController`

### Organização e Estrutura

-   ✅ **Nomes Descritivos**: Descrições claras do que cada teste faz
-   ✅ **Múltiplas Verificações**: Vários `expect()` em um teste
-   ✅ **Separação de Responsabilidades**: Testes específicos para cada classe

## 📊 Cobertura Atual

### Classes Testadas

-   ✅ `MainController::index()` - Teste de retorno de string
-   ✅ `MainOperations::hash_generation()` - Teste de geração de hash

### Tipos de Teste Implementados

-   ✅ **Teste de Controller**: Verificação de métodos de controller
-   ✅ **Teste de Service**: Verificação de lógica de negócio
-   ✅ **Teste de Tipo**: Confirmação de tipos de retorno
-   ✅ **Teste de Valor**: Verificação de valores específicos
-   ✅ **Teste de Tamanho**: Validação de comprimento de strings

### Padrões de Teste Aplicados

-   ✅ **AAA Pattern**: Arrange (setup) → Act (execution) → Assert (verification)
-   ✅ **Testes Unitários Isolados**: Cada teste verifica uma funcionalidade específica
-   ✅ **Nomenclatura Clara**: Nomes de teste explicam exatamente o que é testado

## 🎯 Boas Práticas Aplicadas

1. **Descrições Explicativas**: Cada teste tem nome que explica sua função
2. **Verificações Múltiplas**: Testa tanto tipo quanto valor/tamanho
3. **Isolamento Completo**: Testes não dependem de recursos externos
4. **Tipagem Explícita**: Métodos usam tipagem para melhor testabilidade
5. **Separação de Camadas**: Controller e Service testados separadamente
6. **Métodos Estáticos**: Teste adequado de métodos estáticos

## 📋 Arquitetura Testada

```
Controller Layer:
├── MainController::index() ✅ Testado
└── MainController::showHash() ⏳ Não testado ainda

Service Layer:
└── MainOperations::hash_generation() ✅ Testado

Integration:
└── Feature Tests ⏳ Pasta preparada mas vazia
```

## 🔄 Próximos Passos Sugeridos

### Testes Adicionais

-   [ ] Testar método `MainController::showHash()`
-   [ ] Adicionar testes de integração em `Feature/`
-   [ ] Testar diferentes cenários de geração de hash
-   [ ] Verificar se hash gerada é sempre única

### Melhorias

-   [ ] Adicionar testes de exceções
-   [ ] Implementar mocks para dependências
-   [ ] Configurar RefreshDatabase para testes com banco
-   [ ] Adicionar testes de performance para geração de hash

### Expansão

-   [ ] Testar rotas web que usam os controllers
-   [ ] Implementar factories para dados de teste
-   [ ] Adicionar validação de formato hexadecimal da hash

---

_Este projeto demonstra implementação prática de testes unitários com PestPHP, cobrindo controllers e services com diferentes tipos de verificações._
