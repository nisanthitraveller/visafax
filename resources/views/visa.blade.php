@extends('layouts.app')
@section('title')
Visa {{$country['countryName']}}
@endsection
@section('content')
<!-- style="background-image: url(images/hero-home.jpg);"-->
<section class="banner inner-1">
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

<section class="deals">
    <div class="container">
        <div class="row">

            <h2>Lets us know your details</h2>

            <form class="your-dts" id="visaForm">

                <label>Country of residence</label>
                <input type="text" name="residenceCountry" value="India" placeholder="India" readonly>
                <br><br><br>
                <label>What type of visa you want?</label>

                <div class="col-12">
                    <div class="row">
                        <div class="radio">
                            <input id="radio-1" name="visaType" type="radio" value="Business">
                            <label for="radio-1" class="radio-label"><span>Business</span></label>
                        </div>

                        <div class="radio">
                            <input id="radio-2" name="visaType" type="radio" value="Tourist" checked>
                            <label  for="radio-2" class="radio-label"><span>Tourist</span></label>
                        </div>

                        <div class="radio">
                            <input id="radio-3" name="visaType" type="radio" value="Employment">
                            <label for="radio-3" class="radio-label"><span>Employment</span></label>
                        </div>
                        <div class="radio">
                            <input id="radio-4" name="visaType" type="radio" value="Student">
                            <label for="radio-4" class="radio-label"><span>Student</span></label>
                        </div>
                    </div>
                </div>


                <div class="col-12 qstns">
                    <div class="row align-items-center q-row">

                        <div class="col-8 qs-in"><img src="{{url('/')}}/images/qs3.png">How many persons are traveling?</div>
                        <div class="col-4 text-right">

                            <div class="input-group counter">
                                <input type="button" value="-" class="button-minus" data-field="persons">
                                <input type="number" step="1" max="" value="1" name="persons" class="quantity-field">
                                <input type="button" value="+" class="button-plus" data-field="persons">
                            </div>
                        </div>

                    </div>
                </div>
                <input type="hidden" value="{{$country['id']}}" name="vistingCountry">
            </form>

            <div class="col-sm-12 text-center">
                @guest
                    <a href="javascript:void(0)" onclick="$('#connect-modal').modal('show');" class="cntue">Continue</a>
                @else
                <a href="javascript:void(0)" id="create-visa" class="cntue">Continue</a>
                @endguest
            </div>

        </div>
    </div>
</section>

<div class="modal fade popus" id="connect-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <img src="{{url('/')}}/images/modal-img.png">
                <h3>Please login to contact you back</h3>
                <p>We’ll get back to you with the verification status and the further proceedures. So, please update the contact details and wait</p>
                <div class="col-sm-12 connect-links">
                    <div class="g-signin2" id="my-signin2" data-width="260" data-height="50" data-theme="light" data-longtitle="true" data-onsuccess="onSignIn"></div>
<!--                    <a href="#"><img src="{{url('/')}}/images/facebook.svg">Connect with Google</a>-->
                </div>
                <div class="form-field-cover g-login" style="display: none; margin-top: 30px;">
                    <input id="phone1" name="phone" type="number" required="" />
                    <label>Mobile no:</label>
                </div>
                <button class="btnlogin g-login" style="display: none" onclick="updateMobile()">Login</button>
                <div class="userContent" style="display: none;"></div>
            </div>



        </div>
    </div>
</div>
<div id="fade"></div>
<div id="loader-modal">
    <img src="{{url('/')}}/images/loading.gif">
</div>
@endsection