<section class="index-mais-que-produtos">
    <div class="container big">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
            <div class="row">
                <div class="col-lg-6">
                    <div class="img-principal-box">
                        {!! $helpers->gerarImg($home['mais-que-produtos-imagem'],true,'img-principal') !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="conteudo-main-box">
                        <div class="conteudo-principal">
                            {!! $home['mais-que-produtos'] !!}
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                @include('default.includes.components.cotacao',['title'=>'ORÇAMENTO'])
                            </div>
                            <div class="col-lg-4">
                                @include('default.includes.components.cta-whatsapp')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
</section>