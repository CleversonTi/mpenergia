@extends('default.template')

@section('content')
    <section class="page-orcamento">
        @include('default.includes.header-conteudo')

        <section class="page-orcamento-main">
            <div class="container big">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="box-ctas-contatos">
                            @include('default.includes.components.phone')
                            @include('default.includes.components.zap')
                            @include('default.includes.components.endereco')
                            <a href="{{$config['telefone']['link']??''}}" target="_blank" class="main-cta">
                                Ligar agora
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="24" viewBox="0 0 32 24" fill="none">
                                    <path d="M26.5274 12H5.87695M26.5274 12L18.7835 6M26.5274 12L18.7835 18" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            @include('default.index.index-quer-saber-mais',['form_name'=>'orcamento'])

        </section>


    </section>

@endsection