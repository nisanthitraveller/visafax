<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="height=device-height, 
                      width=device-width, initial-scale=1.0, 
                      minimum-scale=1.0, maximum-scale=1.0, 
                      user-scalable=no, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <title>{{ config('app.name', 'VisaBadge') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
        @include('ga')
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        
    </head>
    <body>
        <div id="app">
            @include('layouts.header')
            @yield('content')
            @include('layouts.footer')
        </div>
        <script src="{{ asset(mix('js/visabadge.js')) }}" defer></script>
    </body>
</html>