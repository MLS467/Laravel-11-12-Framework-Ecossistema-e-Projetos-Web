# Laravel html Template Engine - Estudos e Implementações

## Sobre Este Projeto

Este projeto é um estudo prático sobre **html Template Engine** do Laravel, focando em **layouts**, **seções**, **herança de templates** e conceitos fundamentais do sistema de views do Laravel.

**Branch:** `secao-9-html-template-engine--html-components-e-slot`

---

## Conceitos Estudados e Implementados

### 1. **Layouts Base (Master Templates)**

#### **Layout Principal: `main_layout.html.php`**

```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>
```

**Conceitos aplicados:**

-   ✅ **@yield('section_name')** - Define pontos de inserção de conteúdo
-   ✅ **Estrutura HTML básica** reutilizável
-   ✅ **Template limpo e minimalista**

#### **Layout Avançado: `other_layout.html.php`**

```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    @section('top_bar')
    <div>TEXTO DO TOP BAR USANDO @SHOW</div>
    @show
    <hr>

    @yield('content')

    <hr>
    @yield('bottom_bar')
</body>
</html>
```

**Conceitos aplicados:**

-   ✅ **@section...@show** - Seção com conteúdo padrão que pode ser sobrescrita
-   ✅ **Múltiplas seções** organizadas (top_bar, content, bottom_bar)
-   ✅ **Estrutura mais complexa** com elementos visuais

### 2. **Herança de Templates (@extends)**

#### **View Home: `home.html.php`**

```php
@php
$nome_page = 'Home-Page';
$year = date('Y');
@endphp

@extends('layouts.main_layout')

@section('title', $nome_page)

@section('content')
<h3>Conteúdo da página! {{ $year }}</h3>
@endsection
```

**Conceitos aplicados:**

-   ✅ **@php...@endphp** - Código PHP dentro do html
-   ✅ **@extends('layouts.main_layout')** - Herança de template
-   ✅ **@section('title', $valor)** - Seção inline (uma linha)
-   ✅ **@section...@endsection** - Seção de bloco
-   ✅ **{{ $variavel }}** - Interpolação de variáveis

#### **View Other: `other.html.php`**

```php
@php
$nome_page = 'Other-Page';
$year = date('Y');
@endphp

@extends('layouts.other_layout')

@section('title', $nome_page)

@section('top_bar')
<div>CONTEÚDO DO TOP BAR</div>
@endsection

@section('content')
<div>CONTEÚDO DO CONTENT</div>
@endsection

@section('bottom_bar')
<div>CONTEÚDO DO BOTTOM BAR</div>
@endsection
```

**Conceitos aplicados:**

-   ✅ **Sobrescrita de seção @show** - top_bar substitui o conteúdo padrão
-   ✅ **Múltiplas seções** preenchidas
-   ✅ **Organização estruturada** do conteúdo

### 3. **Sistema de Rotas Simples**

#### **Arquivo: `routes/web.php`**

```php
<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/other', 'other');
```

**Conceitos aplicados:**

-   ✅ **Route::view()** - Rota direta para view (sem controller)
-   ✅ **Simplicidade** para páginas estáticas
-   ✅ **URLs limpos** e organizados

---

## Diferenças entre @yield e @section...@show

### **@yield('section_name')**

```php
// No layout
@yield('content')

// Na view filha
@section('content')
<p>Conteúdo aqui</p>
@endsection
```

**Características:**

-   ❌ **Não tem conteúdo padrão**
-   ✅ **Deve ser preenchido na view filha**
-   ✅ **Mais simples para conteúdo obrigatório**

### **@section...@show**

```php
// No layout
@section('top_bar')
<div>Conteúdo padrão</div>
@show

// Na view filha (opcional)
@section('top_bar')
<div>Conteúdo personalizado</div>
@endsection
```

**Características:**

-   ✅ **Tem conteúdo padrão**
-   ✅ **Pode ser sobrescrito na view filha**
-   ✅ **Funciona mesmo se não for redefinido**

---

## Diretivas html Estudadas

### **1. Estrutura e Herança**

