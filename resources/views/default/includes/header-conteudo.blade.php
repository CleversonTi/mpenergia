<section class="header-conteudo {{!empty($small) ? 'small' : ''}}">
    <div class="container">
        @include('default.includes.breadcrumb')
        <div class="box-header-in">
            <div class="description-in">
                {!! $page['descricao']??'' !!}
            </div>
        </div>
    </div>
</section>
