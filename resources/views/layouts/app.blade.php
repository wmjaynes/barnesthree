<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

@if (env('APP_ENV') === 'prod')
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-29995131-3"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-29995131-3');
        </script>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BarnesThree') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">


</head>
<body>
<div class="container">

    <figure class="image">
        <img src="/images/greenbarnesheader-1200.jpg" class="img-fluid">
    </figure>
    <nav class="navbar">
        <div class="navbar-brand">
            <a id="navbar-about" class="navbar-item" href="{{ route('about') }}">About</a> <a id="navbar-dances"
                                                                                              class="navbar-item"
                                                                                              href="{{ route('dances') }}">Dances</a>
        </div>
    </nav>


    @yield('content')
</div>

<script>
    if (window.location.href.indexOf("about") > -1) {
        document.getElementById("navbar-about").classList.add('is-active');
    }
    if (window.location.href.indexOf("dances") > -1) {
        document.getElementById("navbar-dances").classList.add('is-active');
    }
</script>

</body>
</html>
