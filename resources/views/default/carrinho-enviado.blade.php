@extends('default.template')

@section('content')
    @include('default.includes.header-conteudo',['small'=>true])
    @include('default.carrinho.enviado')
@endsection