| Diretiva                 | Função                    | Exemplo                             |
| ------------------------ | ------------------------- | ----------------------------------- |
| `@extends`               | Herda de um layout        | `@extends('layouts.main')`          |
| `@yield`                 | Define ponto de inserção  | `@yield('content')`                 |
| `@section...@endsection` | Define conteúdo de seção  | `@section('content')...@endsection` |
| `@section...@show`       | Seção com conteúdo padrão | `@section('sidebar')...@show`       |

### **2. Código e Variáveis**

| Diretiva         | Função                     | Exemplo                        |
| ---------------- | -------------------------- | ------------------------------ |
| `@php...@endphp` | Código PHP puro            | `@php $var = 'valor'; @endphp` |
| `{{ $var }}`     | Exibir variável (escapado) | `{{ $nome }}`                  |
| `{!! $var !!}`   | Exibir HTML (não escapado) | `{!! $html !!}`                |

### **3. Seções Inline vs Bloco**

```php
// Seção inline (uma linha)
@section('title', 'Minha Página')

// Seção de bloco (múltiplas linhas)
@section('content')
<div>
    <h1>Título</h1>
    <p>Parágrafo</p>
</div>
@endsection
```

---

## Estrutura de Arquivos Implementada

```
resources/views/
├── layouts/
│   ├── main_layout.html.php      # Layout simples
│   └── other_layout.html.php     # Layout com seções padrão
├── home.html.php                 # Página inicial
└── other.html.php                # Página secundária

routes/
└── web.php                        # Rotas simples com Route::view
```

---

## Fluxo de Funcionamento

### **1. Acesso à Página Home**

```
GET / → Route::view('/', 'home') → home.html.php → @extends('layouts.main_layout')
```

### **2. Renderização da Home**

```
main_layout.html.php
├── @yield('title') ← Home-Page
└── @yield('content') ← <h3>Conteúdo da página! 2025</h3>
```

### **3. Acesso à Página Other**

```
GET /other → Route::view('/other', 'other') → other.html.php → @extends('layouts.other_layout')
```

### **4. Renderização da Other**

```
other_layout.html.php
├── @yield('title') ← Other-Page
├── @section('top_bar')...@show ← CONTEÚDO DO TOP BAR (sobrescrito)
├── @yield('content') ← CONTEÚDO DO CONTENT
└── @yield('bottom_bar') ← CONTEÚDO DO BOTTOM BAR
```

---

## Vantagens do Sistema html

### **1. Reutilização de Código**

-   ✅ **Layouts compartilhados** entre múltiplas páginas
-   ✅ **Redução de duplicação** de HTML
-   ✅ **Manutenção centralizada** da estrutura

### **2. Organização**

-   ✅ **Separação clara** entre layout e conteúdo
-   ✅ **Estrutura hierárquica** de templates
-   ✅ **Facilidade de manutenção**

### **3. Flexibilidade**

-   ✅ **Seções opcionais** com conteúdo padrão
-   ✅ **Sobrescrita seletiva** de seções
-   ✅ **Código PHP integrado** quando necessário

---

## Conceitos para Estudos Futuros

### **1. html Components (Próximo Passo)**

```php
// Criar componentes reutilizáveis
<x-card title="Título">
    Conteúdo do card
</x-card>
```

### **2. Slots e Slots Nomeados**

```php
// Slots para conteúdo dinâmico
<x-modal>
    <x-slot name="title">Título do Modal</x-slot>
    Conteúdo do modal
</x-modal>
```

### **3. Diretivas Avançadas**

```php
@if, @foreach, @while
@include, @includeIf, @includeWhen
@push, @stack para assets
@csrf, @method para formulários
```

### **4. html Directives Customizadas**

```php
// Criar suas próprias diretivas
@datetime($date)
@currency($value)
```

---

## Como Testar o Projeto

### **1. Acessar as Rotas**

```bash
# Página inicial (layout simples)
http://localhost:8000/

# Página other (layout com seções)
http://localhost:8000/other
```

### **2. Observar as Diferenças**

-   **Home**: Layout minimalista com apenas título e conteúdo
-   **Other**: Layout completo com top bar, conteúdo e bottom bar

### **3. Experimentar Modificações**

-   Alterar variáveis PHP nas views
-   Modificar seções nos layouts
-   Testar @show vs @yield

---

## Resumo dos Aprendizados

