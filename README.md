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
