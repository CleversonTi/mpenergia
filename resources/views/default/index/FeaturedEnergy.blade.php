

<section id="featured-energy" class="featured-energy">
    <div class="container big">
        @if(!empty( $energyHome['titulo-home']) && !empty( $energyHome['sub-titulo-home']))
          <h2 class="section-title">
            <strong>{{  $energyHome['titulo-home'] }}</strong> 
            <span>{{  $energyHome['sub-titulo-home'] }}</span>
          </h2>
        @endif

        {{-- Descrição --}}
        @if(!empty( $energyHome['descricao-home']))
          <p>{{  $energyHome['descricao-home'] }}</p>
        @endif
       
        <div class="row">
            @forelse($energy as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        {{-- Imagem --}}
                        @if(!empty($item['imagem']['url']))
                            <img src="{{ asset($item['imagem']['url']) }}"
                                 class="card-img-top"
                                 alt="{{ $item['titulo'] ?? '' }}">
                        @endif

                        {{-- Conteúdo --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['titulo'] ?? '' }}</h5>
                        
                            @if(!empty($item['descricao']))
                                <p class="card-text">
                                    {!! $item['descricao'] !!}
                                </p>
                            @endif

                            @if(!empty($item['link']))
                                <a href="{{ $item['link'] }}" class="btn btn-primary">
                                    Saiba mais
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>Nenhum item de energia cadastrado.</p>
            @endforelse
        </div>
    </div>
</section>
