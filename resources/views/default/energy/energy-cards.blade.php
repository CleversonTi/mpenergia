

<section id="featured-energy" class="featured-energy">
    <div class="container">
        @if(!empty( $energyHome['titulo-home']) && !empty( $energyHome['sub-titulo-home']))
          <h2 class="section-title energy">
            <strong>{{  $energyHome['titulo-home'] }}</strong> 
            <span>{{  $energyHome['sub-titulo-home'] }}</span>
          </h2>
        @endif

       
        @if(!empty( $energyHome['descricao-home']))
        <div class="descricao energy">
            <p>{{  $energyHome['descricao-home'] }}</p>

        </div>
        @endif
       
        <div class="row">
          
            @forelse($energy as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        {{-- Imagem --}}
                        @if(!empty($item['imagem']['url']))
                        <a href="{{ $item['uri'] }}" itemprop="url" class="card-img-link" aria-label="Abrir {{ $item['titulo'] ?? 'serviço' }}">
                       
                        {!! $helpers->gerarImg($item['imagem'], true, 'img-fluid', true, false, 'lazy', 'async', 'image') !!}
                          
                        </a>
                        @endif
                        <div class="card-body">
                            <h3 class="card-title">{{ $item['titulo'] ?? '' }}</h3>

                             @if(!empty($item['descricao']))
                                <div class="card-text">
                                    {!! $item['descricao'] !!}
                                </div>
                            @endif

                           
                             <div class="row ">
                                <div class="col-lg-9">
                                    <div class="row-ctas">
                                        @if(!empty($item['uri']))
                                            <div class="links-energy">
                                                <a href="{{ $item['uri'] }}" itemprop="url" class="btn btn-primary" aria-label="Saiba mais sobre {{ $item['titulo'] ?? '...' }}">
                                                    <span class="icon-energy">
                                                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17" width="17" height="17"><style>.a{fill:#fff}</style><path fill-rule="evenodd" class="a" d="m8.5 17c-4.7 0-8.5-3.8-8.5-8.5 0-4.7 3.8-8.5 8.5-8.5 4.7 0 8.5 3.8 8.5 8.5 0 4.7-3.8 8.5-8.5 8.5zm0-16c-4.2 0-7.5 3.3-7.5 7.5 0 4.1 3.3 7.5 7.5 7.5 4.1 0 7.5-3.4 7.5-7.5 0-4.2-3.4-7.5-7.5-7.5zm-4.5 7h4v1h-4zm9 0v1h-4v-1zm-5 5h1v-4h-1zm1-9h-1v4h1z"/></svg>
                                                    </span>
                                                    <label for="">
                                                        Saiba mais
                                                    </label>
                                                </a>

                                            </div>
                                        @endif
                                       
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row-ctas zapEnergy">
                                         @include('default.includes.components.zapEnergy')

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nenhum item de energia cadastrado.</p>
            @endforelse
        </div>
    </div>
</section>
