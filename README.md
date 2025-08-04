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

## 52. Sessão, Registro de Login e Logout

No fluxo de autenticação do `authController`, foram implementadas as seguintes funcionalidades:

### Registro do último login

Após autenticar o usuário, o campo `last_login` do usuário é atualizado com a data e hora do login:

```php
$user->last_login = date("Y-m-d H:i:s");
$user->save();
```

### Armazenamento dos dados do usuário na sessão

Os dados essenciais do usuário autenticado são salvos na sessão para controle de acesso:

```php
session([
    'user' => [
        'id' => $user->id,
        'name' => $user->username
    ]
]);
```

### Logout

Ao fazer logout, a sessão do usuário é removida e o usuário é redirecionado para a tela de login:

```php
session()->forget('user');
return redirect()->to('/login');
```

**Resumo:**

-   O sistema registra a data/hora do último login do usuário.
-   O login mantém o usuário autenticado via sessão.
-   O logout limpa a sessão e redireciona para o login.

## 53. Middleware de Redirecionamento: checkIsNotLogged

Foi criado o middleware `checkIsNotLogged` para proteger rotas de usuários já autenticados. Sua função é impedir que usuários logados acessem páginas como login ou registro, redirecionando-os para a tela principal de notas.

**Exemplo de código:**

```php
public function handle(Request $request, Closure $next): Response
{
    if (session()->has('user')) {
        return redirect('/newNote');
    }
    return $next($request);
}
```

**Como funciona:**

-   Se existir um usuário na sessão (`session()->has('user')`), o middleware redireciona para `/newNote`.
-   Se não houver usuário logado, a requisição segue normalmente para a rota desejada.

**Resumo:**

-   Garante que páginas como login não sejam acessadas por quem já está autenticado.
-   Melhora a experiência e segurança do fluxo de autenticação.

## 53. Nomeação de Rotas

Para facilitar o gerenciamento e a manutenção das rotas, foi utilizada a funcionalidade de **nomeação de rotas** do Laravel. Com isso, é possível referenciar rotas pelo nome em vez de usar URLs diretamente nas views e controllers, tornando o código mais limpo e flexível.

**Exemplo de nomeação de rotas:**

```php
Route::get("/logout", [authController::class, "logout"])->name('logout');
Route::get("/newNote", [MainController::class, "newNote"])->name('new');
Route::get("/home", [MainController::class, "index"])->name('home');
```

**Como utilizar nas views:**

```blade
<a href="{{ route('logout') }}">Logout</a>
<a href="{{ route('home') }}">Home</a>
```

**Vantagens:**

-   Permite alterar a URL da rota sem precisar modificar todos os lugares onde ela é utilizada.
-   Facilita a manutenção e a leitura do código.
-   Ajuda a evitar erros de digitação em URLs.

A nomeação de rotas é uma boa prática recomendada em

## 55. Componente de Barra Superior (`top_bar.blade.php`)

Foi criado um componente Blade chamado `top_bar.blade.php` para exibir a barra superior em todas as páginas do sistema. Esse componente inclui:

-   O logo do sistema com link para a página inicial (`home`)
-   O nome do projeto centralizado
-   À direita, o ícone do usuário, o nome do usuário (placeholder `[username]`) e o botão de logout com ícone

**Exemplo de código do componente:**

```blade
<div class="row mb-3 align-items-center">
    <div class="col">
        <a href="{{ route('home') }}">
            <img src="assets/images/logo.png" alt="Notes logo">
        </a>
    </div>
    <div class="col text-center">
        A simple <span class="text-warning">Laravel</span> project!
    </div>
    <div class="col">
        <div class="d-flex justify-content-end align-items-center">
            <span class="me-3"><i class="fa-solid fa-user-circle fa-lg text-secondary me-3"></i>[username]</span>
            <a href={{ route('logout') }} class="btn btn-outline-secondary px-3">
                Logout<i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
            </a>
        </div>
    </div>
</div>
<hr>
```

**Como utilizar o componente em outras views:**

Basta incluir o seguinte comando Blade onde desejar exibir a barra superior:

```blade
@include('top_bar')
```

Dessa forma, o componente será renderizado em qualquer view, facilitando a padronização

## 56. Relações Eloquent entre Usuário e Notas

Para facilitar o acesso às notas de cada usuário, foi criada uma relação **um-para-muitos** entre os modelos `User` e `Note` utilizando o Eloquent.

