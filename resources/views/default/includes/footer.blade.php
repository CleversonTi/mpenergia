<section class="footer">
    @if(!empty($config['unidades']))
    <div class="maps">
        @foreach($config['unidades'] as $unidade)
            {!! $unidade['iframe']??'' !!}
        @endforeach
    </div>
    @endif
    <div class="footer-in">

        <div class="container big">
            <div class="row">
                <div class="col-lg-4 offset-lg-1 order-1 order-lg-0">
                    <ul class="menu-footer-left">
                        @foreach($config['menu'] as $key => $item)
                            <li>
                                <a class="{{ $config['rota-atual'] == $item['url'] ? 'active' : '' }}" href="{{$item['url']}}">{{$item['titulo']}}</a>
                            </li>
                            @if($key==3)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 order-0 order-lg-1">
                    {!! $helpers->gerarImg($config['image_rodape'],true,'logo-rodape') !!}

                </div>
                <div class="col-lg-4 order-2">
                    <ul class="menu-footer-right">

                        @foreach($config['menu'] as $key => $item)
                            @if($key<4)
                                @continue
                            @endif
                            <li>
                                <a class="{{ $config['rota-atual'] == $item['url'] ? 'active' : '' }}" href="{{$item['url']}}">{{$item['titulo']}}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
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
                <div class="col-lg-10 offset-lg-1">
                    <div class="line-separator"></div>
                </div>
            </div>
        </div>
        @include("default.includes.copy")

    </div>

</section>
