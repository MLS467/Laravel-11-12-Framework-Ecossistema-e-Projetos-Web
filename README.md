## Instalação do Laravel Breeze

O Laravel Breeze é um ponto de partida minimalista e simples para implementar todos os recursos de autenticação do Laravel, incluindo login, registro, redefinição de senha, verificação de email e confirmação de senha. Siga os passos abaixo para instalar o Laravel Breeze em seu projeto:

### Passo a Passo

1. **Instalar o pacote Laravel Breeze via Composer**

    ```bash
    composer require laravel/breeze --dev
    ```

2. **Executar o comando de instalação do Breeze**

    ```bash
    php artisan breeze:install
    ```

3. **Instalar as dependências do NPM e compilar os assets**

    ```bash

    npm install
    npm build

    ```

4. **Executar as migrações do banco de dados**
    ```bash
    php artisan migrate
    ```

### Opções de Instalação

O comando `php artisan breeze:install` oferece diferentes opções de stack:

-   **Blade**: Stack padrão com Blade templates
-   **React**: Stack com React e Inertia.js
-   **Vue**: Stack com Vue.js e Inertia.js
-   **API**: Stack apenas para API com autenticação Sanctum

### Exemplo de uso com diferentes stacks:

```bash
# Para React
php artisan breeze:install react

# Para Vue
php artisan breeze:install vue

# Para API apenas
php artisan breeze:install api
```

Após a instalação, você terá acesso a rotas de autenticação funcionais em `/login`, `/register`, `/forgot-password`, e outras.
