@extends('layouts.app')

@section('content')
<!-- style="background-image: url(images/hero-home.jpg);" -->
<section class="banner">
    <div class="container">
        <div class="col-sm-12">
            <div class="row align-items-center justify-content-center pt-5">
                <div class="card-body">
                    <h1>Go, like in your dream</h1>
                    <p>Get solutions for all your visa related issues</p>
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
                        <input type="text" class="typeahead" placeholder="Where you want to go?" required>
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
                <a class="nav-link active" data-toggle="tab" href="#asia">Asia Pacific</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#africa">Africa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#america1">North America</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#america2">South America</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#europe">Europe</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="asia" class=" tab-pane active">
                <div class="row">
                    <?php $count = 1; ?>
                    @foreach($countries['Asia-Pacific'] as $country1)
                    <?php $class = $count <= 12 ? null : 'not-visible'; ?>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{strtolower($country1['countryName'])}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country1['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{$country1['countryName']}}</h4>
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
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{strtolower($country2['countryName'])}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country2['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{$country2['countryName']}}</h4>
                                    <p>From ₹ {{number_format($country2['visa_cost'])}}</p>
                                </div></a>
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
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{strtolower($country3['countryName'])}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country3['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{$country3['countryName']}}</h4>
                                    <p>From ₹ {{number_format($country3['visa_cost'])}}</p>
                                </div></a>
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
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{strtolower($country3['countryName'])}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country3['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{$country3['countryName']}}</h4>
                                    <p>From ₹ {{number_format($country3['visa_cost'])}}</p>
                                </div></a>
                        </div>
                    </div>

                    <?php $count3++; ?>
                    @endforeach
                </div>


            </div>
            <div id="europe" class="container tab-pane fade"><br>

                <div class="row">
                    <?php $count3 = 1; ?>
                    @foreach($countries['Europe'] as $country3)
                    <?php $class = $count3 <= 12 ? null : 'not-visible'; ?>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch {{$class}}">
                        <div class="media">
                            <a class="media-left" href="{{ url('/') }}/visa/{{strtolower($country3['countryName'])}}">
                                <img class="media-object" src="https://www.countryflags.io/{{strtolower($country3['countryCode'])}}/shiny/64.png" alt="{{$country1['countryName']}}">

                                <div class="media-body">
                                    <h4 class="media-heading">{{$country3['countryName']}}</h4>
                                    <p>From ₹ {{number_format($country3['visa_cost'])}}</p>
                                </div></a>
                        </div>
                    </div>

                    <?php $count3++; ?>
                    @endforeach
                </div>


            </div>

        </div>

        <a href="javascript:void(0)" class="ld-more">Loading More...</a>

    </div>
</section>


<section class="intro">
    <div class="container">
        <div class="sm-div">
            <h3>Why visafax?</h3>

            <div class="row">

                <div class="col-md-6 col-sm-6 col-12 intro-text"><img src="images/intro-img.png"></div>
                <div class="col-md-6 col-sm-6 col-12 intro-text pt-1">
                    <p>We, at visafax, know and adhere to the fact that holidays and vacations are a time for a change; to be out and about exploring new places, meeting new people and just soaking in the good times. An international holiday trip that you have been planning for years to come gives you access to this.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wht-mke">
    <div class="container">
        <div class="bg-color">
            <h2>What make us different?</h2>

            <div class="row mt-4">
                <div class="col-md-4 col-sm-12 wht-in">
                    <img src="images/ic1.png">
                    <h4>Simple</h4>
                </div>

                <div class="col-md-4 col-sm-12 wht-in">
                    <img src="images/ic2.png">
                    <h4>Instant</h4>
                </div>

                <div class="col-md-4 col-sm-12 wht-in">
                    <img src="images/ic3.png">
                    <h4>Low cost</h4>
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
                <p>We, at visafax, know and adhere to the fact that holidays and vacations are a time for a change; to be out and about exploring new places, meeting new people and just soaking in the good times.</p>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 col-sm-12 wht-in">
                <img src="images/wh1.png">
                <h4>Give details</h4>
            </div>

            <div class="col-md-4 col-sm-12 wht-in">
                <img src="images/wh2.png">
                <h4>Verify documents</h4>
            </div>

            <div class="col-md-4 col-sm-12 wht-in">
                <img src="images/wh3.png">
                <h4>Receive visa</h4>
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
            @if($countFeed <= 2)
            <?php
            $image = isset($feed['image']) ? $feed['image'] : secure_url('/') . "images/st1.jpg";
            ?>

            <div class="item" onclick="location.href ='{{$feed['url']}}'">
                <img src="{{$image}}" alt="{{$feed['title']}}" />
                <div class="item-content">
                    <h4>{{$feed['title']}}</h4>
                    <p>{{substr($feed['content_text'], 0, 150)}}<a href="{{$feed['url']}}">Read More</a></p>
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
                <div><img src="images/test1.jpg"></div>
                <div><img src="images/test1.jpg"></div>
                <div><img src="images/test1.jpg"></div>

            </div>
            <div class="slider slider-for">
                <div>
                    <p>Personalised attention, responsible behaviour & utmost honesty from a travel agent is something of a myth like most of us might have experienced. Well, our experience with visafax, right from the very first interaction was very professional and supporting!</p>
                    <h3>Robert Kart  |  Citizen, Canada</h3>
                </div>
                <div>
                    <p>test content 2</p>
                    <h3>James Bond  |  Citizen, USA</h3>
                </div>
                <div>
                    <p>test 3</p>
                    <h3>Peter Scott  |  Citizen, India</h3>
                </div>
            </div>



        </div>
    </div>
</section>
@endsection
