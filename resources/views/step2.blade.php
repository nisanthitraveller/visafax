@extends('layouts.app')
@section('title')
Visa Payement
@endsection
@section('content')
<section class="banner inner-payment">
    <div class="container">
        <div class="col-sm-12 pt-4 pb-4">
            <h2>Pay now to proceed verification</h2>
        </div>

    </div>
</section>



<section class="deals pasp-up">
    <div class="container">
        <div class="row">

            <h2>Almost done, now upload your passport</h2>
            
            <form method="POST" action="{{url('/')}}/applyvisa/step3/{{$bookingId}}" enctype="multipart/form-data" class="your-dts" id="formDetails">
            @csrf
            <div class="col-12 qstns">
                <div class="row align-items-center q-row">

                    <div class="col-8 qs-in">Please share your offer letter of the company where you are currently employed</div>
                    <div class="col-8 conf-dy-htl">
                        <div class="upload-btn-wrapper">
                            <div class="form-group">
                                <label for="file" class="sr-only">File</label>
                                <div class="input-group">

                                    <span class="input-group-btn">
                                        <div class="btn btn-default  custom-file-uploader">
                                            <input type="file" name="offer_letter" onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''" />
                                            <span>Choose File</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center q-row">

                    <div class="col-8 qs-in">Please share your current residential address</div>
                    <div class="col-8 conf-dy-htl">
                        <div class="upload-btn-wrapper">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" id="address_proof"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12"> <h5>Upload first and last pages of everyones passport</h5></div>
            @foreach($visaDetails as $key => $visaDetail)
            <div class="rows-in">
                <h4>Traveller 0{{$key + 1}}</h4>
                <div class="row pl-4 pr-4">
                    <div class="col-md-6 col-sm-6 col-12">
                        <span class="fl-text">First Page</span>
                        <input type="file" name="firstpage[{{$key}}]" onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''" />
                    </div>
                    <div class="col-md-6 col-sm-6 col-12 text-right chse-2">
                        <span class="fl-text">Last Page</span>
                        <input type="file" name="lastpage[{{$key}}]" onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''" />
                    </div>
                </div>
            </div>
            @endforeach
            </form>
            <div class="rows-in no-border ">

                <div class="row ">
                    <!--<div class="col-md-6 col-sm-6 col-12 add-more"><a href="#"><i class="fa fa-plus"></i> Add More People</a></div>-->

                </div>
            </div>


            <div class="col-sm-12 text-center">
                <a href="{{url('/')}}/applyvisa/step1/1234" class="bck-btn">Back</a>
                <a href="{{url('/')}}/applyvisa/step2/1234" class="cntue">Continue</a>
            </div>

        </div>
    </div>
</section>
@endsection