✅ **Templates Master** com @yield para estrutura reutilizável  
✅ **Herança de Templates** com @extends para organização  
✅ **Seções Flexíveis** com @section...@show para conteúdo padrão  
✅ **Código PHP** integrado com @php...@endphp  
✅ **Rotas Simples** com Route::view para páginas estáticas  
✅ **Organização de Views** em subpastas (layouts/)

**Próximo passo:** Implementar **html Components** e **Slots** para componentização avançada.

---

## Novas Implementações (Atualização)

### 4. **Inclusão de Views com @include**

#### **Navbar Componentizada: `layouts/navbar.html.php`**

```php
<div class="container-fluid bg-black mt-0 p-3">
    <div class="row">
        <h1 class="text-left">NAVBAR</h1>
    </div>
</div>
```

**Conceitos aplicados:**

-   ✅ **View parcial reutilizável** para navbar
-   ✅ **Classes Bootstrap** para estilização
-   ✅ **Estrutura modular** separada do layout principal

#### **Layout Principal Atualizado com @include**

```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: calc(100vh - 100px);
    }
    </style>
</head>
<body class="bg-secondary">

    @include('layouts.navbar')

    @yield('content')

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
```

**Novos conceitos aplicados:**

-   ✅ **@include('layouts.navbar')** - Inclusão de view parcial
-   ✅ **{{ asset() }}** - Helper para assets (CSS/JS)
-   ✅ **Bootstrap integrado** para estilização
-   ✅ **CSS customizado** dentro do layout
-   ✅ **Estrutura responsiva** com classes Bootstrap

### 5. **Integração com Bootstrap Framework**

#### **Assets Adicionados:**

-   ✅ **bootstrap.min.css** - Framework CSS
-   ✅ **bootstrap.bundle.min.js** - JavaScript components

#### **Estilização Customizada:**

```css
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: calc(100vh - 100px);
}
```

**Benefícios da integração:**

-   ✅ **Design responsivo** automático
-   ✅ **Classes utilitárias** prontas para uso
-   ✅ **Componentes pré-estilizados**
-   ✅ **Consistência visual** em toda aplicação

### 6. **Comando Artisan Utilizado**

#### **Criação de View com Artisan:**

```bash
php artisan make:view layouts/navbar
```

**Vantagens do comando:**

-   ✅ **Criação automática** de arquivo .html.php
-   ✅ **Estrutura de pastas** criada automaticamente
-   ✅ **Padronização** na nomenclatura
-   ✅ **Agilidade** no desenvolvimento

---

## Atualização da Estrutura de Arquivos

```
resources/views/
├── layouts/
│   ├── main_layout.html.php      # Layout principal com Bootstrap
│   ├── other_layout.html.php     # Layout com seções padrão
│   └── navbar.html.php           # Navbar componentizada (NOVO)
├── home.html.php                 # Página inicial
└── other.html.php                # Página secundária

public/assets/
├── bootstrap/
│   ├── bootstrap.min.css          # Framework CSS
│   └── bootstrap.bundle.min.js    # JavaScript components

routes/
└── web.php                        # Rotas simples com Route::view
```

---

## Novas Diretivas e Conceitos

### **@include vs @extends**

#### **@include**

```php
// Inclui uma view parcial
@include('layouts.navbar')

// Inclui com dados
@include('layouts.navbar', ['title' => 'Meu Site'])
```

**Características:**

-   ✅ **Reutilização de código** em qualquer lugar
-   ✅ **Views pequenas e modulares**
-   ✅ **Não herda layout** - apenas inclui conteúdo
-   ✅ **Pode receber dados** via segundo parâmetro

#### **@extends**

```php
// Herda um layout completo
@extends('layouts.main_layout')
```

**Características:**

-   ✅ **Herança completa** de estrutura
-   ✅ **Define pontos de inserção** com @section
-   ✅ **Uma view por página**
-   ✅ **Estrutura hierárquica**

### **Helper asset() para Recursos**

#### **Sintaxe:**

```php
<link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
<script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
```

**Vantagens:**

-   ✅ **URLs corretas** independente da estrutura
-   ✅ **Versionamento automático** (cache busting)
-   ✅ **Compatibilidade** com diferentes ambientes
-   ✅ **Organização** de assets públicos

---

## Fluxo Atualizado de Renderização

### **1. Acesso à Página Home (Atualizado)**

