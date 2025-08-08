## 66. Rotas no Projeto Laravel

O arquivo `routes/web.php` foi utilizado para definir diversas rotas, explorando diferentes formas de manipulação de requisições HTTP e recursos do Laravel.

### Tipos de Rotas Implementadas

-   **Rota comum usando função callback**

    ```php
    Route::get('/', function () {
        return "<h1>Hello World!</h1>";
    });
    ```

    Responde ao método GET na raiz do site, retornando um HTML simples.

-   **Rota capturando o Request**

    ```php
    Route::get('/injection', function (Request $request) {
        var_dump($request);
    });
    ```

    Exemplo de injeção de dependência, capturando o objeto `Request` e exibindo seus dados.

-   **Rota usando múltiplos métodos HTTP**

    ```php
    Route::match(['get', 'post'], '/teste', function () {
        echo "teste";
    });
    ```

    Aceita tanto GET quanto POST na mesma rota.

-   **Rota que aceita qualquer método HTTP**

    ```php
    Route::any('/all', function () {
        echo "teste";
    });
    ```

    Responde a qualquer verbo HTTP (GET, POST, PUT, DELETE, etc).

-   **Rota que retorna uma view diretamente**

    ```php
    // Route::view('/', 'home');
    ```

    Retorna a view `home` na raiz do site (comentada no momento).

-   **Rota que retorna uma view com passagem de dados**

    ```php
    Route::view('/', 'home', ['my_name' => "Maisson Leal"]);
    ```

    Retorna a view `home` e passa o dado `my_name` para ser utilizado na view.

-   **Redirecionamento temporário (HTTP 302)**

    ```php
    Route::redirect('/test', '/home');
    ```

    Redireciona `/test` para `/home` com status 302 (temporário).

-   **Redirecionamento permanente (HTTP 301)**
    ```php
    Route::permanentRedirect('/redirect2', '/injection');
    ```
    Redireciona `/redirect2` para `/injection` com status 301 (permanente).

### Observações

-   As rotas podem ser nomeadas usando o método `name()`, facilitando o uso em links e redirecionamentos.
-   O uso de `Route::view` simplifica o retorno de views sem necessidade de controller.
-   Redirecionamentos são úteis para manter URLs amigáveis e evitar links quebrados após mudanças de estrutura.

Essas práticas demonstram o poder e a flexibilidade do sistema de rotas do Laravel, permitindo manipulação avançada de requisições e

## 67. Rotas com Parâmetros e Exemplos Práticos

No arquivo `routes/web.php`, foram criadas rotas que demonstram como trabalhar com parâmetros obrigatórios, opcionais e múltiplos, além de como receber o objeto `Request` no controller.

### Exemplos implementados

-   **Recebendo um valor obrigatório**

    ```php
    Route::get('/valor/{value}', [MainController::class, 'recebe_valor']);
    ```

    -   Controller:
        ```php
        public function recebe_valor($value)
        {
            echo "Valor recebido ---> $value";
        }
        ```
    -   Exemplo de uso:  
        `/valor/123`  
        Saída:  
        `Valor recebido ---> 123`

-   **Recebendo múltiplos valores obrigatórios**

    ```php
    Route::get('/valor2/{value1}/{value2}', [MainController::class, 'recebe_valor2']);
    ```

    -   Controller:
        ```php
        public function recebe_valor2($value1, $value2)
        {
            echo "Valor recebido ---> $value1, $value2";
        }
        ```
    -   Exemplo de uso:  
        `/valor2/abc/456`  
        Saída:  
        `Valor recebido ---> abc, 456`

-   **Recebendo múltiplos valores e o objeto Request**

    ```php
    Route::get('/valor-req/{value1}/{value2}', [MainController::class, 'recebe_valor_req']);
    ```

    -   Controller:
        ```php
        public function recebe_valor_req(Request $request, $value1, $value2)
        {
            echo "Valor recebido ---> $value1, $value2";
            echo "<br>";
            echo $request;
        }
        ```
    -   Exemplo de uso:  
        `/valor-req/1/2`  
        Saída:
        ```
        Valor recebido ---> 1, 2
        [objeto Request impresso]
        ```

