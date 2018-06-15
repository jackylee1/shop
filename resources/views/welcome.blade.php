<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel App</title>


    </head>
    <body>
        <div id="app">
            <div>
                @{{ message }}
            </div>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
