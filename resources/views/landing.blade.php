@extends('layouts.landing')
@section('title')
Apply visas
@endsection
@section('content')
<section class="h-100 banner-video">
    <div id="hero">
        <!--  Video is muted & autoplays, placed after major DOM elements for performance & has an image fallback  -->
        <video id="video-background" autoplay="true" loop="" muted="" playsinline="" class="loaded">
            <source src="https://visabadge-bucket.s3.amazonaws.com/Pexels+Videos+2248564.mp4">
        </video>
    </div>
    <div class="container welcome-contents">
        <div class="row h-100 align-items-center">
            <div class="col-md-7 col-sm-6 wel-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <h2>Your one-stop solution<br>
                    for visa to<br>
                    any country
                </h2>

                <p>Get your visa documents online, for <b>FREE</b>!</p>
                <a href="#" class="scroll-down" address="true"></a>
            </div>
            <div class="col-md-5 col-sm-6 wow fadeInUp top-img" data-wow-duration="1s" data-wow-delay="3s">
                <div class=" wel-image" >
                    <img src="{{url('/')}}/images/wel-img.jpg">
                    <div class="img-conent">
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="5s">Worried about your visa rejections? Find your visa approval chances</p>
                        <a href="#" class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="7s">Check Now <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<section class="vis-rejd sec-pad rej-in">
    <div class="container">
        <div class="row h-100 align-items-center">

            <div class="col-md-7 col-sm-12 rej-text wel-text wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                <h2>21% of visa applications are <span>rejected</span> annually</h2>
                <p>...and, the key reasons for those rejections are - incomplete application, missing documents & data errors in the applications. By sparing a little extra care or taking an expert help, one could significantly increase the chances of approvals.</p>
            </div>

            <div class="col-md-5 col-sm-12 wel-text wow fadeInUp relative wel-in" data-wow-duration="1s" data-wow-delay="1s">
                <div class="counter-wrap">
                    <div class="row" id="counter">
                        <div class="col-md-12 col-sm-4 col-12 counter-Txt">  <span class="counter-value" data-count="22">11%</span> <small>Incomplete application</small></div>
                        <div class="col-md-12 col-sm-4 col-12 counter-Txt">  <span class="counter-value" data-count="29">06%</span><small>Missing documents</small></div>
                        <div class="col-md-12 col-sm-4 col-12 counter-Txt margin-bot-35">  <span class="counter-value" data-count="49">04%</span><small>Data errors in application</small></div>
                    </div>
                </div>
                <img src="{{url('/')}}/images/parerl-1.png" data-enllax-ratio=".5" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl" />
            </div>
        </div>
    </div>
</section>
<section class="pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 ans-intro wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{url('/')}}/images/vis-logo.png">
                <h2>That's why<span>VisaBadge</span></h2>
            </div>

            <div class="col-md-6 col-sm-12 ans-intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                <p>VisaBadge is a free online tool to simplify your visa document preparation, verification, submissions & stamping</p>
            </div>

        </div>
    </div>
</section>
<section class="pb-4 we-gurnte">
    <div class="container-fluid">
        <img src="{{url('/')}}/images/parerl-2.png" data-enllax-ratio=".5" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-2" />
        <img src="{{url('/')}}/images/parerl-3.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-3" />
        <div class="row">
            <div class="we-gurnte-banner col-xl-6 col-md-6 col-sm-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s" style="background-image: url(images/guar-banner.jpg);">
                <div class="we-gurnte-text  wow fadeInUp"  data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="row  no-gutters" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="col-md-4 col-sm-4 col-12 ic-columns">
                            <div class="ic-in wow flipInX" data-wow-duration="1s" data-wow-delay="1s">
                                <img src="{{url('/')}}/images/gur-ic1.png">
                            </div>
                            <h4>Online</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12 ic-columns">
                            <div class="ic-in wow flipInX" data-wow-duration="1s" data-wow-delay="1s">
                                <img src="{{url('/')}}/images/gur-ic2.png">
                            </div>
                            <h4>Instant</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12 ic-columns">
                            <div class="ic-in wow flipInX" data-wow-duration="1s" data-wow-delay="1s">
                                <img src="{{url('/')}}/images/gur-ic3.png">
                            </div>
                            <h4>Free</h4>
                        </div>
                    </div>
                    <a href="" class="gu-link col-sm-12">Interested? Watch a quick video on how visabadge works</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wh-differ">
    <div class="container relative wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
        <h2><small>What makes</small><span>VisaBadge</span> different?</h2>
        <p>On VisaBadge, just upload your passport & our intelligent algorithm will read them to get your visa documents ready - instantly. Watch how it works!</p>
        <div class="video-bg">
            <img src="{{url('/')}}/images/vid-img.jpg">
            <div class="vid-btn">
                <a id="play-video" class="video-play-button" href="#" data-toggle="modal" data-target="#myvideo">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="steps-wrap">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6 col-12 process-in">
                <h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s"><small>The steps involved</small> In the <span>process </span></h2>

                <span class="numb wow flipInX" data-wow-duration="0.5s" data-wow-delay="0.5s">1</span>

                <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">Choose your visa type</h3>
                <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">Start your visa application by selecting the visa type - business & tourist. Provide the number of applicants & country of residents.</p>
            </div>

            <div class="col-md-6 col-sm-6 col-12 process-img wow fadeInRight text-right" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{url('/')}}/images/step1.png">
                <img src="{{url('/')}}/images/parerl-4.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-4" />
            </div>
        </div>
    </div>

