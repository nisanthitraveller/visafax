@extends('layouts.app')
@section('title')
Visa Payment
@endsection
@section('content')
<!-- style="background-image: url(images/hero-home.jpg);"-->
<section class="banner inner-payment" style="background-image: url({{url('/')}}/images/hero-home.png);">
    <div class="container">
        <div class="col-sm-12 pt-4 pb-4">
            <h2>Make payment</h2>
            <p>Your visa application is ready to review – please make payment, before you proceed!</p>
        </div>

    </div>
</section>

<section class="deals payment-screen">
    <div class="container">
        <div class="col-sm-12 text-justify card" style="padding: 10px; margin-bottom: 10px; background-color: #fafafa; color: #2d49a2">
            We’ve prepared your visa documents and it’s ready to be reviewed by you. To start reviewing them, please choose the preferred services from below and make payment.
        </div>
        <form>
            @foreach($countryPrices as $key => $countryPrice)
            <div class="col-sm-12 pay-wrap">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-6 chk-pay ">
                        <div class="md-checkbox">
                            @if($key == 0)
                                <input type="hidden" name="plan_id[]" value="{{$countryPrice['plan_id']}}" />
                                <input id="em{{$countryPrice['plan_id']}}" checked="" data-price="{{$countryPrice['price']}}" readonly="" disabled="" class="price-check" value="{{$countryPrice['plan_id']}}" type="checkbox">
                            @else
                                <input name="plan_id[]" id="em{{$countryPrice['plan_id']}}" data-price="{{$countryPrice['price']}}" class="price-check" value="{{$countryPrice['plan_id']}}" type="checkbox">
                            @endif
                            <label for="em{{$countryPrice['plan_id']}}"></label>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-6 text-right pay-set pl-1"><span class="py-price">₹{{number_format($countryPrice['price'])}}/-</span></div>
                    <div class="col-md-9 col-sm-9 col-12 vis-content pl-0 pr-0">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> 
                                <i class="pay-ic">
                                    @if(empty($countryPrice['master']['icon']))
                                        <img src="{{url('/')}}/images/pic4.png">
                                    @else
                                        <img src="{{url('/')}}/uploads/{{$countryPrice['master']['icon']}}">
                                    @endif
                                </i>
                            </div>
                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>{{$countryPrice['master']['title']}}</h4>
                                <p>{{strip_tags($countryPrice['master']['description'])}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </form>

        <div class="col-sm-12 text-right pay-last-btn">
            <div class="container">
                <form  method="post" name="PayUTransaction" id="PayUTransaction" class="formPay">
                    <input name="amount" type="hidden" id="amount" value="1500"/>
                    <input name="amount1" type="hidden" id="amount1" value="1"/>
                    <input name="persons" type="hidden" id="persons" value="{{count($booking['child']) + 1}}"/>
                    <input name="udf1" type="hidden" id="udf1" value=""/>
                    <input name="udf2" type="hidden" id="udf2" value="{{$payLater}}"/>
                    <input name="txnid" type="hidden" id="reference_no" value="{{$booking['BookingID']}}"/>
                    <input name="key" type="hidden" id="description" value="kjLO4t"/>
                    <input type="hidden" name="firstname" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                    <input type="hidden" name="productinfo" value="VB Payment" >
                    <input type="hidden" name="surl" value="{{url('/')}}/applyvisa/step1/{{$bookingId}}">
                    <input type="hidden" name="furl" value="{{url('/')}}/applyvisa/step1/{{$bookingId}}">
                </form>
                <a href="#" class="bck-btn no-bg">Go back</a>
                @if(!empty($countryPrices))
                    @if($payLater == true)
                        <a href="{{url('/')}}/applyvisa/step1/{{$bookingId}}" class="bck-btn">Pay later</a>
                    @endif
                    <a href="javascript: void(0)" id="pay-button" data-href="{{url('/')}}/applyvisa/step1/{{$bookingId}}" class="cntue">Pay ₹1,500/- <span style='font-size: 12px'>{{count($booking['child']) + 1}} person(s)</span></a>
                @endif
            </div>
        </div>
    </div>
    <div id="submitpayment" style="display: none"></div>
</section>
@endsection
