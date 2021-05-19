<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

    <div id="shop">
        <Shop></Shop>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{asset('js/main.js')}}"></script>

</body>
</html>
