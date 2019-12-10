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
            <div class="col-md-7 col-sm-6 wel-text wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2>Your one-stop solution<br>
                    for visa to<br>
                    any country
                </h2>

                <p>Prepare all your visa documents & submit online!</p>
                <a href="#" class="scroll-down" address="true"></a>
            </div>
            <div class="col-md-5 col-sm-6 wow fadeInUp top-img" data-wow-duration="2s" data-wow-delay="3s">
                <div class=" wel-image" >
                    <img src="images/wel-img.jpg">
                    <div class="img-conent">
                        <p class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="5s">Know the chances of getting your visa approved</p>
                        <a href="#" class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="7s">Try now <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<section class="vis-rejd sec-pad rej-in">
    <div class="container">
        <div class="row h-100 align-items-center">

            <div class="col-md-7 col-sm-12 rej-text wel-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                <h2>30% of visa applications are getting <span>rejected</span> because of</h2>
                <p>VisaBadge is a sleek online tool to simplify your visa document preparation, verification, submissions & stamping. On VisaBadge, you can submit your travel documents online and generate your completed application form, along with all the supporting documents, online. Instantly. </p>

            </div>

            <div class="col-md-5 col-sm-12 wel-text wow fadeInUp relative wel-in" data-wow-duration="2s" data-wow-delay="2s">
                <div class="counter-wrap">
                    <div class="row" id="counter">
                        <div class="col-md-12 col-sm-4 col-12 counter-Txt">  <span class="counter-value" data-count="22">0</span> <small>Wrong
                                informations</small></div>
                        <div class="col-md-12 col-sm-4 col-12 counter-Txt">  <span class="counter-value" data-count="29">0</span><small> Lack of documents</small></div>
                        <div class="col-md-12 col-sm-4 col-12 counter-Txt margin-bot-35">  <span class="counter-value" data-count="49">0</span> <small>Errors in application </small></div>
                    </div>
                </div>
                <img src="images/parerl-1.png" data-enllax-ratio=".5" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl" />
            </div>
        </div>
    </div>
</section>
<section class="pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 ans-intro wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                <img src="images/vis-logo.png">
                <h2>That’s why<span>VisaBadge</span></h2>
            </div>

            <div class="col-md-6 col-sm-12 ans-intro-text wow fadeInUp" data-wow-duration="2s" data-wow-delay="2s">
                <p>VisaBadge is a sleek online tool to simplify your visa document preparation, verification, submissions & stamping</p>
            </div>

        </div>
    </div>
</section>
<section class="pb-4 we-gurnte">
    <div class="container-fluid">
        <img src="images/parerl-2.png" data-enllax-ratio=".5" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-2" />
        <img src="images/parerl-3.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-3" />
        <div class="row">
            <div class="we-gurnte-banner col-xl-6 col-md-6 col-sm-12 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="1s" style="background-image: url(images/guar-banner.jpg);">
                <div class="we-gurnte-text  wow fadeInUp"  data-wow-duration="2s" data-wow-delay="1s">
                    <div class="row  no-gutters" data-wow-duration="2s" data-wow-delay="1s">
                        <div class="col-md-4 col-sm-4 col-12 ic-columns">
                            <div class="ic-in wow flipInX" data-wow-duration="2s" data-wow-delay="2s">
                                <img src="images/gur-ic1.png">
                            </div>
                            <h4>Simple</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12 ic-columns">
                            <div class="ic-in wow flipInX" data-wow-duration="2s" data-wow-delay="2s">
                                <img src="images/gur-ic2.png">
                            </div>
                            <h4>Instant</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12 ic-columns">
                            <div class="ic-in wow flipInX" data-wow-duration="2s" data-wow-delay="2s">
                                <img src="images/gur-ic3.png">
                            </div>
                            <h4>Low cost</h4>
                        </div>
                    </div>
                    <a href="" class="gu-link col-sm-12">Interested? See how we’re guaranteeing your visa</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wh-differ">
    <div class="container relative wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
        <h2><small>What makes</small><span>VisaBadge</span> different?</h2>

        <p>VisaBadge is a sleek online tool to simplify your visa document preparation, verification, submissions & stamping. On VisaBadge, you can submit your travel documents online and generate your completed application form</p>

        <div class="video-bg">
            <img src="images/vid-img.jpg">
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
                <h2 class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s"><small>The steps involved</small> In the <span>process </span></h2>

                <span class="numb wow flipInX" data-wow-duration="1s" data-wow-delay="1s">1</span>

                <h3 class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay="1s">Provide the basic details</h3>
                <p class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay="1s">Shoppers can chat with product specific. customers can start chat with specific product. You can automate repeated question using chatbot.</p>
            </div>

            <div class="col-md-6 col-sm-6 col-12 process-img wow fadeInRight text-right" data-wow-duration="2s" data-wow-delay="1s">
                <img src="images/step1.png">
                <img src="images/parerl-4.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-4" />
            </div>
        </div>
    </div>

</section>
<section class="steps-wrap bg-pink sec-pad">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 col-sm-6 col-12 process-img wow fadeInLeft text-left" data-wow-duration="2s" data-wow-delay="1s">
                <img src="images/step2.png">
                <img src="images/parerl-5.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-5" />
            </div>
            <div class="col-md-6 col-sm-6 col-12 process-in">
                <span class="numb wow flipInX" data-wow-duration="1s" data-wow-delay="1s">2</span>
                <h3 class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="1s">Update the documents</h3>
                <p class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="1s">Shoppers can chat with product specific. customers can start chat with specific product. You can automate repeated question using chatbot.</p>
            </div>
        </div>
    </div>
