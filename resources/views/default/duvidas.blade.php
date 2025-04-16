@extends('default.template')

@section('content')
    <section class="page-duvidas">
        @include('default.includes.header-conteudo')

        <div class="page-duvidas-main">
            <div class="container big">
                <div class="row">
                    <div class="col-lg-6 offset-lg-1">
                        <h2 class="title-main">Todas as dúvidas</h2>
                            <div class="box-duvidas" id="accordionDuvidasMain">
                                @foreach($duvidas as $key => $duvida)
                                    <div class="box-duvidas-item">
                                        <div class="box-pergunta" data-bs-toggle="collapse" data-bs-target="#{{'accordioDuvida'.$key}}" aria-expanded="{{!$key ? 'true' : ''}}" aria-controls="{{'accordioDuvida'.$key}}">
                                            <span>{{$duvida['titulo']}}</span>
                                        </div>
                                        <div id="{{'accordioDuvida'.$key}}" class="box-respota collapse {{!$key ? 'show' : ''}}" data-bs-parent="#accordionDuvidasMain">
                                            {{$duvida['resposta']}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <form name="duvidas" ng-controller="EmailController" ng-submit="submitForm($event,'',duvidas.$error)">
                            <div class="box-form-duvidas">
                                <div class="text-form">
                                    <h3>Ainda tem dúvidas?</h3>
                                    <p>Tem alguma dúvida? Envie para a nossa equipe e ela irá ajudá-lo.</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box-input">
                                            <label for="">Nome*</label>
                                            <input type="text" placeholder="Maria José" ng-model="form.nome" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="box-input">
                                            <label for="">E-mail*</label>
                                            <input type="email" placeholder="Seu melhor e-mail" ng-model="form.email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="box-input">
                                            <label for="">Telefone*</label>
                                            <input type="text" placeholder="(99) 99999-9999" ng-model="form.telefone" class="celular" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="box-input">
                                            <label for="">Telefone*</label>
                                            <input type="text" placeholder="(99) 99999-9999" ng-model="form.telefone" class="celular" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="box-input">
                                            <label for="">Mensagem</label>
                                            <textarea ng-model="form.mensagem"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="main-cta d-flex mt-lg-0 mt-4 mx-auto justify-content-center gap-3">
                                            ENVIAR
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
