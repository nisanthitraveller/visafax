@extends('layouts.app')
@section('title')
Visa Payement
@endsection
@section('content')
<!-- style="background-image: url(images/hero-home.jpg);"-->
<section class="banner inner-payment" style="background-image: url({{url('/')}}/images/hero-home.png);">
    <div class="container">
        <div class="col-sm-12 pt-4 pb-4">
            <h2>Pay now to proceed verification</h2>
        </div>
    </div>
</section>

<section class="deals">
    <div class="container">
        @if($response['payStat'] == 'Payment Failed')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> Payment failed, please try later.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif($response['payStat'] == 'Payment Success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Please complete the process.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <h2>Lets us know your details</h2>
            <form method="POST" action="{{url('/')}}/applyvisa/step2/{{$bookingId}}" enctype="multipart/form-data" class="your-dts" id="formDetails">
                @csrf
                <div class="col-12 qstns">
                    <div class="row align-items-center q-row">
                        <div class="col-8 qs-in"><img src="{{url('/')}}/images/qs1.png">Have you booked your flights?</div>
                        <div class="col-4 text-right">
                            <div class="form-group">
                                <span class=" switch-sm">
                                    <input type="checkbox" class="change-color-switch" id="change-color-switch">
                                    <label for="switch-sm" class="book-state">Not booked</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-8 conf-dy" style="display: none;">
                            <div class="upload-btn-wrapper">
                                <div class="form-group">
                                    <label for="file" class="sr-only">File</label>
                                    <div class="input-group">

                                        <span class="input-group-btn">
                                            <div class="btn btn-default  custom-file-uploader">
                                                <input type="file" name="flightfile" onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''" />
                                                <span>Choose File</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row align-items-center q-row">

                        <div class="col-8 qs-in"><img src="{{url('/')}}/images/qs2.png">Have you booked your hotels?</div>
                        <div class="col-4 text-right">

                            <div class="form-group">

                                <span class=" switch-sm">
                                    <input type="checkbox" class="book-htls" id="book-htls">
                                    <label for="switch-sm" class="book-state">Not booked</label>
                                </span>
                            </div>

                        </div>
                        <div class="col-8 conf-dy-htl" style="display: none;">
                            <div class="upload-btn-wrapper">
                                <div class="form-group">
                                    <label for="file" class="sr-only">File</label>
                                    <div class="input-group">

                                        <span class="input-group-btn">
                                            <div class="btn btn-default  custom-file-uploader">
                                                <input type="file" name="hotelfile" onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''" />
                                                <span>Choose File</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-sm-12 text-center">
                <a href="#" onclick="$('#formDetails').submit()" class="cntue">Continue</a>
            </div>

        </div>
    </div>
</section>
<div class="modal fade popus" id="connect-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <img src="{{url('/')}}/images/modal-img.png">
                <h3>Your travel documents</h3>
                <p>We need your travel documents like flight tickets, hotel vouchers & passport copies to prepare your visa application. Can you share them now?</p>
                <div class="col-sm-12 logind-links">
                    <a href="#" onclick="$('#connect-modal').modal('hide');">No, not now</a>
                    <a href="#" onclick="$('#connect-modal').modal('hide');">Yes, I can</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(window).on('load', function () {
        $('#connect-modal').modal('show');
    });
</script>
@endsection
