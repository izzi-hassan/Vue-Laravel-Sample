<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SparkHub') }}@yield('title')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="/css/app.css" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>

    <body class="onboarding">
        <div id="vue-onboarding">
            <div class="top-bar white-bg">
                <div class="top-bar-title">
                    <a href="/" title="Sparkhub - Inspired Living">
                        <img src="/images/shared/logo-dark.png" alt="SparkHub Logo" />
                    </a>
                </div>

                <div class="top-bar-right">
                    @yield('onboard-progress')
                </div>
            </div>

            <div class="row">
                <div class="small-12 columns static-header black-white-gradient single-border-top single-border-bottom"></div>
            </div>
            <div class="row onboarding-container-row align-center">
                <div class="small-12 medium-10 large-8 columns white-bg">
                    <div class="row align-center onboarding-container-inner">
                        <div class="row collapse">
                            <div class="small-12 medium-8 columns">
                                @yield('intro')
                            </div>
                            <div class="small-12 medium-4 columns">
                                <img class="avatar" title="{{ $user->name }}" src="{{ $authDetails->avatar }}">
                                <i class="fa fa-{{ $lastProvider }}"></i>
                            </div>
                        </div>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <div id="toast" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
        </div>

        <script type="text/javascript" src="/js/manifest.js"></script>
        <script type="text/javascript" src="/js/vendor.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>