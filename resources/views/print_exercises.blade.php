<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>

    <h1>Exercícios de Matemática MathX</h1>
    <hr>
    @foreach ($exercises as $exercise)
    <h3><span>{{ str_pad($loop->index + 1,2,'0',STR_PAD_LEFT) }}) </span> &nbsp;{{ $exercise['exercises'] }}</h3>
    @endforeach

    <br>
    <h3>Soluções</h3>
    <hr>
    @foreach ($exercises as $exercise)
    <span>{{ str_pad($loop->index + 1,2,'0',STR_PAD_LEFT)}})&nbsp; </span>
    <span>{{ $exercise['sollution'] }}</h2>
        <br>
        @endforeach

</body>

</html>