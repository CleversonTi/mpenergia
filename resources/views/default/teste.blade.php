@extends('default.template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                <h2>Obtenção de campos</h2>
                <div class="row">
                    <div class="col-lg-6"><b>Campo texto:</b></div>
                    <div class="col-lg-6">{{$page['campo-texto']}}</div>

                    <div class="col-lg-6"><b>Campo Área de texto:</b></div>
                    <div class="col-lg-6">{{$page['campo-area-de-texto']}}</div>

                    <div class="col-lg-6"><b>Campo Editor:</b></div>
                    <div class="col-lg-6">{!! $page['campo-editor'] !!}</div>

                </div>

                <hr>

                <h2>Galeria</h2>
                <div class="owl-carousel owl-galeria-pagina-teste">
                    @foreach($page['galeria'] as $imagem)
                        <div class="box">
                            <a href="{{$imagem['url']}}" data-lightbox="galeria-teste">
                                {!! $helpers->gerarImg($imagem) !!}
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr>

                <h2>Categorias</h2>


                <ul>
                    @foreach($categorias as $key=> $categoria)
                        <li>
                            <a href="{{route('teste',['categoria'=>$categoria['uri']])}}">
                                {{$categoria['titulo']}}
                            </a>
                            @if(!empty($categoria['subcategorias']))
                                <ul>
                                    @foreach($categoria['subcategorias'] as $keyIn=> $subcategoria)
                                        <li>
                                            <a href="{{route('teste',['categoria'=>$subcategoria['uri']])}}">
                                                {{$subcategoria['titulo']}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>


                <hr>

                <h2>Laço de listagem dos dados (com opção de busca) </h2>
                <form class="form-search mb-3" action="{{ route('teste') }}">
                    <input type="text" name="busca" value="{{$busca ?? ''}}" placeholder="Digite aqui...">
                    <button type="submit">Pesquisar</button>
                </form>

                @if(!empty($itens) && !empty($busca))
                    <h6>{!! 'Exibindo resultados para sua busca "<b>'.$busca.'</b>"... :' !!}</h6>
                @endif

                @if(empty($itens) && !empty($busca))
                    <h6>{!! 'Não foi retornado resultado para sua busca atual:  "<b>'.$busca.'</b>"' !!}</h6>
                @endif

                <div class="items">
                    @foreach($itens as $item)
                        <div class="listagem">
                            {{$item['titulo']}}
                        </div>
                    @endforeach
                </div>

                <hr>
                <h2>Laço de listagem dos dados retornados da paginação</h2>
                <div class="items">
                    @foreach($listagem['data'] as $item)
                        <div class="listagem">
                            {{$item['titulo']}}
                        </div>
                    @endforeach
                </div>
                <hr>

                <h2>Paginação</h2>
                <div class="paginacao">
                    @include('default.includes.paginacao', ['data' => $listagem])
                </div>


                <hr>

                <h2>Disparo de email</h2>



                <form name="nome_formulario" ng-controller="EmailController" ng-submit="submitForm($event,'',nome_formulario.$error)">

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="">Nome*</label>
                            <input type="text" class="form-control" ng-model="form.nome" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="">Email*</label>
                            <input type="text" class="form-control" ng-model="form.email" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="">Telefone*</label>
                            <input type="text" class="form-control celular" ng-model="form.telefone" required>
                        </div>

                        <button class="btn btn-info">Enviar</button>

                    </div>

                </form>

                <hr>

                <h2>Abrindo um modal</h2>


                <a href="" class="main-cta" data-bs-target="#consultoriaModal" data-bs-toggle="modal">
                    Modal Orçamento
                </a>

                <hr>


                <h2>Abrindo modal Youtube</h2>


                @if(!empty($page['video']))
                    <a href="" ng-click="abrirModalYoutube('{{$page['video']['id']}}')" class="video">
                        {!! $helpers->gerarImg($page['video']['thumb'], true, '') !!}
                    </a>
                @endif

                <div class="end mb-5"></div>





            </div>
        </div>

    </div>
@endsection
