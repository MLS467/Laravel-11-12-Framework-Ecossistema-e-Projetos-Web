<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Deu Ruim" }}</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: calc(100vh - 100px);
    }
    </style>
</head>

<body class="bg-secondary">

    @include('layouts.navbar')

    {{ $content ??"deu ruim" }}

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>