```
GET / → Route::view('/', 'home') → home.html.php → @extends('layouts.main_layout')
```

### **2. Renderização com @include**

```
main_layout.html.php
├── <head> com Bootstrap CSS
├── @include('layouts.navbar') ← navbar.html.php renderizada
├── @yield('content') ← Conteúdo da página home
└── Bootstrap JS carregado
```

### **3. Resultado Final**

```html
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Home-Page</title>
        <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css" />
        <style>
            /* CSS customizado */
        </style>
    </head>
    <body class="bg-secondary">
        <!-- Navbar incluída -->
        <div class="container-fluid bg-black mt-0 p-3">
            <div class="row">
                <h1 class="text-left">NAVBAR</h1>
            </div>
        </div>

        <!-- Conteúdo da página -->
        <h3>Conteúdo da página! 2025</h3>

        <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
    </body>
</html>
```

---

## Resumo dos Aprendizados (Atualizado)

✅ **Templates Master** com @yield para estrutura reutilizável  
✅ **Herança de Templates** com @extends para organização  
✅ **Seções Flexíveis** com @section...@show para conteúdo padrão  
✅ **Código PHP** integrado com @php...@endphp  
✅ **Rotas Simples** com Route::view para páginas estáticas  
✅ **Organização de Views** em subpastas (layouts/)  
✅ **Inclusão de Views** com @include para componentização  
✅ **Helper asset()** para gerenciamento de recursos  
✅ **Bootstrap Integration** para estilização moderna  
✅ **Artisan Commands** para criação rápida de views  
✅ **html Components** criados e utilizados

## html Components Implementados

### **Comando usado:**

```bash
php artisan make:component MyComponent
php artisan make:component admin/AdminCard
```

### **Componente Simples: MyComponent**

**Classe:** `app/View/Components/MyComponent.php`

```php
<?php
namespace App\View\Components;
use Illuminate\View\Component;

class MyComponent extends Component
{
    public function render()
    {
        return view('components.my-component');
    }
}
```

**View:** `resources/views/components/my-component.html.php`

```php
<h1 class="text-info">
    Conteúdo do component
</h1>
```

### **Componente em Subpasta: AdminCard**

**Classe:** `app/View/Components/admin/AdminCard.php`

```php
<?php
namespace App\View\Components\admin;
use Illuminate\View\Component;

class AdminCard extends Component
{
    public function render()
    {
        return view('components.admin.admin-card');
    }
}
```

**View:** `resources/views/components/admin/admin-card.html.php`

```php
<h1 class="text-danger">
    Conteúdo admin view
</h1>
```

### **Uso dos Componentes na View:**

```php
@section('content')
<!-- RENDERIZANDO UM COMPONENTE -->
<x-my-component />

<!-- RENDERIZANDO UM COMPONENTE DENTRO DE UMA SUBPASTA -->
<x-admin.admin-card />
@endsection
```

## Passagem de Dados Para html Components

### **1. Dados via Propriedades de String**

**Componente MyComponent atualizado:**

```php
<?php
namespace App\View\Components;
use Illuminate\View\Component;

class MyComponent extends Component
{
    public function __construct(
        public string $teste  // Propriedade pública para receber dados
    ) {}

    public function render()
    {
        return view('components.my-component');
    }
}
```

**View do componente:**

```php
<h1 class="text-info">
    Conteúdo do component: <span class="text-danger">{{ $teste }}</span>
</h1>
```

**Uso na view:**

```php
<x-my-component teste="Maisson Leal da Silva" />
```

### **2. Múltiplas Propriedades**

**Componente AdminCard atualizado:**

```php
<?php
namespace App\View\Components\admin;
use Illuminate\View\Component;

class AdminCard extends Component
{
    public function __construct(
        public string $novo,   // Primeira propriedade
        public string $value   // Segunda propriedade
    ) {}

    public function render()
    {
        return view('components.admin.admin-card');
    }
}
```

**View do componente:**

```php
<h1 class="text-danger">
    {{ $novo }}
</h1>
<h3>
    {{ $value }}
</h3>
```

### **3. Passagem de Dados via Route**

**Route com dados:**

```php
Route::view('/', 'home', ['teste2' => 123456789]);
```

**Uso com variável dinâmica:**

