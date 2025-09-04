@if(!empty($portifolioHome))

@php
   $bgOp = $helpers->getImage($home['fundo-portifolio']['url']);
@endphp
<section id="featured-portifolio" 
  class="featured-portifolio home{{ $bgOp ? 'isBanner' : 'noBanner' }}"
    @if($bgOp) style="background-image:url('{{ $bgOp }}')" @endif>
  <div class="container">

      @if(!empty( $home['portifolio-titulo']) )
          <h2 class="section-title portifolio">
            {!!$home['portifolio-titulo']!!}
          </h2>
        @endif
    

    {{-- Grid de cards --}}
    <div class="row g-4">
        
      @foreach($portifolioInterna as $i => $item)
        <div class="col-6 col-md-6">
          <article class="card featured-card shadow-sm border-0">
            

            <div class="card-body">
              <div class="img-events ">
                <div class="carousel-gallery owl-carousel owl-theme">
                  @foreach ($item['galerias'] as $img)
                    @php
                      $bg = $helpers->getImage($img['url'] ?? '');
                    @endphp
                    <a href="{{$img['url']}}" data-lightbox="galeria-home-portifolio">
                      <div class="gallery-slide" >
                          {!! $helpers->gerarImg($img['url']) !!}
                      </div>
                      </a>
                  @endforeach
                </div>
              </div>
               <div class="infobox grid12-12 no-gutter">
                 @if(!empty($item['titulo']))
                     <div class="card-title h6 mb-1 card-text">
  
                       <a href="{{ $item['uri'] }}" itemprop="url" class="name-home-portifolio" aria-label="Saiba mais sobre {{ $item['titulo'] ?? '...' }}">
     
                         <h4>
                             {!! $item['titulo'] !!}-
                             
                             @if (!empty($item['cidade-estado']))
                                 <x-cidade-estado :value="$item['cidade-estado']" />
                             @endif
                         </h4>
                       </a>
                     </div>
                 @endif
                 
                 @if(!empty($item['descricao']))
                 <div class="text-desc">
                   
                   {!! $item['descricao'] !!}

                 </div>
               
                 @endif


               </div>

            
              </div>
          </article>
        </div>
        
      @endforeach
    </div>

   
   <div class="row-ctas text-center mt-5 links">
        <a href="{{ $portifolioUrl }}" class="btn btn-outline-primary btn-lg" aria-label="Acessar portfólio">
            <span>Acessar portfólio</span>
        </a>
    </div>

  </div>
</section>
@endif
