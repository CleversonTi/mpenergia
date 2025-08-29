
@if(!empty( $servicosHome))
<section id="featured-servicos" class="featured-servicos">
    <div class="container">
       
        @if(!empty( $servicosHome['titulo-home']) || !empty( $servicosHome['sub-titulo-home']))
          <h2 class="section-title services">
            <strong>{{  $servicosHome['titulo-home'] }}</strong> 
            <span>{{  $servicosHome['sub-titulo-home'] }}</span>
          </h2>
        @endif

       
        @if(!empty( $servicosHome['descricao-home']))
        <div class="descricao services">
            <p>{{  $servicosHome['descricao-home'] }}</p>

        </div>
        @endif
       
        <div class="row my-5">
          
            @forelse($servicos as $item)
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
                                            <div class="links-servicos">
                                                <a href="{{ $item['uri'] }}" itemprop="url" class="btn btn-primary" aria-label="Saiba mais sobre {{ $item['titulo'] ?? '...' }}">
                                                    <img src="{{ asset('default/image/icon-more.png') }}" 
                                                        alt="Ícone saiba mais" 
                                                        class="icon-more">
                                                    <span>
                                                       <p>
                                                             Saiba mais
                                                       </p>
                                                    </span>
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
            
            <div class="row-ctas text-center mt-4 links">
                <a href="{{ $url }}" class="btn btn-outline-primary btn-lg" aria-label="Conheça todos os serviços">
                    <span>Conheça todos os serviços</span>
                </a>
            </div>
        </div>
    </div>
</section>
 @endif