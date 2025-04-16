<section class="carrinho">
    <div class="container">
        <div class="passos d-none d-lg-flex">
            <a class="ativo">
                <strong>01</strong>
                Lista de produtos
            </a>
            <a>
                <strong>02</strong>
                Informe os seus dados
            </a>
            <a>
                <strong>03</strong>
                Pronto, envie o seu orçamento
            </a>
        </div>
        <div class="passos d-flex d-lg-none">
            <a class="ativo">Produtos</a>
            <a>Dados</a>
            <a>Enviado</a>
        </div>
        @if(!empty($carrinho))
            <div class="d-none d-lg-block">
                <table class="tabela-carrinho">
                    <thead>
                    <tr class="d-flex">
                        <td class="col-4">Produto</td>
                        <td class="col-3 text-center">Quantidade</td>
                        <td class="col-3 text-center">Preço</td>
                        <td class="col-2 text-center">Ação</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carrinho as $item)
                        <tr class="d-flex">
                            <td class="col-lg-4">
                                <div class="produto">
                                    @if(!empty($item['imagem']) && !empty($item['imagem']['url']))
                                        {!! $helpers->gerarImg($item['imagem'], true, 'img-thumbnail') !!}
                                    @else
                                        {!! $helpers->gerarImg($config['image_logo']??'', true, 'img-thumbnail') !!}
                                    @endif
                                    <h5>{{$item['titulo']}}</h5>
                                </div>
                            </td>
                            <td class="col-3">
                                <div class="quantidade" id="editor{{$item['id']}}">
                                    <span id="qtdCarrinho{{$item['id']}}">{{$item['quantidade']}}</span>
                                    <div class="opcoes">
                                        <a class="aumentar" ng-click="aumentarQtdCarrinho('{{$item['id']}}')"><i class="fas fa-plus"></i></a>
                                        <a class="diminuir" ng-click="diminuirQtdCarrinho('{{$item['id']}}')"><i class="fas fa-minus"></i></a>
                                    </div>
                                    <div class="qtd-loading">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </div>
                                </div>
                            </td>
                            <td class="col-3">
                                <strong>{{$item['valor'] != 0 ? 'R$ ' . number_format($item['valor'], 2, ',', '.') : 'Sob consulta'}}</strong>
                            </td>
                            <td class="col-2">
                                @if(!empty($landing))
                                    <a class="remover" ng-click="removerCarrinho('{{$item['id']}}', $event, '{{route($route.'-carrinho')}}')">
                                        @else
                                            <a class="remover" ng-click="removerCarrinho('{{$item['id']}}', $event)">
                                                @endif
                                                <i class="fas fa-trash-alt"></i>
                                                <i class="fas fa-spinner fa-spin loader"></i>
                                            </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-block d-lg-none">
                <div class="carrinho-mobile">
                    @foreach($carrinho as $item)
                        <div class="row produto">
                            <div class="col-3 p-0">
                                @if(!empty($item['imagem']) && !empty($item['imagem']['url']))
                                    {!! $helpers->gerarImg($item['imagem']) !!}
                                @else
                                    {!! $helpers->gerarImg($config['image_logo']??'') !!}
                                @endif
                            </div>
                            <div class="col-9">
                                <strong>{{$item['titulo']}}</strong><br>
                                <span class="titulo">Preço:</span>
                                {{$item['valor'] != 0 ? 'R$ ' . number_format($item['valor'], 2, ',', '.') : 'Sob consulta'}}<br>
                                <span class="titulo">Quantidade:</span>
                                <div class="quantidade" id="editorMobile{{$item['id']}}">
                                    <span id="qtdMobileCarrinho{{$item['id']}}">{{$item['quantidade']}}</span>
                                    <div class="opcoes">
                                        <a class="aumentar" ng-click="aumentarQtdCarrinho('{{$item['id']}}')"><i class="fas fa-plus"></i></a>
                                        <a class="diminuir" ng-click="diminuirQtdCarrinho('{{$item['id']}}')"><i class="fas fa-minus"></i></a>
                                    </div>
                                    <div class="qtd-loading">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <div class="col-12">
                                @if(!empty($landing))
                                    <a class="removerMobile" ng-click="removerCarrinho('{{$item['id']}}', $event, '{{route($route.'-carrinho')}}')">
                                        @else
                                            <a class="removerMobile" ng-click="removerCarrinho('{{$item['id']}}', $event)">
                                                @endif
                                                <span>
                                <i class="fas fa-trash-alt"></i> Remover
                            </span>
                                                <i class="fas fa-spinner fa-spin loader"></i>
                                            </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-4 text-center text-lg-start">
                        <a class="main-cta bg-blue" href="{{$returnUrl ?? route('produtos')}}">
                            <i class="fas fa-chevron-left me-2"></i>
                            Continuar comprando
                        </a>
                    </div>
                    <div class="col-12 col-lg-4 text-center text-lg-end">
                        <a href="{{!empty($landing) ? route($route.'-carrinho-dados') : route('carrinho-dados')}}" class="main-cta bg-blue">
                            PRÓXIMO PASSO
                            <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="empty">Seu carrinho está vazio!</div>
            <div class="text-center mt-4">
                <a class="main-cta bg-blue" href="{{$returnUrl ?? route('produtos')}}">
                    <i class="fas fa-chevron-left me-2"></i>
                    Continuar comprando
                </a>
            </div>
        @endif

    </div>
</section>