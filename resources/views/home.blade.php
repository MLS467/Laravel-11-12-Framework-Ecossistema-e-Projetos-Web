@php
$nome_page = 'Home-Page';
$year = date('Y');
@endphp

@extends('layouts.main_layout')


@section('title', $nome_page)


@section('content')

<!-- RENDERIZANDO UM COMPONENTE -->
<x-my-component teste="Maisson Leal da Silva" />


<!-- RENDERIZANDO UM COMPONENTE DENTRO DE UMA SUBPASTA -->
<x-admin.admin-card novo="component" :value="$teste2" />
@endsection