</section>
<section class="steps-wrap bg-pink sec-pad">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 col-sm-6 col-12 process-img wow fadeInLeft text-left" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{url('/')}}/images/step2.png">
                <img src="{{url('/')}}/images/parerl-5.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-5" />
            </div>
            <div class="col-md-6 col-sm-6 col-12 process-in">
                <span class="numb wow flipInX" data-wow-duration="0.5s" data-wow-delay="0.5s">2</span>
                <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">Upload your passport</h3>
                <p class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">Upload a scanned copy of your passport. Our intelligent algorithm will read it and automatically fill out your visa documents - instantly!</p>
            </div>
        </div>
    </div>
</section>
<section class="steps-wrap  sec-pad pt-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6 col-12 process-in">
                <div class="badge wow flipInX" data-wow-duration="1s" data-wow-delay="1s"><img src="{{url('/')}}/images/vis-badge.png"></div>
                <span class="numb wow flipInX bg-yellow" data-wow-duration="0.5s" data-wow-delay="0.5s">3</span>
                <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">Get it verified</h3>
                <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">Verify the documents or get it verified by our experts, before you submit it to the Embassies. Remember, an error-free application can improve the chances of your approvals!</p>
            </div>
            <div class="col-md-6 col-sm-6 col-12 process-img wow fadeInRight text-right" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{url('/')}}/images/step3.png">
                <img src="{{url('/')}}/images/parerl-6.png" data-enllax-ratio="0.6" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-5" />
            </div>
        </div>
    </div>
</section>
<section class="carousel-opt">
    <div class="container">
        <div class="row  align-items-center">
            <div class="col-sm-12">
                <h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">  <small>Read more</small>from <span>visa guides</span></h2>

                <div class="stories owl-carousel owl-theme pt-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    @if(!empty($feeds['items']))
                    <?php $countFeed = 0; ?>
                    @foreach($feeds['items'] as $feed)
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
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>



</section>
<section class="pb-4 we-gurnte testmnls">
    <div class="container-fluid relative">

        <h2><small>Listen to our</small><span>customers</span></h2>

        <img src="{{url('/')}}/images/parerl-7.png" data-enllax-ratio=".5" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-7" />
        <img src="{{url('/')}}/images/parerl-8.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-8" />

        <div class="row justify-content-end">
            <div class="we-gurnte-banner col-xl-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" style="background-image: url(images/guar-banner.jpg);">
                <div class="we-gurnte-text  wow fadeInUp"  data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="row  no-gutters" data-wow-duration="1s" data-wow-delay="0.5s">

                        <div class="testmonials owl-carousel owl-theme pt-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                            <div class="item">
                                <div class="auth-img">
                                    <img src="{{url('/')}}/images/author.jpg">
                                </div>
                                <div class="item-content">

                                    <p>One of the major challenges in visa processing is the preparation of documents. VisaBadge makes is really a cake-walk. After submitting the documents online, I received all the documents on My Visas page, fully prepared. 100% hassle free.</p>
                                    <span class="auth">Vivek Singh Rathore, New Delhi</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="auth-img">
                                    <img src="{{url('/')}}/images/author.jpg">
                                </div>
                                <div class="item-content">

                                    <p>Did my Schengen visa application through VisaBadge and the process was quick and seamless. The entire bunch of documents needed was prepared instantly online and the interview process with Embassy was scheduled by VisaBadge directly. Strongly recommend them for making visa processing simpler.</p>
                                    <span class="auth">Arun Gopal Mallepadi, Mumbai</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="auth-img">
                                    <img src="{{url('/')}}/images/author.jpg">
                                </div>
                                <div class="item-content">

                                    <p>Availed end to end services from document preparation, verification, appointment booking, submissions and tracking from VisaBadge for my last trip to the UK. Everything was online, except the interview with the Embassy and found that the services are really competitive for the quality of experience. Strongly recommend to go with Visabadge!</p>
                                    <span class="auth">Abhishek Apte, Bangalore</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pop-cntry">
    <div class="container">
        <div class="row">
            <h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s"><small>Most travelled</small> <span>Countries </span> in {{date('Y')}}</h2>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="200ms">
                <div class="th-img relative"><img src="{{url('/')}}/images/th1.png">
                    <h4>Switzerland</h4>
                    <a href="{{ url('/') }}/visa-application/switzerland-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="300ms">
                <div class="th-img relative"><img src="{{url('/')}}/images/th2.png">
                    <h4>Germany</h4>
                    <a href="{{ url('/') }}/visa-application/germany-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="400ms">
                <div class="th-img relative"><img src="{{url('/')}}/images/th3.png">
                    <h4>Canada</h4>
                    <a href="{{ url('/') }}/visa-application/canada-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="500ms">
                <div class="th-img relative"><img src="{{url('/')}}/images/th4.png">
                    <h4>United States</h4>
                    <a href="{{ url('/') }}/visa-application/united-states-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="600ms">
                <div class="th-img relative"><img src="{{url('/')}}/images/th5.png">
                    <h4>Thailand</h4>
                    <a href="{{ url('/') }}/visa-application/thailand-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="700ms">
                <div class="th-img relative"><img src="{{url('/')}}/images/th6.png">
                    <h4>Singapore</h4>
                    <a href="{{ url('/') }}/visa-application/singapore-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">Apply Now</a>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="pop-cntry">
    <div class="container">
        <div class="row">
            <h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s"><small style="color: #9566cc">Other </small> <span>Countries </span>on VisaBadge</h2>
        </div>

        <div class="row text-justify">
            @foreach($countries1 as $country)
                <a class="mr-3 pull-left" href="{{ url('/') }}/visa-application/{{str_replace(' ', '-', $country['countryName'])}}-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">
                    <small>{{$country['countryName']}}</small>
                </a>
            @endforeach
        </div>
    </div>
