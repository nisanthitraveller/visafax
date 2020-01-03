@extends('layouts.app')
@section('title')
My location
@endsection
@section('content')
<div class="container">
    <div class="card pt-1 m-4">
        <div class="card-body">
            <div id="mapholder"></div>
        </div>
        <div class="card-footer">
            <a href="#" class="btn btn-warning btn-block">Request Parking</a>
            <div class="md-col-12"><i class="fa fa-map-marker" aria-hidden="true"></i> 3 Drivers available</div>
            <div class="md-col-12"><i class="fa fa-inr" aria-hidden="true"></i> Only 60/- per hour</div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(window).on('load', function () {
        getLocation();
    });
</script>
<script>
    var x = document.getElementById("demo");
    function getLocation()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position)
    {
        console.log(position);
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        var latlon = new google.maps.LatLng(lat, lon)
        var mapholder = document.getElementById('mapholder')
        mapholder.style.height = '250px';
        mapholder.style.width = '100%';

        var myOptions = {
            center: latlon, zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL}
        };
        var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
        var marker = new google.maps.Marker({position: latlon, map: map, title: "You are here!"});
    }

    function showError(error)
    {
        switch (error.code)
        {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }
</script>
@endsection