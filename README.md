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

## Blade Template Engine - Documentação Completa

### 86. Da Rota, Pelo Controller Até à View (12m)

O fluxo completo de uma requisição no Laravel:

1. **Rota** (`routes/web.php`) - Define o endpoint
2. **Controller** - Processa a lógica
3. **View** - Renderiza o HTML final

**Exemplo prático:**

```php
// routes/web.php
Route::get('/', [HomeController::class, 'index']);

// HomeController.php
public function index() {
    return view('home', ['titulo' => 'Bem-vindo']);
}

// resources/views/home.blade.php
<h1>{{ $titulo }}</h1>
```

### 87. Como Podemos Criar Views (4m)

Duas formas de criar views:

**Forma 1 - Manual:**

-   Criar arquivo `.blade.php` em `resources/views/`

**Forma 2 - Artisan:**

```bash
php artisan make:view nome-da-view
php artisan make:view pasta.subpasta.view
```

### 88. Passar Dados do Controller Para a View (8m)

Métodos para passar dados:

```php
// Método 1 - Array inline
return view('home', ['nome' => 'João']);

// Método 2 - Array separado
$dados = ['nome' => 'João', 'idade' => 25];
return view('home', $dados);

// Método 3 - Compact
$nome = 'João';
$idade = 25;
return view('home', compact('nome', 'idade'));

// Método 4 - With
return view('home')->with('nome', 'João')->with('idade', 25);
```

### 89. Blade - Introdução (5m)

Blade é o template engine do Laravel que oferece:

-   Sintaxe limpa e legível
-   Herança de templates
-   Componentes reutilizáveis
-   Diretivas poderosas
-   Compilação automática para PHP

**Sintaxe básica:**

```php
{{ $variavel }}           // Escape automático
{!! $html !!}            // HTML não escapado
{{-- Comentário --}}     // Comentário Blade
@directive              // Diretivas
```

### 90. @if, @elseif, @else, @endif (7m)

Estruturas condicionais no Blade:

```php
@if($idade >= 18)
    <p>Maior de idade</p>
@elseif($idade >= 16)
    <p>Pode trabalhar como menor aprendiz</p>
@else
    <p>Menor de idade</p>
@endif

{{-- Condições múltiplas --}}
@if($user && $user->isAdmin())
    <p>Bem-vindo, Administrador!</p>
@endif

{{-- Operadores lógicos --}}
@if($status === 'ativo' && $user->verified)
    <p>Usuário ativo e verificado</p>
@endif
```

### 91. @switch, @case, @default, @endswitch (3m)

Estrutura switch-case no Blade:

```php
@switch($status)
    @case('pendente')
        <span class="badge badge-warning">Pendente</span>
        @break

    @case('aprovado')
        <span class="badge badge-success">Aprovado</span>
        @break

    @case('rejeitado')
        <span class="badge badge-danger">Rejeitado</span>
        @break

    @default
        <span class="badge badge-secondary">Desconhecido</span>
@endswitch
```

### 92. @unless, @isset e @empty (7m)

Diretivas condicionais especiais:

```php
{{-- @unless - inverso do @if --}}
@unless($user->isAdmin())
    <p>Você não tem permissões administrativas</p>
@endunless

{{-- @isset - verifica se variável existe --}}
@isset($usuario)
    <p>Bem-vindo, {{ $usuario->nome }}!</p>
@endisset

{{-- @empty - verifica se está vazio --}}
@empty($produtos)
    <p>Nenhum produto encontrado</p>
@endempty

{{-- Combinações --}}
@isset($mensagens)
    @empty($mensagens)
        <p>Não há mensagens</p>
    @else
        @foreach($mensagens as $msg)
            <p>{{ $msg }}</p>
        @endforeach
    @endempty
@endisset
```

### 93. @for, @foreach, @forelse, @while (9m)

Estruturas de repetição no Blade:

```php
{{-- @for - loop tradicional --}}
@for($i = 0; $i < 10; $i++)
    <p>Item {{ $i }}</p>
@endfor

{{-- @foreach - array/collection --}}
@foreach($usuarios as $usuario)
    <li>{{ $usuario->nome }}</li>
@endforeach

{{-- @forelse - foreach com fallback --}}
@forelse($produtos as $produto)
    <div class="produto">{{ $produto->nome }}</div>
@empty
    <p>Nenhum produto disponível</p>
@endforelse

{{-- @while - loop condicional --}}
@php $contador = 0; @endphp
@while($contador < 5)
    <p>Contador: {{ $contador }}</p>
    @php $contador++; @endphp
@endwhile
```

### 94. @continue, @break e Loop Variable (6m)

Controle de loops e variáveis especiais:

