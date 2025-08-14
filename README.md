# Laravel Blade Template Engine - Estudos e Implementações

## Sobre Este Projeto

Este projeto é um estudo prático sobre **Blade Template Engine** do Laravel, focando em **layouts**, **seções**, **herança de templates** e conceitos fundamentais do sistema de views do Laravel.

**Branch:** `secao-9-blade-template-engine--blade-components-e-slot`

---

## Conceitos Estudados e Implementados

### 1. **Layouts Base (Master Templates)**

#### **Layout Principal: `main_layout.blade.php`**

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

#### **Layout Avançado: `other_layout.blade.php`**

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

#### **View Home: `home.blade.php`**

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

-   ✅ **@php...@endphp** - Código PHP dentro do Blade
-   ✅ **@extends('layouts.main_layout')** - Herança de template
-   ✅ **@section('title', $valor)** - Seção inline (uma linha)
-   ✅ **@section...@endsection** - Seção de bloco
-   ✅ **{{ $variavel }}** - Interpolação de variáveis

#### **View Other: `other.blade.php`**

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

## Diretivas Blade Estudadas

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
│   ├── main_layout.blade.php      # Layout simples
│   └── other_layout.blade.php     # Layout com seções padrão
├── home.blade.php                 # Página inicial
└── other.blade.php                # Página secundária

routes/
└── web.php                        # Rotas simples com Route::view
```

---

## Fluxo de Funcionamento

### **1. Acesso à Página Home**

```
GET / → Route::view('/', 'home') → home.blade.php → @extends('layouts.main_layout')
```

### **2. Renderização da Home**

```
main_layout.blade.php
├── @yield('title') ← Home-Page
└── @yield('content') ← <h3>Conteúdo da página! 2025</h3>
```

### **3. Acesso à Página Other**

```
GET /other → Route::view('/other', 'other') → other.blade.php → @extends('layouts.other_layout')
```

### **4. Renderização da Other**

```
other_layout.blade.php
├── @yield('title') ← Other-Page
├── @section('top_bar')...@show ← CONTEÚDO DO TOP BAR (sobrescrito)
├── @yield('content') ← CONTEÚDO DO CONTENT
└── @yield('bottom_bar') ← CONTEÚDO DO BOTTOM BAR
```

---

## Vantagens do Sistema Blade

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

### **1. Blade Components (Próximo Passo)**

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

### **4. Blade Directives Customizadas**

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

**Próximo passo:** Implementar **Blade Components** e **Slots** para componentização avançada.

---

## Novas Implementações (Atualização)

### 4. **Inclusão de Views com @include**

#### **Navbar Componentizada: `layouts/navbar.blade.php`**

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

-   ✅ **Criação automática** de arquivo .blade.php
-   ✅ **Estrutura de pastas** criada automaticamente
-   ✅ **Padronização** na nomenclatura
-   ✅ **Agilidade** no desenvolvimento

---

## Atualização da Estrutura de Arquivos

```
resources/views/
├── layouts/
│   ├── main_layout.blade.php      # Layout principal com Bootstrap
│   ├── other_layout.blade.php     # Layout com seções padrão
│   └── navbar.blade.php           # Navbar componentizada (NOVO)
├── home.blade.php                 # Página inicial
└── other.blade.php                # Página secundária

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
GET / → Route::view('/', 'home') → home.blade.php → @extends('layouts.main_layout')
```

### **2. Renderização com @include**

```
main_layout.blade.php
├── <head> com Bootstrap CSS
├── @include('layouts.navbar') ← navbar.blade.php renderizada
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

**Próximo passo:** Implementar **Blade Components** e **Slots** para componentização avançada.

---

**Desenvolvido para estudos do Laravel Blade Template Engine**
