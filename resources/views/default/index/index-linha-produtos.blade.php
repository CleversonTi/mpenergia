@php
    use App\Http\Controllers\SiteController;
@endphp

@if(!empty($categorias))
    <section class="index-linha-produtos">
        <div class="container big">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="back-blue">
                        {!! $helpers->gerarImg('default/image/mais18anos.png',true,'mais18') !!}
                        <div class="linha-produtos-title">
                            Linha de Produtos
                        </div>
                    </div>
                    <div class="box-categorias">
                        @foreach($categorias as $categoria)
                            <a href="{{$categoria['url']}}" class="box-categoria-produto"
                                    style="<?= !empty($categoria['cor-fundo']) ? ('background-color:'.$categoria['cor-fundo'].';') : '' ?>">
                            <span class="icon">
                                {!! $helpers->gerarImg($categoria['icone-verde'],true) !!}
                            </span>
                                <span class="title-in"
                                        style="
<?= !empty($categoria['cor-fonte']) ? ('color:'.$categoria['cor-fonte'].';') : '' ?>
">
                                    {{$categoria['titulo']}}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif