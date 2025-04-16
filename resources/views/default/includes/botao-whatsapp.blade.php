@if(!empty($config['whatsapp']['link']))
{{--<a href="{{$helpers->linkZap()}}" target="_blank">--}}
 <a href="" ng-click="abrirZapChat('')" target="_blank">
    <section class="botao_whatsapp">
        <i class="fab fa-whatsapp"></i>
    </section>
</a>
@endif