```php
<x-admin.admin-card novo="component" :value="$teste2" />
```

### **Sintaxes de Passagem de Dados:**

| Tipo               | Sintaxe                 | Exemplo                    | Descrição                  |
| ------------------ | ----------------------- | -------------------------- | -------------------------- |
| **String literal** | `atributo="valor"`      | `teste="Texto"`            | Passa string diretamente   |
| **Variável PHP**   | `:atributo="$variavel"` | `:value="$teste2"`         | Passa conteúdo de variável |
| **Expressão**      | `:atributo="expressao"` | `:count="$items->count()"` | Avalia expressão PHP       |

### **Exemplo Completo de Uso:**

**No arquivo home.html.php:**

```php
@php
$nome_page = 'Home-Page';
$year = date('Y');
@endphp

@extends('layouts.main_layout')

@section('title', $nome_page)

@section('content')
<!-- Componente com string literal -->
<x-my-component teste="Maisson Leal da Silva" />

<!-- Componente com múltiplas propriedades -->
<x-admin.admin-card novo="component" :value="$teste2" />
@endsection
```

**No arquivo routes/web.php:**

```php
<?php
use Illuminate\Support\Facades\Route;

Route::view('/', 'home', ['teste2' => 123456789]);
Route::view('/other', 'other');
```

### **Resultado Renderizado:**

```html
<!-- MyComponent -->
<h1 class="text-info">
    Conteúdo do component:
    <span class="text-danger">Maisson Leal da Silva</span>
</h1>

<!-- AdminCard -->
<h1 class="text-danger">component</h1>
<h3>123456789</h3>
```

### **Conceitos Importantes:**

✅ **Propriedades públicas** no construtor ficam disponíveis na view  
✅ **String literal** usa `atributo="valor"`  
✅ **Variáveis PHP** usam `:atributo="$variavel"`  
✅ **Dados da route** podem ser passados via terceiro parâmetro  
✅ **Tipagem** nas propriedades para validação

### **Estrutura Final Atualizada:**

```
app/View/Components/
├── MyComponent.php               # Com propriedade $teste
└── admin/
    └── AdminCard.php            # Com propriedades $novo e $value

resources/views/components/
├── my-component.html.php       # Exibe {{ $teste }}
└── admin/
    └── admin-card.html.php     # Exibe {{ $novo }} e {{ $value }}

routes/web.php                   # Route com dados ['teste2' => 123456789]
```

### **Próximos Conceitos para Estudar:**

-   **Slots** para conteúdo dinâmico
-   **Slots nomeados** para múltiplas áreas
-   **Attributes bag** para atributos HTML
-   **Componentes anônimos** sem classe PHP

## Componente com Arrays e Loops

### **Comando usado:**

```bash
php artisan make:component languages
```

### **Controller para Dados:**

```php
<?php
namespace App\Http\Controllers;
use Illuminate\View\View;

class MainController extends Controller
{
    public function show(): View
    {
        $languege_peoples = [
            'john' => [
                'portuguese',
                'english',
            ],
            'maria' => [
                'portuguese',
            ],
            'james' => [
                'portuguese',
                'english',
                'france'
            ],
        ];

        return view('home', compact('languege_peoples'));
    }
}
```

### **Componente Languages:**

```php
<?php
namespace App\View\Components;
use Illuminate\View\Component;

class languages extends Component
{
    public function __construct(
        public string $keyName,    // Nome da pessoa
        public array $lansName     // Array de idiomas
    ) {}

    public function render()
    {
        return view('components.languages');
    }
}
```

### **View do Componente:**

```php
<h1 class="bg-dark w-25 text-start">{{ $keyName }}</h1>
<h3 class="text-warning">Linguas:</h3>
@foreach ($lansName as $lan)
<ul class="d-flex justify-center">
    <li>{{ $lan }}</li>
</ul>
@endforeach
```

### **Uso na View Home:**

```php
@if(count($languege_peoples) != 0)
@foreach ($languege_peoples as $key => $languages)
<x-languages :key-name="$key" :lans-name="$languages" />
@endforeach
@else
<div class="alert alert-danger">
    <span class="text-light">
        Não há dados!
    </span>
</div>
@endif
```

### **Route Atualizada:**

```php
Route::get('/', [MainController::class, 'show']);
```

