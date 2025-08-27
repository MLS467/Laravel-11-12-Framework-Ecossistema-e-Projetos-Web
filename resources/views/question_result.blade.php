<x-layout.main title="Result">

    <x-Question :totalQuestions="$total_questions" :country="$country" :currentQuestion="$current_question" />

    <div class="container">

        <div class="text-center fs-3 mb-3">
            Resposta correta: <span class="text-info">{{ $correct_answer }}</span>
        </div>

        <div class="text-center fs-3 mb-3">
            A sua resposta: <span class="[conditional]">{{ $choice_answer }}</span>
        </div>

    </div>

    <!-- cancel game -->
    <div class="text-center mt-5">
        <a href="{{ route('nextQuestion') }}" class="btn btn-primary mt-3 px-5">AVANÇAR</a>
    </div>

</x-layout.main>