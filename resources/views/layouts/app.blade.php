<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OUTIL-RH') }}</title>
    @yield('styles')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
</head>
<body class="app sidebar-mini">
 


  @include('layouts.partials.styles')

  @include('layouts.partials.sidebar')

   @yield('content')

  @include('layouts.partials.scripts')

  
 @yield('scripts')

</body>
</html>
