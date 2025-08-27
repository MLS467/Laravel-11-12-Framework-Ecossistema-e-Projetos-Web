# Projeto Quiz - Países e Capitais

Um sistema completo de quiz desenvolvido em Laravel 11, onde o usuário responde perguntas sobre capitais dos países.

## Funcionalidades Principais

### 1. Sistema de Quiz Dinâmico

-   Configuração do número de perguntas (3-30)
-   Embaralhamento aleatório de perguntas e respostas
-   Rastreamento de acertos e erros
-   Cálculo de percentual final

### 2. Gerenciamento de Sessão

-   Armazenamento do estado do quiz em sessão
-   Controle de progresso (questão atual/total)
-   Persistência de pontuação

---

## Estrutura do Projeto

### Controller Principal (MainController)

```php
class MainController extends Controller
{
    private array $countryAndCapitals;

    public function __construct()
    {
        // Carrega dados de países e capitais
        $this->countryAndCapitals = require app_path('/Data/data.php');
    }
}
```

#### Função: startGame()

Renderiza a página inicial do quiz.

```php
public function startGame(): View
{
    return view('home');
}
```

#### Função: prepareGame()

Valida entrada do usuário e prepara o quiz.

```php
public function prepareGame(Request $request)
{
    // Validação: mínimo 3, máximo 30 questões
    $request->validate([
        'total_questions' => 'required | min:3 | max:30 | integer'
    ]);

    $total_questions = intval($request->total_questions);
    $quiz = $this->prepareQuiz($total_questions);

    // Armazena dados na sessão
    session()->put([
        'quiz' => $quiz,
        'total_questions' => $total_questions,
        'current_question' => 1,
        'correct_answer' => 0,
        'wrong_answer' => 0,
    ]);
}
```

#### Função: prepareQuiz()

Algoritmo inteligente para gerar quiz aleatório.

```php
private function prepareQuiz(int $total_question)
{
    $questions = [];
    $num_total_question = count($this->countryAndCapitals);

    // Gera array de índices e embaralha
    $range_num_total_question = range(0, $num_total_question - 1);
    shuffle($range_num_total_question);

    // Seleciona quantidade desejada
    $number_questions = array_slice($range_num_total_question, 0, $total_question);

    foreach ($number_questions as $number_question_index) {
        $question['country'] = $this->countryAndCapitals[$number_question_index]['country'];
        $question['correct_answer'] = $this->countryAndCapitals[$number_question_index]['capital'];

        // Gera respostas incorretas
        $other_capitals = array_column($this->countryAndCapitals, 'capital');
        $other_capitals = array_diff($other_capitals, [$question['correct_answer']]);
        shuffle($other_capitals);

        $questions[] = $question;
    }

    return $questions;
}
```

#### Função: game()

Prepara dados para exibir questão atual.

```php
public function game(): View
{
    $quiz = session()->get('quiz');
    $current_question = session()->get('current_question') - 1;

    // Mistura resposta correta com incorretas
    $answers = $quiz[$current_question]['wrong_answers'];
    $answers[] = $quiz[$current_question]['correct_answer'];
    shuffle($answers);

    return view('game')->with(['answers' => $answers]);
}
```

#### Função: answer()

Processa resposta do usuário e atualiza pontuação.

```php
public function answer($dec_answer): View
{
    $answer = Crypt::decryptString($dec_answer);

    $quiz = session('quiz');
    $current_question = session('current_question') - 1;
    $correct_answer_value = $quiz[$current_question]['correct_answer'];

    // Verifica se resposta está correta
    if ($answer == $correct_answer_value) {
        $quiz[$current_question]['correct'] = true;
        // Incrementa contador de acertos
    } else {
        // Incrementa contador de erros
    }

    return view('question_result');
}
```

---

## Componentes Blade

### Componentes Anônimos

Componentes criados apenas com arquivo Blade, sem classe PHP.

```php
<x-alert>
    Olá, Esse é um component anônimo!
</x-alert>
```

Arquivo do componente:

```php
<!-- resources/views/components/alert.blade.php -->
<div class="alert alert-warning">
    {{ $slot }}
</div>
```

### Componentes com Classe

```php
<?php
class Question extends Component
{
    public function __construct(
        public string $current_question = '',
        public string $total_questions = '',
        public string $country = ''
    ) {}
}
```

### Slots e Multi-Slots

**Slot simples:**

```php
<x-other>
    <h1>INSERIDO COM SLOT</h1>
</x-other>
```

**Multi-slot:**

```php
<x-multi_slot>
    <x-slot:title>Título</x-slot:title>
    <x-slot:content>Conteúdo principal</x-slot:content>
    <x-slot:footer>Rodapé</x-slot:footer>
</x-multi_slot>
```

### Layout Components

Estrutura base das páginas:

```php
<x-layout.main title="{{ env('APP_NAME') }}">
    <div class="container mt-3">
        <form action="{{ route('prepareGame') }}" method="post">
            @csrf
            <input type="number" name="total_questions" value="10">
            <button type="submit">INICIAR QUESTIONÁRIO</button>
        </form>
    </div>
</x-layout.main>
```

---

## Recursos Técnicos Utilizados

### Validação de Formulários

```php
$request->validate([
    'total_questions' => 'required | min:3 | max:30 | integer'
]);
```

### Manipulação de Arrays

-   `array_column()` - Extrai coluna específica
-   `array_diff()` - Remove elementos
-   `shuffle()` - Embaralha elementos
-   `array_slice()` - Seleciona porção do array

### Sessões Laravel

-   `session()->put()` - Armazena dados
-   `session()->get()` - Recupera dados
-   Persistência entre requisições

### Criptografia

```php
$answer = Crypt::decryptString($dec_answer);
```

### Roteamento

```php
Route::get('/', [MainController::class, 'startGame'])->name('home');
Route::post('/prepare', [MainController::class, 'prepareGame'])->name('prepareGame');
Route::get('/game', [MainController::class, 'game'])->name('game');
```

---

## Algoritmos Implementados

### Geração de Quiz Aleatório

1. Conta total de países disponíveis
2. Gera array sequencial de índices
3. Embaralha os índices
4. Seleciona quantidade desejada
5. Para cada questão, gera respostas incorretas

### Sistema de Pontuação

-   Contador de acertos em sessão
-   Contador de erros em sessão
-   Cálculo de percentual: `(acertos * 100) / total_questões`

Este projeto demonstra uso avançado do Laravel com foco em:

-   Arquitetura MVC bem estruturada
-   Manipulação inteligente de dados
-   Interface responsiva com Bootstrap
-   Gerenciamento de estado com sessões