-   **Recebendo valor opcional**

    ```php
    Route::get('/valor-opc/{value_opc?}', [MainController::class, 'recebe_valor_opc']);
    ```

    -   Controller:
        ```php
        public function recebe_valor_opc($value = null)
        {
            echo "Valor recebido ---> $value";
        }
        ```
    -   Exemplo de uso:  
        `/valor-opc`  
        Saída:  
        `Valor recebido --->`  
        `/valor-opc/xyz`  
        Saída:  
        `Valor recebido ---> xyz`

-   **Recebendo múltiplos parâmetros com parte fixa na rota**
    ```php
    Route::get('/user/{user_id}/post/{post_id?}', [MainController::class, 'recebe_post']);
    ```
    -   Controller:
        ```php
        public function recebe_post(Request $request, $user_id, $post_id = null)
        {
            echo "Valor recebido ---> $user_id, $post_id";
            echo "<br>";
            echo $request;
        }
        ```
    -   Exemplo de uso:  
        `/user/10/post`  
        Saída:  
        `Valor recebido ---> 10,`  
        `/user/10/post/99`  
        Saída:  
        `Valor recebido ---> 10, 99`

### Observações

-   Parâmetros obrigatórios são definidos entre `{}`.
-   Parâmetros opcionais são definidos entre `{}` e seguidos de `?`, e devem ter valor padrão no método do controller.
-   O Laravel injeta automaticamente os parâmetros da URL nos métodos do controller conforme a ordem definida na rota.
-   O objeto `Request` pode ser injetado em qualquer método para acessar dados da requisição.

Esses exemplos mostram como criar rotas dinâmicas e flexíveis, facilitando o recebimento de dados diretamente pela URL e o uso do

## 68. Parâmetros de Rota com Restrições (Constraints)

No arquivo `routes/web.php`, foram criadas rotas que recebem parâmetros dinâmicos na URL e aplicam **restrições (constraints)** usando expressões regulares para garantir que apenas valores válidos sejam aceitos.

### Exemplos implementados

-   **Rota com parâmetros obrigatórios e opcionais, e restrições:**

    ```php
    Route::get('/user/{user_id}/post/{post_id?}', function ($user_id, $post_id = null) {
        echo "USER ID = $user_id e POST ID = $post_id";
    })->where([
        'user_id' => '[0-9]+',
        'post_id' => '[a-zA-Z0-9]+'
    ]);
    ```

    -   `{user_id}` é obrigatório e deve conter apenas números (`[0-9]+`).
    -   `{post_id}` é opcional e, se informado, deve conter apenas letras e/ou números (`[a-zA-Z0-9]+`).
    -   Exemplo de uso:
        -   `/user/123/post` → `USER ID = 123 e POST ID =`
        -   `/user/123/post/abc123` → `USER ID = 123 e POST ID = abc123`
        -   `/user/abc/post` → **Não será aceita** (user_id deve ser numérico)
        -   `/user/123/post/!@#` → **Não será aceita** (post_id deve ser alfanumérico)

-   **Outras formas testadas (comentadas no código):**
    -   Restringindo apenas o `user_id`:
        ```php
        // Route::get('/user/{user_id}/post/{post_id?}', function ($user_id, $post_id = null) {
        //     echo "USER ID = $user_id e POST ID = $post_id";
        // })->where('user_id', '[0-9]+');
        ```
    -   Restringindo apenas o `post_id`:
        ```php
        // Route::get('/user/{user_id}/post/{post_id?}', function ($user_id, $post_id = null) {
        //     echo "USER ID = $user_id e POST ID = $post_id";
        // })->where('post_id', '[a-zA-Z0-9]+');
        ```

### Observações

