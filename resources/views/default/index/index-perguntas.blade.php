@php

    // Render da imagem (use sua helper ou HTML direto)
    $image_html =
        $helpers->gerarImg($home['perguntas-imagem'] ?? ($home['quer-saber-mais-1'] ?? []), true, 'pf-img') ?? '';
@endphp

@php
    $bgOp = $helpers->getImage($home['imagem-duvidas-frequentes']['url']);
@endphp

<section class="index-duvidas home{{ $bgOp ? 'isBanner' : 'noBanner' }}"
    @if ($bgOp) style="background-image:url('{{ $bgOp }}')" @endif>

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @if (!empty($home['titulo-duvidas-frequentes']))
                    <h2 class="section-title">
                        {!! $home['titulo-duvidas-frequentes'] !!}

                    </h2>
                @endif
                @include('default.includes.perguntas-frequentes')
                @isset($duvidasUrl)
                    <a href="{{ $duvidasUrl }}" class="faq-all main-cta mt-3">Acesse todas as dúvidas</a>
                @endisset
            </div>
        </div>
    </div>


</section>
