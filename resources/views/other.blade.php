@php
$nome_page = 'Other-Page';
$year = date('Y');
@endphp

@extends('layouts.other_layout')


@section('title', $nome_page)


@section('top_bar')
<div>CONTEÚDO DO TOP BAR</div>
@endsection

@section('content')
<div>CONTEÚDO DO CONTENT</div>
@endsection

@section('bottom_bar')
<div>CONTEÚDO DO BOTTOM BAR</div>
@endsection