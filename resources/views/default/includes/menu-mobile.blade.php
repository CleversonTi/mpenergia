<div class="menu-mobile" ng-class="{'aberto':abrirMobile}">
    <div class="container">
        <div class="fechar" ng-click="abrirMobile=!abrirMobile">
            <i class="far fa-times-circle"></i>
        </div>
        <a href="{{route('home')}}">
            <div class="logo">
                {!! $helpers->gerarImg($config['image_rodape'],true); !!}
            </div>
        </a>

        <ul>
            @foreach ($config['menu'] as $url)
            <li>
                <a href="{{$url['url']}}">
                    {{ $url['titulo'] }}
                </a>
            </li>
            @endforeach
            <li>
                <a href="{{route('politica-de-privacidade')}}">
                    Política de Privacidade
                </a>
            </li>
            <li>
                <a href="{{route('termos-de-uso')}}">
                    Termos de Uso
                </a>
            </li>
        </ul>

    </div>
</div>