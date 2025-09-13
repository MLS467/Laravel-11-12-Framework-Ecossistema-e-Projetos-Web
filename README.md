# Curso Laravel - Testes com PestPHP

Este projeto é parte do curso de Laravel na Udemy, focando especialmente na **Seção 27: Testes Funcionais e Unitários com PestPHP**.

## 🧪 Sistema de Testes

### Configuração do PestPHP

O projeto foi configurado para utilizar o **PestPHP**, um framework de testes moderno e elegante para PHP que oferece uma sintaxe mais limpa e expressiva comparado ao PHPUnit tradicional.

### Estrutura de Testes

```
tests/
├── Feature/                       # Testes funcionais/integração (vazio)
├── Unit/
│   └── MainControllerTest.php    # Teste unitário do MainController
├── Pest.php                      # Configurações globais do Pest
└── TestCase.php                  # Classe base para testes
```

## 🎯 Implementações Realizadas

### 1. Controller Principal

**Arquivo**: `app/Http/Controllers/MainController.php`

```php
<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index(): string
    {
        return "Hello World Test";
    }
}
```

**Características:**

-   Controller simples com método `index()`
-   Retorna uma string "Hello World Test"
-   Tipagem de retorno explícita (`string`)
-   Criado especificamente para demonstrar testes unitários

### 2. Teste Unitário do MainController

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

-   ✅ **Instanciação**: Cria uma nova instância do `MainController`
-   ✅ **Execução**: Chama o método `index()`
-   ✅ **Tipo de Retorno**: Verifica se o resultado é uma string (`toBeString()`)
-   ✅ **Valor Específico**: Confirma que retorna exatamente "Hello World Test" (`toEqual()`)
