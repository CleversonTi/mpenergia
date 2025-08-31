

<section id="sobre-mais" class="sobre-mais">
  <div class="container big">
    <div class="sobre-mais__grid">
      <div class="sobre-mais__content">

        @if(!empty($home['sobre-titulo']))
          <h2 class="section-title about">
          
            {!! $home['sobre-titulo'] !!}
          </h2> 
        @endif
         @if(!empty($home['descricao-sobre']))
          <div class="sobre-mais__desc">
          {!! $home['descricao-sobre']  !!}
          </div>
         @endif
        
        @if(!empty($home['texto-sobre']))
          <div class="row-ctas text-left mt-4 links">
                  <a Aqui  href="{{ !empty($home['link-sobre']) ? $home['link-sobre'] : '#' }}"  class="btn btn-outline-primary btn-lg" aria-label="Conheça todos os serviços">
                      <span>{{$home['texto-sobre']}}</span>
                  </a>
              </div>
          </div>
        @endif

      <div class="col-lg-5 align-self-center video">
          <a  class="open-video" ng-click="abrirModalYoutube('{{ $home['video-sobre']['id'] ?? '' }}')">
              {!! $helpers->gerarImg(['url' => $home['video-sobre']['thumb'] ?? ''], true, '') !!}
              <svg version="1.2" xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 82 82" width="82" height="82">
                <style>.a{fill:none;stroke:#fff;stroke-linejoin:round;stroke-width:2}</style>
                <path fill-rule="evenodd" 
                class="a" 
                d="m1 41c0-22.1 17.9-40 40-40 22.1 0 40 17.9 40 40 0 22.1-17.9 40-40 40-22.1 0-40-17.9-40-40zm32 13.9l24-13.9-24-13.9z"/>
              </svg>
          </a>
      </div>

        
        
    </div>
  </div>
</section>
