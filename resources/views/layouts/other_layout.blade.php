<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>

<body>
    @section('top_bar')
    <div>TEXTO DO TOP BAR USANDO @SHOW</div>
    @show
    <hr>

    @yield('content')

    <hr>
    @yield('bottom_bar')

</body>

</html>