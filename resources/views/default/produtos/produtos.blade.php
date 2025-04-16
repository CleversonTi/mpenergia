@extends('default.template')

@section('content')
    <section class="page-produtos">
        @include('default.includes.header-conteudo')
        <div class="list-produtos">
            <div class="container big">
                <div class="col-lg-10 offset-lg-1">

                    <div class="row">
                        <div class="col-lg-3 order-2 order-lg-1">
                            @include('default.produtos.produtos-left-bar')
                        </div>
                        <div class="col-lg-9 order-1 order-lg-2">
                            <div class="row g-3">
                                @if(!empty($titulo))
                                    <div class="col-12">
                                        <h2 class="titulo-principal">{{$titulo??''}}</h2>
                                    </div>
                                @endif
                                @if(empty($produtos['data']))
                                    <div class="alert alert-light">
                                        <h4><strong>Ops...</strong></h4>
                                        Não conseguimos encontrar resultados para sua busca, <a class="text-secondary text-decoration-underline" href="{{route('produtos')}}">clique aqui</a> e continue navegando.
                                    </div>
                                @endif
                                @foreach($produtos['data'] as $key => $p)
                                    <div class="col-lg-4 mb-3 col-12">
                                        @include('default.includes.components.card-produto',['produto'=>$p])
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    @include('default.includes.paginacao', ['categoria'=>$caturl??'','busca' => $busca ?? '', 'data' => $produtos])
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection