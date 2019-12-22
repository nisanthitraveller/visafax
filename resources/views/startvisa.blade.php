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
                <h5 class="card-title text-center"><strong style="color: #282828">Passport Information</strong></h5>
                <p class="card-text">Please enter the data exactly as per passport</p>
                <form method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputPassport">Passport No.</label>
                        <input type="text" class="form-control" name="PassportNo" id="inputPassport" required="" placeholder="N12345">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email ID</label>
                            <input type="email" class="form-control" name="EmailID" id="inputEmail" required="" placeholder="Email ID">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Phone No</label>
                            <input type="text" class="form-control" name="PhoneNo" id="inputPhone" required="" placeholder="Mobile No.">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputSurname">Surname</label>
                            <input type="text" class="form-control" name="Surname" id="inputSurname" required="" placeholder="Surname">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputGiven">Given Name(s)</label>
                            <input type="text" class="form-control" name="FirstName" id="inputGiven" required="" placeholder="Given name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <textarea class="form-control" id="inputAddress" name="Address" required="" placeholder="1234 Main St"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNation">Nationality</label>
                            <input type="text" class="form-control" name="CountryOfBirth" required="" id="inputNation" placeholder="Indian">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputSex">Sex</label>
                            <select id="inputSex" name="Sex" required="" class="form-control">
                                <option selected value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="T">Transgender</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputDOB">Date of birth</label>
                            <input type="text" name="DOB" class="form-control datepicker" required="" id="inputDOB" placeholder="01/01/2000">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPOB">Place of Birth</label>
                            <input type="text" name="PlaceOfBirth" class="form-control" required="" id="inputPOB" placeholder="Bangalore, Karnataka">
                        </div>
<!--                        <div class="form-group col-md-6">
                            <label for="inputPOI">Place of Issue</label>
                            <input type="text" class="form-control" required="" id="inputPOI" placeholder="Bangalore">
                        </div>-->
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDOI">Date of Issue</label>
                            <input type="text" name="PassportDOI" class="form-control datepicker" required="" id="inputDOI" placeholder="01/01/2005">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputDOE">Date of Expiry</label>
                            <input type="text" name="PassportDOE" class="form-control datepicker" required="" id="inputDOE" placeholder="01/01/2020">
                        </div>
                    </div>
                    <div class="form-row pull-right">
                        <input name="visaType" value="{{$request['visaType']}}" type="hidden">
                        <input type="hidden" name="persons" value="{{$request['persons']}}" />
                        <input type="hidden" value="{{$request['vistingCountry']}}" name="vistingCountry">
                        <input type="hidden" value="{{$request['residenceCountry']}}" name="residenceCountry">
                        <button type="submit" class="btn btn-warning">Submit</button>
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
        $('.datepicker').datepicker();
        $('.datepicker').datepicker("option", "dateFormat", 'dd/mm/yy');
        //mixpanel.track('Page_2_Load');
    });
</script>
@endsection