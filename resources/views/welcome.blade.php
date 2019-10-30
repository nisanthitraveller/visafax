@extends('layouts.app')
@section('title')
Apply visas
@endsection
@section('content')
<!-- style="background-image: url(images/hero-home.jpg);" -->
<section class="banner" style="background-image: url({{url('/')}}/images/hero-home.png);">
    <div class="container">
        <div class="col-sm-12">
            <div class="row align-items-center justify-content-center pt-5">
                <div class="card-body">
                    <h1>Your one-stop solution for visa to any country</h1>
                    <p>Prepare all your visa documents & submit online!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="search">
    <div class="container">
        <div class="col-12">
            <div class="button_box2"> <form class="form-wrapper-2 cf">
                    <form autocomplete="off" id="searchForm" method="post">
                        <input type="text" class="typeahead" placeholder="Which visa do you want?" required>
                        <button type="submit"><i class="fa fa-angle-right"></i></button>
                    </form>
            </div>
        </div>

        <div class="col-12 text-center oth-opt">
            <h3>Or choose from below</h3>
        </div>

    </div>
</section>
<section class="tabs-ch">
    <div class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs for-cntry" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#europe">Europe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#asia">Asia Pacific</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#america1">North America</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#africa">Africa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#america2">South America</a>
            </li>
            
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="asia" class="container tab-pane fade">
                <div class="row">
                    <?php $count = 1; ?>
                    @foreach($countries['Asia-Pacific'] as $country1)
                    <?php $class = $count <= 12 ? null : 'not-visible'; ?>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}" title="{{$country1['countryName']}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{str_replace(' ', '-', strtolower($country1['countryName']))}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country1['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{substr($country1['countryName'], 0, 15)}}</h4>
                                    <p>From ₹ {{number_format($country1['visa_cost'])}}</p>
                                </div></a>
                        </div>
                    </div>

                    <?php $count++; ?>
                    @endforeach
                </div>

            </div>

            <div id="africa" class="container tab-pane fade"><br>

                <div class="row">
                    <?php $count2 = 1; ?>
                    @foreach($countries['Africa'] as $country2)
                    <?php $class = $count2 <= 12 ? null : 'not-visible'; ?>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}" title="{{$country2['countryName']}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{str_replace(' ', '-', strtolower($country2['countryName']))}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country2['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{substr($country2['countryName'], 0, 15)}}</h4>
                                    <p>From ₹ {{number_format($country2['visa_cost'])}}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php $count2++; ?>
                    @endforeach
                </div>


            </div>
            <div id="america1" class="container tab-pane fade"><br>

                <div class="row">
                    <?php $count3 = 1; ?>
                    @foreach($countries['North-America'] as $country3)
                    <?php $class = $count3 <= 12 ? null : 'not-visible'; ?>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}" title="{{$country3['countryName']}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{str_replace(' ', '-', strtolower($country3['countryName']))}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country3['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{substr($country3['countryName'], 0, 15)}}</h4>
                                    <p>From ₹ {{number_format($country3['visa_cost'])}}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php $count3++; ?>
                    @endforeach
                </div>

            </div>
            <div id="america2" class="container tab-pane fade"><br>

                <div class="row">
                    <?php $count3 = 1; ?>
                    @foreach($countries['South-America'] as $country3)
                    <?php $class = $count3 <= 12 ? null : 'not-visible'; ?>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}" title="{{$country3['countryName']}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{str_replace(' ', '-', strtolower($country3['countryName']))}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country3['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{substr($country3['countryName'], 0, 15)}}</h4>
                                    <p>From ₹ {{number_format($country3['visa_cost'])}}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php $count3++; ?>
                    @endforeach
                </div>

            </div>
            <div id="europe" class="tab-pane active"><br>
                <div class="row">
                    <?php $count3 = 1; ?>
                    @foreach($countries['Europe'] as $country3)
                    <?php $class = $count3 <= 12 ? null : 'not-visible'; ?>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}" title="{{$country3['countryName']}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{str_replace(' ', '-', strtolower($country3['countryName']))}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country3['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{substr($country3['countryName'], 0, 15)}}</h4>
                                    <p>From ₹ {{number_format($country3['visa_cost'])}}</p>
                                </div></a>
                        </div>
                    </div>
                    <?php $count3++; ?>
                    @endforeach
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="ld-more">Load More...</a>

    </div>
</section>


<section class="intro">
    <div class="container">
        <div class="sm-div">
            <h3>What's VisaBadge?</h3>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12 intro-text"><img src="images/intro-img.png"></div>
                <div class="col-md-6 col-sm-6 col-12 intro-text pt-1">
                    <p>VisaBadge is a sleek online tool to simplify your visa document preparation, verification, submissions & stamping. On VisaBadge, you can submit your travel documents online and generate your completed application form, along with all the supporting documents, online. Instantly. You can also book your appointments with the Embassies & track the processing. Read more about us here.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wht-mke">
    <div class="container">
        <div class="bg-color">
            <h2>Why Visabadge?</h2>
            <div class="row mt-4">
                <div class="col-md-4 col-sm-12 wht-in">
                    <img src="images/ic1.png">
                    <h4>Fully Online</h4>
                </div>

                <div class="col-md-4 col-sm-12 wht-in">
                    <img src="images/ic2.png">
                    <h4>Instant & Convenient</h4>
                </div>

                <div class="col-md-4 col-sm-12 wht-in">
                    <img src="images/ic3.png">
                    <h4>Value For Money</h4>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="who-we">
    <div class="container">
        <div class="row">
            <h2>How it works?</h2>
            <div class="col-12">
                <p>Our endeavour has always been to make your visa applications simpler. At VisaBadge, we allow you to sign up & submit your travel documents like flight tickets, hotel vouchers etc, online. We verify them and prepare your visa documents like application forms, cover letters, NOCs etc. All of them shall be verified by you on VisaBadge.com, before we go ahead with the submissions at Embassy.</p>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 col-sm-12 wht-in">
                <img src="images/wh1.png">
                <h4>You submit your tickets, vouchers</h4>
            </div>

            <div class="col-md-4 col-sm-12 wht-in">
                <img src="images/wh2.png">
                <h4>VisaBadge prepares & verifies your application</h4>
            </div>

            <div class="col-md-4 col-sm-12 wht-in">
                <img src="images/wh3.png">
                <h4>Submit documents for Embassy approvals</h4>
            </div>
        </div>
    </div>
</section>

<section class="more-stories">
    <div class="container">
        <h2>Read more stories from us</h2>
        <div class="stories owl-carousel owl-theme">
            @if(!empty($feeds['items']))
            <?php $countFeed = 0; ?>
            @foreach($feeds['items'] as $feed)
            @if($countFeed <= 6)
            <?php
            $image = isset($feed['image']) ? $feed['image'] : secure_url('/') . "images/st1.jpg";
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
            @endforeach
            @endif
        </div>
    </div>

</section>
<section class="tstmnls">
    <div class="container">
        <h2>Listen to others</h2>
        <div class="bg-color">
            <div class="slider slider-nav">
                <div>
                    <img src="images/test1.jpg">
                    <div class="no_pic">SP</div>
                </div>
                <div>
                    <img src="images/test1.jpg">
                    <div class="no_pic">PG</div>
                </div>
                <div>
                    <img src="images/test1.jpg">
                    <div class="no_pic">AR</div>
                </div>
            </div>
            <div class="slider slider-for">
                <div>
                    <p>One of the major challenges in visa processing is the preparation of documents. VisaBadge makes is really a cake-walk. After submitting the documents online, I received all the documents on My Visas page, fully prepared. 100% hassle free.</p>
                    <h3>Sai Padmanabhan, New Delhi</h3>
                </div>
                <div>
                    <p>Did my Schengen visa application through VisaBadge and the process was quick and seamless. The entire bunch of documents needed was prepared instantly online and the interview process with Embassy was scheduled by VisaBadge directly. Strongly recommend them for making visa processing simpler.</p>
                    <h3>Priyank Gupta, Mumbai</h3>
                </div>
                <div>
                    <p>Availed end to end services from document preparation, verification, appointment booking, submissions and tracking from VisaBadge for my last trip to the UK. Everything was online, except the interview with the Embassy and found that the services are really competitive for the quality of experience. Strongly recommend to go with Visabadge!</p>
                    <h3>Aditya Raghavan, Bangalore</h3>
                </div>
            </div>
        </div>
    </div>
</section>
@if (!Auth::guest())
<div class="modal fade popus" id="connect-modal-user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <img src="{{url('/')}}/images/modal-img.png">
                <h3>Welcome back, {{Auth::user()->name}}!</h3>
                <p>Do you want to visit My Visas page to view your old visa applications or create a new visa application?</p>
                <div class="col-sm-12 logind-links">
                    <a href="javascript:void(0)" onclick="$('#connect-modal-user').modal('hide'); $('.typeahead').focus()">Get New Visa</a>
                    <a href="{{url('/')}}/dashboard">Go to My Visas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@if (!Auth::guest())
@section('scripts')
<script type="text/javascript">
    $(window).on('load', function () {
        $('#connect-modal-user').modal('show');
    });
</script>
@endsection
@elseif($dashboard == true)
    @section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#connect-modal').modal('show');
        });
    </script>
    @endsection
@endif
