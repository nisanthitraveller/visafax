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
                <h3>Sign in & initiate your visa application for FREE!</h3>
                <p>Sign in to initiate your visa application. On VisaBadge, we get your visa documents prepared instantly, on a single page - completely FREE!</p>
                <div class="col-sm-12 connect-links">
                    <!--<div class="g-signin2" id="my-signin2" data-width="260" data-height="50" data-theme="light" data-longtitle="true" data-onsuccess="onSignIn"></div>-->
                    <a href="javascript:void(0)" id="googleSignIn"><img src="{{url('/')}}/images/search.svg">Connect with Google</a>
                </div>
                <div class="userContent" style="display: none;"></div>
            </div>



        </div>
    </div>
</div>
<div class="modal fade popus" id="connect-modal-mobile">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <img src="{{url('/')}}/images/modal-img.png">
                <h3>Share your contact number</h3>
                <p>Share your mobile number that can be added to your visa application form, which the Embassy officials may use to reach you directly.</p>
                <div class="col-sm-12 connect-links">
                    <input id="phone1" name="phone" type="number" placeholder="Enter mobile number" />
                </div>
                <div class="col-sm-12 connect-links">
                    <button class="btn btn-primary btn-lg" onclick="updateMobile()">Login</button>
                </div>
                
                <div class="userContent" style="display: none;"></div>
            </div>



        </div>
    </div>
</div>
<div style="" class="loading">
  <div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:40%"></div>
  </div>
</div>
<div id="fade"></div>
<div id="loader-modal">
    <img src="{{url('/')}}/images/loading.gif">
</div>
<footer class="pt-5 ftr mt-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 col-sm-2 ft-logo"><img src="{{url('images/logo-reverse.png')}}" style="width: 116px"></div>
            <div class="col-md-10 col-sm-10 ft-qlinks text-right ">
                <ul>
                    <li><a href="{{url('about')}}">About</a></li>
                    <li><a href="{{url('faq')}}">FAQ</a></li>
                    <li><a href="{{url('privacy')}}">Privacy policy </a></li>
                    <li><a href="{{url('terms')}}">T&C</a></li>
                    <li><a href="{{url('blog')}}">Blog</a></li>
                    <li><a href="{{url('contact')}}">Contact</a></li>
                </ul>
            </div>
            <div class="col-12 ft-social">
                <ul class="social">
                    <li><a href="https://www.facebook.com/visabadge" target="_blank"> <i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com/BadgeVisa" target="_blank"> <i class="fab fa-twitter"></i></a></li>
                    <!--<li><a href="https://www.youtube.com/user/visabadge" target="_blank"> <i class="fab fa-youtube"></i></a></li>-->
                    <li><a href="https://instagram.com/visabadge" target="_blank"> <i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://in.pinterest.com/visabadge" target="_blank"> <i class="fab fa-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid copy-r mt-2">
        <div class="row text-center">
            <p>&COPY; {{date('Y')}} - All rights reserved.</p>
        </div>
    </div>
    <span id="siteseal"><script async type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=pHi7E0z5FAke4eRlgiOnlqhBMzp526aCIcLR6WvBdIBWjdxvoM5ZEqdAJsyH"></script></span>
</footer>