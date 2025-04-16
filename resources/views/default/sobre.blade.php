@extends('default.template')

@section('content')
    <section class="page-sobre">
        @include('default.includes.header-conteudo')

        <section class="bg-sobre-nos">
            @include('default.sobre.sobre-nos')
            @include('default.sobre.missao-visao-valores')
        </section>

       @include('default.sobre.sobre-galeria-fotos')
        @include('default.index.index-fornecedores')
    </section>

@endsection