<div class="lente-whatsapp" ng-click="exibirZapChat = false" ng-class="{'exibir':exibirZapChat}"></div>

<section class="modal-whatsapp" ng-class="{'exibir':exibirZapChat}">

    <div class="cabecario-zap">
        <i class="fab fa-whatsapp"></i> <span class="zaptitulo">WhatsApp</span>
        <i class="far fa-times-circle" ng-click="exibirZapChat=!exibirZapChat"></i>
    </div>

    <form name="whatsapp_modal" ng-controller="EmailController" ng-submit="submitForm($event,$root.zapContato,whatsapp_modal.$error)">
        <div class="msg-bot">
            Olá, tudo bem? Preencha os dados abaixo para iniciar a conversa:

            <div class="campo-in">
                <label>Nome*</label>
                <input type="text" placeholder="Digite Aqui" autocomplete="off" ng-model="form.nome" name="nome" required>
            </div>
            <div class="campo-in">
                <label>Telefone*</label>
                <input type="text" class="celular" autocomplete="off" placeholder="(62) 9 9999-9999" ng-model="form.telefone" name="telefone" required>
            </div>
            <div class="campo-in hide-desktop">
                <label>Mensagem</label>
                <input name="zapmsg" autocomplete="off" ng-model="$root.formulario.mensagem" placeholder="Digite uma mensagem">
            </div>
        </div>

        <div class="hide-desktop">
            <button ng-disabled="whatsapp_modal.$invalid" type="submit" class="acao-mobile">
                <i class="fas fa-paper-plane"></i> Enviar mensagem
            </button>
        </div>

        <div class="campo-acao">
            <div class="texto">
                <input name="zapmsg" autocomplete="off" ng-model="$root.formulario.mensagem" placeholder="Digite uma mensagem">
            </div>
            <div class="button-zap">
                <button ng-disabled="whatsapp_modal.$invalid" type="submit" class="acao">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </form>


</section>