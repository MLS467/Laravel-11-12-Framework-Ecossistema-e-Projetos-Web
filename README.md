iniciando com laravel fortify

Observações específicas sobre o Fortify neste projeto:

- `config/fortify.php`: por enquanto deixei apenas a feature de registro habilitada — `Features::registration()` está descomentada. Se você quiser habilitar outras features (reset de senha, verificação de e-mail, atualização de perfil, atualização de senha, two-factor), basta abrir `config/fortify.php` e descomentar as linhas correspondentes às Features desejadas.

- `FortifyServiceProvider`: foi adicionada a view de login personalizada no provider (`app/Providers/FortifyServiceProvider.php`) com:

	```php
	Fortify::loginView(function () {
			return view('auth.login');
	});
	```

	Isso faz com que o Fortify utilize `resources/views/auth/login.blade.php` para a tela de login.

- Migração (two-factor): neste projeto existe uma migração que adiciona colunas para suportar autenticação de dois fatores (`two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`). Observação: o pacote Fortify em si não cria automaticamente todas as migrações — algumas migrações podem ser criadas por scaffolding (Breeze/Jetstream) ou manualmente. Aqui a migração já foi incluída para preparar o suporte a two-factor.

Se quiser, eu deixo o README mais detalhado (com a lista completa de arquivos alterados, passos exatos que foram rodados e exemplos de formulários com exibição de erros). Diga se quer que eu insira isso agora.
