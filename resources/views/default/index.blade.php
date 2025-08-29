@php
    use App\Http\Controllers\SiteController;
@endphp
@extends('default.template')

@section('content')

        @include('default.index.banner')
        @include('default.index.FeaturedResults');
        @include('default.servicos.servicos-cards');
        @include('default.eventos.eventos-cards');


        @include('default.index.index-linha-produtos')
        @include('default.index.index-destaque-produtos',[
            'class_destaque'=>'bg-destaque-hospitalar',
            'titulo_categoria'=>$produtos_destaques[SiteController::CATEGORIA_HOSPITALAR]['titulo'],
            'link_categoria'=>route('produtos-categorias',['uri'=>$produtos_destaques[SiteController::CATEGORIA_HOSPITALAR]['uri']]),
            'produtos_destaques'=>$produtos_destaques[SiteController::CATEGORIA_HOSPITALAR],
            'categoria' => $produtos_destaques[SiteController::CATEGORIA_HOSPITALAR]['categoria'] ?? null,
        ])
        @include('default.index.index-mais-que-produtos')
        @include('default.index.index-vantagens')
        @include('default.index.index-promo')
        @include('default.index.index-destaque-produtos',[
            'class_destaque'=>'bg-destaque-estetica',
            'titulo_categoria'=>$produtos_destaques[SiteController::CATEGORIA_ESTETICA]['titulo'],
            'link_categoria'=>route('produtos-categorias',['uri'=>$produtos_destaques[SiteController::CATEGORIA_ESTETICA]['uri']]),
            'produtos_destaques'=>$produtos_destaques[SiteController::CATEGORIA_ESTETICA],
            'categoria' => $produtos_destaques[SiteController::CATEGORIA_ESTETICA]['categoria'] ?? null,
        ])
        @include('default.index.index-quer-saber-mais')
        @include('default.index.index-fornecedores')
        <section class="index-bg-middle-site">
            @include('default.index.index-sobre')
            @include('default.index.index-instagram')
            @include('default.index.index-blog')
        </section>

@endsection
