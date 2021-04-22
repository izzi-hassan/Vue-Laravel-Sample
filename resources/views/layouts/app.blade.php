<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SparkHub') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="/css/app.css" rel="stylesheet">

        <link rel="stylesheet" href="/getmdl-select/getmdl-select.min.css">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body class="app">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=15755920103";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div id="vue-app">
            <top-bar></top-bar>
            <offcanvas-menu></offcanvas-menu>
            <!--
            <offcanvas-search></offcanvas-search>
            -->

            <announcement></announcement>
            <div class="off-canvas-content" data-off-canvas-content>
                <router-view></router-view>
            </div>
            <app-footer></app-footer>
            <snackbar></snackbar>
        </div>
        <script type="text/javascript" src="/js/manifest.js"></script>
        <script type="text/javascript" src="/js/vendor.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>