@extends('default.template')

@section('content')
    <section class="page-blog">
        @include('default.includes.header-conteudo')
        <div class="page-blog-in">
            <div class="container big">
                <div class="row">
                    <div class="col-lg-3 offset-lg-1 order-2 order-lg-1 pt-5 pt-lg-0">
                        @include('default.includes.left-bar',[
        'exibir_search'=>true,
        'exibir_categorias'=>true,
        'exibir_form'=>false,
        'busca' => $busca,
        'categorias' => $categorias_blog,
        'categoria_atual' => $categoria_atual,
        'form_name' => 'blog'
        ])
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2">
                        @if(!empty($busca))
                            <h4 class="alert-txt">Exibindo resultados para a busca: <b>{{$busca}}</b></h4>
                        @endif
                        @if(!empty($blog['data']))
                            @foreach($blog['data'] as $post)
                                <a class="blog-card" href="{{route('blog-interna',['uri'=>$post['uri']])}}">
                                    <span class="blog-card-img">
                                        {!! $helpers->gerarImg($post['imagem'],true,'blog-img') !!}
                                    </span>
                                    <span class="blog-card-text">
                                        <h3>{{$post['titulo']}}</h3>
                                    <span class="resumo">{!! $post['resumo'] !!}</span>
                                    <span class="continue">CONTINUE A LEITURA</span>
                                    </span>

                                </a>
                            @endforeach
                        @else
                            <div class="alert alert-light">
                                <h4><strong>Ops...</strong></h4>
                                Não conseguimos encontrar resultados para sua busca, <a class="text-secondary text-decoration-underline" href="{{route('produtos')}}">clique aqui</a> e continue navegando.
                            </div>
                        @endif

                        @include('default.includes.paginacao',['data'=>$blog ])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection