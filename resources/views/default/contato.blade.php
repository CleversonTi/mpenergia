@extends('default.template')
@section('content')
    <section class="page-contato">
        @include('default.includes.header-conteudo')
        <div class="page-contato-main">

            <div class="container big">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="box-card-contato">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="box-card-left">
                                        <div class="box-img">
                                            {!! $helpers->gerarImg($page['imagem'],true) !!}
                                        </div>
                                        <div class="box-text-info">
                                            {!! $page['conteudo'] ?? '' !!}
                                        </div>

                                        <div class="box-redes">

                                            @if(!empty($config['redes']['instagram']))
                                                <a href="{{$config['redes']['instagram']}}" class="box-rede-in">
                                                    <div class="icon">
                                                        <i class="fab fa-instagram"></i>
                                                    </div>
                                                    <div class="label-txt">Instagram</div>
                                                </a>
                                            @endif

                                            @if(!empty($config['redes']['facebook']))
                                                <a href="{{$config['redes']['facebook']}}" class="box-rede-in">
                                                    <div class="icon">
                                                        <i class="fab fa-facebook"></i>
                                                    </div>
                                                    <div class="label-txt">Facebook</div>
                                                </a>
                                            @endif

                                            @if(!empty($config['redes']['youtube']))
                                                <a href="{{$config['redes']['youtube']}}" class="box-rede-in">
                                                    <div class="icon">
                                                        <i class="fab fa-youtube"></i>
                                                    </div>
                                                    <div class="label-txt">Youtube</div>
                                                </a>
                                            @endif

                                            <a href="{{route('blog')}}" class="box-rede-in">
                                                    <div class="icon">
                                                        <i class="fas fa-file-alt"></i>
                                                    </div>
                                                    <div class="label-txt">Blog</div>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <form name="contato" ng-controller="EmailController" ng-submit="submitForm($event,'',contato.$error)">
                                                <div class="text-form">
                                                    <h3>{!! $page['formulario'] !!}</h3>
                                                </div>
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
                </div>
            </div>
        </div>
    </section>

@endsection