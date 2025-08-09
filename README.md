## Como funciona o fluxo Da Rota, Pelo Controller Até à View

Este projeto segue o padrão MVC do Laravel. O fluxo básico de uma requisição até a renderização da view é:

1. **Rota**  
   Definida em [routes/web.php](routes/web.php), por exemplo:

    ```php
    Route::get('/', [App\Http\Controllers\main\HomeController::class, 'index'])->name('home')->middleware(App\Http\Middleware\getIp::class);
    ```

2. **Controller**  
   A rota chama o método [`App\Http\Controllers\main\HomeController::index`](app/Http/Controllers/main/HomeController.php), que retorna a view:

    ```php
    public function index(Request $request): View
    {
        return view('home', ['nome' => 'Maisson']);
    }
    ```

3. **View**  
   A view [resources/views/home.blade.php](resources/views/home.blade.php) recebe a variável `$nome` e exibe:
    ```php
    <p class="display-6 text-secondary text-center py-5">CONTENT AQUI: {{ strtoupper($nome) }}</p>
    ```

Assim, ao acessar a rota `/`, o usuário vê a view renderizada com o valor passado pelo controller.

## Como Podemos Criar Views

Existem duas maneiras principais de criar views no Laravel:

### 1. Criação Manual

Navegue até a pasta `resources/views/` e crie um arquivo `.blade.php` manualmente:

**Exemplo:** Criar `resources/views/sobre.blade.php`

```php
@extends('layouts.main_layout')

@section('content')
    <h1>Sobre Nós</h1>
    <p>Esta página foi criada manualmente!</p>
@endsection
```

### 2. Usando Artisan Command

Use o comando `php artisan make:view` para criar views automaticamente:

```bash
# Criar uma view simples
php artisan make:view contato

# Criar uma view dentro de uma pasta
php artisan make:view admin.dashboard

# Criar uma view com template
php artisan make:view produtos.lista --extends=layouts.app
```

**Exemplo de uso:**

```bash
php artisan make:view portfolio
```

Isso criará automaticamente o arquivo `resources/views/portfolio.blade.php` com conteúdo básico.

### Estrutura Gerada pelo Artisan

O comando `make:view` cria um arquivo com estrutura básica:

```php
<!-- resources/views/portfolio.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Conteúdo da view aqui -->
            </div>
        </div>
    </div>
@endsection
```

### Exemplo Prático Executado

**Comando executado:**

```bash
php artisan make:view admin/page
```

Este comando criou o arquivo `resources/views/admin/page.blade.php` automaticamente, incluindo:

-   Criação da pasta `admin/` dentro de `resources/views/`
-   Arquivo `page.blade.php` com conteúdo básico:

```php
<div>
    Nothing worth having comes easy. - Theodore Roosevelt
</div>
```

**Resultado:**

-   ✅ Pasta criada: `resources/views/admin/`
-   ✅ Arquivo criado: `resources/views/admin/page.blade.php`
-   ✅ View acessível via: `view('admin.page')`

## Como Passar Dados para as Views

Existem três maneiras principais de passar dados do Controller para as Views no Laravel:

### Método 1: Array de Dados

Crie um array com os dados e passe como segundo parâmetro:

```php
public function index(Request $request): View
{
    $data = ['nome' => 'Maisson'];

    return view(
        'home',
        $data
    );
}
```

### Método 2: Array Inline

Passe os dados diretamente como array no segundo parâmetro:

```php
public function index(Request $request): View
{
    return view(
        'home',
        ['nome' => 'Maisson']
    );
}
```

### Método 3: Usando compact()

Use a função `compact()` para criar automaticamente um array com variáveis:

```php
public function index(Request $request): View
{
    $nome = 'Shaolin Matador de porco';
    return view(
        'home',
        compact('nome')
    );
}
```

### Exemplos Práticos Implementados

**Controller `HomeController.php`:**

-   Método `index()` - Usa compact() para passar `$nome` para `home.blade.php`
-   Método `admin()` - Usa array inline para passar dados para `admin.page.blade.php`

**Na View (`home.blade.php`):**

```php
<p class="display-6 text-secondary text-center py-5">
    CONTENT AQUI: {{ strtoupper($nome) }}
</p>
```

### Qual Método Usar?

-   **Método 1 (Array):** Ideal quando você tem muitos dados para organizar
-   **Método 2 (Inline):** Perfeito para poucos dados simples
-   **Método 3 (Compact):** Útil quando as variáveis já existem no escopo
