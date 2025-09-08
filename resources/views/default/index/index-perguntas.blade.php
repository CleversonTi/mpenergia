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
        <div class="row area-duvidas align-items-center">
            <div class="col-lg-6 h-100">
                {{-- Título + perguntas --}}
                @if (!empty($home['titulo-duvidas-frequentes']))
                    <h2 class="section-title">
                        {!! $home['titulo-duvidas-frequentes'] !!}

                    </h2>
                @endif
                @include('default.includes.perguntas-frequentes')
                @isset($duvidasUrl)
                    <div class="row-ctas text-left mt-5 links">
                        <a href="{{ $duvidasUrl }}" class="btn btn-outline-primary btn-lg"
                            aria-label="Acesse todas as dúvidas">
                            <span>Acesse todas as dúvidas</span>
                        </a>
                    </div>
                @endisset

            </div>
            <div class="col-lg-6">

            </div>
        </div>
    </div>


</section>