-   As restrições garantem que apenas URLs válidas sejam aceitas pela aplicação, aumentando a segurança e a previsibilidade das rotas.
-   Parâmetros opcionais devem ser definidos com `?` tanto na rota quanto no método/função.
-   É possível combinar múltiplas restrições em uma única rota usando um array no método `where`.

Essas práticas são essenciais para criar rotas robustas e seguras em

## 69. Rotas Avançadas: Prefixos, Middleware, Controllers e Fallback

No arquivo `routes/web.php`, foram implementados exemplos de rotas avançadas utilizando prefixos, middleware, controllers e fallback para rotas não encontradas.

### Rotas com Prefixo

Utilizando o método `prefix`, é possível agrupar rotas sob um mesmo caminho base, facilitando a organização de rotas administrativas:

```php
Route::prefix('admin')->group(function () {
    // http://localhost:8000/admin/
    Route::get('/', function () {
        echo "primeira rota admin";
    });

    // http://localhost:8000/admin/home
    Route::get('/home', function () {
        echo "home rota admin";
    });
});
```

### Rotas com Middleware

O middleware `onlyAdmin` foi aplicado a um grupo de rotas para restringir o acesso apenas a usuários autorizados:

```php
Route::middleware([onlyAdmin::class])->group(function () {
    Route::get('/admin', function () {
        echo "<br>";
        echo "home rota admin";
    });

    Route::get('/admin1', function () {
        echo "<br>";
        echo "home rota admin 1";
    });

    Route::get('/admin2', function () {
        echo "<br>";
        echo "home rota admin 2";
    });
});
```

-   Apenas usuários que passam pelo middleware `onlyAdmin` conseguem acessar essas rotas.

### Rotas com Controller

Utilizando o método `controller`, é possível agrupar rotas que utilizam o mesmo controller, deixando o código mais limpo:

```php
Route::controller(MainController::class)->group(function () {
    Route::get('/teste-controller', 'index');
});
```

-   A rota `/teste-controller` chama o método `index` do `MainController`.

### Rota Fallback

A rota fallback é utilizada para capturar qualquer requisição que não corresponda a nenhuma rota definida, exibindo uma mensagem personalizada de página não encontrada:

```php
Route::fallback(function () {
    echo "<h1>Página não encontrada</h1>";
});
```

### Observações

-   O uso de prefixos e middleware facilita a organização e a segurança das rotas.
-   O fallback garante uma resposta amigável para URLs inválidas.
-   O agrupamento por controller deixa o arquivo de rotas mais limpo e fácil de manter.

Essas práticas são recomendadas para projetos de

## 70. Rotas Resource e Single Action

No arquivo `routes/web.php`, foram implementadas rotas utilizando diferentes recursos do Laravel para facilitar o desenvolvimento e a organização do projeto.

### Rota Single Action Controller

```php
Route::get('/', SingleActionController::class);
```

-   Define a rota raiz (`/`) para ser tratada por um **Single Action Controller**.
-   Um Single Action Controller é uma classe controller com apenas um método `__invoke`, ideal para ações simples e isoladas.

### Rota Resource

```php
Route::resource('user', UserController::class);
```

