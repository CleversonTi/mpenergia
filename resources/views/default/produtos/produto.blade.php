@extends('default.template')

@section('content')

    <section class="page-produto">
        @include('default.includes.header-conteudo')
        <div class="page-produto-in">
            <div class="container big">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1">
                        <div class="box-produto-imgs">

                            @if(!empty($produto['galeria']))
                                <div class="box-galeria">
                                    @foreach($produto['galeria'] as $imagem)
                                        <a href="{{$imagem['url']}}" data-lightbox="galeria-produto">
                                            {!! $helpers->gerarImg($imagem) !!}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <a class="img-principal {{empty($produto['galeria']) ? 'full' : ''}}" href="{{$produto['imagem']['url']}}" data-lightbox="galeria-produto">
                                {!! $helpers->gerarImg($produto['imagem'] ?? '',true) !!}
                            </a>

                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="titulo-produto">
                            {{$produto['titulo'] ?? ''}}
                        </div>

                        <div class="box-info-produto">
                            @if(!empty($produto['caracteristicas-tecnicas']) || !empty($produto['informacoes-complementares']) || !empty($produto['descricao']))
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @if(!empty($produto['caracteristicas-tecnicas']) || !empty($produto['descricao']))
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="link-caracteristicas" data-bs-toggle="tab" data-bs-target="#tab-caracteristicas" type="button" role="tab" aria-controls="tab-caracteristicas" aria-selected="true">Características Técnicas:</button>
                                        </li>
                                    @endif
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?= (empty($produto['caracteristicas-tecnicas']) && empty($produto['descricao'])) ? 'active' : '' ?>" id="link-info-complementares" data-bs-toggle="tab" data-bs-target="#tab-info-complementares" type="button" role="tab"
                                                aria-controls="tab-info-complementares"
                                                aria-selected="<?= (empty($produto['caracteristicas-tecnicas']) && empty($produto['descricao'])) ? 'true' : 'false' ?>">
                                            Informações complementares:
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tab-info-produto">
                                    @if(!empty($produto['caracteristicas-tecnicas']) || !empty($produto['descricao']))
                                        <div class="tab-pane fade show active" id="tab-caracteristicas" role="tabpanel" aria-labelledby="link-caracteristicas">
                                            @if(!empty($produto['descricao']))
                                                <div class="produto-descricao">
                                                    {!! $produto['descricao'] !!}
                                                </div>
                                            @endif
                                            @if(!empty($produto['caracteristicas-tecnicas']))
                                                <div class="produto-caracteristicas">
                                                    @foreach($produto['caracteristicas-tecnicas'] as $caract)
                                                        <div class="produto-caracteristicas-in">
                                                            <span class="info-in">{{$caract['titulo'].': '.$caract['valor']}}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if(!empty($produto['informacoes-complementares']))
                                        <div class="tab-pane {{empty($produto['caracteristicas-tecnicas']) && empty($produto['descricao']) ? 'show active' : ''}} fade" id="tab-info-complementares" role="tabpanel" aria-labelledby="link-info-complementares">
                                            {!! $produto['informacoes-complementares'] !!}
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if(!empty($produto['variacoes']))
                                <div class="variacoes">
                                    @foreach($produto['variacoes'] as $variacao)
                                        @if(!empty($variacao['opcoes']))
                                            @php
                                                $campoNome = strtolower($helpers->urlAmigavel($variacao['nome-da-variacao'],true));
                                            @endphp
                                            <div class="box-variacao">
                                                <label for="">Selecione a {{$variacao['nome-da-variacao']}}</label>
                                                <select ng-model="form.{{$campoNome}}" ng-init="form.{{$campoNome}}='{{current($variacao['opcoes'])}}'">
                                                    @foreach($variacao['opcoes'] as $key => $opcao)
                                                        <option>{{$opcao}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            @endif

                            <div class="rows-ctas">
                                @include('default.includes.components.cotacao',['title'=>'ORÇAMENTO','assunto'=>$produto['titulo']])
                                @include('default.includes.components.cta-whatsapp',['assunto'=> 'Olá, gostaria de saber mais sobre o produto '.addslashes($produto['titulo'])])
                                <a class="main-cta carrinho" ng-click="adicionarCarrinho('{{$produto['id']}}', $event)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M7.5 17.5C8.32843 17.5 9 16.8284 9 16C9 15.1716 8.32843 14.5 7.5 14.5C6.67157 14.5 6 15.1716 6 16C6 16.8284 6.67157 17.5 7.5 17.5Z" stroke="#10404B"/>
                                        <path d="M14.5 17.5C15.3284 17.5 16 16.8284 16 16C16 15.1716 15.3284 14.5 14.5 14.5C13.6716 14.5 13 15.1716 13 16C13 16.8284 13.6716 17.5 14.5 17.5Z" stroke="#10404B"/>
                                        <path d="M1 1H3L6.504 12H14.5" stroke="#10404B" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.72399 9.5L3.79999 3.5H16.307C16.3863 3.4999 16.4644 3.51865 16.535 3.5547C16.6056 3.59075 16.6666 3.64307 16.713 3.70734C16.7594 3.77162 16.7899 3.846 16.8019 3.92435C16.8138 4.00271 16.807 4.08279 16.782 4.158L15.115 9.158C15.0818 9.25752 15.0182 9.3441 14.9332 9.40548C14.8481 9.46685 14.7459 9.49992 14.641 9.5H5.72399Z" stroke="#10404B" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="txt-in">+ Carrinho</span>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @include('default.index.index-destaque-produtos',[
    'class_destaque'=>'bg-produto-relacionados',
    'titulo_categoria'=>$produtos_relacionados['titulo'],
    'link_categoria'=>route('produtos-categorias',['uri'=>$produtos_relacionados['uri']]),
    'produtos_destaques'=>$produtos_relacionados,
    'categoria' => $produtos_relacionados['categoria'] ?? null,
])
@endsection