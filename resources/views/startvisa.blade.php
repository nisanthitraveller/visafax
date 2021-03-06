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
                    <span class="tb-name" style="top: -50px;">Start</span>
                </a>
            </li>
            <li>
                <a>
                    <span class="tb-name" style="top: -50px;">Upload Docs</span>
                </a>
            </li>
            <li>
                <a>
                    <span class="tb-name" style="top: -50px;">VisaBadge Verification</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="card pt-1 m-4">
            <div class="card-body">
                <h4 class="card-title m-0" style="font-size: 20px;"><strong style="color: #282828">Passport Information</strong></h4>
                <p class="card-text">Please enter the data exactly as per passport</p>
                <form method="post" id="comment" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputGiven">First Name</label>
                            <input type="text" class="form-control" name="FirstName" id="inputGiven" required="" placeholder="Eg: Rahul">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputSurname">Surname</label>
                            <input type="text" class="form-control" name="Surname" id="inputSurname" required="" placeholder="Eg: Sharma">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputSex" style="display: block">Gender</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline1" name="Sex" value="M" checked="">
                                <label class="custom-control-label" for="defaultInline1">Male</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline2" name="Sex" value="F">
                                <label class="custom-control-label" for="defaultInline2">Female</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputDOB">Date of birth</label>
                            <input type="text" name="DOB" class="form-control dob" style="box-shadow:none;" required="" id="inputDOB" placeholder="Select Date">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassport">Passport No.</label>
                            <input type="text" class="form-control" name="PassportNo" id="inputPassport" required="" placeholder="Eg: J1498476">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputDOE">Passport Expiry</label>
                            <input type="text" name="PassportDOE" class="form-control doe" style="box-shadow:none;" required="" id="inputDOE" placeholder="Select Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" name="Address" required="" placeholder="Enter your address exactly as per your passport" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email ID</label>
                            <input type="email" class="form-control" name="EmailID" id="inputEmail" required="" placeholder="email@example.com">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Phone No</label>
                            <input type="text" class="form-control" name="PhoneNo" id="inputPhone" required="" placeholder="Your 10 digit phone number">
                        </div>
                    </div>
                    <div class="text-right">
                        <input name="visaType" value="{{$request['visaType']}}" type="hidden">
                        <input type="hidden" name="persons" value="{{$request['persons']}}" />
                        <input type="hidden" value="{{$request['vistingCountry']}}" name="vistingCountry">
                        <input type="hidden" value="{{$request['residenceCountry']}}" name="residenceCountry">
                        <button type="submit" class="btn btn-warning" style="background-color: #ffdf00; color: #000; font-weight: bold">Confirm & Proceed</button>
                    </div>
                </form>
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
        $(".dob").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            maxDate: "-1d",
            yearRange: "-100:+0"
        });

        $(".doe").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            minDate: "+1d"
        });
        $('#comment').on('submit', function(e) {
            mixpanel.track('Confirm_Proceed');
            e.preventDefault();
            openModal();
            $.ajax({
                type: "POST",
                url: '/visa/<?=str_replace('', '-', strtolower($country['countryName']))?>',
                data: $(this).serialize(),
                success: function(msg) {
                    closeModal();
                    $('#connect-modal').modal('show');
                }
            });
        });
        
    });
</script>
@endsection