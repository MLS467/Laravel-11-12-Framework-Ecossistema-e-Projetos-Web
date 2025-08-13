@php
$nome_page = 'Home-Page';
$year = date('Y');
@endphp

@extends('layouts.main_layout')


@section('title', $nome_page)


@section('content')
<h3>Conteúdo da página! {{ $year }}</h3>
@endsection