<h1 class="bg-dark w-25 text-start">{{ $keyName }}</h1>
<h3 class="text-warning">Linguas:</h3>
@foreach ($lansName as $lan)
<ul class="d-flex justify-center">
    <li>{{ $lan }}</li>
</ul>
@endforeach