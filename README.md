# Projeto Laravel com Fortify - Autenticação

Este projeto implementa autenticação usando Laravel Fortify durante o curso.

## Configurações do Fortify

### Features Habilitadas

-   `config/fortify.php`: por enquanto deixei apenas a feature de registro habilitada — `Features::registration()` está descomentada. Se você quiser habilitar outras features (reset de senha, verificação de e-mail, atualização de perfil, atualização de senha, two-factor), basta abrir `config/fortify.php` e descomentar as linhas correspondentes às Features desejadas.

### Service Provider

-   `FortifyServiceProvider`: foi adicionada a view de login personalizada no provider (`app/Providers/FortifyServiceProvider.php`) com:

    ```php
    Fortify::loginView(function () {
    	return view('auth.login');
    });
    ```

    Isso faz com que o Fortify utilize `resources/views/auth/login.blade.php` para a tela de login.

### Migração Two-Factor

-   Migração (two-factor): neste projeto existe uma migração que adiciona colunas para suportar autenticação de dois fatores (`two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`). Observação: o pacote Fortify em si não cria automaticamente todas as migrações — algumas migrações podem ser criadas por scaffolding (Breeze/Jetstream) ou manualmente. Aqui a migração já foi incluída para preparar o suporte a two-factor.

## Implementações Adicionais

### Views e Layout

-   **Layout Principal**: Criado componente de layout em `resources/views/components/layout/main.blade.php` com Bootstrap integrado
-   **Página de Login**: Reformulada `resources/views/auth/login.blade.php` com:
    -   Design responsivo usando Bootstrap
    -   Formulário estilizado com classes do Bootstrap
    -   Layout centralizado com card
    -   Link para "Ainda não tem conta?"

### Páginas Criadas

-   **Página Home**: Nova view `resources/views/home.blade.php` com:
    -   Header com nome da aplicação
    -   Exibição de dados do usuário logado (nome e email)
    -   Botão de logout funcional
    -   Design responsivo com Bootstrap

### Controllers

-   **MainController**: Criado `app/Http/Controllers/MainController.php` como invoke controller para:
    -   Gerenciar a página inicial
    -   Obter dados do usuário autenticado
    -   Passar dados para a view home

### Rotas

-   **Rota Principal**: Configurada em `routes/web.php`:
    -   Rota `/` protegida com middleware `auth`
    -   Redirecionamento para MainController
    -   Só acessível para usuários autenticados

### Recursos de UI

-   **Bootstrap**: Integrado via assets locais
    -   CSS: `public/assets/bootstrap/bootstrap.min.css`
    -   JS: `public/assets/bootstrap/bootstrap.bundle.min.js`
-   **Design Responsivo**: Todas as páginas adaptáveis a diferentes tamanhos de tela

## Como Usar

1. Faça login através da página `/login`
2. Após autenticação, será redirecionado para a página inicial (`/`)
3. Na página inicial você pode ver seus dados e fazer logout
4. O sistema protege automaticamente rotas que precisam de autenticação

## Arquivos Modificados/Criados

-   `resources/views/components/layout/main.blade.php` - Layout base
-   `resources/views/auth/login.blade.php` - Página de login estilizada
-   `resources/views/home.blade.php` - Página inicial pós-login
-   `app/Http/Controllers/MainController.php` - Controller da página inicial
-   `routes/web.php` - Rota principal protegida
-   `app/Providers/FortifyServiceProvider.php` - Configuração do Fortify
