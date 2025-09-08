<section class="footer">
    {{-- MAPS (todas as unidades) --}}
    @if (!empty($config['unidades']))
        <div class="maps">
            @foreach ($config['unidades'] as $unidade)
                {!! $unidade['iframe'] ?? '' !!}
            @endforeach
        </div>
    @endif
    @php
        $descricao_resumida =
            $config['descricao_resumida'] ??
            'Com equipamentos de 10kVA a 550kVA, frota própria e equipe
    técnica preparada, oferecemos soluções completas — do transporte à operação — com agilidade, segurança e
    responsabilidade técnica.';
        $menu = (array) ($config['menu'] ?? []);
        // “Soluções” por título (robusto a variações de acento)
        $solucoes = array_values(
            array_filter($menu, function ($it) {
                $t = mb_strtolower($it['titulo'] ?? '');
                return in_array($t, ['emergencial', 'eventos', 'uso contínuo', 'uso continuo']);
            }),
        );

        // Contatos: pega a 1ª unidade como padrão
        $unidades = (array) ($config['unidades'] ?? []);
        $u = $unidades[0] ?? [];
        $whatsNum = $u['whatsapp']['numero'] ?? '';
        $whatsLink = $u['whatsapp']['link'] ?? '';
        $telNum = $u['telefone']['numero'] ?? '';
        $telLink = $u['telefone']['link'] ?? '';
    @endphp

    <div class="footer-in">
        <div class="container big">
            <div class="row gx-4 gy-4 footer-grid">
                {{-- Coluna 1: Logo + texto + redes --}}
                <div class="col-lg-4">
                    <div class="footer-brand">
                        {!! $helpers->gerarImg($config['image_rodape'], true, 'logo-rodape') !!}
                        @if (!empty($descricao_resumida))
                            <div class="mb-3 small pe-lg-4 short_description">
                                <p> {!! $descricao_resumida !!}</p>

                            </div>
                        @endif



                        @include('default.includes.components.redes-sociais-footer')

                    </div>
                </div>

                {{-- Coluna 2: Links --}}
                <div class="col-6 col-lg-2">
                    <div class="footer-title"><strong>Links</strong></div>
                    <ul class="footer-links text-links">
                        @foreach ($menu as $item)
                            <li>
                                <a class="Links " href="{{ $item['url'] }}"
                                    aria-label="Abrir {{ $item['titulo'] ?? 'serviço' }}">{{ $item['titulo'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Coluna 3: Soluções --}}
                <div class="col-6 col-lg-2">

                    <div class="footer-title"><strong>Soluções</strong></div>
                    <ul class="footer-links text-links">
                        @forelse($servicos as $item)
                            <li>
                                <a href="{{ $item['uri'] }}" itemprop="url" class="Links"
                                    aria-label="Abrir {{ $item['titulo'] ?? 'serviço' }}">
                                    @if (!empty($item['titulo']))
                                        <div class="card-text">
                                            {!! $item['titulo'] !!}
                                        </div>
                                    @endif
                                </a>



                            </li>
                        @empty
                            {{-- fallback (caso não existam no menu) --}}
                            <li><span class="muted">Em breve</span></li>
                        @endforelse
                    </ul>
                </div>

                {{-- Coluna 4: Contato --}}
                <div class="col-6 col-lg-2">
                    <div class="footer-title"><strong>Contato</strong></div>
                    <ul class="footer-contact footer-links social-links">


                        @if ($config['whatsapp']['numero'])
                            <li>
                                <a ng-click="abrirZapChat('{{ $assunto ?? '' }}')" class=" zap Links">

                                    <div class="info">
                                        <span class="label">{{ $config['whatsapp']['rotulo'] ?? '' }}</span>
                                        <span class="number">{{ $config['whatsapp']['numero'] ?? '' }}</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if ($config['telefone']['numero'])
                            <li>
                                <a class=" zap Links" title="{{ $config['telefone']['rotulo'] }}"
                                    aria-label="{{ $config['telefone']['rotulo'] }}"
                                    href="{{ $config['telefone']['link'] ?? '' }}" target="_blank" class="main-phone">

                                    <div class="info">
                                        <span class="label">{{ $config['telefone']['rotulo'] ?? '' }}</span>
                                        <div class="number">{{ $config['telefone']['numero'] ?? '' }}</div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                {{-- Coluna 5: Newsletter --}}
                <div class="col-6 col-lg-2">
                    <div class="footer-title"><strong>Newsletter</strong></div>

                    <form class="footer-news" name="newsletter_footer" ng-controller="EmailController"
                        ng-submit="submitForm($event,'newsletter',newsletter_footer.$error)">
                        <label for="news_email" class="label">E-mail</label>
                        <div class="news-input">
                            <input id="news_email" type="email" ng-model="form.email" required autocomplete="email"
                                inputmode="email" />
                            <button type="submit" aria-label="Enviar" class="send-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17.991 6.0096L5.39901 10.5626L9.59401 12.9906L13.293 9.2906C13.4806 9.10309 13.7351 8.99781 14.0004 8.9979C14.2656 8.99799 14.52 9.10346 14.7075 9.2911C14.895 9.47874 15.0003 9.73319 15.0002 9.99846C15.0001 10.2637 14.8946 10.5181 14.707 10.7056L11.007 14.4056L13.437 18.5996L17.991 6.0096ZM18.314 3.7656C19.509 3.3326 20.667 4.4906 20.234 5.6856L14.952 20.2906C14.518 21.4886 12.882 21.6346 12.243 20.5316L9.02601 14.9736L3.46801 11.7566C2.36501 11.1176 2.51101 9.4816 3.70901 9.0476L18.314 3.7656Z"
                                        fill="#EBB632" />
                                </svg>
                            </button>
                        </div>
                    </form>

                </div>
            </div>


        </div>


    </div>
</section>
