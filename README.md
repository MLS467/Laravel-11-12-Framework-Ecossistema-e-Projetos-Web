# Curso Laravel - Testes com PestPHP

Este projeto é parte do curso de Laravel na Udemy, focando especialmente na **Seção 27: Testes Funcionais e Unitários com PestPHP**.

## 🧪 Testes Implementados

### Configuração do PestPHP

O projeto foi configurado para utilizar o **PestPHP**, um framework de testes moderno e elegante para PHP que oferece uma sintaxe mais limpa e expressiva comparado ao PHPUnit tradicional.

#### Estrutura de Testes

```
tests/
├── Feature/
│   └── MeuPrimeiroTest.php    # Testes funcionais/integração
├── Unit/
│   └── MeuPrimeiroTest.php    # Testes unitários
├── Pest.php                   # Configurações globais do Pest
└── TestCase.php              # Classe base para testes
```

### Testes Implementados

#### 1. Teste Funcional (Feature)

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

#### 2. Teste Unitário

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

### Configuração do Pest (`tests/Pest.php`)

O arquivo de configuração inclui:

-   **Extensão do TestCase**: Todos os testes de Feature estendem `Tests\TestCase`
-   **Expectativas Customizadas**: Exemplo de extensão `toBeOne()`
-   **Funções Helpers**: Espaço para funções auxiliares globais
-   **Comentários sobre RefreshDatabase**: Preparado para testes com banco de dados

### Como Executar os Testes

```bash
# Executar todos os testes
./vendor/bin/pest

# Executar apenas testes unitários
./vendor/bin/pest tests/Unit

# Executar apenas testes funcionais
./vendor/bin/pest tests/Feature

# Executar com relatório de cobertura
./vendor/bin/pest --coverage
```

### Recursos do PestPHP Utilizados

-   ✅ **Sintaxe Funcional**: Uso de `test()` ao invés de classes
-   ✅ **Expectativas Expressivas**: `expect($value)->toBeTrue()`
-   ✅ **Configuração Centralizada**: Arquivo `Pest.php` para configurações globais
-   ✅ **Compatibilidade Laravel**: Integração completa com o framework
-   ✅ **Extensibilidade**: Suporte a expectativas e helpers customizados

### Próximos Passos

Este é o setup inicial para testes com PestPHP. Os próximos desenvolvimentos podem incluir:

-   Testes de modelos e relacionamentos
-   Testes de controllers e middlewares
-   Testes de APIs e validações
-   Testes com banco de dados (RefreshDatabase)
-   Testes de autenticação e autorização
-   Factories e seeders para testes

---

_Este projeto faz parte do aprendizado na Seção 27 do curso de Laravel, explorando as melhores práticas de testes funcionais e unitários._
