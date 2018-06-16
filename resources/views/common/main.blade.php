<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>eVention Shop</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    </head>
    <body>
        <div id="app">
            <navbar></navbar>
            @yield('content')
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
