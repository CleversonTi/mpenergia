@extends('default.template')

@section('content')
    @php
        $carouselId = 'owl-depoimentos-'.uniqid();
        $depoimentos = array_merge($depoimentos,$depoimentos);
    @endphp
    <section class="page-depoimentos">
        @include('default.includes.header-conteudo')

        <div class="page-depoimentos-main">
            <div class="container big">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="page-texto">
                            {!! $page['texto']??'' !!}
                        </div>

                        <div class="owl-carousel {{$carouselId}}">
                            @foreach($depoimentos as $depoimento)
                              <div class="box-depoimento">
                                  <div class="icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                          <path d="M13.4879 1.11952L13.6404 0.5H13.0024H6.89713H6.54941L6.42839 0.825985L2.75211 10.7287C2.00948 12.6778 1.44888 14.3437 1.07319 15.7236C0.689894 17.0824 0.5 18.5358 0.5 20.0812C0.5 22.226 1.13583 24.0278 2.43537 25.4444L2.44174 25.4514L2.44837 25.4581C3.79794 26.8223 5.50172 27.5 7.52153 27.5C9.53967 27.5 11.2233 26.8231 12.5286 25.4547C13.8769 24.0901 14.5431 22.3583 14.5431 20.2997C14.5431 18.5207 14.1068 17.0221 13.1929 15.8466C12.445 14.8324 11.5138 14.0953 10.4039 13.647L13.4879 1.11952ZM29.4448 1.11952L29.5973 0.5H28.9593H22.8541H22.5063L22.3853 0.825985L18.7098 10.7267C18.7095 10.7274 18.7093 10.7281 18.709 10.7288C17.9664 12.6778 17.4058 14.3438 17.0301 15.7237C16.6468 17.0825 16.4569 18.5358 16.4569 20.0812C16.4569 22.226 17.0928 24.0278 18.3923 25.4444L18.3987 25.4514L18.4053 25.4581C19.7549 26.8223 21.4587 27.5 23.4785 27.5C25.4966 27.5 27.1803 26.8231 28.4855 25.4547C29.8339 24.0901 30.5 22.3583 30.5 20.2997C30.5 18.5207 30.0638 17.0221 29.1498 15.8465C28.4019 14.8324 27.4707 14.0953 26.3608 13.647L29.4448 1.11952Z" stroke="#599AA8"/>
                                      </svg>
                                  </div>
                                  <div class="depoimento-in">
                                      {!! $depoimento['depoimento'] !!}
                                  </div>
                                  <div class="autor-in">
                                      {!! $depoimento['titulo'] !!}
                                  </div>
                                  <div class="empresa-in">
                                      {!! $depoimento['empresa'] !!}
                                  </div>
                              </div>
                            @endforeach
                        </div>

                        @if(count($depoimentos)>3)
                            <div class="carousel-tool">
                                <div class="prev" id="customPrevBtn-{{$carouselId}}">
                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="19.1016" cy="19.3047" r="19.1016" fill="white"/>
                                        <circle cx="19.1016" cy="19.3047" r="18.1016" stroke="black" stroke-opacity="0.3" stroke-width="2"/>
                                        <path d="M16.9531 25.4637V20.9637H26.9881L27.0219 18.7025H16.9531V14.2137L11.3281 19.8387L16.9531 25.4637Z" fill="#243352"/>
                                    </svg>
                                </div>
                                <ul class="carousel-tool-dots" id="carousel-tool-dots-{{ $carouselId }}">
                                    @for($i=1;$i<=ceil(count($depoimentos)/3);$i++)
                                        <div class="custom-dots-destaque-in custom-dots-destaque-in-{{ $carouselId }}"></div>
                                    @endfor
                                </ul>
                                <div class="next" id="customNextBtn-{{$carouselId}}">
                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="19.1016" cy="19.1016" r="19.1016" transform="matrix(-1 0 0 1 38.7031 0)" fill="white"/>
                                        <circle cx="19.1016" cy="19.1016" r="18.1016" transform="matrix(-1 0 0 1 38.7031 0)" stroke="black" stroke-opacity="0.3" stroke-width="2"/>
                                        <path d="M21.75 25.2606V20.7606H11.715L11.6813 18.4994H21.75V14.0106L27.375 19.6356L21.75 25.2606Z" fill="#243352"/>
                                    </svg>
                                </div>
                            </div>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('default.index.index-mais-que-produtos')

    <script>
        $(document).ready(function () {
            $('.{{ $carouselId }}').owlCarousel({
                items: 3,
                margin: 0,
                nav: false,
                autoHeight:false,
                responsive: {
                    0: {
                        margin: 15,
                        items: 1,
                        dots: true,
                    },
                    992: {
                        margin: 50,
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
@endsection