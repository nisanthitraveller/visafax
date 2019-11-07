<?php
$requests = explode('/', Request::path());
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="google-signin-client_id" content="720640930504-5iie69aclsvbithnfr0hakfe0tuanptn.apps.googleusercontent.com">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('images/fav-icon.png') }}">
        <script src="{{ asset('admin-template/assets/js/jquery-1.10.2.js') }}"></script>
        <script src="{{ asset('admin-template/assets/js/bootstrap.min.js') }}"></script>
        
        
        <link href="{{ asset('admin-template/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-template/assets/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-template/assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-template/assets/css/demo.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-template/assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-template/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-template/assets/css/exportcsv/buttons.dataTables.min.css') }}" rel="stylesheet">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link href="{{ asset('https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:400,700,300') }}" rel="stylesheet">
        <link href="{{ asset('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}" rel="stylesheet">
        @yield('styles')
        <style type="text/css">
            .card {padding: 15px}
            #fade {
                display: none;
                position:absolute;
                top: 0%;
                left: 0%;
                width: 100%;
                height: 100%;
                background-color: #ababab;
                z-index: 1001;
                -moz-opacity: 0.8;
                opacity: .70;
                filter: alpha(opacity=80);
            }

            #loader-modal {
                display: none;
                position: absolute;
                top: 45%;
                left: 45%;
                width: 64px;
                height: 64px;
                padding:30px 15px 0px;
                border: 3px solid #ababab;
                box-shadow:1px 1px 10px #ababab;
                border-radius:20px;
                background-color: white;
                z-index: 1002;
                text-align:center;
                overflow: auto;
            }
        </style>
        <script>
            var baseUrl = "{{url('/')}}";
        </script>
        <script src="{{ asset('js/googleadmin.js') }}" defer></script>
        @yield('headscript')
    </head>
    <body class="sidebar-mini">

        <div class="wrapper" id="app">
            <div class="sidebar" data-color="black" data-image="{{ asset('admin-template/assets/img/sidebar-4.jpg') }}">

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="{{ secure_url('/') }}" class="simple-text"><img src = "{{ secure_asset('/images/logo-reverse.png') }}" style="width: 116px" /></a>
                    </div>

                    <ul class="nav">
                        <li <?php if ($requests[1] == 'enquiries') { ?> class="active" <?php } ?> >
                            <a href="{{ secure_url('/') }}/bo/enquiries">
                                <p>Enquiries</p>
                            </a>
                        </li>
                        <li <?php if ($requests[1] == 'users') { ?> class="active" <?php } ?> >
                            <a href="{{ secure_url('/') }}/bo/users">
                                <p>Users</p>
                            </a>
                        </li>
                        <li <?php if ($requests[1] == 'bookings') { ?> class="active" <?php } ?> >
                            <a href="{{ secure_url('/') }}/bo/bookings">
                                <p>Bookings</p>
                            </a>
                        </li>
                        <li <?php if ($requests[1] == 'documenttypes') { ?> class="active" <?php } ?> >
                            <a href="{{ secure_url('/') }}/bo/documenttypes">
                                <p>Document Types</p>
                            </a>
                        </li>
                        <li <?php if ($requests[1] == 'countries') { ?> class="active" <?php } ?> >
                            <a href="{{ secure_url('/') }}/bo/countries">
                                <p>Countries</p>
                            </a>
                        </li>
                        <li <?php if ($requests[1] == 'pricingtypes') { ?> class="active" <?php } ?> >
                            <a href="{{ secure_url('/') }}/bo/pricingtypes">
                                <p>Pricing Master</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
               <!-- <nav class="navbar navbar-default navbar-fixed">-->
                    <div class="container-fluid">
                    <!--  <div class="navbar-header">

                            <a class="navbar-brand" >Admin Console</a>
                        </div>-->
                        <div class="collapse navbar-collapse">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Links
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Bookings</a></li>
                                        <li><a href="">Payments</a></li>
                                    </ul>
                                <li>
                                    <a href="logout">
                                        Log out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
            <!--  </nav> -->


                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>


                <footer class="footer">
                    <div class="container-fluid">
                        <p class="copyright pull-right">
                            &COPY; {{date('Y')}} - All rights reserved.
                        </p>
                    </div>
                </footer>

            </div>
        </div>


    </body>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('admin-template/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-template/assets/js/bootstrap-checkbox-radio-switch.js') }}"></script>
    <script src="{{ asset('admin-template/assets/js/chartist.min.js') }}"></script>
    <script src="{{ asset('admin-template/assets/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('admin-template/assets/js/light-bootstrap-dashboard.js') }}"></script>
    <script src="{{ asset('admin-template/assets/js/demo.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.js') }}"></script>
    <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="popover"]').popover();
                $(".datepicker").datepicker({
                    dateFormat: 'dd/mm/yy',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
                
                $(".datepicker2").datepicker({
                    dateFormat: 'dd/mm/yy',
                    changeMonth: true,
                    changeYear: true,
                    minDate: "+1d"
                });
                
                $(".datepicker3").datepicker({
                    dateFormat: 'dd/mm/yy',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-30:+30"
                });

                $(document).on('click', function (e) {
                    $('[data-toggle="popover"],[data-original-title]').each(function () {
                        //the 'is' for buttons that trigger popups
                        //the 'has' for icons within a button that triggers a popup
                        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                            (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false;  // fix for BS 3.3.6
                        }

                    });
                });
                
                $('#listTable').DataTable({"pageLength": 100});

            });
            
            $(window).load(function () {
                if($("textarea").length > 0){
                    CKEDITOR.replace( 'editor1' );
                    CKEDITOR.replace( 'editor2' );
                }
            });
            
    </script>
    <script>
        $('.datetimepicker').datetimepicker({
            format: 'Y-m-dPH:i:00'
        });
    </script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    @yield('scripts')

</html>