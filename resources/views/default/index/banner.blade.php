<section class="index-banner">
    @if(!empty($home['banner-desktop']))
        <div class="owl-carousel owl-banner hide-mobile">
            @foreach($home['banner-desktop'] as $item)
                @if(empty($item['link']))
                    {!! $helpers->gerarImg($item, true, '', false, 'consultoriaModal') !!}
                @else
                    {!! $helpers->gerarImg($item, true, '') !!}
                @endif
            @endforeach
        </div>
    @endif
    @if(!empty($home['banner-mobile']))
        <div class="owl-carousel owl-banner hide-desktop">
            @foreach($home['banner-mobile'] as $item)
                @if(empty($item['link']))
                    {!! $helpers->gerarImg($item, true, '', false, 'consultoriaModal') !!}
                @else
                    {!! $helpers->gerarImg($item, true, '') !!}
                @endif
            @endforeach
        </div>
    @endif
</section>