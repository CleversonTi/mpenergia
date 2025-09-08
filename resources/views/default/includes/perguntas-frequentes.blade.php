@php
    /** @var array $duvidasItens  Estrutura esperada: [['perguntas' => '<h3>…</h3>', 'respostas' => '<p>…</p>'], …] */

    $itens = array_values((array) ($duvidasItens ?? []));
    $faqJson = [];

    // prepara dados para JSON-LD (FAQPage)
    foreach ($itens as $it) {
        $q = trim(strip_tags($it['perguntas'] ?? ''));
        $a = trim(strip_tags($it['respostas'] ?? ''));
        if ($q !== '') {
            $faqJson[] = [
                '@type' => 'Question',
                'name' => $q,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $a,
                ],
            ];
        }
    }
@endphp

@if (!empty($itens))
    <section class="faq" aria-labelledby="faq-title">
        <h2 id="faq-title" class="sr-only">Perguntas Frequentes</h2>

        <ul class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
            @foreach ($itens as $i => $it)
                @php
                    $qid = 'faq-q-' . ($i + 1);
                    $aid = 'faq-a-' . ($i + 1);
                    $open = $i === 0; // abre só o primeiro
                @endphp

                <li class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 class="faq-item__title">
                        <button id="{{ $qid }}" class="faq-q" aria-controls="{{ $aid }}"
                            aria-expanded="{{ $open ? 'true' : 'false' }}" itemprop="name" type="button">
                            <span class="faq-q__text">{!! $it['perguntas'] !!}</span>
                        </button>
                    </h3>

                    <div id="{{ $aid }}" class="faq-a{{ $open ? ' is-open' : '' }}" role="region"
                        aria-labelledby="{{ $qid }}" @unless ($open) hidden @endunless>
                        <div class="faq-a__box" itemprop="acceptedAnswer" itemscope
                            itemtype="https://schema.org/Answer">
                            <div itemprop="text">{!! $it['respostas'] !!}</div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>


        {{-- SEO: FAQ structured data --}}
        @if (!empty($faqJson))
            <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type'    => 'FAQPage',
            'mainEntity' => $faqJson,
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
        </script>
        @endif

        {{-- JS: acordeão acessível e sem dependências --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const items = document.querySelectorAll('.faq-item');
                items.forEach((item) => {
                    const btn = item.querySelector('.faq-q');
                    const ans = item.querySelector('.faq-a');

                    // normaliza estado inicial
                    ans.hidden = btn.getAttribute('aria-expanded') !== 'true';
                    ans.classList.toggle('is-open', !ans.hidden);

                    btn.addEventListener('click', () => {
                        const isOpen = btn.getAttribute('aria-expanded') === 'true';

                        // fecha os outros (comportamento acordeão)
                        items.forEach((it) => {
                            if (it !== item) {
                                const b = it.querySelector('.faq-q');
                                const a = it.querySelector('.faq-a');
                                b.setAttribute('aria-expanded', 'false');
                                a.hidden = true;
                                a.classList.remove('is-open');
                            }
                        });

                        // alterna o atual
                        btn.setAttribute('aria-expanded', String(!isOpen));
                        ans.hidden = isOpen;
                        ans.classList.toggle('is-open', !isOpen);
                    });

                    // acessibilidade extra pelo teclado
                    btn.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            btn.click();
                        }
                    });
                });
            });
        </script>
    </section>
@endif
