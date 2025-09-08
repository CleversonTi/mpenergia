@php
    use App\Http\Controllers\SiteController;
@endphp
@extends('default.template')

@section('content')
    @include('default.index.banner')
    @include('default.index.FeaturedResults')
    @include('default.servicos.servicos-cards')
    @include('default.eventos.eventos-cards')
    @include('default.index.index-sobre-mais')
    @include('default.index.operations')
    @include('default.index.portifolio')
    @include('default.index.index-contato')
    @include('default.index.index-avaliacoes')
    @include('default.includes.redes')
    @include('default.index.index-blog')
    @include('default.index.index-perguntas')
@endsection
