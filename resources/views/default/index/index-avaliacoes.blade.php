<section id="featured-avaliacoes-home" class="index-avaliacoes home">
    <div class="container">

        @if (!empty($home['conteudo-avaliacoes']))
            <h2 class="section-titleavaliacoes">{!! $home['conteudo-avaliacoes'] !!}</h2>
        @endif

        <div class="row">
            @forelse($clientesInterna as $item)
                <div class="col-md-4 mb-4">
                    <div class="avaliacao-card card">
                        <div class="card-body">

                            @php
                                $rating = (int) ($item['avaliacoes'] ?? 0);
                                $rating = max(0, min(5, $rating));
                            @endphp

                            <div class="ratings">
                                <div class="rating-box" aria-label="{{ $rating }} de 5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20"
                                            height="20" class="star">
                                            <path
                                                d="M10 1.5l2.47 4.99 5.51.8-3.99 3.89.94 5.48L10 14.96 5.07 16.66l.94-5.48L2.02 7.29l5.51-.8L10 1.5z"
                                                fill="{{ $i <= $rating ? '#EBB632' : '#E5E7EB' }}" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>

                            <p class="card-text">{!! $item['campo-depoimentos'] ?? '' !!}</p>
                            <h5 class="card-title">{{ $item['titulo'] ?? '' }}</h5>

                            @if (!empty($item['link']))
                                <a href="{{ $item['link'] }}" class="btn btn-primary">Saiba mais</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>Nenhum item de energia cadastrado.</p>
            @endforelse
        </div>

        <div class="row-ctas text-center mt-5 links">
            <a href="{{ $clientesUrl }}" class="btn btn-outline-primary btn-lg" aria-label=" Veja todas as avaliações">
                <span> Veja todas as avaliações</span>
            </a>
        </div>

    </div>
</section>