-   Cria automaticamente todas as rotas RESTful para o recurso `user`, mapeando para os métodos padrão do `UserController` (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`).
-   Exemplo de rotas geradas:
    -   `GET /user` → `index`
    -   `GET /user/create` → `create`
    -   `POST /user` → `store`
    -   `GET /user/{user}` → `show`
    -   `GET /user/{user}/edit` → `edit`
    -   `PUT/PATCH /user/{user}` → `update`
    -   `DELETE /user/{user}` → `destroy`

### Rotas Resource Múltiplos

```php
Route::resources([
    'products' => ProductsController::class,
    'clientes' => ClientsController::class
]);
```

-   Cria rotas RESTful para múltiplos recursos de uma só vez.
-   Para cada recurso (`products` e `clientes`), são geradas todas as rotas RESTful padrão, mapeando para seus respectivos controllers (`ProductsController` e `ClientsController`).

### Vantagens

-   **Produtividade:** Reduz a quantidade de código necessário para criar rotas CRUD.
-   **Organização:** Mantém o arquivo de rotas limpo e fácil de manter.
-   **Padrão RESTful:** Segue as melhores práticas de desenvolvimento de APIs e aplicações web.

Essas abordagens são recomendadas para projetos que precisam de operações CRUD padronizadas e para ações simples que podem ser resolvidas com

## Organização de Controllers em Subpastas no Laravel

No Laravel, é possível organizar seus controllers em subpastas para manter o código mais limpo e modular. Por exemplo, você pode criar uma subpasta `admin` dentro de `app/Http/Controllers` para agrupar controllers relacionados à área administrativa.

### Exemplo de Estrutura

```
app/
└── Http/
    └── Controllers/
        ├── Controller.php
        └── admin/
            └── AdminController.php
```

### Como Referenciar Controllers em Subpastas nas Rotas

Ao definir rotas para controllers em subpastas, utilize o namespace completo. Exemplo:

```php
use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/index',
    [AdminController::class, 'index']
)->name('index');
```

> **Dica:** O nome da subpasta (`admin`) faz

## Sobre o Controller Base

O arquivo `Controller.php` serve como **controller base** no Laravel. Ele define funcionalidades comuns que podem ser utilizadas por outros controllers do projeto, promovendo reutilização de código e organização.

### Exemplo de Método Compartilhado

No exemplo abaixo, o método `cleanToUpperCase` foi definido no controller base para ser utilizado por outros controllers. Ele recebe um argumento, remove espaços em branco e retorna o valor em letras maiúsculas, formatado em HTML:

```php
// app/Http/Controllers/Controller.php

abstract class Controller
{
    // Método utilitário para limpar e converter texto para maiúsculas
    protected function cleanToUpperCase($args)
    {
        return "<h1>Valor de: " . strtoupper(trim($args)) . "</h1>";
    }
}
```

Assim, qualquer controller que estenda o controller base poderá usar esse método, facilitando a padronização e manutenção do

## 71. Middlewares de Início e Fim de Requisição

No diretório [`app/Http/Middleware`](app/Http/Middleware), foram criados dois middlewares personalizados para demonstrar como executar ações no início e no fim do ciclo de uma requisição HTTP no Laravel.

### StartMiddleware

O [`StartMiddleware`](app/Http/Middleware/StartMiddleware.php) executa uma ação **antes** do request ser processado pelo controller. No exemplo, ele imprime uma mensagem no topo da resposta:

```php
public function handle(Request $request, Closure $next): Response
{
    $upperValue = strtoupper("start middleware");
    echo ">>>>>>>>>>>>>>> $upperValue <<<<<<<<<<<<<<< <br>";

    return $next($request);
}
```

### EndMiddleware

O [`EndMiddleware`](app/Http/Middleware/EndMiddleware.php) executa uma ação **após** o controller processar a requisição, modificando o conteúdo da resposta antes de enviá-la ao cliente:

```php
public function handle(Request $request, Closure $next): Response
{
    $response = $next($request);

    $response->setContent(
        $response->getContent() . ">>>>>>>>>>>End middleware<<<<<<<<"
    );

    return $response;
}
```

### Como Usar os Middlewares nas Rotas

No arquivo [`routes/web.php`](routes/web.php), os middlewares foram aplicados de diferentes formas:

-   **Aplicando ambos os middlewares em um grupo de rotas:**

    ```php
    Route::controller(MainController::class)->group(function () {
        Route::middleware([StartMiddleware::class, EndMiddleware::class])->group(function () {
            // Rotas aqui...
        });
    });
    ```

-   **Removendo um middleware de uma rota específica com `withoutMiddleware`:**

    ```php
    Route::get('/index', 'index')
        ->name("index")
        ->withoutMiddleware(EndMiddleware::class);
    ```

-   **Rotas que recebem ambos os middlewares:**
    ```php
    Route::get('/about', 'about')->name("about");
    Route::get('/contact', 'contact')->name("contact");
    ```

#### Resumo do fluxo

-   Ao acessar `/about` ou `/contact`, o `StartMiddleware` executa **antes** do controller e o `EndMiddleware` executa **depois**.
-   Ao acessar `/index`, apenas o `StartMiddleware` é executado, pois o `EndMiddleware` foi removido com `withoutMiddleware`.

### Vantagens

-   Permite executar lógicas globais antes ou depois do processamento das rotas (ex: logs, banners, pós-processamento de resposta).
-   Fácil de aplicar em grupos ou rotas individuais, com flexibilidade para incluir ou excluir middlewares conforme necessário.

Esses exemplos mostram como criar middlewares personalizados e aplicá-los de forma granular nas rotas do Laravel.

## Middlewares Personalizados: Execução Antes e Depois das Rotas

Neste projeto, foram criados e configurados middlewares para executar ações **antes** e **depois** do processamento das rotas, utilizando grupos nomeados para facilitar a aplicação seletiva.

### 1. Criação dos Middlewares

-   **StartMiddleware:** Executa uma ação antes do controller (exemplo: imprime mensagem no início da resposta).
-   **EndMiddleware:** Executa uma ação depois do controller (exemplo: adiciona mensagem ao final da resposta).

Os arquivos estão em:  
`app/Http/Middleware/StartMiddleware.php`  
`app/Http/Middleware/EndMiddleware.php`

### 2. Registro dos Middlewares em Grupos

No arquivo [`bootstrap/app.php`](bootstrap/app.php), os middlewares foram agrupados usando nomes personalizados:

```php
$middleware->prependToGroup('ocorre_antes', [
    StartMiddleware::class
]);

