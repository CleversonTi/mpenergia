<section id="featured-eventos" class="featured-eventos">
  <div class="container big">
    <h2 class="section-title services">
      <strong>Eventos entregues</strong> <span>com sucesso!</span>
    </h2>
    @php
        $totalEventos = is_countable($eventosInterna ?? []) ? count($eventosInterna) : 0;
    @endphp
    <div class="itens-events owl-carousel-events {{ $totalEventos > 5 ? 'loading' : '' }}">
      @forelse(collect($eventosInterna) as $e)
        <article class="card-events">
          <a href="{{ $e['uri'] }}" class="card" aria-label="Abrir {{ strip_tags($e['titulo'] ?? 'evento') }}">
            {{-- imagem --}}
            @if(!empty($e['imagem']['url']))
              {!! $helpers->gerarImg($e['imagem'], true, 'card-img', true, false, 'lazy', 'async', 'image') !!}
            @endif
            {{-- título sobre a imagem --}}
            <h3 class="card-title">{{ strip_tags(html_entity_decode($e['titulo'] ?? '')) }}</h3>
          </a>
        </article>
      @empty
        <p class="empty">Nenhum evento cadastrado.</p>
      @endforelse
    </div>
  </div>
</section>