## Short Attribute Syntax

### **Sintaxe Abreviada:**

```php
<!-- Antes (sintaxe longa) -->
<x-languages :key-name="$key" :lans-name="$languages" />

<!-- Depois (sintaxe curta) -->
<x-languages :$key :$languages />
```

### **Componente atualizado:**

```php
public function __construct(
    public string $key,      // Mudou de $keyName para $key
    public array $languages  // Mudou de $lansName para $languages
) {}
```

### **Regra:**

-   Nome da variável deve coincidir com o nome da propriedade
-   Use `:$variavel` quando o nome da variável = nome da propriedade
-   Mais limpo e direto

### **Conceitos Aplicados:**

✅ **Array como propriedade** do componente  
✅ **@foreach dentro do componente** para iterar dados  
✅ **Kebab-case** na passagem de propriedades (:key-name, :lans-name)  
✅ **Controller** para fornecer dados estruturados  
✅ **Condicionais @if/@else** na view principal  
✅ **Passagem de chave e valor** do array associativo

### **Resultado Renderizado:**

```html
<!-- Para cada pessoa no array -->
<h1 class="bg-dark w-25 text-start">john</h1>
<h3 class="text-warning">Linguas:</h3>
<ul class="d-flex justify-center">
    <li>portuguese</li>
</ul>
<ul class="d-flex justify-center">
    <li>english</li>
</ul>

<h1 class="bg-dark w-25 text-start">maria</h1>
<h3 class="text-warning">Linguas:</h3>
<ul class="d-flex justify-center">
    <li>portuguese</li>
</ul>
<!-- ... mais pessoas -->
```

## Métodos de Componentes

### **Componente Languages com Métodos Personalizados:**

```php
<?php
namespace App\View\Components;
use Illuminate\View\Component;

class languages extends Component
{
    public function __construct(
        public string $key,
        public array $languages
    ) {}

    public function render()
    {
        return view('components.languages');
    }

    // Controla se o componente deve ser renderizado
    public function shouldRender(): bool
    {
        // Só renderiza se a pessoa falar mais de 1 idioma
        return count($this->languages) > 1;
    }

    // Método para lógica de estilização
    public function changeColorName(): bool
    {
        // Retorna true se o nome for 'john'
        return $this->key === 'john';
    }
}
```

### **View do Componente usando Métodos:**

```php
<h1 class="bg-dark w-25 text-start">{{ $key }}</h1>
<h3 class="text-warning">Linguas:</h3>
@foreach ($languages as $language)
<ul class="d-flex justify-center">
    <li class="{{ $changeColorName() ? 'text-primary':'text-danger' }}">
        {{ $language }}
    </li>
</ul>
@endforeach
```

### **Conceitos de Métodos de Componentes:**

#### **1. shouldRender()**

-   **Função**: Controla se o componente deve ser renderizado
-   **Retorno**: `bool` (true = renderiza, false = não renderiza)
-   **Uso**: Filtragem condicional de componentes
-   **Exemplo**: Só mostra pessoas que falam mais de 1 idioma

#### **2. Métodos Personalizados**

-   **Função**: Lógica de negócio dentro do componente
-   **Acesso**: Chamados diretamente na view `{{ $metodo() }}`
-   **Vantagem**: Encapsula lógica complexa
-   **Exemplo**: `changeColorName()` para estilização condicional

### **Resultado Prático:**

```html
<!-- Só renderiza se shouldRender() retornar true -->
<h1 class="bg-dark w-25 text-start">john</h1>
<h3 class="text-warning">Linguas:</h3>
<ul class="d-flex justify-center">
    <li class="text-primary">portuguese</li>
    <!-- azul para john -->
</ul>
<ul class="d-flex justify-center">
    <li class="text-primary">english</li>
    <!-- azul para john -->
</ul>

<!-- maria não aparece (só fala 1 idioma) -->

<h1 class="bg-dark w-25 text-start">james</h1>
<h3 class="text-warning">Linguas:</h3>
<ul class="d-flex justify-center">
    <li class="text-danger">portuguese</li>
    <!-- vermelho para james -->
</ul>
<!-- ... -->
```

### **Vantagens dos Métodos:**

