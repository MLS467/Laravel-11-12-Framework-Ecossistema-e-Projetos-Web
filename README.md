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

## O que foi feito em routes/web.php

No arquivo `routes/web.php` foram implementados exemplos práticos de conexão com múltiplos bancos de dados e configuração dinâmica de conexões.

### Conexão com múltiplos bancos

```php
Route::get('/', function () {
	try {
		DB::connection()->getPdo(); // conexão padrão
		DB::connection('batata')->getPdo(); // conexão adicional

		echo "conectado com sucesso!" .  DB::connection()->getDatabaseName();
		echo "</br>conectado com sucesso!" .  DB::connection('batata')->getDatabaseName();
	} catch (Exception $e) {
		echo "Erro ao conectar: " . $e->getMessage();
	}
});
```

### Conexão dinâmica

Também foi feito um exemplo de criação dinâmica de conexão, sem precisar editar o arquivo `config/database.php` manualmente:

```php
use Illuminate\Support\Facades\Config;

Route::get('/dinamica', function () {
	try {
		Config::set(
			'database.connections.batata',
			[
				'driver' => 'mysql',
				'host' => 'localhost',
				'port' => 3306,
				'database' => 'curso_laravel_2',
				'username' => env('DB_USERNAME', 'root'),
				'password' => env('DB_PASSWORD', ''),
				// ... demais configs ...
			]
		);
		echo "conectado: " . DB::connection('batata')->getDatabaseName();
	} catch (Exception $e) {
		echo "Erro ao conectar: " . $e->getMessage();
	}
});
```

Esses exemplos mostram como trabalhar com múltiplas conexões e como criar conexões de banco de dados em tempo de execução no Laravel.

## Migrations

O projeto utiliza migrations para versionar e criar as tabelas do banco de dados de forma automatizada.

### Exemplo de migration criada

Arquivo: `database/migrations/2025_08_31_160617_create_users_table.php`

```php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Schema::create('users', function (Blueprint $table) {
	$table->id();
	$table->string('username', 100)->nullable();
	$table->string('password', 300)->nullable();
	$table->boolean('active')->default(true);
	$table->timestamps(); // cria as colunas updated_at e created_at
	$table->softDeletes(); // cria a coluna deleted_at
});
```

Essa migration cria a tabela `users` com os campos principais, além de timestamps e soft deletes para controle de exclusão lógica.

Para rodar as migrations, utilize:

```shell
php artisan migrate
```

Assim, o banco de dados é criado ou atualizado conforme a estrutura

## Migrations: O que foi feito e exemplos práticos

O projeto utiliza migrations para criar e modificar tabelas do banco de dados de forma controlada e versionada.

### Como criar migrations

Para criar uma migration, utilize o comando:

```shell
php artisan make:migration nome_da_migration
```

#### Exemplo real criado no projeto:

```shell
php artisan make:migration add_picture_to_products_table
```

Isso gera um arquivo em `database/migrations` para adicionar a coluna `picture` na tabela `products`.

### Exemplo de migration para adicionar coluna

Arquivo: `2025_08_31_174648_add_picture_to_products_table.php`

```php
Schema::table('products', function (Blueprint $table) {
	$table->string('picture', 200)
		->nullable()
		->after('description');
});
```

### Exemplo de migration para alterar coluna (change)

Arquivo: `2025_08_31_175757_change_description_to_products_table.php`

```php
Schema::table('products', function (Blueprint $table) {
	$table->string('description', 200)
		->nullable()
		->change();
});
```

O método `change()` permite alterar o tipo, tamanho ou outras propriedades de uma coluna existente.

### Como simular (preview) as alterações sem executar

Use o parâmetro `--pretend` para ver o SQL que será executado:

```shell
php artisan migrate --pretend
```

Assim, você pode revisar as queries antes de aplicar as mudanças no banco.

### Como rodar as migrations

```shell
php artisan migrate
```

### Como desfazer uma migration

```shell
php artisan migrate:rollback
```

Esses exemplos mostram como criar, modificar e simular migrations no Laravel, usando comandos e arquivos reais do projeto.
definida nas migrations.

## Seeders (database/seeders)

