# Documentação de Conexão com Banco de Dados

Este projeto demonstra como conectar o Laravel a diferentes bancos de dados utilizando as configurações do arquivo `.env` e um teste de conexão simples em `routes/web.php`.

## Teste de Conexão (web.php)

O arquivo `routes/web.php` possui uma rota para testar a conexão com o banco configurado:

```php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	try {
		DB::connection()->getPdo();
		echo "conectado com sucesso!";
	} catch (Exception $e) {
		echo "Erro ao conectar: " . $e->getMessage();
	}
});
```

## Configuração do Banco de Dados (.env)

O arquivo `.env` permite alternar facilmente entre MySQL e SQLite.

### Exemplo para MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=curso_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Exemplo para SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/database/curso_laravel.sqlite3
```

Para usar SQLite, basta comentar as linhas do MySQL e descomentar as do SQLite no `.env`.

## Observações

-   O teste de conexão exibe "conectado com sucesso!" se a configuração estiver correta.
-   Caso haja erro, a mensagem de exceção será exibida na tela.
-   O caminho do banco SQLite deve ser absoluto ou relativo à raiz do projeto.

---

Esses exemplos mostram como alternar e testar rapidamente diferentes bancos de dados em um projeto Laravel.
