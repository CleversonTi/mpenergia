<section class="barra-fixa-mobile oculta">
    <div class="container">
        <div class="list-itens">
            <a ng-click="abrirMobile=!abrirMobile">
                <i class="fas fa-bars exibirMobile"></i>
            </a>

            @if(!empty($config['telefone']))
            <a href="{{$config['telefone']['link']}}" target="_blank">
                <i class="fas fa-phone exibirMobile"></i>
            </a>
            @endif

            @if(!empty($config['whatsapp']))
            <a href="{{$helpers->linkZap()}}" ng-click="" target="_blank">
            {{-- <a href="" ng-click="abrirZapChat('')" target="_blank"> --}}
                <i class="fab fa-whatsapp"></i>
            </a>
            @endif

            <a href="">
                <i class="fas fa-map-marker-alt"></i>
            </a>
        </div>
    </div>
</section>