@extends('default.template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="row">
                    <div class="col-lg-6"><b>Campo texto:</b></div>
                    <div class="col-lg-6">{{$page['campo-texto']}}</div>

                    <div class="col-lg-6"><b>Campo Área de texto:</b></div>
                    <div class="col-lg-6">{{$page['campo-area-de-texto']}}</div>

                    <div class="col-lg-6"><b>Campo Editor:</b></div>
                    <div class="col-lg-6">{!! $page['campo-editor'] !!}</div>

                </div>

                <div class="owl-carousel owl-galeria-pagina-teste">
                    @foreach($page['galeria'] as $imagem)
                        <div class="box">
                            <a href="{{$imagem['url']}}" data-lightbox="galeria-teste">
                                {!! $helpers->gerarImg($imagem) !!}
                            </a>
                        </div>
                    @endforeach
                </div>


                <div class="items">
                    @foreach($listagem['data'] as $item)
                        <div class="listagem">
                            {{$item['titulo']}}
                        </div>
                    @endforeach
                </div>
                <div class="paginacao">


                    @include('default.includes.paginacao', ['data' => $listagem])


                </div>


            </div>
        </div>

    </div>
@endsection