```php
{{-- @continue e @break --}}
@foreach($usuarios as $usuario)
    @if($usuario->inativo)
        @continue
    @endif

    @if($loop->index > 10)
        @break
    @endif

    <p>{{ $usuario->nome }}</p>
@endforeach

{{-- Loop variables disponíveis --}}
@foreach($items as $item)
    <p>
        Índice: {{ $loop->index }}      {{-- 0, 1, 2... --}}
        Iteração: {{ $loop->iteration }} {{-- 1, 2, 3... --}}
        Primeiro: {{ $loop->first ? 'Sim' : 'Não' }}
        Último: {{ $loop->last ? 'Sim' : 'Não' }}
        Total: {{ $loop->count }}
        Restante: {{ $loop->remaining }}
        Profundidade: {{ $loop->depth }}
        Par: {{ $loop->even ? 'Sim' : 'Não' }}
        Ímpar: {{ $loop->odd ? 'Sim' : 'Não' }}
    </p>
@endforeach
```

### 95. @csrf e Executando PHP Na View (13m)

Proteção CSRF e execução de PHP:

```php
{{-- Token CSRF para formulários --}}
<form method="POST" action="/usuarios">
    @csrf
    <input type="text" name="nome">
    <button type="submit">Enviar</button>
</form>

{{-- Método HTTP personalizado --}}
<form method="POST" action="/usuarios/1">
    @csrf
    @method('PUT')
    {{-- Formulário será enviado como PUT --}}
</form>

{{-- Executando PHP na view --}}
@php
    $dataAtual = date('Y-m-d');
    $usuario = auth()->user();
    $configuracao = config('app.name');
@endphp

<p>Data: {{ $dataAtual }}</p>
<p>Usuário: {{ $usuario->nome ?? 'Visitante' }}</p>
<p>App: {{ $configuracao }}</p>

{{-- PHP inline (uso moderado) --}}
{{ strtoupper($nome) }}
{{ number_format($preco, 2, ',', '.') }}
```

### 96. @production, @env, @error, @enderror (15m)

Diretivas de ambiente e tratamento de erros:

```php
{{-- @production - apenas em produção --}}
@production
    <script>
        // Google Analytics apenas em produção
        gtag('config', 'GA_TRACKING_ID');
    </script>
@endproduction

{{-- @env - ambiente específico --}}
@env('local')
    <div class="debug-bar">Modo de desenvolvimento</div>
@endenv

@env(['staging', 'production'])
    <script src="app.min.js"></script>
@else
    <script src="app.js"></script>
@endenv

{{-- @error - exibe erros de validação --}}
<input type="email" name="email" class="@error('email') is-invalid @enderror">
@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

{{-- Múltiplos campos --}}
@error('nome')
    <span class="error">{{ $message }}</span>
@enderror

@error('senha')
    <span class="error">{{ $message }}</span>
@enderror

{{-- Verificar se há erros --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

### 97. @session e @endsession (8m)

Trabalhando com sessões no Blade:

```php
{{-- @session - verificar dados da sessão --}}
@session('status')
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endsession

{{-- Verificar múltiplas chaves --}}
@session(['success', 'message'])
    <div class="notification">
        {{ session('success') ?? session('message') }}
    </div>
@endsession

{{-- Combinado com outras diretivas --}}
@session('user_type')
    @if(session('user_type') === 'admin')
        <nav class="admin-menu">
            {{-- Menu administrativo --}}
        </nav>
    @endif
@endsession

{{-- Flash messages --}}
@session('success')
    <div class="alert alert-success alert-dismissible">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endsession

@session('error')
    <div class="alert alert-danger alert-dismissible">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endsession

{{-- Verificar se sessão existe --}}
@if(session()->has('carrinho'))
    <span class="badge">{{ count(session('carrinho')) }}</span>
@endif
```

### Resumo das Diretivas Blade

| Diretiva               | Função              | Exemplo                                     |
| ---------------------- | ------------------- | ------------------------------------------- |
| `@if/@endif`           | Condicionais        | `@if($user) ... @endif`                     |
| `@foreach/@endforeach` | Loops               | `@foreach($items as $item) ... @endforeach` |
| `@csrf`                | Token CSRF          | `@csrf`                                     |
| `@method`              | HTTP Method         | `@method('PUT')`                            |
| `@error/@enderror`     | Erros validação     | `@error('field') ... @enderror`             |
| `@session/@endsession` | Dados sessão        | `@session('key') ... @endsession`           |
| `@production`          | Ambiente produção   | `@production ... @endproduction`            |
| `@env`                 | Ambiente específico | `@env('local') ... @endenv`                 |

```

```
