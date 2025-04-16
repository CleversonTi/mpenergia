@extends('default.template')

@section('content')
<section class="black-friday">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <div class="title">
                    {!! $helpers->gerarImg('default/image/black.png', true, 'black') !!}
                    <span>Estoques Limitados. Não Perca!</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="topo">
                    {!! $page['texto-topo']??'' !!}
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach ($produtos as $produto)
            <div class="col-lg-3 col-6">
                <div class="card-produto-default">
                    {{-- <div class="add-cart" ng-click="adicionarCarrinho('{{$produto['id']}}', $event)">
                    <span class="txt-in">Adicionar</span>
                    @include('default.includes.svg.cart-white')
                </div> --}}
                <div class="card-destaque-in">
                    {{-- <a href="{{route('produto',['uri'=>$produto['uri']])}}"> --}}
                    <div class="thumb-in">
                        {!! $helpers->gerarImg($produto['foto']) !!}
                    </div>
                    {{-- </a> --}}
                    <div class="content">
                        {{-- <a href="{{route('produto',['uri'=>$produto['uri']])}}"> --}}
                        <div class="title">{{Str::limit($produto['titulo'], 50)}}</div>
                        {{-- </a> --}}
                        <div class="botoes-novos">
                            <a class="action-orcamento" ng-click="setAssunto('Black Friday - {!! $produto['titulo'] !!}')" data-bs-toggle="modal" data-bs-target="#orcamento_modal">
                                R$ {{ $produto['preco']??'' }} À VISTA
                            </a>
                            @if(!empty($config['whatsapp']))
                            <a class="action-zap" href="{{$config['whatsapp']['link'].'?text=Olá, vim pela Black Friday do site e gostaria de saber mais sobre o produto '.$produto['titulo']}}" target="_blank">
                                <i class="fab fa-whatsapp"></i> @if(!$mobile)Falar pelo @endif WhatsApp
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="rodape">
        {{ $page['texto-rodape']??'' }}
    </div>
    <div class="box-form">
        <h3>Preencha o formulário e entraremos em contato com você!</h3>
        <form name="black_friday" ng-controller="EmailController" ng-submit="submitForm($event,'',black_friday.$error)">
            <div class="row g-lg-4 g-3">
                <div class="col-lg-6">
                    <label for="">Nome *</label>
                    <input type="text" ng-model="form.nome" required placeholder="Ex.: Maria Alves de Sousa">
                </div>
                <div class="col-lg-6">
                    <label for="">Unidade mais próxima *</label>
                    <select name="" ng-model="form.unidade" required>
                        <option value="">Selecione uma unidade</option>
                        @foreach ($config['unidades'] as $item)
                        <option>{{ $item['cidade']??'' }} - {{ $item['unidade']??'' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Telefone *</label>
                    <input type="text" class="celular" ng-model="form.telefone" required placeholder="(99) 99999-9999">
                </div>
                <div class="col-lg-6">
                    <label for="">Seu melhor e-mail *</label>
                    <input type="email" ng-model="form.email" required placeholder="exemplo@exemplo.com">
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="action-orcamento">
                    @include('default.includes.svg.currency')
                    Orçamento Rápido
                </button>
            </div>
        </form>
    </div>
    </div>
</section>
@endsection
