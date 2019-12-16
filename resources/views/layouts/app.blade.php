<?php
$requests = explode('/', Request::path());
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="height=device-height, 
                      width=device-width, initial-scale=1.0, 
                      minimum-scale=1.0, maximum-scale=1.0, 
                      user-scalable=no, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <meta name="google-signin-client_id" content="720640930504-5iie69aclsvbithnfr0hakfe0tuanptn.apps.googleusercontent.com">
        <meta name="google-site-verification" content="4WYUMGCZRrrmwc9spzf18mOu_Wrn3ROb-DhkhG-iecU" />
        <title>{{ config('app.name', 'VisaBadge') }} - @yield('title')</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('images/fav-icon.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        @include('ga')
        @if((isset($requests[1]) && $requests[1] == 'dashboard'))
        <script>
            gtag('event', 'conversion', {'send_to': 'AW-1054771783/B2KXCJbpzrIBEMeU-vYD'});
        </script>
        @endif
        <script src="{{ asset('js/google.js') }}" defer></script>
        @include('fs')
        @include('amplitude')
    </head>
    <body style="background: #fff !important">
        <div id="app">
            @include('layouts.header')
            @yield('content')
            @if(!isset($requests[1]) || (isset($requests[1]) && $requests[1] != 'payment'))
                @include('layouts.footer')
            @endif
            <a target="_blank" href="https://api.whatsapp.com/send?phone={{env('PHONE_NUM')}}&text=Hello VisaBadge" class="chat"><img src="{{url('images/whatsapp.png')}}" width="64" /></a>
        </div>
        
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/slick.min.js') }}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="{{ asset(mix('js/visabadge.js')) }}" defer></script>
        <script type="text/javascript">
            var path = "{{ route('autocomplete') }}";
            
        </script>
        <script src="https://apis.google.com/js/platform.js?onload=onLoadGoogleCallback" async defer></script>
        @yield('scripts')
        <!--<script type="text/javascript" src="https://botsrv.com/qb/widget/KlXDVbBYj7EYdgQL/8qJgArRo1AEdvoR9" async defer></script>-->
    </body>
</html>