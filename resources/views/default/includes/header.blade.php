<section class="header">
    <div class="container big">
        <div class="row">
            <div class="offset-lg-1 col-lg-2">
                <a href="{{route('home')}}">
                    {!! $helpers->gerarImg($config['image_logo'], true, 'logo') !!}
                </a>
            </div>
            <div class="col-lg-8">

                <div class="header-row-1">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="row-ctas">
                                @include('default.includes.components.phone')
                                @include('default.includes.components.zap')
                            </div>
                        </div>
                        <div class="col-lg-5 mt-3 mt-lg-0">

                            <div class="row">
                                <div class="col-2 col-lg-6">
                                    @include('default.includes.components.cta-carrinho')
                                </div>
                                <div class="col-10 col-lg-6">
                                    @include('default.includes.components.cotacao')
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-2 mt-3 mt-lg-0">
                            <div class="box-redes">
                                @if(!empty($config['redes']['instagram']))
                                    <a href="{{$config['redes']['instagram']}}" class="box-rede-in">
                                        <div class="icon">
                                            <i class="fab fa-instagram"></i>
                                        </div>
                                    </a>
                                @endif
                                @if(!empty($config['redes']['facebook']))
                                    <a href="{{$config['redes']['facebook']}}" class="box-rede-in">
                                        <div class="icon">
                                            <i class="fab fa-facebook"></i>
                                        </div>
                                    </a>
                                @endif
                                @if(!empty($config['redes']['youtube']))
                                    <a href="{{$config['redes']['youtube']}}" class="box-rede-in">
                                        <div class="icon">
                                            <i class="fab fa-youtube"></i>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-row-2">

                    <ul class="menu-principal">
                        @foreach($config['menu'] as $item)
                            <li>
                                <a class="{{ $config['rota-atual'] == $item['url'] ? 'active' : '' }}" href="{{$item['url']}}">{{$item['titulo']}}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>

            </div>
        </div>
    </div>

    <div class="container big d-block d-lg-none">
        <div class="row">
            <div class="col">
                <form action="{{route('produtos')}}">
                    <div class="box-search">
                        <div class="box-input-search">
                            <input id='product-search' type="text" name="busca" value="{{$busca ?? ''}}" placeholder="Buscar nos produtos">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M19 19L13 13M1 8C1 8.91925 1.18106 9.82951 1.53284 10.6788C1.88463 11.5281 2.40024 12.2997 3.05025 12.9497C3.70026 13.5998 4.47194 14.1154 5.32122 14.4672C6.1705 14.8189 7.08075 15 8 15C8.91925 15 9.82951 14.8189 10.6788 14.4672C11.5281 14.1154 12.2997 13.5998 12.9497 12.9497C13.5998 12.2997 14.1154 11.5281 14.4672 10.6788C14.8189 9.82951 15 8.91925 15 8C15 7.08075 14.8189 6.1705 14.4672 5.32122C14.1154 4.47194 13.5998 3.70026 12.9497 3.05025C12.2997 2.40024 11.5281 1.88463 10.6788 1.53284C9.82951 1.18106 8.91925 1 8 1C7.08075 1 6.1705 1.18106 5.32122 1.53284C4.47194 1.88463 3.70026 2.40024 3.05025 3.05025C2.40024 3.70026 1.88463 4.47194 1.53284 5.32122C1.18106 6.1705 1 7.08075 1 8Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @if(!empty($categorias))
        <a href="" class="exibir-categorias-mobile" ng-click="openCategoriasMobile=!openCategoriasMobile">
            Linhas de produtos <i class="fas" ng-class="{'fa-chevron-down':!openCategoriasMobile,'fa-chevron-up':openCategoriasMobile}"></i>
        </a>
        <div class="header-row-3" ng-class="{'active':openCategoriasMobile}">
            <div class="container big">
                <div class="col-lg-10 offset-lg-1">
                    <ul class="categorias-principais">
                        @foreach($categorias as $item)
                            <li>
                                <a href="{{$item['url']}}">
                                    <span class="icon">{!! $helpers->gerarImg($item['icone-branco'],true) !!}</span>
                                    <span class="title-in">{{$item['titulo']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</section>