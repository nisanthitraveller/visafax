@extends('layouts.app')
@section('title')
Visa {{$country['countryName']}}
@endsection
@section('content')
<!-- style="background-image: url(images/hero-home.jpg);"-->
<section class="banner inner-1" style="background-image: url({{url('/')}}/images/hero-home.png);">
    <div class="container">
        <div class="col-sm-12">
            <div class="row align-items-center justify-content-center pt-4">

                <div class="col-9 cntry-ch cntry-selected">
                    <div class="media">
                        <a class="media-left" href="{{url('/')}}">
                            <img class="media-object" src="https://www.countryflags.io/{{$country['countryCode']}}/shiny/64.png" alt="{{$country['countryName']}}">

                            <div class="media-body">
                                <h4 class="media-heading">Applying visa for</h4>
                                <p>{{$country['countryName']}}</p>
                            </div>
                            <div class="media-body"><button>Change</button></div>

                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<div class="dasboard-detail-wrap">
    <div class="container">
        <ul class="tablist tab1">
            <li class="active">
                <a>
                    <span class="tb-name" style="top: -50px; width: 105px">Start my application</span>
                    <span class="tb-year">{{date('d M, y')}}</span>
                </a>
            </li>
            <li class="active">
                <a>
                    <span class="tb-name" style="top: -50px; width: 105px">Upload passport & payslip</span>
                    <span class="tb-year">{{date('d M, y')}}</span>
                </a>
            </li>
            <li class="active">
                <a>
                    <span class="tb-name" style="top: -50px; width: 105px">Save my information</span>
                    <span class="tb-year">{{date('d M, y')}}</span>
                </a>
            </li>

            <li>
                <a>
                    <span class="tb-name" style="top: -50px; width: 105px">View my documents</span>
                </a>
            </li>
            <li class="last">
                <a>
                    <span class="tb-name" style="top: -50px; width: 105px">Verification by VisaBadge</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="card pt-1 mt-4">
            <div class="card-body">
                <h5 class="card-title text-center"><strong style="color: #282828">Thank you</strong></h5>
                <p class="card-text">Thank you we will get back you soon</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade popus" id="connect-modal-signup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <img src="{{url('/')}}/images/modal-img.png">
                <h3>Sign up successful – please upload your travel documents</h3>
                <p>Thanks for signing up on VisaBadge. Now, please share your travel documents to prepare your visa application</p>
                <div class="col-sm-12 logind-links">
                    <a href="{{url('/')}}/dashboard">Upload My Travel Documents</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(window).on('load', function () {
        console.log('Event');
        $('.datepicker').datepicker();
        $('.datepicker').datepicker("option", "dateFormat", 'dd/mm/yy');
        //mixpanel.track('Page_2_Load');
    });
</script>
@endsection