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

<section class="deals payment-screen">
    <div class="container">
        <form>
            <div class="col-sm-12 pay-wrap pay-active">

                <div class="row">
                    <div class="col-md-1 col-sm-1 col-6 chk-pay ">
                        <div class="md-checkbox">
                            <input id="vis" type="checkbox">
                            <label for="vis"></label>
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-2 col-6 text-right pay-set pl-1"><span class="py-price">₹1,500/-</span></div>

                    <div class="col-md-9 col-sm-9 col-12 vis-content pl-0 pr-0">

                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> <i class="pay-ic"><img src="{{url('/')}}/images/pic1.png"></i></div>


                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>Visa document preparation</h4>
                                <p>Assistance in preparing the documents, as per the requirements of the Embassy - the documents will be available on the dashboard, from where you can download or fetch as an email</p>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> <i class="pay-ic"><img src="{{url('/')}}/images/pic2.png"></i></div>


                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>Document verification</h4>
                                <p>All the documents relevant for the visa application will be verified & confirmed by our operations team to ensure that they are complete as per the standards</p>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> <i class="pay-ic"><img src="{{url('/')}}/images/pic3.png"></i></div>


                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>Support - on chat and mail</h4>
                                <p>Chat based support (10 AM to 6 PM, Mon to Fri), in clearing doubts, while preparing the visa documents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-sm-12 pay-wrap">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-6 chk-pay ">
                        <div class="md-checkbox">
                            <input id="em" type="checkbox">
                            <label for="em"></label>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-6 text-right pay-set pl-1"><span class="py-price">₹500/-</span></div>
                    <div class="col-md-9 col-sm-9 col-12 vis-content pl-0 pr-0">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> <i class="pay-ic"><img src="{{url('/')}}/images/pic4.png"></i></div>
                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>Embassy appointment</h4>
                                <p>Assistance in booking the appointment based on the preferred time slots, subject to availability</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-sm-12 pay-wrap">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-6 chk-pay ">
                        <div class="md-checkbox">
                            <input id="ded" type="checkbox">
                            <label for="ded"></label>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-6 text-right pay-set pl-1"><span class="py-price">₹500/-</span></div>
                    <div class="col-md-9 col-sm-9 col-12 vis-content pl-0 pr-0">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> <i class="pay-ic"><img src="{{url('/')}}/images/pic5.png"></i></div>
                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>Dedicated & personalised support - on phone</h4>
                                <p>Personalised and dedicated account manager support, between 10 to 6 PM, Mon to Fri, who can be accessed on phone, to clear any queries, doubts associated with the visa application process and filing.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-12 pay-wrap">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-6 chk-pay ">
                        <div class="md-checkbox">
                            <input id="sub" type="checkbox">
                            <label for="sub"></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-6 text-right pay-set pl-1"><span class="py-price">₹1,000/-</span></div>
                    <div class="col-md-9 col-sm-9 col-12 vis-content pl-0 pr-0">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> <i class="pay-ic"><img src="{{url('/')}}/images/pic6.png"></i></div>
                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>Submission at the Embassy</h4>
                                <p>Manual submission of documents at the Embassy, by VisaBadge person, on your behalf.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 pay-wrap">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-6 chk-pay ">
                        <div class="md-checkbox">
                            <input id="per" type="checkbox">
                            <label for="per"></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-6 text-right pay-set pl-1"><span class="py-price">₹3,000/-</span></div>
                    <div class="col-md-9 col-sm-9 col-12 vis-content pl-0 pr-0">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-2"> <i class="pay-ic"><img src="{{url('/')}}/images/pic7.png"></i></div>
                            <div class="col-md-11 col-sm-11 col-10">
                                <h4>Personalised assistance at Embassy</h4>
                                <p>Personal assistance at the Embassy, while visiting for document submission, personal interview or finger print scanning</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="col-sm-12 text-right">
            <a href="#" class="bck-btn">Go back</a>
            <a href="{{url('/')}}/applyvisa/step1/1234" class="cntue">Pay ₹2,000/-</a>
        </div>

    </div>
</section>
@endsection
