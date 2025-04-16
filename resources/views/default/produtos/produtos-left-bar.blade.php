<section class="produtos-left-bar">

    <form action="{{route('produtos')}}">

        <div class="box-search">
            <label for="product-search">O que você procura?</label>
            <div class="box-input-search">
                <input id='product-search' type="text" name="busca" value="{{$busca ?? ''}}" placeholder="Buscar nos produtos">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M19 19L13 13M1 8C1 8.91925 1.18106 9.82951 1.53284 10.6788C1.88463 11.5281 2.40024 12.2997 3.05025 12.9497C3.70026 13.5998 4.47194 14.1154 5.32122 14.4672C6.1705 14.8189 7.08075 15 8 15C8.91925 15 9.82951 14.8189 10.6788 14.4672C11.5281 14.1154 12.2997 13.5998 12.9497 12.9497C13.5998 12.2997 14.1154 11.5281 14.4672 10.6788C14.8189 9.82951 15 8.91925 15 8C15 7.08075 14.8189 6.1705 14.4672 5.32122C14.1154 4.47194 13.5998 3.70026 12.9497 3.05025C12.2997 2.40024 11.5281 1.88463 10.6788 1.53284C9.82951 1.18106 8.91925 1 8 1C7.08075 1 6.1705 1.18106 5.32122 1.53284C4.47194 1.88463 3.70026 2.40024 3.05025 3.05025C2.40024 3.70026 1.88463 4.47194 1.53284 5.32122C1.18106 6.1705 1 7.08075 1 8Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

            </div>
        </div>


        <div class="separator-line"></div>


        <label for="">Categorias</label>
        <ul class="categorias">
            <li class="produto-categoria {{ empty($categoria) && empty($subcategoria) ? 'active' : '' }}">
                <div class="categoria-in">
                    <a href="{{route('produtos')}}" class="link">Todos os produtos</a>
                </div>
            </li>
            @if(!empty($categoria))
                @php($c = $categoria)
                <li class="produto-categoria {{$categoria_atual == $c['id'] ? 'active' : ''}}">
                    <div class="categoria-in">
                        <a href="{{route('produtos-categorias', ['uri' => $c['uri']])}}" class="link {{!empty($c['filhas']) ? 'tem-filhas' : ''}}">{{$c['titulo']}}</a>
                    </div>
                    @if(!empty($c['filhas']))
                        <ul class="subcategorias">
                            @foreach($c['filhas'] as $keyIn=> $cIn)
                                <li class="subcategoria-in {{$subcategoria_atual == $cIn['id'] ? 'active' : ''}}">
                                    <a href="{{route('produtos-categorias', ['uri' => $c['uri'], 'uri2' => $cIn['uri']])}}" class="link">{{$cIn['titulo']}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>

            @endif
            @foreach($config['categorias'] as $key => $c)
                @if(!empty($categoria) && $c['id'] == $categoria['id'])
                    @continue
                @endif
                <li class="produto-categoria {{$categoria_atual == $c['id'] ? 'active' : ''}}">
                    <div class="categoria-in">
                        <a href="{{route('produtos-categorias', ['uri' => $c['uri']])}}" class="link {{!empty($c['filhas']) ? 'tem-filhas' : ''}}">{{$c['titulo']}}</a>
                    </div>
                    @if(!empty($c['filhas']))
                        <ul class="subcategorias">
                            @foreach($c['filhas'] as $keyIn=> $cIn)
                                <li class="subcategoria-in {{$subcategoria_atual == $cIn['id'] ? 'active' : ''}}">
                                    <a href="{{route('produtos-categorias', ['uri' => $c['uri'], 'uri2' => $cIn['uri']])}}" class="link">{{$cIn['titulo']}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>

            @endforeach
        </ul>

        @if(!empty($marcas))
            <div class="separator-line"></div>

            <label for="">Compre por marca</label>

            <div class="list-marcas">

                @foreach($marcas as $m)
                    <a href="{{route(empty($categoria) ? 'produtos' : 'produtos-categorias',[
                                'uri'=> $categoria['uri'] ?? null,
                                'uri2'=>$subcategoria['uri'] ?? null,
                                'busca'=>!empty($busca) ? $busca : null,
                                'marca'=>$m['uri']
                                ])}}"

                       class="{{empty($marca) || $marca_atual !== $m['id'] ? '' : 'active'}}">
                        {!! $helpers->gerarImg($m['logo'],true) !!}
                    </a>
                @endforeach

            </div>

        @endif


        @if(!empty($busca) || !empty($marca)|| !empty($subcategoria) || !empty($subcategoria))
            <a href="{{route('produtos')}}" class="main-cta limpar">
                <i class="fas fa-backspace"></i>
                Limpar filtros
            </a>
        @endif

    </form>
</section>
