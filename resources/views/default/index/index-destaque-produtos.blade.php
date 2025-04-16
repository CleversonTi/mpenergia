@php
    $uniqid = uniqid();
    $carouselId = 'owl-produtos-destaque-'.$uniqid;
    $classDestaque = 'destaque-produtos-'.$uniqid;
@endphp

@if(!empty($categoria['cor-fonte']))
    <style>
        section.index-destaque-produtos.{{$classDestaque}} {
            background-image: unset !important;
            background-color: {{$categoria['cor-fundo']}}     !important;
        }
    </style>
@endif
@if(!empty($categoria['cor-fonte']))
    <style>
        section.index-destaque-produtos.{{$classDestaque}} .row-head-title-destaque h2.title-categoria-destaque,
        section.index-destaque-produtos.{{$classDestaque}} .row-head-title-destaque a {
            color: {{$categoria['cor-fonte']}}     !important;
        }
    </style>
@endif

@if(!empty($produtos_destaques['listagem']))
    <section class="index-destaque-produtos {{$class_destaque ?? ''}} {{$classDestaque}}"
            style="<?= !empty($categoria['cor-fundo']) ? ('background-image:unset;background-color:'.$categoria['cor-fundo'].';') : '' ?>">
        <div class="container big">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row-head-title-destaque">
                        <h2 class="title-categoria-destaque" style="<?= !empty($categoria['cor-fonte']) ? ('color:'.$categoria['cor-fonte'].';') : '' ?>">{{$titulo_categoria}}</h2>
                        <a href="{{$link_categoria}}">
                            confira todos >
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="owl-carousel {{$carouselId}}">
                        @foreach($produtos_destaques['listagem'] as $produto)
                            @include('default.includes.components.card-produto',['produto'=>$produto])
                        @endforeach
                    </div>

                    @if($produtos_destaques['qtd']>4)
                        <div class="carousel-tool">
                            <div class="prev" id="customPrevBtn-{{$carouselId}}">
                                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="19.1016" cy="19.3047" r="19.1016" fill="white"/>
                                    <circle cx="19.1016" cy="19.3047" r="18.1016" stroke="{{( !empty($class_destaque) && (in_array($class_destaque, ['bg-destaque-estetica','bg-produto-relacionados']))) ? 'transparent' :'black'}}" stroke-opacity="0.3" stroke-width="2"/>
                                    <path d="M16.9531 25.4637V20.9637H26.9881L27.0219 18.7025H16.9531V14.2137L11.3281 19.8387L16.9531 25.4637Z" fill="#243352"/>
                                </svg>
                            </div>
                            <ul class="carousel-tool-dots" id="carousel-tool-dots-{{ $carouselId }}">
                                @for($i=1;$i<=ceil($produtos_destaques['qtd']/4);$i++)
                                    <div class="custom-dots-destaque-in custom-dots-destaque-in-{{ $carouselId }}"></div>
                                @endfor
                            </ul>
                            <div class="next" id="customNextBtn-{{$carouselId}}">
                                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="19.1016" cy="19.1016" r="19.1016" transform="matrix(-1 0 0 1 38.7031 0)" fill="white"/>
                                    <circle cx="19.1016" cy="19.1016" r="18.1016" transform="matrix(-1 0 0 1 38.7031 0)" stroke="{{( !empty($class_destaque) && (in_array($class_destaque, ['bg-destaque-estetica','bg-produto-relacionados']))) ? 'transparent' :'black'}}" stroke-opacity="0.3" stroke-width="2"/>
                                    <path d="M21.75 25.2606V20.7606H11.715L11.6813 18.4994H21.75V14.0106L27.375 19.6356L21.75 25.2606Z" fill="#243352"/>
                                </svg>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $('.{{ $carouselId }}').owlCarousel({
                mouseDrag: true,
                autoplay: true,
                autoplayTimeout: 8000,
                autoplayHoverPause: false,
                autoHeight: true,
                loop: false,
                nav: false,
                responsive: {
                    0: {
                        margin: 0,
                        items: 1
                    },
                    992: {
                        dotsContainer: '#carousel-tool-dots-{{ $carouselId }}',
                        margin: 20,
                        items: 4
                    }
                }
            });

            $('.custom-dots-destaque-in-{{ $carouselId }}').click(function () {
                $('.{{ $carouselId }}').trigger('to.owl.carousel', [$(this).index(), 300]);
            });
            $('#customNextBtn-{{ $carouselId }}').click(function () {
                $('.{{ $carouselId }}').trigger('next.owl.carousel');
            })
            $('#customPrevBtn-{{ $carouselId }}').click(function () {
                $('.{{ $carouselId }}').trigger('prev.owl.carousel', [300]);
            })
        });
    </script>
@endif

