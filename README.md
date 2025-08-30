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

## Resumo das Configurações e Testes de Banco de Dados

Neste projeto, foi implementado um teste de conexão com o banco de dados na rota principal (`/`), utilizando o arquivo `web.php`. O objetivo foi garantir que a aplicação está conectando corretamente ao banco definido no `.env`.

No arquivo `config/database.php`, estão definidas as conexões para diferentes bancos suportados pelo Laravel, incluindo SQLite e MySQL. O valor padrão pode ser alterado pela variável `DB_CONNECTION` no `.env`.

### Exemplo de Teste de Conexão (web.php)

```php
Route::get('/', function () {
	try {
		DB::connection()->getPdo();
		echo "conectado com sucesso!";
	} catch (Exception $e) {
		echo "Erro ao conectar: " . $e->getMessage();
	}
});
```

### Configuração de Conexões (config/database.php)

O arquivo já vem preparado para múltiplos bancos. Exemplo dos blocos principais:

```php
'default' => env('DB_CONNECTION', 'sqlite'),

'connections' => [
	'sqlite' => [
		'driver' => 'sqlite',
		'database' => env('DB_DATABASE', database_path('database.sqlite')),
		// ...
	],
	'mysql' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '127.0.0.1'),
		'database' => env('DB_DATABASE', 'laravel'),
		'username' => env('DB_USERNAME', 'root'),
		'password' => env('DB_PASSWORD', ''),
		// ...
	],
	// ... outros bancos
]
```

### Alternando entre bancos

Basta alterar a variável `DB_CONNECTION` no `.env` para `mysql` ou `sqlite` e ajustar os demais parâmetros conforme o banco escolhido. O Laravel usará a configuração correspondente definida em `config/database.php`.

---

Essas práticas permitem testar e alternar facilmente entre diferentes bancos de dados durante o desenvolvimento.

## Conectando em Duas Bases de Dados Distintas

Além de alternar entre bancos, também é possível conectar em mais de uma base de dados no mesmo projeto. Veja um exemplo prático feito em `web.php`:

```php
use Illuminate\Support\Facades\DB;

Route::get('/test-multiple', function () {
	try {
		// Conexão padrão
		DB::connection()->getPdo();
		echo "Conectado na base padrão com sucesso!<br>";

		// Conexão secundária (exemplo: mysql2)
		DB::connection('mysql2')->getPdo();
		echo "Conectado na base mysql2 com sucesso!";
	} catch (Exception $e) {
		echo "Erro ao conectar: " . $e->getMessage();
	}
});
```

No arquivo `config/database.php`, basta adicionar uma nova conexão, por exemplo:

```php
'connections' => [
	// ...
	'mysql' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '127.0.0.1'),
		'database' => env('DB_DATABASE', 'laravel'),
		'username' => env('DB_USERNAME', 'root'),
		'password' => env('DB_PASSWORD', ''),
		// ...
	],
	'mysql2' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST2', '127.0.0.1'),
		'database' => env('DB_DATABASE2', 'outra_base'),
		'username' => env('DB_USERNAME2', 'root'),
		'password' => env('DB_PASSWORD2', ''),
		// ...
	],
]
```

No `.env`, adicione as variáveis para a segunda base:

```env
DB_HOST2=127.0.0.1
DB_DATABASE2=outra_base
DB_USERNAME2=root
DB_PASSWORD2=
```

Assim, é possível acessar e manipular dados de duas bases distintas no mesmo projeto Laravel.
