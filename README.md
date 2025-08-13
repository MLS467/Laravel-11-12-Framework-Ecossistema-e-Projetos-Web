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

1. **✅ Geração de Exercícios**: ~~Implementar lógica para criar exercícios matemáticos~~ - **CONCLUÍDO**
2. **Impressão**: Sistema para imprimir exercícios
3. **Exportação**: Funcionalidade para exportar para PDF ou outros formatos
4. **Banco de Dados**: Persistir exercícios e resultados
5. **Sistema de Usuários**: Autenticação e perfis de usuário

## Implementações Detalhadas (Para Estudos Futuros)

### 7. Sistema Completo de Geração de Exercícios

#### **Arquivo: MainController.php - Método generate_exercises()**

**O que foi implementado:**
- Validação avançada com regras personalizadas
- Lógica de identificação das operações selecionadas
- Algoritmo de geração aleatória de exercícios
- Sistema de cálculo automático das soluções
- Redirecionamento para página de resultados

**Código implementado (para referência):**
```php
// 1. Identificação das operações selecionadas
$operation = [];
if ($request->has('check_sum')) $operation[] = 'sum';
if ($request->has('check_subtraction')) $operation[] = 'subtraction';
if ($request->has('check_multiplication')) $operation[] = 'multiplication';
if ($request->has('check_division')) $operation[] = 'division';

// 2. Captura dos valores min/max
$min_value = $request->number_one;
$max_value = $request->number_two;
$number_of_exercises = $request->number_exercises;

// 3. Loop de geração dos exercícios
$data = [];
for ($index = 1; $index <= $number_of_exercises; $index++) {
    $data[] = $this->get_operation(
        $operation[array_rand($operation)], // Operação aleatória
        $operation,
        rand($min_value, $max_value), // Primeiro número
        rand($min_value, $max_value)  // Segundo número
    );
}

return view('operations', compact('data'));
```

#### **Arquivo: MainController.php - Método get_operation()**

**Lógica das 4 operações matemáticas:**
```php
private function get_operation(
    string $operation,
    array $data,
    string $min_value,
    string $max_value
): array {
    $exercises = '';
    $solution = '';

    switch ($operation) {
        case 'sum':
            $exercises = "$min_value + $max_value =";
            $solution = $min_value + $max_value;
            break;

        case 'subtraction':
            $exercises = "$min_value - $max_value =";
            $solution = $min_value - $max_value;
            break;

        case 'multiplication':
            $exercises = "$min_value x $max_value =";
            $solution = $min_value * $max_value;
            break;

        case 'division':
            $exercises = "$min_value : $max_value = ";
            // Tratamento para evitar divisão por zero
            $solution = $min_value / ($max_value != '0' || 0 ? $max_value : 1);
            break;
    }

    return [
        'operation' => $operation,
        'exercises' => $exercises,
        'solution' => "$exercises " . round($solution, 3)
    ];
}
```

### 8. Página de Resultados (operations.blade.php)

**Arquivo criado:** `resources/views/operations.blade.php`

**Funcionalidades implementadas:**
- Exibição em grid responsivo (4 colunas)
- Numeração sequencial dos exercícios
- Formatação com badges do Bootstrap
- Botões de ação (Voltar, Imprimir, Descarregar)
- Layout consistente com o resto da aplicação

**Estrutura do layout:**
```blade
@extends('layout.main')

@section('content')
<!-- Logo -->
<div class="text-center my-3">
    <img src="{{ asset('assets/images/logo.jpg') }}" alt="logo" class="img-fluid" width="250px">
</div>

<!-- Grid de exercícios -->
<div class="container">
    <div class="row">
        @foreach ($data as $operation)
        <div class="col-3 display-6 mb-3">
            <span class="badge bg-dark">{{ $loop->index + 1 }}</span>
            <span>{{ $operation['exercises'] }}</span>
        </div>
        @endforeach
    </div>
</div>

<!-- Botões de ação -->
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="{{ route('home') }}" class="btn btn-primary px-5">VOLTAR</a>
        </div>
        <div class="col text-end">
            <a href="#" class="btn btn-secondary px-5">DESCARREGAR EXERCÍCIOS</a>
            <a href="#" class="btn btn-secondary px-5">IMPRIMIR EXERCÍCIOS</a>
        </div>
    </div>
</div>
@endsection
```

### 9. Melhorias nas Validações

**Validações aprimoradas implementadas:**
```php
$request->validate([
    // Operações - pelo menos uma deve ser selecionada
    'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
    'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
    'check_multiplication' => 'required_without_all:check_subtraction,check_sum,check_division',
    'check_division' => 'required_without_all:check_subtraction,check_multiplication,check_sum',
    
    // Valores numéricos com validação de tipo e comparação
    'number_one' => 'integer|required|min:0|max:999|lt:number_two',
    'number_two' => 'integer|required|min:0|max:999',
    'number_exercises' => 'integer|required|min:5|max:50'
]);
```

**Principais melhorias:**
- `integer`: Garante que os valores sejam números inteiros
- `lt:number_two`: Valida que o valor mínimo seja menor que o máximo
- Mensagens de erro personalizadas em português

### 10. Sistema de Rotas Reorganizado

**Arquivo: routes/web.php**

**Estrutura implementada:**
```php
Route::controller(MainController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::post('/generate_exercises', 'generate_exercises')->name('gen_exe');
    Route::get('/print_exercises', 'print_exercises')->name('print');
    Route::get('/export_exercises', 'export_exercises')->name('export');
});
```

