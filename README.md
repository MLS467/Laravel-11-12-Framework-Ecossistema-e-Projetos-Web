# Documentação do Projeto Laravel Notes

## 31. Projeto Laravel Notes

Este projeto é um sistema de anotações desenvolvido em Laravel, abordando conceitos fundamentais do framework, como rotas, controllers, views, autenticação e validação de dados.

---

## 32. Criar o Projeto

Para criar um novo projeto Laravel:

```bash
composer create-project --prefer-dist laravel/laravel nome-do-projeto
```

Após a instalação, configure o arquivo `.env` com as informações do banco de dados e execute:

```bash
php artisan serve
```

---

## 33. Introdução às Routes

As rotas em Laravel são definidas no arquivo `routes/web.php`. Elas determinam como as URLs são tratadas pela aplicação.

Exemplo:

```php
Route::get('/', function () {
    return view('welcome');
});
```

---

## 34. Criar um Controller e Uma Route para o Controller

Para criar um controller:

```bash
php artisan make:controller NomeController
```

Exemplo de rota apontando para um método do controller:

```php
use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'showLoginForm']);
```

---

## 35. Apresentar Uma View a Partir de um Controller

No controller, retorne uma view:

```php
public function showLoginForm() {
    return view('login');
}
```

---

## 36. Receber Parâmetros nas Routes

Rotas podem receber parâmetros dinâmicos:

```php
Route::get('/note/{id}', [NoteController::class, 'show']);
```

No controller:

```php
public function show($id) {
    // lógica para buscar a nota pelo $id
}
```

---

## 37. Views e Blade

Laravel utiliza o Blade como engine de templates. As views ficam em `resources/views` e usam a extensão `.blade.php`.

Exemplo de view:

```blade
<h1>Bem-vindo, {{ $user->name }}</h1>
```

---

## 38. Criando Layout para Múltiplas Views

Crie um layout base, por exemplo `layouts/main.blade.php`:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Laravel Notes')</title>
</head>
<body>
    @yield('content')
</body>
</html>
```

Nas views filhas:

```blade
@extends('layouts.main')

@section('content')
    <h2>Conteúdo da página</h2>
@endsection
```

---

## 39. Vamos Limpar o Nosso Projeto

Remova arquivos e códigos desnecessários, como a view `welcome.blade.php` e rotas/páginas padrão não utilizadas.

---

## 40. Controller para Autenticação

Crie um controller para autenticação:

```bash
php artisan make:controller AuthController
```

Exemplo de método:

```php
public function login(Request $request) {
    // lógica de autenticação
}
```

---

## 41. Criando o Layout Base da Aplicação e o Formulário de Login

O layout base foi mostrado acima. O formulário de login pode ser criado em `resources/views/login.blade.php`:

```blade
<form action="/login_submit" method="post" novalidate>
    @csrf
    <div class="mb-3">
        <label for="text_username">Username</label>
        <input type="text" name="text_username" value="{{ old('text_username') }}">
        @error('text_username')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="text_password">Password</label>
        <input type="password" name="text_password" value="{{ old('text_password') }}">
        @error('text_password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">LOGIN</button>
</form>
```

---

## 42. CSRF e Submissão de Formulários

Laravel protege formulários contra CSRF (Cross-Site Request Forgery) usando o token `@csrf`:

```blade
<form method="POST">
    @csrf
    <!-- campos -->
</form>
```

---

## 43. Como Capturar os Dados do Formulário

No controller, use o objeto `Request` para capturar os dados:

```php
use Illuminate\Http\Request;

public function login(Request $request) {
    $username = $request->input('text_username');
    $password = $request->input('text_password');
}
```

---

## 44. Introdução à Validação de Dados

Valide os dados recebidos usando o método `validate`:

```php
$validated = $request->validate([
    'text_username' => 'required',
    'text_password' => 'required|min:6',
]);
```

Se houver erros, eles são automaticamente enviados para a view e podem ser exibidos com `@error`.

---

## 46. Validação Customizada no AuthController

No método `login_submit` do `AuthController`, foi implementada uma validação customizada para o formulário de login, utilizando regras e mensagens personalizadas:

```php
public function login_submit(Request $request)
{
    // Regras de validação
    $validation = [
        'text_username' => 'required | email',
        'text_password' => 'required | min:6 | max:10'
    ];

    // Mensagens personalizadas
    $message = [
        'text_username.required' => "O username não pode ser vázio!",
        'text_username.email' => "O username deve ser um email válido!",
        'text_password.required' => "O password não pode ser vázio!",
        'text_password.min' => "O password deve ter pelo menos :min caracteres!",
        'text_password.max' => "O password deve ter no máximo :max caracteres!",
    ];

    // Validação
    $request->validate($validation, $message);

    // Se passou, retorna "ok"
    return "ok";
}
```

**Resumo:**

-   `text_username` deve ser obrigatório e um e-mail válido.
-   `text_password` deve ser obrigatório, mínimo 6 e máximo 10 caracteres.
-   Mensagens de erro são personalizadas para cada regra.
-   Se houver erro, o usuário é redirecionado de volta ao formulário com os erros exibidos automaticamente.
