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
