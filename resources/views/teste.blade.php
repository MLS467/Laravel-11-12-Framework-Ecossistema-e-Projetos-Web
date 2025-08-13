@extends('layout.main')


@section('content')

<div>
    @foreach ($data as $operation)

    <p>{{ $loop->index + 1  }} => {{ $operation['exercises'] }}</p>

    @endforeach
</div>

@endsection