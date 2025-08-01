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

**Exemplo de código do teste de conexão:**

```php
public function test_db(): void
{
    try {
        DB::connection()->getPdo();
        echo "connection successfuly";
    } catch (\PDOException $e) {
        echo "connection failed $e";
    }
}
```

## 48. Migration para a Tabela de Notas

Foi criada uma migration para a tabela `notes`, responsável por armazenar as anotações dos usuários. A migration define os seguintes campos:

-   `id`: identificador único da nota (auto incremento)
-   `user_id`: referência ao usuário (pode ser nulo)
-   `title`: título da nota (até 200 caracteres, pode ser nulo)
-   `text`: texto da nota (até 3000 caracteres, pode ser nulo)
-   `timestamps`: campos automáticos de criação e atualização
-   `softDeletes`: campo para exclusão lógica (soft delete)

**Exemplo de código da migration:**

```php
Schema::create('notes', function (Blueprint $table) {
    $table->id()->autoIncrement();
    $table->integer('user_id')->nullable();
    $table->string('title', 200)->nullable();
    $table->string('text', 3000)->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

Para criar a migration, utilize o comando:

```bash
php artisan make:migration create_notes_table
```

Para aplicar a migration e criar a tabela no banco de dados:

```bash
php artisan migrate
```

**Informações importantes sobre migrations:**

-   Todas as migrations executadas ficam registradas na tabela `migrations` do banco de dados, permitindo o controle de quais já foram aplicadas.
-   É possível desfazer (rollback) uma ou mais migrations, voltando o banco ao estado anterior. Para desfazer a última migration executada, use:

```bash
php artisan migrate:rollback --step=1
```

-   O parâmetro `--step=1` faz o rollback de apenas um passo (uma migration). Se quiser desfazer mais de uma, altere o número do step.

## 49. Seeders: Popular o Banco de Dados

Seeders são classes utilizadas para popular o banco de dados com dados iniciais ou de teste. No Laravel, ficam em `database/seeders`.

**Como criar um seeder:**

```bash
php artisan make:seeder NotesSeeder
```

**Exemplo de código de um seeder:**

```php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesSeeder extends Seeder
{
    public function run()
    {
        DB::table('notes')->insert([
            'user_id' => 1,
            'title' => 'Primeira nota',
            'text' => 'Conteúdo da nota de exemplo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
```

**Como executar os seeders:**

```bash
php artisan db:seed --class=NotesSeeder
```

Para executar todos os seeders registrados em `DatabaseSeeder.php`:

```bash
php artisan db:seed
```

**Resumo:**

-   Seeders facilitam a criação de dados de teste ou iniciais para o projeto.
-   Podem ser executados individualmente ou em conjunto.
-   Úteis para desenvolvimento, testes e demonstrações.

## 50. Listando Usuários com Eloquent no AuthController

No método `login_submit` do `authController`, foi utilizado o Eloquent ORM para buscar todos os usuários cadastrados na tabela `users` e exibir o resultado na tela.

**Exemplo de código:**

```php
use App\Models\User;

// ...

User::all()->toArray()

// ou

$userModel = new User();
$users = $userModel->all()->toArray();

echo "<pre>";
print_r($users);
echo "</pre>";
```

**Explicação:**

-   O Eloquent é utilizado para acessar o banco de dados de forma orientada a objetos.
-   O método `all()` retorna todos os registros da tabela `users` como uma coleção.
-   O método `toArray()` converte a coleção em um array PHP.
-   O resultado é exibido formatado na tela usando `print_r` dentro de uma tag `<pre>` para facilitar a leitura.

Esse recurso é útil para depuração e para visualizar rapidamente todos os usuários cadastrados no sistema.

## 51. Autenticação de Usuário no AuthController

No método `login_submit` do `authController`, foi implementado o fluxo de autenticação de usuário. O processo segue as etapas abaixo:

1. **Validação dos dados:**
    - O username deve ser um e-mail válido e o password deve ter entre 6 e 10 caracteres.
2. **Busca do usuário:**
    - O sistema procura um usuário na tabela `users` com o campo `username` igual ao informado e que não esteja deletado (`deleted_at` igual a NULL).
3. **Verificação de existência:**
    - Se o usuário não for encontrado, o sistema redireciona de volta para o formulário, mantém os dados preenchidos e exibe a mensagem "Credenciais inexistentes".
4. **Verificação de senha:**
    - Se o usuário existir, o sistema verifica se a senha informada confere com a senha salva no banco usando `password_verify`.
    - Se a senha estiver incorreta, o sistema redireciona de volta para o formulário, mantém os dados preenchidos e exibe a mensagem "Credenciais inexistentes".
5. **Login bem-sucedido:**
    - Se tudo estiver correto, o sistema retorna a mensagem "LOGIN REALIZADO COM SUCESSO!".

**Exemplo de código:**

```php
$user = User::where('username', $request->text_username)
    ->where('deleted_at', NULL)
    ->first();

if (!$user) {
    return redirect()
        ->back()
        ->withInput()
        ->with('loginError', 'Credenciais inexistentes');
}

if (!password_verify($request->text_password, $user->password)) {
    return redirect()
        ->back()
        ->withInput()
        ->with('loginError', 'Credenciais inexistentes');
}

return "LOGIN REALIZADO COM SUCESSO!";
```

**Resumo:**

-   O fluxo garante que apenas usuários válidos e com senha correta consigam acessar o sistema.
-   Mensagens de erro são exibidas de forma amigável e os dados do formulário são mantidos em caso de erro.
