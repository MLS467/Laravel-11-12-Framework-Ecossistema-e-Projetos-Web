@php
$nome_page = 'Home-Page';
$year = date('Y');
@endphp

@extends('layouts.main_layout')


@section('title', $nome_page)


@section('content')

<!-- RENDERIZANDO UM COMPONENTE -->
<x-my-component />


<!-- RENDERIZANDO UM COMPONENTE DENTRO DE UMA SUBPASTA -->
<x-admin.admin-card />
@endsection