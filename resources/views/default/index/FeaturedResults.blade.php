@php

  $items = $home['resultados-em-destaque']['itens']
        ?? $home['resultados-em-destaque']
        ?? [];

  // helperzinho local para decidir se é URL/arquivo ou classe de ícone
  $isUrl = function ($v) {
      return is_string($v) && (str_starts_with($v, 'http')
          || str_starts_with($v, '/')
          || preg_match('~\.(svg|png|jpg|jpeg|webp)$~i', $v));
  };
@endphp

@if(!empty($items) && is_iterable($items))
<section class="featured-results py-5">
  <div class="container">
    <div class="row g-3 g-md-4 justify-content-center">

      @foreach($items as $it)
        @php
          $icon  = $it['icon']['url'] ?? $it['icon'] ?? null;
          $num   = (string)($it['numeros'] ?? $it['numero'] ?? $it['valor'] ?? '');
          $desc  = $it['descricao'] ?? $it['label'] ?? '';

          // garante sinal de + no início, se quiser esse padrão
          

          // se tiver helper de imagem no projeto:
          if (isset($helpers) && $icon) {
            $icon = $helpers->getImage(is_array($icon) ? ($icon['url'] ?? '') : $icon) ?: $icon;
          }
        @endphp

        <div class="ietm-card col-6 col-md-3">
          <div class="result-card h-100 p-3 p-md-4 bg-white shadow-sm rounded-4 border border-2">
            <div class="result-icon mb-2">
              @if($icon && $isUrl($icon))
                <img src="{{ $icon }}" alt="" width="32" height="32" class="img-fluid" loading="lazy">
              @elseif(is_string($icon) && $icon)
                <i class="{{ $icon }}" aria-hidden="true"></i>
              @endif
            </div>

           @php
                $targetNum = (int) ($it['numeros'] ?? $it['numero'] ?? $it['valor'] ?? 0);
            @endphp


           @if($targetNum > 0)
            <div class="result-number h3 fw-bold mb-1">
                <span class="number-plus">+</span>
                <span class="number-value" data-target="{{ $targetNum }}">0</span>
            </div>
            @endif


            <div class="result-desc text-muted small">
              <span>
                {!! $desc !!}
              </span>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>
@endif
<script src="{{ asset('default/js/animation.js') }}?v={{ filemtime(public_path('default/js/animation.js')) }}" defer></script>




