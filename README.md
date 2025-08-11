# MathX - Gerador de Exercícios de Matemática

## Sobre o Projeto

MathX é uma aplicação web desenvolvida em Laravel 11 para gerar exercícios de matemática personalizados. O projeto permite criar exercícios das quatro operações básicas (soma, subtração, multiplicação e divisão) com parâmetros configuráveis.

## Funcionalidades Implementadas

### 1. Interface Principal (home.blade.php)

-   Formulário para seleção de operações matemáticas
-   Checkboxes para as 4 operações básicas: soma, subtração, multiplicação e divisão
-   Campos para definir valores mínimo e máximo das parcelas (0 a 999)
-   Campo para definir quantidade de exercícios (5 a 50)
-   Layout responsivo com Bootstrap
-   Exibição de mensagens de erro de validação

### 2. Controller Principal (MainController.php)

-   **Método home()**: Renderiza a página inicial
-   **Método generate_exercises()**: Processa o formulário e gera exercícios
-   **Método print_exercises()**: Para impressão de exercícios (placeholder)
-   **Método export_exercises()**: Para exportação de exercícios (placeholder)

### 3. Sistema de Validação

Validações implementadas no método `generate_exercises()`:

#### Validação de Operações:

-   `required_without_all`: Pelo menos uma operação deve ser selecionada
-   Aplicado aos campos: check_sum, check_subtraction, check_multiplication, check_division

#### Validação de Parcelas:

-   `number_one`: obrigatório, mínimo 0, máximo 999
-   `number_two`: obrigatório, mínimo 0, máximo 999

#### Validação de Quantidade:

-   `number_exercises`: obrigatório, mínimo 5, máximo 50

### 4. Mensagens de Erro Personalizadas

Mensagens em português para melhor experiência do usuário:

-   "Selecione pelo menos uma operação."
-   "O campo número X é obrigatório."
-   "O número X deve ser no mínimo/máximo Y."
-   "A quantidade mínima/máxima de exercícios é X."

### 5. Rotas Configuradas

```php
Route::get('/', [MainController::class, 'home'])->name('home');
Route::post('/generate-exercises', [MainController::class, 'generate_exercises'])->name('gen_exe');
Route::get('/print-exercises', [MainController::class, 'print_exercises'])->name('print_exe');
Route::get('/export-exercises', [MainController::class, 'export_exercises'])->name('export_exe');
```

### 6. Layout e Estrutura

-   Layout principal em `resources/views/layout/main.blade.php`
-   View home em `resources/views/home.blade.php`
-   Integração com Bootstrap para estilização
-   Logo e footer personalizados
-   Estrutura responsiva

## Tecnologias Utilizadas

-   **Framework**: Laravel 11
-   **Frontend**: Blade Templates, Bootstrap
-   **Backend**: PHP 8.x
-   **Validação**: Laravel Validation
-   **Estrutura**: MVC Pattern

## Estrutura de Arquivos Principais

```
app/Http/Controllers/main/
├── MainController.php          # Controller principal com validações

resources/views/
├── layout/
│   └── main.blade.php         # Layout base
├── home.blade.php             # Página inicial com formulário

routes/
└── web.php                    # Definição das rotas

public/assets/
├── css/                       # Estilos customizados
├── images/                    # Imagens e logo
└── bootstrap/                 # Framework Bootstrap
```

## Próximos Passos (Funcionalidades Planejadas)

1. **Geração de Exercícios**: Implementar lógica para criar exercícios matemáticos
2. **Impressão**: Sistema para imprimir exercícios
3. **Exportação**: Funcionalidade para exportar para PDF ou outros formatos
4. **Banco de Dados**: Persistir exercícios e resultados
5. **Sistema de Usuários**: Autenticação e perfis de usuário