✅ **Lógica encapsulada** no próprio componente  
✅ **Reutilização** de código entre diferentes views  
✅ **Controle de renderização** automático  
✅ **Separação de responsabilidades** (lógica vs apresentação)  
✅ **Código mais limpo** nas views

**Próximo passo:** Implementar **Slots** para componentização avançada.

---

## Introdução a Slots

Slots permitem injetar conteúdo flexível dentro de componentes, criando estruturas reutilizáveis que envolvem conteúdo dinâmico.

### **Criação do Componente Other**

```bash
php artisan make:component other
```

### **Classe do Componente Other**

```php
<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class other extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.other');
    }
}
```

### **View do Componente com Slot**

```html
{{-- resources/views/components/other.html.php --}}
<div class="row">
    <div class="col-12">
        <h3>INICIO</h3>
        {{ $slot }}
        <h3>FIM</h3>
    </div>
</div>
```

### **Uso do Componente com Slot**

```html
{{-- Uso básico --}}
<x-other>
    <p>Este conteúdo será inserido no slot</p>
    <div class="alert alert-info">Qualquer HTML pode ser colocado aqui</div>
</x-other>
```

### **Resultado Renderizado:**

```html
<div class="row">
    <div class="col-12">
        <h3>INICIO</h3>
        <p>Este conteúdo será inserido no slot</p>
        <div class="alert alert-info">Qualquer HTML pode ser colocado aqui</div>
        <h3>FIM</h3>
    </div>
</div>
```

### **Características dos Slots:**

✅ **`{{ $slot }}`**: Variável especial que recebe o conteúdo  
✅ **Flexibilidade**: Todo conteúdo entre as tags do componente vai para o slot  
✅ **Wrapper Components**: Ideal para componentes que envolvem conteúdo  
✅ **HTML Dinâmico**: Aceita qualquer estrutura HTML dentro do slot  
✅ **Reutilização**: Mesmo componente, conteúdo diferente

### **Casos de Uso Comuns:**

-   **Cards** com conteúdo variável
-   **Modais** com diferentes corpos
-   **Containers** com estrutura fixa e conteúdo dinâmico
-   **Layouts** de seção com header/footer fixos

**Vantagem principal:** Separação entre estrutura (componente) e conteúdo (slot).

## Multi-Slots (Slots Nomeados)

Os multi-slots permitem definir múltiplas áreas de conteúdo dentro de um mesmo componente, cada uma com um nome específico.

### componente com multi slot

```html
<div>
    <h1>{{ $title }}</h1>

    <p>{{ $content }}</p>

    <p>{{ $footer }}</p>
</div>
```

### Usando os multi slot:

```html
<x-multi_slot>
    <x-slot:title> Hello slot </x-slot:title>

    <x-slot:content> it´s multi slot content </x-slot:content>

    <x-slot:footer> it´s multi slot footer </x-slot:footer>
</x-multi_slot>
```

### **Vantagens dos Slots:**

-   **Flexibilidade**: Permite reutilizar componentes com conteúdo dinâmico
-   **Organização**: Multi-slots ajudam a estruturar melhor componentes complexos
-   **Manutenibilidade**: Facilita a manutenção e atualização de templates
-   **Reusabilidade**: Um mesmo componente pode ser usado em diferentes contextos
    Diferenças:
-   **Slot simples**: Aceita apenas um conteúdo que será inserido na posição do {{ $slot }}
-   **Multi-slot**: Permite múltiplas seções nomeadas, acessíveis através de {{ $title }}, {{ $content }}, {{ $footer }}, etc.

## Componentes Anônimos no Laravel Blade

### O que são?

Componentes anônimos são componentes Blade criados apenas com um arquivo de view (sem classe PHP), ideais para trechos de interface reutilizáveis e sem lógica complexa.

### Exemplo do seu código

**No arquivo `home.blade.php`:**

```php
@for ($index = 0; $index < 5; $index++)
    <x-alert>
        Olá, Esse é um component anônimo!
    </x-alert>
@endfor
```

```php
<div class="alert alert-warning">
    {{ $slot }}
</div>

```

### Como funciona?

-   O Blade procura por resources/views/components/alert.blade.php ao usar <x-alert>.
-   O conteúdo entre <x-alert> ... </x-alert> é passado para o slot padrão do - - componente.
-   Não precisa de classe PHP, apenas do arquivo Blade.