### Implementação

No modelo `User`:

```php
// app/Models/User.php

public function notes()
{
    return $this->hasMany(Note::class, 'user_id');
}
```

Isso permite acessar todas as notas de um usuário de forma simples.

### Exemplo de uso

-   **Recuperar todas as notas de um usuário:**

```php
$user = User::find($id);
$notes = $user->notes; // retorna uma coleção de notas do usuário
```

-   **Na controller:**

```php
// Carregar usuário e suas notas
$id = session('user.id');
$user = User::find($id);
$notes = $user
```

### Vantagens

-   Facilita consultas relacionadas entre tabelas.
-   Permite acessar dados relacionados de forma intuitiva e orientada a objetos.
-   Reduz a necessidade de queries SQL manuais.

Essa abordagem segue as melhores práticas do Laravel para modelagem de dados e relacionamento entre entidades.

## 57. Exibição das Notas com Blade e Componentes

Na view principal (`main.blade.php`), as notas do usuário são exibidas utilizando o loop `@foreach` do Blade. Para cada nota, é incluído um componente parcial chamado `note`, responsável por renderizar os detalhes de cada anotação.

**Exemplo de código:**

```blade
@foreach ($notes as $note)
    @include('note')
@endforeach
```

-   Se não houver notas, é exibida uma mensagem e um botão para criar a primeira nota.
-   Se houver notas, cada uma é renderizada usando o componente `note`, facilitando a manutenção e a reutilização do layout das anotações.

Essa abordagem torna o código mais organizado e modular, seguindo as boas

## 58. Encriptação dos IDs nas Rotas

Para aumentar a segurança e evitar a exposição direta dos IDs das notas nas URLs, foi utilizada a encriptação dos IDs ao gerar os links de edição e exclusão.

**Exemplo de código no componente de nota (`note.blade.php`):**

```blade
<a href="/edit/{{ Crypt::encrypt($note->id) }}" class="btn btn-outline-secondary btn-sm mx-1">
    <i class="fa-regular fa-pen-to-square"></i>
</a>
<a href="/delete/{{ Crypt::encrypt($note->id) }}" class="btn btn-outline-danger btn-sm mx-1">
    <i class="fa-regular fa-trash-can"></i>
</a>
```

-   O método `Crypt::encrypt($note->id)` gera uma string criptografada do ID da nota.
-   Isso impede que usuários mal-intencionados tentem acessar ou manipular notas de outros usuários apenas alterando o número do ID na URL.

**Vantagens:**

-   Melhora a segurança das rotas sensíveis.
-   Evita exposição de informações internas do banco de dados.

Na controller responsável por

## 59. Desencriptação dos IDs nas Controllers

Para garantir a segurança ao manipular notas (edição e exclusão), os IDs das notas são **encriptados** nas URLs e **desencriptados** nas controllers antes de qualquer operação. Isso impede que usuários manipulem diretamente os IDs na URL para acessar ou modificar recursos que não lhes pertencem.

**Exemplo de código na controller (`MainController.php`):**

```php
public function editNote($id)
{
    try {
        $capture_id = Crypt::decrypt($id);
        // lógica para editar a nota com o $capture_id
    } catch (DecryptException $e) {
        return redirect()->route('home');
    }
}

public function deleteNote($id)
{
    try {
        $capture_id = Crypt::decrypt($id);
        // lógica para deletar a nota com o $capture_id
    } catch (DecryptException $e) {
        return redirect()->route('home');
    }
}
```

-   O método `Crypt::decrypt($id)` recupera o ID original da nota.
-   Se a desencriptação falhar (por exemplo, se alguém tentar manipular a URL), o usuário é redirecionado para a página inicial.
-   Esse padrão aumenta a segurança das operações sensíveis do sistema.

**Resumo:**  
IDs sensíveis nunca são expostos diretamente nas URLs e sempre passam

## 61. Service de Utilidades: `Operation`

Para centralizar funções utilitárias e permitir sua reutilização em diferentes partes do projeto, foi criado o service `Operation` em `app/Http/Services/Operation.php`.

### Funções implementadas

-   **descrypt_id($value)**

    -   Desencripta um valor (ID) usando o helper do Laravel `Crypt::decrypt`.
    -   Em caso de falha na desencriptação (por exemplo, se o valor foi manipulado), redireciona o usuário para a rota `home`.
    -   Exemplo de uso:
        ```php
        $id_final = Operation::descrypt_id($id_encrypted);
        ```

