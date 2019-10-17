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
        </style>
        <script>
            var baseUrl = "{{url('/')}}";
        </script>

        @yield('headscript')
    </head>
    <body class="sidebar-mini">

        <div class="wrapper" id="app">
            <div class="sidebar" data-color="black" data-image="{{ asset('admin-template/assets/img/sidebar-4.jpg') }}">

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="{{ secure_url('/') }}" class="simple-text"><img src = "{{ secure_asset('/images/logo.png') }}" style="width: 116px" /></a>
                    </div>

                    <ul class="nav">
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
                $("#datepicker1, #datepicker2, .datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });
                
                jQuery('.dp3').datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeYear: true,
                    yearRange: '1900:<?=date('Y')?>',
                    maxDate: new Date,
                    onSelect: function () {
                    }
                });
                jQuery('.dp2').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeYear: true,
                    yearRange: '<?=date('Y')?>:2050',
                    onSelect: function () {
                    }
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
    @yield('scripts')

</html>