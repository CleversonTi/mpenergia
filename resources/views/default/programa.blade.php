@extends('default.template')

@section('content')
    <section class="page-programa">
        @include('default.includes.header-conteudo')
        <div class="page-programa-main">

            <div class="container big">
                @if(!empty($page['como-funciona']))
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="box-como-funciona">

                                <h3>Como funciona o programa?</h3>

                                <div class="row row-como-funciona">
                                    @foreach($page['como-funciona'] as $passo)
                                        <div class="col-lg-4 col-como-funciona">
                                            <div class="box-como-funciona-in">
                                                <div class="icon">
                                                    <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="36" cy="36" r="35.5" stroke="#599AA8"/>
                                                        <path d="M32.1411 47L22 37.0457L24.5353 34.5572L32.1411 42.0229L48.4647 26L51 28.4886L32.1411 47Z" fill="#599AA8"/>
                                                    </svg>
                                                </div>
                                                <div class="titulo-in">
                                                    {{$passo['titulo'] ?? ''}}
                                                </div>
                                                <div class="valor-in">
                                                    {{$passo['valor'] ?? ''}}
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-5 offset-lg-1">
                        <div class="box-green">
                            <div class="box-green-conteudo">
                                {!! $page['conteudo-formulario'] !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <form name="programa" ng-controller="EmailController" ng-submit="submitForm($event,'',programa.$error)">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="box-input">
                                        <label for="">Nome:*</label>
                                        <input type="text" placeholder="Maria José" ng-model="form.nome" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="box-input">
                                        <label for="">E-mail:*</label>
                                        <input type="email" placeholder="Seu melhor e-mail" ng-model="form.email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="box-input">
                                        <label for="">Telefone:*</label>
                                        <input type="text" placeholder="(99) 99999-9999" ng-model="form.telefone" class="celular" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="box-input">
                                        <label for="">Mensagem:</label>
                                        <textarea ng-model="form.mensagem" placeholder="Como podemos te ajudar?"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="main-cta">
                                        ENVIAR
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


            </div>

        </div>
        @include('default.index.index-destaque-produtos',[
     'class_destaque'=>'bg-destaque-estetica',
     'titulo_categoria'=>$produtos_relacionados['titulo'],
     'link_categoria'=>route('produtos'),
     'produtos_destaques'=>$produtos_relacionados,
     'categoria' => $produtos_relacionados['categoria'] ?? null,
 ])
        <div class="cadastre">
            <div class="txt-cadastre">
                {!! $page['cadastre'] ?? '' !!}
            </div>
            @include('default.includes.components.cta-whatsapp')
        </div>


    </section>

@endsection
