@extends('layouts.app')
@section('title')
Visa Payement
@endsection
@section('content')
<!-- style="background-image: url(images/hero-home.jpg);"-->
<section class="banner inner-payment">
    <div class="container">
        <div class="col-sm-12 pt-4 pb-4">
            <h2>Pay now to proceed verification</h2>
        </div>

    </div>
</section>

<section class="deals">
    <div class="container">
        <div class="row">

            <h2>Lets us know your details</h2>

            <form class="your-dts">
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
                                                <input type="file" name="file" onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''" />
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

                            <div id="multipleupload">Choose File</div>
                        </div>

                    </div>

                </div>

            </form>

            <div class="col-sm-12 text-center">
                <a href="{{url('/')}}/applyvisa/step2/1234" class="cntue">Continue</a>
            </div>

        </div>
    </div>
</section>
@endsection
