@php
$nome_page = 'Home-Page';
$year = date('Y');
@endphp

@extends('layouts.main_layout')


@section('title', $nome_page)


@section('content')
<!-- @if(count($languege_peoples) != 0)
@foreach ($languege_peoples as $key => $languages)
<x-languages :$key :$languages />
@endforeach
@else
<div class="alert alert-danger">
    <span class="text-light">
        Não há dados!
    </span>
</div>
@endif -->

<!-- <x-other>
    <h1 class="text-info">INSERIDO COM SLOT</h1>
</x-other> -->

<!-- <x-other>
    <div class="alert alert-danger">Testando o slot</div>
</x-other> -->

<x-multi_slot>
    <x-slot:title>
        Hello slot
    </x-slot:title>

    <x-slot:content>
        it´s multi slot content
    </x-slot:content>

    <x-slot:footer>
        it´s multi slot footer
    </x-slot:footer>
</x-multi_slot>

@endsection