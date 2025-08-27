<a href="{{ route('answer',Crypt::encryptString($answer) ) }}" class="col-6 text-decoration-none text-center">
    <div class="text-center">
        <p class="response-option">{{ $answer }}</p>
    </div>
</a>