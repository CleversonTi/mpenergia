@php
    $desk = $home['banner-desktop'] ?? [];
    $mob  = $home['banner-mobile'] ?? [];
@endphp
@if(!empty($home['banner-desktop']) || !empty($home['banner-mobile']))
<section id="banners" class="index-banner">
    <div id="bannerDesktop"
         class="owl-carousel owl-banner d-none d-md-block"
         data-role="desktop" aria-hidden="true">
        @foreach( count($desk) ? $desk : $mob as $b )
            @php
                $bg = $helpers->getImage($b['banner']['url'] ?? ($b['image']['url'] ?? ($b['url'] ?? '')));
            @endphp
            <div class="item-banner" @if($bg) style="background-image:url('{{ $bg }}')" @endif>
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-12 col-lg-7 content-banner">
                             @if(!empty($b['icone-banner']))
                                <div class="icon-none">
                                   
                                     {!! $helpers->gerarImg($b['icone-banner']??"",true,'icone-banner') !!}
                                </div>
                            @endif
                            @if(!empty($b['titulo-banner']))
                                <div class="banner-content title-text">{!! $b['titulo-banner'] !!}</div>
                            @endif
                            @if(!empty($b['descricao-banner']))
                                <div class="banner-content description-text">{!! $b['descricao-banner'] !!}</div>
                            @endif
                            @php
                                $ctaLink = !empty($b['link-botao-banner']) ? $b['link-botao-banner'] : '#';
                                $ctaText = !empty($b['texto-botao-banner']) ? $b['texto-botao-banner'] : 'Saiba mais';
                                @endphp


                                @if(!empty($b['link-botao-banner']) || !empty($b['texto-botao-banner']))
                                <div class="banner-cta mt-3 main-cta">
                                    <x-special-button class="red" :link="$ctaLink">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 0C15.342 0 20 4.41 20 9.5C20 14.504 15.447 18.442 10 18.442C8.83497 18.4428 7.67721 18.2585 6.57 17.896C6.106 18.346 5.947 18.499 4.962 19.449C4.252 19.985 3.584 20.167 2.987 19.829C2.385 19.489 2.204 18.827 2.327 17.955L2.727 15.636C0.99 14.002 0 11.842 0 9.5C0 4.41 4.657 0 10 0ZM10 1.4C5.414 1.4 1.4 5.2 1.4 9.5C1.4 11.545 2.312 13.428 3.92 14.83L3.94 14.847L4.237 15.105L4.17 15.495L4.032 16.299L3.995 16.513L3.71 18.171C3.69367 18.2827 3.68365 18.3952 3.68 18.508V18.603C3.68 18.6077 3.67933 18.6103 3.678 18.611C3.685 18.601 3.821 18.558 4.054 18.388L6.224 16.282L6.638 16.438C7.71349 16.839 8.85218 17.0439 10 17.043C14.716 17.043 18.6 13.683 18.6 9.5C18.6 5.201 14.586 1.4 10 1.4ZM5.227 7.813C5.42846 7.80564 5.62933 7.83896 5.81762 7.91098C6.00591 7.983 6.17776 8.09223 6.32288 8.23215C6.46801 8.37207 6.58344 8.53981 6.66228 8.72535C6.74113 8.91088 6.78176 9.11041 6.78176 9.312C6.78176 9.51359 6.74113 9.71312 6.66228 9.89865C6.58344 10.0842 6.46801 10.2519 6.32288 10.3918C6.17776 10.5318 6.00591 10.641 5.81762 10.713C5.62933 10.785 5.42846 10.8184 5.227 10.811C4.83892 10.7968 4.47146 10.6327 4.20191 10.3531C3.93237 10.0736 3.78176 9.70034 3.78176 9.312C3.78176 8.92366 3.93237 8.55045 4.20191 8.27088C4.47146 7.99131 4.83892 7.82718 5.227 7.813ZM10.225 7.813C10.4265 7.80564 10.6273 7.83896 10.8156 7.91098C11.0039 7.983 11.1758 8.09223 11.3209 8.23215C11.466 8.37207 11.5814 8.53981 11.6603 8.72535C11.7391 8.91088 11.7798 9.11041 11.7798 9.312C11.7798 9.51359 11.7391 9.71312 11.6603 9.89865C11.5814 10.0842 11.466 10.2519 11.3209 10.3918C11.1758 10.5318 11.0039 10.641 10.8156 10.713C10.6273 10.785 10.4265 10.8184 10.225 10.811C9.83692 10.7968 9.46946 10.6327 9.19991 10.3531C8.93037 10.0736 8.77976 9.70034 8.77976 9.312C8.77976 8.92366 8.93037 8.55045 9.19991 8.27088C9.46946 7.99131 9.83692 7.82718 10.225 7.813ZM15.222 7.813C15.4235 7.80564 15.6243 7.83896 15.8126 7.91098C16.0009 7.983 16.1728 8.09223 16.3179 8.23215C16.463 8.37207 16.5784 8.53981 16.6573 8.72535C16.7361 8.91088 16.7768 9.11041 16.7768 9.312C16.7768 9.51359 16.7361 9.71312 16.6573 9.89865C16.5784 10.0842 16.463 10.2519 16.3179 10.3918C16.1728 10.5318 16.0009 10.641 15.8126 10.713C15.6243 10.785 15.4235 10.8184 15.222 10.811C14.8339 10.7968 14.4665 10.6327 14.1969 10.3531C13.9274 10.0736 13.7768 9.70034 13.7768 9.312C13.7768 8.92366 13.9274 8.55045 14.1969 8.27088C14.4665 7.99131 14.8339 7.82718 15.222 7.813Z"
                                                fill="#023766" />
                                        </svg>
                                        {{ $ctaText }}
                                    </x-special-button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

   
    <div id="bannerMobile"
         class="owl-carousel owl-banner d-block d-md-none"
         data-role="mobile" aria-hidden="false">
        @foreach( count($mob) ? $mob : $desk as $b )
            @php
                $bg = $helpers->getImage($b['banner']['url'] ?? ($b['image']['url'] ?? ($b['url'] ?? '')));
            @endphp
            <div class="item-banner" @if($bg) style="background-image:url('{{ $bg }}')" @endif>
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-12 col-md-11">
                            @if(!empty($b['titulo-banner']))
                                <div class="banner-content title-text">{!! $b['titulo-banner'] !!}</div>
                            @endif
                            @if(!empty($b['descricao-banner']))
                                <div class="banner-content description-text">{!! $b['descricao-banner'] !!}</div>
                            @endif
                            @php
                                $ctaLink = !empty($b['link-botao']) ? $b['link-botao'] : '#';
                                $ctaText = !empty($b['texto-button']) ? $b['texto-button'] : 'Saiba mais';
                                @endphp

                                @if(!empty($b['link-botao']) || !empty($b['texto-button']))
                                <div class="banner-cta mt-3">
                                    <x-special-button class="red" :link="$ctaLink">
                                    {{ $ctaText }}
                                    </x-special-button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif


@push('scripts')
<script>
(function () {
  function init(el) {
    if (!el || $(el).hasClass('owl-loaded')) return;
    $(el).owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      dots: true,
      nav: false
    });
  }

  const mq = window.matchMedia('(min-width: 768px)');
  function sync() {
    const isDesk = mq.matches;
    const $desk = $('#bannerDesktop');
    const $mob  = $('#bannerMobile');

    $desk.attr('aria-hidden', !isDesk);
    $mob.attr('aria-hidden',  isDesk);

    if (isDesk) { init($desk); }
    else       { init($mob);  }
  }

  document.addEventListener('DOMContentLoaded', sync);
  // suporte a browsers antigos
  mq.addEventListener ? mq.addEventListener('change', sync) : mq.addListener(sync);
})();
</script>
@endpush
