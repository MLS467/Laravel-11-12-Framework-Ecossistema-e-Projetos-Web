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

## ⚠️ Problemas Conhecidos do Laravel Breeze

### Problemas de Segurança

1. **Configuração de Segurança Básica**

    - O Breeze vem com configurações de segurança mínimas que podem não ser adequadas para ambientes de produção
    - É necessário implementar medidas adicionais como rate limiting personalizado
    - Falta de proteção contra ataques de força bruta mais sofisticados

2. **Validação de Senhas**

    - As regras de validação de senha padrão podem ser insuficientes
    - Recomenda-se implementar políticas de senha mais rigorosas
    - Ausência de verificação de senhas comprometidas

3. **Sessões e Tokens**
    - Configuração padrão de expiração de sessão pode ser inadequada
    - Necessário revisar configurações de CSRF em ambientes complexos
    - Tokens de redefinição de senha com tempo de vida padrão

### Problemas de Aspecto Visual

1. **Design Limitado**

    - Interface visual muito básica e genérica
    - Estilos CSS mínimos que podem não atender necessidades específicas
    - Responsividade básica que pode precisar de ajustes

2. **Personalização Complexa**

    - Modificar o visual padrão requer conhecimento profundo dos componentes
    - Estrutura de views pode ser confusa para customizações avançadas
    - Dependência do Tailwind CSS pode conflitar com outros frameworks

3. **Componentes Blade**
    - Componentes são muito simples e podem precisar de expansão
    - Falta de variações visuais para diferentes contextos
    - Limitações na reutilização de componentes personalizados
