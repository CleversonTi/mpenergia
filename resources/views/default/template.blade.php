@php
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $version = '?raddarAtt=' . md5(rand(1, 999999999));
    } else {
        $version = '?raddarAtt=' . md5('08/09/25 13:31');
    }
@endphp
<!doctype html>
<html lang="pt-br" data-ng-app="raddarSite">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="imagetoolbar" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--    Seo Html    -->
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}" />
    <meta name="keywords" content="{{ $seo['keywords'] }}" />
    <meta name="robots" content="index, follow">
    <meta property="og:site_name" content="{{ $seo['site_name'] }}">
    <meta property="og:locale" content="{{ $seo['lang'] }}">
    <meta property="og:url" content="{{ URL::current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:image" content="{{ $seo['image'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="article:author" content="{{ $seo['author'] }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $seo['title'] }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">

    <link rel="canonical" href="{{ URL::current() }}">

    <!--    Favicon     -->
    <link href="{{ $seo['favicon'] }}" rel="apple-touch-icon" type="image/png">
    <link href="{{ $seo['favicon'] }}" rel="icon" type="image/x-icon">
    <link href="{{ $seo['favicon'] }}" rel="shortcut icon" type="image/x-icon">

    <!--    Css     -->
    <link href="{{ URL::to('plugins/bootstrap-5.0.0-beta1/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('plugins/fontawesome-free-5.15.2/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('plugins/owlcarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('plugins/lightbox2/dist/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('default/css/custom.css') . $version }}" rel="stylesheet">

    <!--Preload Fonts-->
    <link rel="preload" href="{{ asset('default/fonts/DMSans18pt-Light.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('default/fonts/DMSans18pt-Regular.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('default/fonts/DMSans18pt-Medium.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('default/fonts/DMSans18pt-Bold.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('default/fonts/DMSans18pt-ExtraBold.woff2') }}" as="font"
        type="font/woff2" crossorigin>

    <!--    Js     -->
    <script src="{{ URL::to('plugins/jquery-3.5.1/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::to('plugins/owlcarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>


    <!-- Tag manager -->
    @if ($_SERVER['HTTP_HOST'] != 'localhost')
        {!! $config['tagHead'] !!}
    @endif

    <!--    BaseUrl     -->
    <base href="{{ substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'server.php')) }}">

</head>

<body data-ng-controller="MainController">

    @if (!empty($config['whatsapp']))
        <nn ng-init="$root.zapContato='{{ $config['whatsapp']['link'] }}'"></nn>
    @endif

    {{-- @include('default.includes.preloader') --}}

    <!-- Tag manager -->
    @if ($_SERVER['HTTP_HOST'] != 'localhost')
        {!! $config['tagBody'] !!}
    @endif

    <header>
        @include('default.includes.barra-lgpd')
        @include('default.includes.header')
    </header>

    <main>
        @yield('content')
        @include('default.includes.modal')
    </main>

    <footer>
        @include('default.includes.footer')

        @include('default.includes.botao-whatsapp')
        @include('default.includes.modal-whatsapp')
        @include('default.includes.barra-fixa-mobile')
        @include('default.includes.menu-mobile')
    </footer>

    <!--    Js      -->
    <script src="{{ URL::to('plugins/bootstrap-5.0.0-beta1/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('plugins/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ URL::to('plugins/lightbox2/dist/js/lightbox.min.js') }}"></script>
    <script src="{{ URL::to('default/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL::to('default/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::to('default/js/geral.js' . $version) }}"></script>
    <script src="{{ URL::to('default/js/carousel.js' . $version) }}"></script>
    <script src="{{ URL::to('default/js/lgpd.js' . $version) }}"></script>
    <script src="{{ URL::to('plugins/sweetalert2/sweetalert2.js') }}"></script>

    <!-- Angular -->
    <script src="{{ URL::to('plugins/angularjs-1.8.2/angular.min.js') }}"></script>
    <script src="{{ URL::to('plugins/angular-validate/dist/angular-validate.min.js') }}"></script>
    <script src="{{ URL::to('plugins/ng-file-upload/dist/ng-file-upload-shim.min.js') }}"></script>
    <script src="{{ URL::to('plugins/ng-file-upload/dist/ng-file-upload.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/checklist-model/1.0.0/checklist-model.min.js"></script>
    <script src="{{ URL::to('default/angularjs/modulo.js' . $version) }}"></script>
    <script src="{{ URL::to('default/angularjs/controllers/MainController.js' . $version) }}"></script>
    <script src="{{ URL::to('default/angularjs/controllers/EmailController.js' . $version) }}"></script>
</body>

</html>
