@php
    use App\Http\Controllers\SiteController;
@endphp
<section class="index-promo">
    @include('default.index.index-destaque-produtos',[
    'titulo_categoria'=>$produtos_destaques[SiteController::CATEGORIA_ODONTOLOGICA]['titulo'],
    'link_categoria'=>route('produtos-categorias',['uri'=>$produtos_destaques[SiteController::CATEGORIA_ODONTOLOGICA]['uri']]),
    'produtos_destaques'=>$produtos_destaques[SiteController::CATEGORIA_ODONTOLOGICA],
    'categoria' => $produtos_destaques[SiteController::CATEGORIA_ODONTOLOGICA]['categoria'] ?? null,
    ])

    <div class="container big">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                {!! $helpers->gerarImg($home['banner-promocao'],true,'banner-promo',true) !!}
            </div>
        </div>
    </div>

</section>