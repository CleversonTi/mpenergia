<section class="produtos-left-bar">

    <form class="form-search" action="{{ $route_search ?? route(request()->route()->getName()) }}">
        <div class="box-search">
            <label for="product-search">O que você procura?</label>
            <div class="box-input-search">
                <input id='product-search' type="text" name="busca" value="{{$busca ?? ''}}" placeholder="Buscar no blog">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M19 19L13 13M1 8C1 8.91925 1.18106 9.82951 1.53284 10.6788C1.88463 11.5281 2.40024 12.2997 3.05025 12.9497C3.70026 13.5998 4.47194 14.1154 5.32122 14.4672C6.1705 14.8189 7.08075 15 8 15C8.91925 15 9.82951 14.8189 10.6788 14.4672C11.5281 14.1154 12.2997 13.5998 12.9497 12.9497C13.5998 12.2997 14.1154 11.5281 14.4672 10.6788C14.8189 9.82951 15 8.91925 15 8C15 7.08075 14.8189 6.1705 14.4672 5.32122C14.1154 4.47194 13.5998 3.70026 12.9497 3.05025C12.2997 2.40024 11.5281 1.88463 10.6788 1.53284C9.82951 1.18106 8.91925 1 8 1C7.08075 1 6.1705 1.18106 5.32122 1.53284C4.47194 1.88463 3.70026 2.40024 3.05025 3.05025C2.40024 3.70026 1.88463 4.47194 1.53284 5.32122C1.18106 6.1705 1 7.08075 1 8Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </form>


    <div class="separator-line"></div>

    <label for="">Categorias</label>
    @if(!empty($categorias))
        <ul class="categorias">
            <li class="produto-categoria {!! empty($categoria_atual) ? 'active' : '' !!}">
                <div class="categoria-in">
                    <a href="{{route('blog')}}" class="link">Todas publicações</a>
                </div>
            </li>
            @foreach($categorias as $key => $cat)
                <li class="produto-categoria {!! $cat['id'] == $categoria_atual ? 'active' : '' !!}">
                    <div class="categoria-in">
                        <a href="{{route( $route_categories ?? request()->route()->getName(),['categoria'=>$cat['uri']])}}" class="link">{!! $cat['titulo'] !!}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</section>