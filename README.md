# Laravel 11 + PestPHP - Testes Funcionais e Unitários

Este projeto demonstra a implementação de testes funcionais e unitários usando o framework **PestPHP** no Laravel 11. O PestPHP oferece uma sintaxe mais limpa e expressiva para escrever testes em comparação ao PHPUnit tradicional.

## 📚 Conceitos Implementados

### 1. Testes Funcionais vs Unitários

#### **Testes Funcionais**

-   Testam funcionalidades completas da aplicação
-   Incluem interações com rotas, middlewares e banco de dados
-   Localização: `tests/Feature/`

#### **Testes Unitários**

-   Testam unidades isoladas de código (métodos, classes)
-   Não dependem de recursos externos
-   Localização: `tests/Unit/`

### 2. Sintaxe do PestPHP

#### **Função `test()` vs `it()`**

-   Ambas as funções criam testes
-   `test()`: Mais descritiva e clara
-   `it()`: Mais concisa, ideal para BDD (Behavior-Driven Development)

#### **Função `describe()`**

-   Agrupa testes relacionados
-   Permite organizar múltiplos testes de uma mesma funcionalidade
-   Facilita a leitura e manutenção dos testes

## 🚀 Implementações Realizadas

### 1. Teste Funcional - HomePageTest.php

```php
test('Testando a rota home', function () {
    $response = $this->get('/show-hash');
    expect($response->status())->toBe(200);
});
```

**O que testa:**

-   Verifica se a rota `/show-hash` retorna status HTTP 200
-   Valida que o endpoint está funcionando corretamente

### 2. Testes Unitários

#### **MainControllerTest.php**

```php
test('class MainController | method index : return string', function () {
    $method_index = new MainController();
    $result = $method_index->index();

    expect($result)->toBeString();
    expect($result)->toEqual('Hello World Test');
});
```

**O que testa:**

-   Instancia diretamente o controller
-   Verifica se o método `index()` retorna uma string
-   Valida o conteúdo exato da resposta

#### **MainOperatorHashGeneratorTest.php**

```php
test('Testando se tem a qtd caracteres', function () {
    expect(strlen(MainOperations::hash_generation()))->toEqual(32);
    expect(strlen(MainOperations::hash_generation(64)))->toEqual(64);
    expect(strlen(MainOperations::hash_generation(80)))->toEqual(80);
});
```

**O que testa:**

-   Verifica se a função de geração de hash retorna o número correto de caracteres
-   Testa diferentes tamanhos de hash (32, 64, 80 caracteres)

#### **MathOperationTest.php** - Usando `describe()` e `it()`

```php
describe('Test all Math operation', function () {
    it('test sum', function () {
        $result = MainOperations::MathOperation(10, 5, 'add');
        expect(intval($result))->toBe(15);
    });

    it('test subtract', function () {
        $result = MainOperations::MathOperation(10, 5, 'subtract');
        expect(intval($result))->toBe(5);
    });

    // ... outros testes de operações matemáticas
});
```

**O que testa:**

-   Agrupa todos os testes de operações matemáticas
-   Testa soma, subtração, multiplicação e divisão
-   Verifica tratamento de divisão por zero
-   Valida comportamento para operações inválidas

### 3. Classes de Apoio

#### **MainController.php**

```php
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

#### **MainOperations.php**

```php
class MainOperations
{
    public static function hash_generation($num = 32): string
    {
        return bin2hex(random_bytes($num / 2));
    }

    public static function MathOperation(float $valueOne, float $valueTwo, string $operation): float|string
    {
        // Implementação das operações matemáticas com tratamento de erros
    }
}
```

## 🔧 Configurações do PestPHP

### **Pest.php**

-   Configura os testes para usar `TestCase` do Laravel
-   Define expectativas customizadas
-   Aplica configurações específicas para testes Feature

### **Estrutura de Pastas**

```
tests/
├── Feature/           # Testes funcionais
│   └── HomePageTest.php
├── Unit/             # Testes unitários
│   ├── MainControllerTest.php
│   ├── MainOperatorHashGeneratorTest.php
│   └── MathOperationTest.php
├── Pest.php         # Configurações do Pest
└── TestCase.php     # Classe base para testes
```

## 🎯 Boas Práticas Demonstradas

1. **Nomenclatura Clara**: Nomes descritivos para testes e métodos
2. **Isolamento**: Testes unitários não dependem de recursos externos
3. **Cobertura Completa**: Testa casos de sucesso e erro
4. **Organização**: Uso de `describe()` para agrupar testes relacionados
5. **Assertivas Expressivas**: Uso das expectativas do Pest para maior legibilidade

## 🚀 Como Executar os Testes

```bash
# Executar todos os testes
./vendor/bin/pest

# Executar apenas testes unitários
./vendor/bin/pest tests/Unit

# Executar apenas testes funcionais
./vendor/bin/pest tests/Feature

# Executar com detalhes
./vendor/bin/pest --verbose
```

## 📈 Benefícios do PestPHP

1. **Sintaxe Limpa**: Mais legível que PHPUnit tradicional
2. **Flexibilidade**: Permite `test()`, `it()` e `describe()`
3. **Expectativas Expressivas**: API mais intuitiva para assertivas
4. **Compatibilidade**: 100% compatível com PHPUnit
5. **Produtividade**: Menos código repetitivo (boilerplate)

---

**Autor**: Implementação baseada no curso Laravel Udemy  
**Framework**: Laravel 11  
**Ferramenta de Teste**: PestPHP
