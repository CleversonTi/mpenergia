@php
    $carouselId = 'owl-index-sobre-'.uniqid();
@endphp
<section class="index-sobre">
    <div class="container big">
        <div class="row">
            <div class="col-lg-4 offset-lg-1">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="box-logo">
                            {!! $helpers->gerarImg($config['image_logo'], true, 'logo') !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="title-in">
                            <h2>{!! $home['sobre-titulo'] !!}</h2>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="conteudo-sobre">
                            {!! $home['sobre-conteudo'] !!}
                        </div>
                        <a href="{{route('sobre')}}" class="main-cta">SAIBA MAIS</a>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="box-carousel">
                    {!! $helpers->gerarImg('default/image/mais18anos.png',true,'mais18') !!}
                    <div class="owl-carousel {{$carouselId}}">
                        @foreach($home['sobre-galeria'] as $key => $img)
                            <div class="box-img-in">
                                <a href="{{ $img['url']??'' }}" data-lightbox="galeria-index-sobre">
                                    {!! $helpers->gerarImg($img, true) !!}
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if(count($home['sobre-galeria'])>3)
                        <div class="carousel-tool">
                            <div class="prev" id="customPrevBtn-{{$carouselId}}">
                                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="19.1016" cy="19.3047" r="19.1016" fill="white"/>
                                    <circle cx="19.1016" cy="19.3047" r="18.1016" stroke="{{( !empty($class_destaque) && ($class_destaque == 'bg-destaque-estetica')) ? 'transparent' :'black'}}" stroke-opacity="0.3" stroke-width="2"/>
                                    <path d="M16.9531 25.4637V20.9637H26.9881L27.0219 18.7025H16.9531V14.2137L11.3281 19.8387L16.9531 25.4637Z" fill="#243352"/>
                                </svg>
                            </div>
                            <ul class="carousel-tool-dots" id="carousel-tool-dots-{{ $carouselId }}">
                                @for($i=1;$i<=ceil(count($home['sobre-galeria'])/3);$i++)
                                    <div class="custom-dots-destaque-in custom-dots-destaque-in-{{ $carouselId }}"></div>
                                @endfor
                            </ul>
                            <div class="next" id="customNextBtn-{{$carouselId}}">
                                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="19.1016" cy="19.1016" r="19.1016" transform="matrix(-1 0 0 1 38.7031 0)" fill="white"/>
                                    <circle cx="19.1016" cy="19.1016" r="18.1016" transform="matrix(-1 0 0 1 38.7031 0)" stroke="{{(!empty($class_destaque) && ($class_destaque == 'bg-destaque-estetica')) ? 'transparent' : 'black'}}" stroke-opacity="0.3" stroke-width="2"/>
                                    <path d="M21.75 25.2606V20.7606H11.715L11.6813 18.4994H21.75V14.0106L27.375 19.6356L21.75 25.2606Z" fill="#243352"/>
                                </svg>
                            </div>
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
            center: true,
            items: 3,
            loop: true,
            margin: 0,
            nav: false,
            responsive: {
                0: {
                    margin: 0,
                    items: 1,
                    dots: true,
                },
                992: {
                    margin: 0,
                    items: 3,
                    dotsContainer: '#carousel-tool-dots-{{ $carouselId }}',
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