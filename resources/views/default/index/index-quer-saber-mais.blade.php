<section class="index-quer-saber-mais">
    <div class="container big">
        <div class="row">
            <div class="col-lg-6 offset-lg-1">

                <div class="box-imgs">

                    <div class="row">
                        <div class="col-6 col-lg-12 order-1 order-lg-0">
                            <div class="img-principal">
                                {!! $helpers->gerarImg($home['quer-saber-mais-1'],true) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 order-0 order-lg-1 mb-3 mb-lg-0">
                            <div class="conteudo-box-in">
                                {!! $helpers->gerarImg($config['image_rodape'],true,'logo-white') !!}
                                <div class="txt-in">
                                    {!! $home['quer-saber-mais-texto'] !!}
                                </div>

                            </div>
                        </div>
                        <div class="col-6 order-2">
                            {!! $helpers->gerarImg($home['quer-saber-mais-2'],true,'img-secundaria') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="texto-form">
                    {!! $home['quer-saber-mais-formulario'] !!}
                </div>
                <form name="{{$form_name ?? 'index_quer_saber_mais'}}" ng-controller="EmailController" ng-submit="submitForm($event,'',{{$form_name ?? 'index_quer_saber_mais'}}.$error)">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-input">
                                <label for="">Nome Completo*</label>
                                <input type="text" placeholder="Maria José" ng-model="form.nome" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-input">
                                <label for="">E-mail *</label>
                                <input type="email" placeholder="Seu melhor e-mail" ng-model="form.email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-input">
                                <label for="">Telefone *</label>
                                <input type="text" placeholder="(99) 99999-9999" ng-model="form.telefone" class="celular" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="box-input">
                                <label for="">Nome da sua Empresa</label>
                                <input type="text" placeholder="Sua empresa" ng-model="form.empresa" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-input">
                                <label for="">Linha de Produto</label>
                                <select ng-model="form.produto">
                                    <option value="" selected>Selecione...</option>
                                    @foreach($categorias as $key => $categoria)
                                        <option value="{{$categoria['titulo']}}">{{$categoria['titulo']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-input">
                                <label for="">Mensagem *</label>
                                <input type="text" placeholder="Opcional" ng-model="form.mensagem">
                            </div>
                        </div>
                        <div class="col-12">

                            <button class="main-cta d-flex mt-lg-0 mt-4 mx-auto justify-content-center gap-3">
                                ENVIAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>