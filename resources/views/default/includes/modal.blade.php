<div class="modal fade" id="consultoriaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close closebtn" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">Fechar [X]</span>
            </button>
            <div class="modal-body">
                <div class="container">
                    <h1>Solicite um orçamento</h1>
                    <h3>Preencha o formulário abaixo e entraremos em contato!</h3>
                    <form name="cotacao" ng-controller="EmailController" ng-submit="submitForm($event,'',consultoria.$error)">
                        <div class="row">
                            <div class="col-12">
                                <label>Nome</label>
                                <input type="text" name="nome" ng-model="form.nome" required placeholder="Digite aqui">
                            </div>
                            <div class="col-lg-6">
                                <label>E-mail</label>
                                <input type="email" name="email" ng-model="form.email" required placeholder="Digite aqui">
                            </div>
                            <div class="col-lg-6">
                                <label>Telefone</label>
                                <input type="text" name="telefone" ng-model="form.telefone" required class="celular" placeholder="Digite aqui">
                            </div>
                            <div class="col-12" ng-if="$root.formulario.assunto">
                                <label>Produto</label>
                                <input disabled type="text" name="assunto" ng-model="$root.formulario.assunto" placeholder="Digite aqui">
                            </div>
                            <div class="col-12">
                                <label>Mensagem</label>
                                <textarea name="mensagem" ng-model="form.mensagem" placeholder="Digite aqui"></textarea>
                            </div>
                            <div class="col-12 text-center mt-lg-2">
                                <button class="main-cta">
                                    ENVIAR MENSAGEM
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="close-modal" ng-click="modalYoutube=false" data-bs-dismiss="modal"></div>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close closebtn" data-bs-dismiss="modal" aria-label="Close" ng-click="modalYoutube=false">
                <span aria-hidden="true">Fechar [X]</span>
            </button>
            <div class="modal-body video" ng-if="modalYoutube" ng-bind-html="iframeYoutube">
            </div>
        </div>
    </div>
</div>