@php
    $bgOp = $helpers->getImage($home['fundo-contato-home']['url']);
@endphp



<section id="featured-portifolio-home" class="index-contato home{{ $bgOp ? 'isBanner' : 'noBanner' }}"
    @if ($bgOp) style="background-image:url('{{ $bgOp }}')" @endif>
    <div class="index-contato__mask"></div>

    <div class="container big">
        <div class="row align-items-center justify-content-around">
            {{-- LADO ESQUERDO – Texto + CTA --}}
            <div class="col-lg-4 offset-lg-1">
                <div class="index-contato__left">
                    <div class="header">
                        @if (!empty($home['icone-contatos-home']))
                            <div class="index-contato__brand">
                                {!! $helpers->gerarImg($home['icone-contatos-home'] ?? [], true, 'logo-white') !!}
                            </div>
                        @endif
                        @if (!empty($home['titulo-contatos']))
                            <h2 class="section-title contatos">
                                {!! $home['titulo-contatos'] !!}
                            </h2>
                        @endif

                        @if (!empty($home['descricao-contato']))
                            <div class="card-text contatos">
                                {!! $home['descricao-contato'] !!}
                            </div>
                        @endif
                    </div>
                    <div class="footer-descricao">
                        @if (!empty($home['texto-fale-com-a-gente-contatos']))
                            <div class="card-text contatos">
                                {!! $home['texto-fale-com-a-gente-contatos'] !!}
                            </div>
                        @endif
                        @php
                            $zapLink =
                                $config['whatsapp']['link'] ?? ($config['unidades'][0]['whatsapp']['link'] ?? '#');
                        @endphp
                        <div class="row-ctas contact">
                            @include('default.includes.components.zap-contact', [
                                'label' => 'Atendimento rápido',
                                'assunto' => 'Home – Hero', // opcional, se já usa
                                'aria' => 'Falar no WhatsApp', // opcional (senão usa a label)
                            ])
                        </div>

                    </div>




                </div>
            </div>


            <div class="col-lg-4 offset-lg-1 form">
                <div class="index-contato__form-card">


                    <form name="{{ $form_name ?? 'index_contato' }}" novalidate ng-controller="EmailController"
                        ng-submit="submitForm($event,'',{{ $form_name ?? 'index_contato' }}.$error)">

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="label">Nome:</label>
                                <input type="text" class="input" ng-model="form.nome" required>
                            </div>
                            <div class="col-12">
                                <label class="label">E-mail:</label>
                                <input type="email" class="input" ng-model="form.email" required>
                            </div>
                            <div class="col-12">
                                <label class="label">Telefone:</label>
                                <input type="text" class="input celular" ng-model="form.telefone" required>
                            </div>
                            <div class="col-12">
                                <label class="label">Cidade:</label>
                                <input type="text" class="input" ng-model="form.cidade">
                            </div>
                            <div class="col-12">
                                <label class="label">Mensagem:</label>
                                <textarea class="input textarea" rows="3" ng-model="form.mensagem"></textarea>
                            </div>

                            {{-- Hidden úteis (origem/assunto) --}}
                            <input type="hidden" ng-model="form.assunto"
                                ng-init="form.assunto='Contato - Página Inicial'">
                            <input type="hidden" ng-model="form.origem" ng-init="form.origem='Index - Bloco Contato'">

                            <div class="col-12  mt-4 text-center gap-3">
                                <button class="main-cta w-100">
                                    <span>
                                        Enviar mensagem

                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
