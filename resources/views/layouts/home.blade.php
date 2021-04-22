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

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        @yield('additional-assets')
    </head>
    <body class="home">
        <div id="vue-home">
            @include('pages._off-canvas')

            <div class="off-canvas-content" data-off-canvas-content>
                @include('pages._sticky-nav')

                @yield('content')

                @include('pages._footer')

                @include('pages._sticky-social')

                <div id="toast" class="mdl-js-snackbar mdl-snackbar">
                    <div class="mdl-snackbar__text"></div>
                    <button class="mdl-snackbar__action" type="button"></button>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/js/manifest.js"></script>
        <script type="text/javascript" src="/js/vendor.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