</section>
<section class="steps-wrap  sec-pad pt-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6 col-12 process-in">
                <div class="badge wow flipInX" data-wow-duration="2s" data-wow-delay="2s"><img src="images/vis-badge.png"></div>
                <span class="numb wow flipInX bg-yellow" data-wow-duration="1s" data-wow-delay="1s">3</span>
                <h3 class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay="1s">Get it approved</h3>
                <p class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay="1s">Shoppers can chat with product specific. customers can start chat with specific product. You can automate repeated question using chatbot.</p>
            </div>
            <div class="col-md-6 col-sm-6 col-12 process-img wow fadeInRight text-right" data-wow-duration="2s" data-wow-delay="1s">
                <img src="images/step3.png">
                <img src="images/parerl-6.png" data-enllax-ratio="0.6" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-5" />
            </div>
        </div>
    </div>
</section>
<section class="carousel-opt">
    <div class="container">
        <div class="row  align-items-center">
            <div class="col-sm-12">
                <h2 class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">  <small>Read more</small><span>stories</span> about visa?</h2>

                <div class="stories owl-carousel owl-theme pt-3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                    @if(!empty($feeds['items']))
                    <?php $countFeed = 0; ?>
                    @foreach($feeds['items'] as $feed)
                    @if($countFeed <= 6)
                    <?php
                    $image = isset($feed['image']) ? $feed['image'] : secure_url('/') . "/images/st1.jpg";
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

        <h2><small>Listen to</small> their <span>voice</span></h2>

        <img src="images/parerl-7.png" data-enllax-ratio=".5" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-7" />
        <img src="images/parerl-8.png" data-enllax-ratio="0.2" data-enllax-type="foreground" data-enllax-direction="vertical" class="parl-8" />

        <div class="row justify-content-end">
            <div class="we-gurnte-banner col-xl-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s" style="background-image: url(images/guar-banner.jpg);">
                <div class="we-gurnte-text  wow fadeInUp"  data-wow-duration="2s" data-wow-delay="1s">
                    <div class="row  no-gutters" data-wow-duration="2s" data-wow-delay="1s">

                        <div class="testmonials owl-carousel owl-theme pt-3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                            <div class="item">
                                <div class="auth-img">
                                    <img src="images/author.jpg">
                                </div>
                                <div class="item-content">

                                    <p>One of the major challenges in visa processing is the preparation of documents. VisaBadge makes is really a cake-walk. After submitting the documents online, I received all the documents on My Visas page, fully prepared. 100% hassle free.</p>
                                    <span class="auth">Vivek Singh Rathore, New Delhi</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="auth-img">
                                    <img src="images/author.jpg">
                                </div>
                                <div class="item-content">

                                    <p>Did my Schengen visa application through VisaBadge and the process was quick and seamless. The entire bunch of documents needed was prepared instantly online and the interview process with Embassy was scheduled by VisaBadge directly. Strongly recommend them for making visa processing simpler.</p>
                                    <span class="auth">Arun Gopal Mallepadi, Mumbai</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="auth-img">
                                    <img src="images/author.jpg">
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
            <h2 class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s"><small>Most popular</small> <span>Countries </span> in {{date('Y')}}</h2>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="200ms">
                <div class="th-img relative"><img src="images/th1.png">
                    <h4>Switzerland</h4>
                    <a href="{{ secure_url('/') }}/visa/switzerland">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="300ms">
                <div class="th-img relative"><img src="images/th2.png">
                    <h4>Germany</h4>
                    <a href="{{ secure_url('/') }}/visa/germany">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="400ms">
                <div class="th-img relative"><img src="images/th3.png">
                    <h4>Canada</h4>
                    <a href="{{ secure_url('/') }}/visa/canada">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="500ms">
                <div class="th-img relative"><img src="images/th4.png">
                    <h4>United States</h4>
                    <a href="{{ secure_url('/') }}/visa/united-states">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="600ms">
                <div class="th-img relative"><img src="images/th5.png">
                    <h4>Thailand</h4>
                    <a href="{{ secure_url('/') }}/visa/thailand">Apply Now</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 pop-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="700ms">
                <div class="th-img relative"><img src="images/th6.png">
                    <h4>Singapore</h4>
                    <a href="{{ secure_url('/') }}/visa/singapore">Apply Now</a>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="choose-sect">

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 ft-search">
                <div class="input-group">
                    <form autocomplete="off" id="searchForm" method="post" style="width: 90%">
                        <input type="text" class="form-control typeahead border-primary border-right-0" name="query" id="query" placeholder="Select a country for visa" data-provide="typeahead" autocomplete="off">
                    </form>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary border-left-0">
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>

                <ul>
                    <li><img src="images/flash.png"></li>
                    <li><a href="{{ secure_url('/') }}/visa/canada">Canada</a></li>
                    <li><a href="{{ secure_url('/') }}/visa/switzerland">Switzerland</a></li>
                    <li><a href="{{ secure_url('/') }}/visa/germany">Germany</a></li>
                    <li><a href="{{ secure_url('/') }}/visa/malaysia">Malaysia</a></li>
                </ul>

            </div>
            <div class="col-md-6 col-sm-6 story-p">
                <p><img src="images/story-th.png">Read stories about visas</p>
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

var a = 0;
$(window).scroll(function() {

  var oTop = $('#counter').offset().top - window.innerHeight;
  if (a == 0 && $(window).scrollTop() > oTop) {
    $('.counter-value').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 7000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }

        });
    });
    a = 1;
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
