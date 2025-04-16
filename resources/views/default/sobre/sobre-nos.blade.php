<section class="sobre-nos">
    <div class="container big">
        <div class="row">
            <div class="col-lg-4 offset-lg-1 d-flex align-items-end order-1 order-lg-0">
                <div class="texto-sobre-nos">
                    {!! $page['texto'] !!}
                </div>
            </div>
            <div class="col-lg-6 order-0 order-lg-1">
                <div class="img-sobre-main">
                    {!! $helpers->gerarImg('default/image/mais18anos.png',true,'mais18') !!}
                    {!! $helpers->gerarImg($page['imagem'],true,'sobre-nos-img') !!}
                </div>
            </div>
        </div>
    </div>
</section>