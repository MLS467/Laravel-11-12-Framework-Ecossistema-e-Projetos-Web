# Curso Laravel - Testes com PestPHP

Este projeto é parte do curso de Laravel na Udemy, focando especialmente na **Seção 27: Testes Funcionais e Unitários com PestPHP**.

## 🧪 Sistema de Testes

### Configuração do PestPHP

O projeto foi configurado para utilizar o **PestPHP**, um framework de testes moderno e elegante para PHP que oferece uma sintaxe mais limpa e expressiva comparado ao PHPUnit tradicional.

### Estrutura de Testes

```
tests/
├── Feature/
│   └── MeuPrimeiroTest.php    # Testes funcionais/integração
├── Unit/
│   └── MeuPrimeiroTest.php    # Testes unitários
├── Pest.php                   # Configurações globais do Pest
└── TestCase.php              # Classe base para testes
```

### Configuração PHPUnit

A configuração dos testes está definida em `phpunit.xml`, que organiza os testes em diferentes suítes:

-   **Unit**: Testes unitários isolados
-   **Feature**: Testes funcionais e de integração

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
# Filtrar um teste específico
php artisan test --testsuite=Unit --filter=MeuSegundoTest

# Filtrar por padrão de nome
php artisan test --filter=MeuPrimeiro
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

## 📝 Testes Implementados

### 1. Teste Funcional (Feature)

**Arquivo**: `tests/Feature/MeuPrimeiroTest.php`

```php
test('example', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
```

-   **Propósito**: Testa a rota principal da aplicação
-   **Tipo**: Teste de integração que verifica se a aplicação responde corretamente
-   **Verificação**: Confirma que a página inicial retorna status HTTP 200

### 2. Teste Unitário

**Arquivo**: `tests/Unit/MeuPrimeiroTest.php`

```php
test('example', function () {
    $a = true;
    expect($a)->toBeTrue();
});
```

-   **Propósito**: Demonstra a sintaxe básica do PestPHP
-   **Tipo**: Teste unitário simples
-   **Verificação**: Testa expectativas básicas usando a sintaxe `expect()`

## ⚙️ Configuração do Pest

### Arquivo `tests/Pest.php`

O arquivo de configuração inclui:

-   **Extensão do TestCase**: Todos os testes de Feature estendem `Tests\TestCase`
-   **Expectativas Customizadas**: Exemplo de extensão `toBeOne()`
-   **Funções Helpers**: Espaço para funções auxiliares globais
-   **Comentários sobre RefreshDatabase**: Preparado para testes com banco de dados

```php
pest()->extend(Tests\TestCase::class)
    ->in('Feature');

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});
```

## 🛠️ Recursos do PestPHP Utilizados

-   ✅ **Sintaxe Funcional**: Uso de `test()` ao invés de classes
-   ✅ **Expectativas Expressivas**: `expect($value)->toBeTrue()`
-   ✅ **Configuração Centralizada**: Arquivo `Pest.php` para configurações globais
-   ✅ **Compatibilidade Laravel**: Integração completa com o framework
-   ✅ **Extensibilidade**: Suporte a expectativas e helpers customizados
-   ✅ **Organização por Suítes**: Separação clara entre Unit e Feature tests

## 📋 Próximos Passos

Este é o setup inicial para testes com PestPHP. Os próximos desenvolvimentos podem incluir:

-   [ ] Testes de modelos e relacionamentos
-   [ ] Testes de controllers e middlewares
-   [ ] Testes de APIs e validações
-   [ ] Testes com banco de dados (RefreshDatabase)
-   [ ] Testes de autenticação e autorização
-   [ ] Factories e seeders para testes
-   [ ] Testes de performance e carga
-   [ ] Integração contínua com GitHub Actions

## 🎯 Boas Práticas

1. **Organização**: Mantenha testes unitários em `Unit/` e funcionais em `Feature/`
2. **Nomenclatura**: Use nomes descritivos para os testes
3. **Isolamento**: Testes unitários devem ser independentes
4. **Cobertura**: Busque alta cobertura de código
5. **Performance**: Testes devem ser rápidos para execução frequente

---

_Este projeto faz parte do aprendizado na Seção 27 do curso de Laravel, explorando as melhores práticas de testes funcionais e unitários com PestPHP._
