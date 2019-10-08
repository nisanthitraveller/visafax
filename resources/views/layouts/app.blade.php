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
        <title>{{ config('app.name', 'VisaBadge') }} - @yield('title')</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('images/fav-icon.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
        @include('ga')
        
        <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
        <script src="{{ asset('js/google.js') }}" defer></script>
    </head>
    <body>
        <div id="app">
            @include('layouts.header')
            @yield('content')
            @include('layouts.footer')
        </div>
        
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/slick.min.js') }}" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="{{ asset(mix('js/visabadge.js')) }}" defer></script>
        <script type="text/javascript">
            var path = "{{ route('autocomplete') }}";
            $('input.typeahead').typeahead({
                source: function (query, process) {
                    var $this = this //get a reference to the typeahead object
                    return $.get(path, { query: query }, function (data) {
                        var options = [];
                        $this['map'] = {}; //replace any existing map attr with an empty object
                        $.each(data,function (i,val){
                            options.push(val.name);
                            $this.map[val.name] = val.id; //keep reference from name -> id
                        });
                        return process(options);
                    });
                },
                updater: function (item) {
                    var str3 = 'india';
                    var str3 = item.replace(" ", "-");
                    console.log('dsdsdsd' + str3);
                    if(str3 != '') {
                        window.location.href = "{{ url('/') }}/visa/" + str3.toLowerCase();
                        console.log(this.map[item],item); //access it here
                    }

                }
            });
        </script>
    </body>
</html>