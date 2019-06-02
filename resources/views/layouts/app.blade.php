<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BarnesThree') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



</head>
<body>
    <div class="container">

        <figure class="image">
            <img src="/images/greenbarnesheader-1200.jpg" class="img-fluid">
        </figure>
        <nav class="navbar">
            <div class="navbar-brand">
                <a class="navbar-item active" href="{{ route('about') }}">About</a>
                <a class="navbar-item" href="{{ route('dances') }}">Dances</a>
            </div>
        </nav>



        @yield('content')
    </div>

</body>
</html>
