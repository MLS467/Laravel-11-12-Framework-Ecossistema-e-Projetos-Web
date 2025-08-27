<x-layout.main title="Game">

    <div class="container">

        <x-Question :totalQuestions="$total_questions" :country="$country" :currentQuestion="$current_question" />


        <div class="row">
            @foreach ($answers as $answer)
            <x-answer :answer="$answer" />
            @endforeach
        </div>


    </div>

    <!-- cancel game -->
    <div class="text-center mt-5">
        <a href="{{ route('startGame') }}" class="btn btn-outline-danger mt-3 px-5">CANCELAR JOGO</a>
    </div>
</x-layout.main>