@extends('default.template')

@section('content')
    <section class="blog-interna">
        @include('default.includes.header-conteudo')
        <div class="blog-interna-main">

            <div class="container big">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="txt-blog-in">
                            <div class="img-principal">
                                {!! $helpers->gerarImg($post['imagem']) !!}
                            </div>
                            <div class="conteudo-in">
                                {!! $post['conteudo'] !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection