@if(!empty($breadcrumb))
    <section class="breadcrumb">
        @foreach($breadcrumb as $key => $page)
            @if($key==0)
                <a href="{{$page[1] ?? ''}}">{{$page[0] ?? ''}}</a>
            @else
                <a href="{{$page[1] ?? ''}}" class="{{($key+1)==count($breadcrumb) ? ' active ' : ''}}">
                    {{$page[0] ?? ''}}
                </a>
            @endif
            @if(($key+1)<count($breadcrumb))
                /
            @endif
        @endforeach
    </section>
@endif