No diretório `database/seeders` foram criados seeders para popular a tabela `users`. O seeder `usersTableSeeders.php` contém três formas práticas de inserir dados diretamente na tabela (comentadas e com um exemplo ativo):

1. Inserir um usuário diretamente (single insert)

```php
DB::table('users')->insert([
	'username' => 'batata',
	'password' => bcrypt('password'),
	'active' => true,
	'created_at' => Carbon::now()
]);
```

2. Inserir vários usuários com um array (batch insert)

```php
$users = [
	[
		'username' => 'batata 2',
		'password' => bcrypt('password'),
		'active' => true,
		'created_at' => Carbon::now(),
	],
	// ... outros usuários
];

DB::table('users')->insert($users);
```

3. Gerar e inserir usuários randômicos em loop (exemplo usado no projeto)

```php
$qtd = 10;
$users = [];
for ($i = 0; $i < $qtd; $i++) {
	$users[] = [
		'username' => Str::random(10),
		'password' => bcrypt('password'),
		'active' => (bool) rand(0, 1),
		'created_at' => Carbon::now(),
	];
}

DB::table('users')->insert($users);
```

### Como executar seeders (três maneiras diretas)

-   Executar um seeder específico pela classe:

```shell
php artisan db:seed --class=Database\\Seeders\\usersTableSeeders
```

-   Executar todos os seeders configurados (chama `DatabaseSeeder`):

```shell
php artisan db:seed
```

-   Executar migrations e seeders juntos (útil em criação de ambiente):

```shell
php artisan migrate --seed
```

Opcionalmente, você pode chamar seeders a partir do `DatabaseSeeder` usando `$this->call(usersTableSeeders::class);` e então executar `php artisan db:seed`.

Esses exemplos refletem o conteúdo real do arquivo `database/seeders/usersTableSeeders.php` e mostram as formas práticas de popular a base durante o desenvolvimento e testes.

## Agrupando e executando todas as seeders a partir de uma única seeder

No diretório `database/seeders` há vários seeders: `usersTableSeeders`, `usersTableSeeders2`, `usersTableSeeders3` e uma seeder de coleção `usersCollectionTableSeeders3` que chama todas as outras.

### Seeder de coleção (exemplo real)

Arquivo: `database/seeders/usersCollectionTableSeeders3.php`

```php
class usersCollectionTableSeeders3 extends Seeder
{
	public function run(): void
	{
		$this->call([
			usersTableSeeders::class,
			usersTableSeeders2::class,
			usersTableSeeders3::class,
		]);
	}
}
```

### Como executar todas as seeders de uma vez

-   Executar a seeder de coleção diretamente:

```shell
php artisan db:seed --class=Database\\Seeders\\usersCollectionTableSeeders3
```

-   Ou registrar a chamada no `DatabaseSeeder` e executar `php artisan db:seed`:

```php
// DatabaseSeeder.php
public function run(): void
{
	$this->call(usersCollectionTableSeeders3::class);
}
```

Em seguida:

```shell
php artisan db:seed
```

Essas abordagens facilitam popular o banco com conjuntos de seeders organizados e reutilizáveis.

## Comandos usados (migrations e seeders)

Aqui estão os comandos que você utilizou e o que cada um faz.

-   Resetar todas as migrations (executa o método down de cada migration):

```shell
php artisan migrate:reset
```

-   Refresh (desfaz todas as migrations e executa novamente). Opções úteis:
    -   `--seed` executa os seeders após a migração.
    -   `--seeder=` permite especificar uma seeder concreta.

Exemplo que você usou (correção do nome do flag `--seeder`):

```shell
php artisan migrate:refresh --seed --seeder=Database\\Seeders\\usersCollectionTableSeeders3
```

Esse comando desfaz e reaplica todas as migrations e, em seguida, executa apenas a seeder `usersCollectionTableSeeders3`.

-   Observação rápida sobre diferenças:
    -   `migrate:reset` apenas desfaz todas as migrations.
    -   `migrate:refresh` desfaz e reaplica todas as migrations.
    -   `migrate:fresh` remove todas as tabelas e roda as migrations (útil quando quiser limpar tudo rapidamente).

Use esses comandos com cuidado em ambientes de produção — prefira backups antes de ações destrutivas.
