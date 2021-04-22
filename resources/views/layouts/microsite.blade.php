<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('additional-meta')

    <title>{{ config('app.name', 'SparkHub') }} - @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/microsite.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>

    @yield('additional-assets')
</head>
<body class="microsite {{ $slug }}" id="microsite-body">
    @include('pages.microsite._off-canvas')

    <div class="off-canvas-content" data-off-canvas-content>
        @include('pages.microsite._sticky-nav')
        <div class="row align-center align-middle collapse header" style="background-image: url('{{ $pageData->cover_image }}')">
            <div class="gradient-container small-12 columns">
                <div class="row align-center">
                    <div class="small-10 medium-9 columns" style="padding-top: 25vmin">
                        <h1>{!! $pageData->heading !!}</h1>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        @include('pages.microsite._footer')

        @include('pages._sticky-social')
    </div>
    <script type="text/javascript" src="/js/manifest.js"></script>
    <script type="text/javascript" src="/js/vendor.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/microsite.js"></script>
</body>
</html>