-   **testing_database()**
    -   Testa a conexão com o banco de dados.
    -   Retorna `true` se a conexão for bem-sucedida, ou `false` e exibe uma mensagem de erro caso contrário.
    -   Exemplo de uso:
        ```php
        if (Operation::testing_database()) {
            // conexão ok
        } else {
            // erro de conexão
        }
        ```

### Vantagens

-   **Reutilização:** Permite que funções comuns sejam usadas em qualquer controller ou classe do projeto.
-   **Organização:** Centraliza lógicas utilitárias, facilitando manutenção e testes.
-   **Segurança:** O método de desencriptação já trata exceções e redireciona em caso de tentativa de acesso inválido.

Esse padrão segue boas práticas de desenvolvimento Laravel, tornando o código

## 62. Tela de Criação de Nova Nota

A tela de criação de nova nota (`new_note.blade.php`) permite ao usuário adicionar uma nova anotação ao sistema de forma simples e intuitiva.

### Funcionalidades implementadas

-   **Barra superior:**  
    Inclui o componente `top_bar` para navegação e identidade visual.

-   **Título e botão de cancelar:**  
    O topo da página exibe o título "NEW NOTE" e um botão de cancelar (ícone de X), que retorna para a tela inicial.

-   **Formulário de criação:**

    -   Campo para o título da nota (`text_title`)
    -   Campo para o texto da nota (`text_note`)
    -   Ambos os campos utilizam validação do lado do servidor, exibindo mensagens de erro caso estejam inválidos.
    -   O valor antigo dos campos é mantido em caso de erro de validação, usando `old('text_title')` e `old('text_note')`.

-   **Ações:**
    -   Botão "Cancel" para voltar à tela inicial sem salvar.
    -   Botão "Save" para submeter o formulário e criar a nota.

### Exemplo de código do formulário

```blade
<form action="{{ route('notesubmit') }}" method="post">
    @csrf
    <div class="mb-3">
        <label class="form-label">Note Title</label>
        <input type="text" class="form-control bg-primary text-white"
            value="{{ old('text_title') }}" name="text_title">
        @error('text_title')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Note Text</label>
        <textarea class="form-control bg-primary text-white" name="text_note" rows="5">{{ old('text_note') }}</textarea>
        @error('text_note')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="text-end">
        <a href="{{ route('home') }}" class="btn btn-primary px-5">
            <i class="fa-solid fa-ban me-2"></i>Cancel
        </a>
        <button type="submit" class="btn btn-secondary px-5">
            <i class="fa-regular fa-circle-check me-2"></i>Save
        </button>
    </div>
</form>
```

Essa tela segue as boas práticas de UX, validação e reutilização de componentes

## 63. Edição e Atualização de Notas

O sistema permite que o usuário edite e atualize suas notas de forma segura e validada.

### Funcionalidades implementadas

-   **editNote($id)**

    -   Recebe o ID encriptado da nota pela URL.
    -   Utiliza o service `Operation::descrypt_id($id)` para desencriptar o ID.
    -   Busca a nota correspondente no banco de dados.
    -   Retorna a view `edit_note` com os dados da nota para edição.

    ```php
    public function editNote($id)
    {
        $id_final = Operation::descrypt_id($id);
        $nota = Note::find($id_final);
        return view('edit_note', ['nota' => $nota]);
    }
    ```

-   **editNoteSubmit(Request $request)**

    -   Valida os campos do formulário de edição (título e texto da nota).
    -   Garante que o campo `note_id` está presente.
    -   Desencripta o ID da nota recebida do formulário.
    -   Atualiza os campos da nota no banco de dados.
    -   Redireciona para a tela inicial após a atualização.

    ```php
    public function editNoteSubmit(Request $request)
    {
        $request->validate([
            'text_title' => 'required | min:3 | max:200',
            'text_note' => 'required | min:3 | max:3000'
        ], [
            'text_title.required' => "O título é obrigatório!",
            'text_tile.min' => "O título deve ter no mínimo :min caracteres!",
            'text_tile.max' => "O título deve ter no máximo :max caracteres!",
            'text_note.required' => "A nota é obrigatória!",
            'text_note.min' => "A nota deve ter no mínimo :min caracteres!",
            'text_note.max' => "A nota deve ter no máximo :max caracteres!",
        ]);

        if (!$request->note_id)
            return redirect()->route('home');

        $id = Operation::descrypt_id($request->note_id);

        $nota = Note::find($id);
        $nota->title = $request->text_title;
        $nota->text = $request->text_note;
        $nota->update();

        return redirect()->route('home');
    }
    ```

