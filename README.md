# Laravel 11/12 - Framework, Ecossistema e Projetos Web

## Seção 27: Testes Funcionais e Unitários com PestPHP

Este projeto demonstra a implementação de testes unitários utilizando PestPHP no Laravel, focando na validação de controllers e services.

### 📋 Implementações Realizadas

#### 1. Testes Unitários

##### MainControllerTest

-   **Localização**: `tests/Unit/MainControllerTest.php`
-   **Objetivo**: Validar o método `index()` do MainController
-   **Testes implementados**:
    -   Verifica se o método retorna uma string
    -   Valida se o conteúdo retornado é exatamente "Hello World Test"

```php
test('class MainController | method index : return string', function () {
    $method_index = new MainController();
    $result = $method_index->index();

    expect($result)->toBeString();
    expect($result)->toEqual('Hello World Test');
});
```

##### MainOperatorHashGeneratorTest

-   **Localização**: `tests/Unit/MainOperatorHashGeneratorTest.php`
-   **Objetivo**: Validar a geração de hashes com tamanhos específicos
-   **Testes implementados**:
    -   Verifica se o hash padrão tem 32 caracteres
    -   Valida hashes personalizados com 64 caracteres
    -   Confirma hashes personalizados com 80 caracteres

```php
test('Testando se tem a qtd caracteres', function () {
    expect(strlen(MainOperations::hash_generation()))->toEqual(32);
    expect(strlen(MainOperations::hash_generation(64)))->toEqual(64);
    expect(strlen(MainOperations::hash_generation(80)))->toEqual(80);
});
```

#### 2. Service Layer - MainOperations

##### Funcionalidades Implementadas

-   **Localização**: `app/Services/MainOperations.php`
-   **Método**: `hash_generation($num = 32)`
-   **Propósito**: Gerar hashes hexadecimais com tamanho customizável

**Características:**

-   Valor padrão de 32 caracteres
-   Utiliza `random_bytes()` para garantir aleatoriedade criptográfica
-   Conversão para hexadecimal com `bin2hex()`
-   Implementação correta: `bin2hex(random_bytes($num / 2))`

**Observação Importante**: O código inclui um comentário demonstrando uma implementação incorreta que causaria falha nos testes:

```php
// return bin2hex(random_bytes($num)); // ❌ Implementação incorreta
```

#### 3. Controller - MainController

##### Métodos Implementados

-   **`index()`**: Retorna string "Hello World Test"
-   **`showHash()`**: Utiliza o service MainOperations para gerar hash

### 🧪 Execução dos Testes

Para executar os testes unitários:

```bash
# Executar todos os testes
./vendor/bin/pest

# Executar testes específicos
./vendor/bin/pest tests/Unit/MainControllerTest.php
./vendor/bin/pest tests/Unit/MainOperatorHashGeneratorTest.php
```

### 📁 Estrutura de Arquivos

```
app/
├── Http/Controllers/
│   └── MainController.php
└── Services/
    └── MainOperations.php

tests/
└── Unit/
    ├── MainControllerTest.php
    └── MainOperatorHashGeneratorTest.php
```

### 🎯 Conceitos Demonstrados

1. **Testes Unitários com PestPHP**

    - Sintaxe moderna e expressiva
    - Assertions com `expect()`
    - Testes focados e específicos

2. **Service Layer Pattern**

    - Separação de responsabilidades
    - Métodos estáticos para operações utilitárias
    - Validação através de testes

3. **Test-Driven Development (TDD)**
    - Testes que validam comportamentos específicos
    - Documentação através de testes
    - Detecção de regressões

### 🔧 Tecnologias Utilizadas

-   **Laravel 11/12**
-   **PestPHP** para testes
-   **PHPUnit** como base para PestPHP
-   **PHP 8.x**

### 💡 Principais Aprendizados

1. **Configuração do PestPHP**: Framework de testes moderno e expressivo para PHP
2. **Testes de Controller**: Validação de retornos de métodos sem dependências externas
3. **Testes de Service**: Verificação de lógica de negócio e geração de dados
4. **Assertions Específicas**: Uso de `toBeString()`, `toEqual()` e validações de tamanho
5. **Estrutura de Testes**: Organização clara entre testes unitários e funcionais

### 🚀 Como Usar

1. Clone o repositório
2. Execute `composer install`
3. Configure o arquivo `.env`
4. Execute os testes com `./vendor/bin/pest`

---

_Este projeto faz parte do curso "Laravel 11/12 - Framework, Ecossistema e Projetos Web" e demonstra as melhores práticas para implementação de testes unitários em aplicações Laravel usando PestPHP._
