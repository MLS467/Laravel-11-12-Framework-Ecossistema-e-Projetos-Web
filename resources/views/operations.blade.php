@extends('layout.main')

@section('content')
<!-- logo -->
<div class="text-center my-3">
    <img src="{{ asset('assets/images/logo.jpg') }}" alt="logo" class="img-fluid" width="250px">
</div>

<!-- operations -->
<div class="container">

    <hr>

    <div class="row">

        <!-- each operation -->
        @foreach ($data as $operation)

        <div class="col-3 display-6 mb-3">
            <span class="badge bg-dark">{{ $loop->index + 1  }}</span>
            <span>{{ $operation['exercises'] }}</span>
            <!-- <span>+</span> -->
            <!-- <span>000</span> -->
        </div>
        @endforeach

    </div>

    <hr>

</div>

<!-- print version -->
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

<!-- footer -->
<footer class="text-center mt-5">
    <p class="text-secondary">MathX &copy; <span class="text-info">{{ date('Y') }}</span></p>
</footer>

@endsection