### Segurança

-   Os IDs das notas são sempre encriptados nas URLs e desencriptados nas controllers, evitando manipulação direta por usuários mal-intencionados.
-   Todos os campos são validados antes de qualquer alteração no banco de dados.

Essas práticas garantem a integridade e a segurança dos dados do usuário durante o processo de edição de

## 64. Exclusão de Notas (Soft Delete)

O sistema implementa a exclusão de notas utilizando o conceito de **soft delete** do Laravel, garantindo que as notas excluídas não sejam removidas definitivamente do banco de dados, mas apenas marcadas como excluídas.

### Como funciona

-   **Tela de confirmação:**  
    Ao solicitar a exclusão de uma nota, o usuário é direcionado para uma tela de confirmação (`delete_note`), onde pode confirmar ou cancelar a operação.

-   **Soft delete:**  
    No método `deleteNoteConfirm`, o ID da nota é desencriptado e a nota é localizada no banco de dados.  
    Em vez de remover o registro, o campo `deleted_at` é preenchido com a data e hora da exclusão.

    ```php
    public function deleteNoteConfirm($id)
    {
        $id_decrypt = Operation::descrypt_id($id);

        if (!$id_decrypt)
            return redirect()->route('home');

        // Soft delete
        $nota = Note::find($id_decrypt);
        $nota->deleted_at = date("Y/m/d H:i:s");
        $nota->save();

        return redirect()
            ->route('home')
            ->with('sucesso', 'Excluido com sucesso!');
    }
    ```

-   **Observação:**  
    O Laravel possui suporte nativo ao soft delete. Para utilizar o método padrão e garantir compatibilidade com recursos do framework, basta usar:

    ```php
    Note::find($id_decrypt)->delete();
    ```

    Isso preenche automaticamente o campo `deleted_at`.

-   **Listagem:**  
    As notas marcadas como excluídas (`deleted_at` diferente de `NULL`) não aparecem na listagem principal.

### Vantagens

-   Permite restaurar notas excluídas, se necessário.
-   Evita perda permanente de dados por exclusão acidental.
-   Segue boas práticas de segurança e integridade de dados.

Essa abordagem garante maior segurança e flexibilidade na gestão das notas do

## 65. Exclusão de Notas: Soft Delete e Hard Delete

O sistema permite excluir notas de duas formas: **soft delete** (exclusão lógica) e **hard delete** (exclusão física).

### Soft Delete (Exclusão Lógica)

-   O soft delete marca a nota como excluída preenchendo o campo `deleted_at`, mas mantém o registro no banco de dados.
-   Para realizar o soft delete corretamente no Laravel, basta usar:
    ```php
    Note::find($id_decrypt)->delete();
    ```
-   Notas com `deleted_at` preenchido não aparecem na listagem principal.

### Hard Delete (Exclusão Física)

-   O hard delete remove o registro do banco de dados de forma permanente.
-   Para realizar o hard delete no Laravel, utilize:
    ```php
    Note::find($id_decrypt)->forceDelete();
    ```

### Implementação no Controller

No método `deleteNoteConfirm`, você pode alternar entre soft delete e hard delete comentando/descomentando as linhas correspondentes:

```php
public function deleteNoteConfirm($id)
{
    $id_decrypt = Operation::descrypt_id($id);

    if (!$id_decrypt)
        return redirect()->route('home');

    // Soft delete (recomendado)
    // Note::find($id_decrypt)->delete();

    // Hard delete (remove definitivamente)
    Note::find($id_decrypt)->forceDelete();

    return redirect()
        ->route('home')
        ->with('sucesso', 'Excluido com sucesso!');
}
```

### Observações

-   O soft delete é recomendado para evitar perda permanente de dados e permitir possível restauração futura.
-   O hard delete deve ser usado apenas quando a remoção definitiva for realmente necessária.
-   O método de exclusão utilizado pode ser facilmente alterado conforme a necessidade do projeto.

Essas práticas garantem flexibilidade e segurança na gestão
