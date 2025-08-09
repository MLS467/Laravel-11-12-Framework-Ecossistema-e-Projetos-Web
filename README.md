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

Assim, ao acessar a rota `/`, o usuário vê a view renderizada com o valor passado
