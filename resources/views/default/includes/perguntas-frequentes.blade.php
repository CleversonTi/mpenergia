@php
    // Normaliza a coleção
    $items = array_values((array) ($duvidasItens ?? []));
    $items = array_filter($items, fn($it) => !empty($it['perguntas']));

    // Base para IDs únicos
    $baseId = 'faq-' . substr(md5(uniqid('', true)), 0, 6);

    // Coleta para Schema.org (FAQPage)
    $faqSchema = [];
@endphp

@if (count($items))
    <section class="faq" aria-label="Perguntas frequentes">
        <ul class="faq-list">
            @foreach ($items as $i => $it)
                @php
                    $qHtml = (string) ($it['perguntas'] ?? '');
                    $aHtml = (string) ($it['respostas'] ?? '');

                    // Texto puro para o botão (button não aceita <p> etc.)
                    $qText = trim(preg_replace('/\s+/', ' ', strip_tags($qHtml)));

                    $open = $i === 0; // abre só o primeiro ao carregar

                    $qid = $baseId . '-q-' . $i;
                    $aid = $baseId . '-a-' . $i;

                    if ($qText !== '') {
                        $faqSchema[] = [
                            '@type' => 'Question',
                            'name' => $qText,
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => strip_tags($aHtml),
                            ],
                        ];
                    }
                @endphp

                <li class="faq-item">
                    <button id="{{ $qid }}" class="faq-q" type="button" aria-controls="{{ $aid }}"
                        aria-expanded="{{ $open ? 'true' : 'false' }}">
                        <span class="faq-q__text">{{ $qText }}</span>
                    </button>

                    <div id="{{ $aid }}" class="faq-a{{ $open ? ' is-open' : '' }}" role="region"
                        aria-labelledby="{{ $qid }}" aria-hidden="{{ $open ? 'false' : 'true' }}">
                        <div class="faq-a__box">
                            {!! $aHtml !!}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>


    </section>

    {{-- SEO: Schema.org FAQPage --}}
    @if (!empty($faqSchema))
        <script type="application/ld+json">
{!! json_encode([
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => $faqSchema,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
    @endif

    {{-- Acordeão acessível com transições suaves (combina com o SCSS) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.faq-item');

            items.forEach((item) => {
                const btn = item.querySelector('.faq-q');
                const panel = item.querySelector('.faq-a');

                // Estado inicial sem display:none (para permitir animação)
                const startOpen = btn.getAttribute('aria-expanded') === 'true';
                panel.classList.toggle('is-open', startOpen);
                panel.setAttribute('aria-hidden', String(!startOpen));

                btn.addEventListener('click', () => {
                    const isOpen = btn.getAttribute('aria-expanded') === 'true';

                    // Acordeão: fecha os outros
                    items.forEach((it) => {
                        if (it !== item) {
                            const b = it.querySelector('.faq-q');
                            const p = it.querySelector('.faq-a');
                            b.setAttribute('aria-expanded', 'false');
                            p.classList.remove('is-open');
                            p.setAttribute('aria-hidden', 'true');
                        }
                    });

                    // Alterna o atual
                    btn.setAttribute('aria-expanded', String(!isOpen));
                    panel.classList.toggle('is-open', !isOpen);
                    panel.setAttribute('aria-hidden', String(isOpen));
                });
            });
        });
    </script>
@endif