**Vantagens desta estrutura:**
- Rotas agrupadas por controller
- Nomes de rotas consistentes
- Fácil manutenção e organização
- Seguindo boas práticas do Laravel

## Conceitos Laravel Aplicados (Para Estudos)

### **1. Validação de Formulários**
- `required_without_all`: Campo obrigatório quando outros estão vazios
- `integer`: Validação de tipo de dados
- `min/max`: Validação de valores mínimos e máximos
- `lt`: Validação de comparação entre campos
- Mensagens de erro personalizadas

### **2. Manipulação de Arrays**
- `array_rand()`: Seleção aleatória de elementos
- `$request->has()`: Verificar se campo existe na requisição
- Loop `for` com geração de dados dinâmicos

### **3. Blade Templates**
- `@extends` e `@section`: Herança de layouts
- `@foreach`: Iteração em views
- `{{ $loop->index }}`: Variável especial de loop
- `{{ asset() }}`: Helper para assets públicos
- `{{ route() }}`: Helper para geração de URLs

### **4. Controllers e Métodos**
- Métodos públicos para rotas
- Métodos privados para lógica interna
- Tipagem de parâmetros e retornos
- `compact()`: Passagem de dados para views

### **5. Estrutura MVC**
- **Model**: (ainda não implementado)
- **View**: Blade templates organizados
- **Controller**: Lógica de negócio separada

## Fluxo Completo da Aplicação

### **1. Entrada do Usuário (home.blade.php)**
```
Usuário preenche formulário → POST /generate_exercises
```

### **2. Processamento (MainController@generate_exercises)**
```
Validação → Identificação de operações → Geração de exercícios → Retorno de dados
```

### **3. Exibição (operations.blade.php)**
```
Recebe array de dados → Renderiza em grid → Exibe botões de ação
```

## Exemplo de Dados Gerados

**Input do usuário:**
- Operações: Soma, Multiplicação
- Valores: 10 a 50
- Quantidade: 5 exercícios

**Array gerado ($data):**
```php
[
    [
        'operation' => 'sum',
        'exercises' => '23 + 45 =',
        'solution' => '23 + 45 = 68'
    ],
    [
        'operation' => 'multiplication',
        'exercises' => '12 x 8 =',
        'solution' => '12 x 8 = 96'
    ],
    // ... mais 3 exercícios
]
```

**Saída na tela:**
```
[1] 23 + 45 =
[2] 12 x 8 =
[3] 34 + 16 =
[4] 7 x 9 =
[5] 41 + 29 =
```

## Pontos Importantes Aprendidos

### **1. Tratamento de Divisão por Zero**
```php
// Implementação segura para evitar erro de divisão por zero
$solution = $min_value / ($max_value != '0' || 0 ? $max_value : 1);
```

### **2. Validação Condicional**
```php
// Campo obrigatório apenas se os outros estiverem vazios
'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division'
```

### **3. Geração de Números Aleatórios**
```php
// Geração dentro de um intervalo específico
rand($min_value, $max_value)

// Seleção aleatória de array
$operation[array_rand($operation)]
```

### **4. Estrutura de Dados Organizada**
```php
// Retorno padronizado do método get_operation()
return [
    'operation' => $operation,      // Tipo da operação
    'exercises' => $exercises,      // String do exercício
    'solution' => $solution         // Solução calculada
];
```

### **5. Uso do Helper asset()**
```blade
<!-- Caminho correto para assets públicos -->
<img src="{{ asset('assets/images/logo.jpg') }}" alt="logo">
```

## Dicas para Estudos Futuros

### **Para Melhorar o Código:**
1. **Implementar Repository Pattern** para organização
2. **Criar Service Classes** para lógica de negócio
3. **Adicionar testes unitários** para validar funções
4. **Implementar cache** para melhor performance
5. **Criar middlewares** para validações customizadas

### **Para Expandir Funcionalidades:**
1. **Sistema de níveis de dificuldade**
2. **Histórico de exercícios gerados**
3. **Exportação para PDF com bibliotecas como DomPDF**
4. **Sistema de pontuação e gamificação**
5. **API REST para integração com outros sistemas**

### **Conceitos Laravel para Estudar Mais:**
- **Eloquent ORM** para banco de dados
- **Factories e Seeders** para dados de teste
- **Jobs e Queues** para processamento assíncrono
- **Events e Listeners** para desacoplamento
- **Form Requests** para validações complexas

## Como Executar o Projeto

### **Pré-requisitos:**
- PHP 8.1+
- Composer
- Laravel 11

### **Instalação:**
```bash
# 1. Clone o repositório
git clone [url-do-repositorio]

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Execute o servidor
php artisan serve

# 5. Acesse no navegador
http://localhost:8000
```

### **Teste da Aplicação:**
1. Acesse a página inicial
2. Selecione uma ou mais operações
3. Configure os valores (ex: 1 a 100)
4. Defina a quantidade (ex: 10 exercícios)
5. Clique em "Gerar exercícios"
6. Visualize os resultados gerados

## Licença

Este projeto é desenvolvido como parte do curso "Laravel 11 & 12: Framework, Ecossistema e Projetos Web" e está sob licença educacional.

---

**Desenvolvido com ❤️ usando Laravel 11**
