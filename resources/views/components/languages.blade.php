<h1 class="bg-dark w-25 text-start">{{ $key }}</h1>
<h3 class="text-warning">Linguas:</h3>
@foreach ($languages as $language)
<ul class="d-flex justify-center">
    <li class="{{ $changeColorName() ? 'text-info':'' }}">
        {{ $language }}
    </li>
</ul>
@endforeach