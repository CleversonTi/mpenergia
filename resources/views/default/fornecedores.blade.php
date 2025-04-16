@extends('default.template')

@section('content')
    <section class="page-fornecedores">
        @include('default.includes.header-conteudo')
        <div class="page-fornecedores-main">

            <div class="container big">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="page-texto">
                            {!! $page['texto']??'' !!}
                        </div>

                        @if(!empty($page['fornecedores']))
                            <div class="rows-fornecedores">
                                @foreach($page['fornecedores'] as $fornecedor)
                                    <a class="img-fornecedor" href="{{$fornecedor['url']}}" data-lightbox="galeria-fornecedores">
                                        {!! $helpers->gerarImg($fornecedor,true) !!}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection