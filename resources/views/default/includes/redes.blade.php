<section id="sec-redes" class="redes-sociais">
    <div class="container redes-wrap">

        <div class="row gx-4 gy-4 align-items-center">
            {{-- Esquerda: título + texto curto --}}
            <div class="col-lg-4">

                @if (!empty($home['titulo-instagram']))
                    <h2 class="section-title instagram">
                        {!! $home['titulo-instagram'] !!}

                    </h2>
                @endif

                <div class="redes-underline"></div>
                @if (!empty($home['instagram-texto']))
                    <div class="redes-desc instagram">
                        {!! $home['instagram-texto'] !!}

                    </div>
                @endif

            </div>

            {{-- Direita: painel azul com 3 imagens --}}
            @php
                // traga $redesImagens do controller; aqui só garantimos 3 itens
                $redesImagens = array_slice($redesImagens ?? [], 0, 3);

                // links das redes (ex.: $config['redes']['facebook'] = 'https://...')
                $links = $config['redes'] ?? [];
                $counter = $socialCount ?? 173; // número do badge vermelho
            @endphp

            <div class="col-lg-8">
                <div class="redes-panel">
                    <div class="redes-gallery">
                        @foreach ($home['instagram-galeria'] as $item)
                            @if (empty($item['link']))
                                {!! $helpers->gerarImg($item, true, 'img-fluid', true, false, 'lazy', 'async', 'image') !!}
                            @else
                                {!! $helpers->gerarImg($item, true, '') !!}
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        {{-- Faixa amarela sobreposta --}}
        <div class="redes-ribbon" role="complementary" aria-label="Nossas redes sociais">
            <div class="icons">
                <a href="{{ $links['facebook'] ?? '#' }}" target="_blank" rel="noopener" aria-label="Facebook">
                    @include('default.includes.components.rede-sociais.facebook')
                </a>
                <a href="{{ $links['instagram'] ?? '#' }}" target="_blank" rel="noopener" aria-label="Instagram">
                    @include('default.includes.components.rede-sociais.instagram')
                </a>
                <a href="{{ $links['linkedin'] ?? '#' }}" target="_blank" rel="noopener" aria-label="LinkedIn">
                    @include('default.includes.components.rede-sociais.linkedin')
                </a>
                <a href="{{ $links['youtube'] ?? '#' }}" target="_blank" rel="noopener" aria-label="YouTube">
                    @include('default.includes.components.rede-sociais.youtube')
                </a>
            </div>

        </div>

    </div>
</section>
