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
            <div class="col-sm-12"> <h5>Upload first and last pages of everyones passport</h5></div>

            <div class="rows-in">
                <h4>Traveller 01</h4>
                <div class="row pl-4 pr-4">
                    <div class="col-md-6 col-sm-6 col-12"><span class="fl-text">First Page</span></div>
                    <div class="col-md-6 col-sm-6 col-12 text-right chse-2"><span class="fl-text">Last Page</span></div>
                </div>
            </div>

            <div class="rows-in">
                <h4>Traveller 02</h4>
                <div class="row pl-4 pr-4">
                    <div class="col-md-6 col-sm-6 col-12"><span class="fl-text">First Page</span></div>
                    <div class="col-md-6 col-sm-6 col-12 text-right chse-2"><span class="fl-text">Last Page</span></div>
                </div>
            </div>


            <div class="rows-in">
                <h4>Traveller 03</h4>
                <div class="row pl-4 pr-4">
                    <div class="col-md-6 col-sm-6 col-12"><span class="fl-text">First Page</span></div>
                    <div class="col-md-6 col-sm-6 col-12 text-right chse-2"><span class="fl-text">Last Page</span></div>
                </div>
            </div>


            <div class="rows-in no-border ">

                <div class="row ">
                    <div class="col-md-6 col-sm-6 col-12 add-more"><a href="#"><i class="fa fa-plus"></i> Add More People</a></div>

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