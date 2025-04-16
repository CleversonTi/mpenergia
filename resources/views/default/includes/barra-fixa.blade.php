<section class="barra-fixa oculta">
    <div class="container big">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-around">
                    @include('default.includes.components.phone')
                    @include('default.includes.components.zap')
                    @include('default.includes.components.cotacao',['title'=>'ORÇAMENTO'])
                    @include('default.includes.components.cta-whatsapp')
                </div>
            </div>
        </div>
    </div>
</section>