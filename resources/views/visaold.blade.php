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
                <li>
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Start my application</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Update passport Information</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Save my information</span>
                        <span class="tb-year"></span>
                    </a>
                </li>

                <li>
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">View my documents</span>
                    </a>
                </li>
                <li class="last">
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Verify by VisaBadge</span>
                    </a>
                </li>
            </ul>
    </div>

    <div class="inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 mt-4  dashboard-wrap">
                    <div class="row mb-2 ">
                        <div class="col-md-12 col-sm-12 col-12 doc-block">
                            <h2>Start your visa application</h2>
                            <p>Here you can start your visa processing. Choose a country and on the next page, you will have more details on the visa processing & documents needed</p>
                        </div>
                    </div>

                    <form class="your-dts page-detail" method="post" id="visaForm" action="{{url('/')}}/visa-details/{{str_replace('', '-', strtolower($country['countryName']))}}-visa">
                        @csrf
                        <div class="row">
                            <div class="col-xl-5 col-md-5 col-sm-4 col-6 data-colt ">

                                <label>What type of visa you want?</label>
                                <div class="radio">
                                    <input id="radio-1" name="visaType" value="Business" type="radio" checked>
                                    <label for="radio-1" class="radio-label"><span>Business</span></label>
                                </div>
                                <div class="radio">
                                    <input id="radio-2" name="visaType" value="Tourist" type="radio">
                                    <label for="radio-2" class="radio-label"><span>Tourist</span></label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-4 col-6 data-colt">

                                <label>No of travellers</label>
                                <div class="quantity buttons_added counter input-group">
                                    <input type="button" value="-" class="minus button-minus" data-field="persons">
                                    <input type="number" step="1" min="1" max="" name="persons" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                    <input type="button" value="+" class="plus button-plus" data-field="persons">
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 col-sm-4 col-12 data-colt">
                                <label>Country of residence</label>
                                <select class="selectpicker" name="residenceCountry">
                                    <option value="India">India</option>
                                </select>
                                <input type="hidden" value="{{$country['id']}}" name="vistingCountry">
                            </div>
                        </div>
                    </form>

                    <div class="col-sm-12 text-center down-bnch  mb-5">
                        <a href="javascript:void(0)" onclick="mixpanel.track('Start_My_Visa'); $('#visaForm').submit()" class="cntue" style="background-color: #ffdf00; color: #000;">Show More Details</a>
                    </div>
                    <div class="sm-sections">
                        <h2>A quick guide about {{$country['countryName']}} visa process</h2>
                        <p>Here you find a quick, but comprehensive summary of items to be noted as part of your visa application to {{$country['countryName']}}.</p>
                    </div>
                    <div class="sm-sections mt-3 mb-4 row">

                        <div class="col-xl-6 col-md-6 col-sm-6 tab-menu pl-0">

                            <a href="#th-know"><i class="icon-img"><img src="{{url('/')}}/images/tb-ic1.png"></i>Things to know</a>
                            <a href="#checklist"><i class="icon-img"><img src="{{url('/')}}/images/tb-ic2.png"></i>Visa document checklist</a>
                            <a href="#faq"><i class="icon-img"><img src="{{url('/')}}/images/tb-ic3.png"></i>Frequently asked questions</a>
                            <a href="#stories"><i class="icon-img"><img src="{{url('/')}}/images/tb-ic4.png"></i>Stories to read</a>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6 tab-img pr-0">
                            <img src="{{url('/')}}/images/img-read.jpg">
                        </div>
                    </div>
                    <div class="sm-sections mt-3 mb-4 row content-tabs" id="th-know">
                        <h2>Know everything about {{$country['countryName']}} visa process</h2>
                        <p>The below is a comprehensive summary of items that comes handy while you start preparing your {{$country['countryName']}} visa application.</p>
                        <div class="col-xl-12 col-md-12 col-sm-12 tab-img pr-0 pl-0">
                            <img src="{{url('/')}}/images/img-read1.jpg">
                        </div>
                        <div style="width: 100%">&nbsp;</div>
                        <?php echo ($country['description']) ?>
                    </div>
                    <div class="sm-sections mt-0 mb-4 row content-tabs" id="checklist">
                        <h2>{{$country['countryName']}} Visa Document Checklist</h2>
                        <p>Here we have tried summarising the key documents to be prepared while applying for your visa for {{$country['countryName']}}. </p>
                        <div class="col-xl-12 col-md-12 col-sm-12 tab-img pr-0 pl-0">
                            <img src="{{url('/')}}/images/img-read3.jpg">
                        </div>
                        <div style="width: 100%">&nbsp;</div>
                        <?php echo ($country['description2']) ?>
                    </div>
                    <div class="sm-sections mt-0 mb-4 row content-tabs" id="faq">
                        <h2>FAQs on {{$country['countryName']}} Visa Processing</h2>
                        <p>We understand that you may have many questions in mind, before you apply for your visa. Some of them may get answered below. For any more queries, write or call us,</p>
                        <div class="col-xl-12 col-md-12 col-sm-12 tab-img pr-0 pl-0">
                            <img src="{{url('/')}}/images/img-read4.jpg">
                        </div>
                        <div style="width: 100%">&nbsp;</div>
                        <?php echo ($country['description3']) ?>
                        <h2 class="social-head">Still having queries? Connect on WhatsApp or Mail</h2>
                        <div class="col-12 fur-cnt mb-4">
                            <div class="row">
                                <a href="mailto:hello@visabadge.com" ><i class="ic-cnt"><img src="{{url('/')}}/images/enve.png"></i>hello@visabadge.com</a>
                                <a href="https://wa.me/+91 999 5020 746" ><i class="ic-cnt"><img src="{{url('/')}}/images/whats.png"></i>+91 999 5020 746</a>
                            </div>
                        </div>
                        <div class="col-12 more-slider mb-3" id="stories">
                            <div class="row">

                                <h4>Read More on {{$country['countryName']}} Visa Process</h4>
                                <p>Some of our experts have compiled a lot more information that you may find useful, that contain varied nuances how things work with visa application, submission, Embassies and immigration centers. Please find them below in our blog.</p>

                                <div class="stories owl-carousel owl-theme">
                                    @if(!empty($feeds['items']))
                                    <?php $countFeed = 0; ?>
                                    @foreach($feeds['items'] as $feed)
                                    @if(strpos($feed['title'], $country['countryName']) !== false || strpos($feed['content_text'], $country['countryName']) !== false)
                                    @if($countFeed <= 6)
                                    <?php
                                    $image = isset($feed['image']) ? $feed['image'] : url('/') . "/images/st1.jpg";
                                    ?>

                                    <div class="item" onclick="location.href ='{{$feed['url']}}'">
                                        <img src="{{$image}}" alt="{{$feed['title']}}" />
                                        <div class="item-content">
                                            <h4>{{$feed['title']}}</h4>
                                            <p>{{substr($feed['content_text'], 0, 150)}}&nbsp;&nbsp;&nbsp;<a href="{{$feed['url']}}">Read More</a></p>
                                        </div>
                                    </div>
                                    <?php $countFeed++; ?>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
        mixpanel.track('Page_2_Load');
    });
</script>
@endsection