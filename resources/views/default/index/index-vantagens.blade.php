<section class="index-vantagens">
    <div class="container big">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="row-vantagens">
                    @foreach($home['vantagens'] as $vantagem)
                        <div class="box-vantagem">
                            <div class="img-in">{!! $helpers->gerarImg($vantagem,true) !!}</div>
                            <div class="title-in">{!! $vantagem['titulo'] !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>