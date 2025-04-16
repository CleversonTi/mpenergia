<section class="sobre-galeria-fotos">
    <div class="container big">
        <h2>Galeria de Fotos</h2>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="owl-carousel owl-galeria-sobre">
                    @foreach($page['galeria'] as $imagem)
                        <a href="{{$imagem['url'] ?? ''}}" data-lightbox="galeria-sobre-nos" class="galeria-in">
                            {!! $helpers->gerarImg($imagem,true) !!}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>