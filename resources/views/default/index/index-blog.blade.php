@if(!empty($blog))
<section class="index-blog">
    <div class="container big">
        <h2>Nosso blog</h2>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="row">
                    @foreach($blog as $post)
                        <div class="col-lg-4">
                            <a class="blog-card" href="{{route('blog-interna',['uri'=>$post['uri']])}}">
                                {!! $helpers->gerarImg($post['imagem'],true,'blog-img') !!}
                                <h3>{{$post['titulo']}}</h3>
                                <span class="resumo">
                            {!! $post['resumo'] !!}
                        </span>
                                <span class="continue">CONTINUE A LEITURA</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
@endif