$middleware->appendToGroup('ocorre_depois', [
    EndMiddleware::class
]);
```

-   O grupo **`ocorre_antes`** executa o `StartMiddleware` antes das rotas.
-   O grupo **`ocorre_depois`** executa o `EndMiddleware` depois das rotas.

### 3. Aplicação dos Middlewares nas Rotas

No arquivo [`routes/web.php`](routes/web.php), os grupos de middlewares são aplicados diretamente nas rotas:

```php
Route::controller(MainController::class)->group(function () {

    Route::get('/index', 'index')
        ->name("index")
        ->middleware('ocorre_depois');

    Route::get('/about', 'about')
        ->name("about");

    Route::get('/contact', 'contact')
        ->name("contact");
});
```

-   A rota `/index` utiliza o grupo de middleware `'ocorre_depois'`, então o `EndMiddleware` será executado **após** o controller.
-   As rotas `/about` e `/contact` não utilizam nenhum grupo de middleware personalizado, seguindo o fluxo padrão.

### 4. Como funciona na prática

-   **Ao acessar `/index`:**  
    O controller processa a requisição normalmente e, antes de enviar a resposta ao usuário, o `EndMiddleware` modifica o conteúdo da resposta (por exemplo, adicionando uma mensagem ao final).

-   **Ao acessar `/about` ou `/contact`:**  
    Nenhum middleware personalizado é executado, apenas o fluxo padrão do Laravel.

### 5. Vantagens dessa abordagem

-   **Organização:** Permite criar middlewares reutilizáveis e aplicá-los de forma seletiva.
-   **Flexibilidade:** Fácil adicionar/remover middlewares em rotas específicas usando grupos nomeados.
-   **Manutenção:** Centraliza a configuração dos middlewares em `bootstrap/app.php`, facilitando ajustes futuros.

---

**Resumo:**  
Você criou middlewares para executar ações antes e depois das rotas, agrupou-os com nomes personalizados e aplicou esses grupos nas rotas conforme a necessidade, tornando o fluxo da aplicação mais flexível
