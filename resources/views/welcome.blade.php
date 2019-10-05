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
                <form autocomplete="off">
                    <input type="text" placeholder="Where you want to go?" required>
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
                <a class="nav-link active" data-toggle="tab" href="#asia">Asia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#africa">Africa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#australia">Australia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#america">America</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#europe">Europe</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="asia" class=" tab-pane active">
                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt1.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Albania</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt2.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Iceland</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt3.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Italy</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt4.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">North Macedonia</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt5.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">San Marino</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt6.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Sweden</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt7.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Turkey</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt8.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Ukraine</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt9.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">United Kingdom</h4>
                                    <p>From ₹ 9000</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt10.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Scotland</h4>
                                    <p>From ₹ 2,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt11.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Luxembourg</h4>
                                    <p>From ₹ 3,100</p>
                                </div></a>
                        </div>
                    </div>


                </div>

            </div>



            <div id="africa" class="container tab-pane fade"><br>

                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt1.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Albania</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt2.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Iceland</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt3.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Italy</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt4.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">North Macedonia</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt5.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">San Marino</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt6.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Sweden</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt7.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Turkey</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt8.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Ukraine</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt9.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">United Kingdom</h4>
                                    <p>From ₹ 9000</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt10.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Scotland</h4>
                                    <p>From ₹ 2,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt11.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Luxembourg</h4>
                                    <p>From ₹ 3,100</p>
                                </div></a>
                        </div>
                    </div>


                </div>


            </div>
            <div id="australia" class="container tab-pane fade"><br>

                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt1.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Albania</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt2.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Iceland</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt3.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Italy</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt4.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">North Macedonia</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt5.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">San Marino</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt6.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Sweden</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt7.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Turkey</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt8.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Ukraine</h4>
                                    <p>From ₹ 3,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt9.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">United Kingdom</h4>
                                    <p>From ₹ 9000</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt10.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Scotland</h4>
                                    <p>From ₹ 2,900</p>
                                </div></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4 col-sm-4 col-6 cntry-ch">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img class="media-object" src="images/cnt11.png" alt="">

                                <div class="media-body">
                                    <h4 class="media-heading">Luxembourg</h4>
                                    <p>From ₹ 3,100</p>
                                </div></a>
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <a href="#" class="ld-more">Loading More...</a>

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

<!--
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
                    <h3>Robert Kart  |  Citizen, Canada</h3></div>
                <div>
                    <p>Personalised attention, responsible behaviour & utmost honesty from a travel agent is something of a myth like most of us might have experienced. Well, our experience with visafax, right from the very first interaction was very professional and supporting!</p>
                    <h3>Robert Kart  |  Citizen, Canada</h3></div>

                <div>
                    <p>Personalised attention, responsible behaviour & utmost honesty from a travel agent is something of a myth like most of us might have experienced. Well, our experience with visafax, right from the very first interaction was very professional and supporting!</p>
                    <h3>Robert Kart  |  Citizen, Canada</h3></div>
            </div>



        </div>
    </div>
</section>
-->
@endsection