</section>
<section class="choose-sect">

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 ft-search">
                <div class="input-group">
                    <form autocomplete="off" id="searchForm" method="post" style="width: 89%">
                        <input type="text" class="form-control typeahead border-primary border-right-0" name="query" id="query" placeholder="Choose a country" data-provide="typeahead" autocomplete="off">
                    </form>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary border-left-0">
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>

                <ul>
                    <li><img src="{{url('/')}}/images/flash.png"></li>
                    <li><a href="{{ url('/') }}/visa-application/united-kingdom-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">UK</a></li>
                    <li><a href="{{ url('/') }}/visa-application/united-states-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">US</a></li>
                    <li><a href="{{ url('/') }}/visa-application/canada-visa-from-{{str_replace(' ', '-', $position['countryName'])}}">Canada</a></li>
                    <li><a href="javascript:;" onclick="$('.typeahead').focus()">+ 120 Countries</a></li>
                </ul>

            </div>
            <div class="col-md-6 col-sm-6 story-p">
                <p><img src="{{url('/')}}/images/story-th.png"><a href="{{ url('/') }}/blog" style="color: #fff">Read our visa guides</a></p>
            </div>
        </div>
    </div>

</section>
<div class="modal fade" id="myvideo">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/ngElkyQ6Rhs" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script type="text/javascript">
let video = document.querySelector('video');

const setVideoDimensions = () => {
  if (window.innerWidth / window.innerHeight > 16 / 9) {
    video.style.width = '100vw';
    video.style.height = 'calc(100vw * 9 / 16)';
  } else {
    video.style.width = 'calc(100vh * 16 / 9)';
    video.style.height = '100vh';
  }
};

window.onresize = setVideoDimensions;
setVideoDimensions();
console.clear();

const app = (() => {
  let body;
  let menu;
  let menuItems;

  const init = () => {
    body = document.querySelector('body');
    menu = document.querySelector('.menu-icon');
    menuItems = document.querySelectorAll('.nav__list-item');

    applyListeners();
  };

  const applyListeners = () => {
    menu.addEventListener('click', () => toggleClass(body, 'nav-active'));
  };

  const toggleClass = (element, stringClass) => {
    if (element.classList.contains(stringClass))
    element.classList.remove(stringClass);else

    element.classList.add(stringClass);
  };

  init();
})();

new WOW().init();
$(window).on('scroll', function(){
    if ($(".rej-text").is(':visible')){

        $(".rej-text").addClass("rej-uline");

        timeout = setTimeout(function() {
        $(self).addClass('rej-uline');

    // 10 seconds
    }, 10e3);

    }
});

$(window).enllax();

 $(function() {
    $('.scroll-down').click (function() {
      $('html, body').animate({scrollTop: $('.first-sects').offset().top }, 'slow');
      return false;
    });
  });

function isOnScreen(elem) {
  // if the element doesn't exist, abort
  if( elem.length == 0 ) {
    return;
  }
  var $window = jQuery(window)
  var viewport_top = $window.scrollTop()
  var viewport_height = $window.height()
  var viewport_bottom = viewport_top + viewport_height
  var $elem = jQuery(elem)
  var top = $elem.offset().top
  var height = $elem.height()
  var bottom = top + height

  return (top >= viewport_top && top < viewport_bottom) ||
  (bottom > viewport_top && bottom <= viewport_bottom) ||
  (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
}

jQuery( document ).ready( function() {
  window.addEventListener('scroll', function(e) {
    if( isOnScreen( jQuery( 'footer' ) ) ) { /* Pass element id/class you want to check */
      $('.choose-sect').addClass("active");
    } 

    else{
       $('.choose-sect').removeClass("active");
    }
  });
});

$(window).on('beforeunload', function(){
    $(window).scrollTop(0);
});

</script>
@endsection
@endsection
