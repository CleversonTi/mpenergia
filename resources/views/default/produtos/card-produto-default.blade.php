<div class="card-produto-default">
    {{-- <div class="add-cart" ng-click="adicionarCarrinho('{{$produto['id']}}', $event)">
        <span class="txt-in">Adicionar</span>
        @include('default.includes.svg.cart-white')
    </div> --}}
    <div class="card-destaque-in">
        <a href="{{route('produto',['uri'=>$produto['uri']])}}">
            <div class="thumb-in">
                {!! $helpers->gerarImg($produto['thumb']) !!}

            </div>
        </a>
        <div class="content">
            <a href="{{route('produto',['uri'=>$produto['uri']])}}">
                <div class="title">{{Str::limit($produto['titulo'], 50)}}</div>
                {{-- <div class="saiba-mais">SAIBA MAIS</div> --}}
            </a>
            <div class="botoes-novos">
                <a class="action-orcamento" ng-click="setAssunto('{!! $produto['titulo'] !!}')" data-bs-toggle="modal" data-bs-target="#orcamento_modal">
                    Orçamento @if(!$mobile) Rápido @endif
                </a>
                @if(!empty($config['whatsapp']))
                <a class="action-zap" href="{{$config['whatsapp']['link'].'?text=Olá, gostaria de saber mais sobre o produto '.$produto['titulo']}}" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                @endif
                <a href="{{route('produto',['uri'=>$produto['uri']])}}" class="mais-detalhes">@if(!$mobile) + @endif DETALHES</a>
                <a href="" ng-click="adicionarCarrinho('{{$produto['id']}}', $event)" class="carrinho"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
    </div>
</div>
