$languages@php
$nome_page = 'Home-Page';
$year = date('Y');
@endphp

@extends('layouts.main_layout')


@section('title', $nome_page)


@section('content')
@if(count($languege_peoples) != 0)
@foreach ($languege_peoples as $key => $languages)
<x-languages :$key :$languages />
@endforeach
@else
<div class="alert alert-danger">
    <span class="text-light">
        Não há dados!
    </span>
</div>
@endif
@endsection