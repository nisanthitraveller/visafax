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

<section class="deals">
    <div class="container">
        <div class="row">

            <h2>Start your visa application – please provide below information</h2>

            <form class="your-dts" id="visaForm" style="max-width: 100%; padding: 0 15px">

                <label>Country of residence</label>
                <input type="text" name="residenceCountry" value="India" placeholder="India" readonly>
                <br><br><br>
                <label>What type of visa you want?</label>

                <div class="col-12">
                    <div class="row">
                        <div class="radio">
                            <input id="radio-1" name="visaType" type="radio" value="Business">
                            <label for="radio-1" class="radio-label"><span>Business</span></label>
                        </div>

                        <div class="radio">
                            <input id="radio-2" name="visaType" type="radio" value="Tourist" checked>
                            <label  for="radio-2" class="radio-label"><span>Tourist</span></label>
                        </div>

                        <!--                        <div class="radio">
                                                    <input id="radio-3" name="visaType" type="radio" value="Employment">
                                                    <label for="radio-3" class="radio-label"><span>Employment</span></label>
                                                </div>
                                                <div class="radio">
                                                    <input id="radio-4" name="visaType" type="radio" value="Student">
                                                    <label for="radio-4" class="radio-label"><span>Student</span></label>
                                                </div>-->
                    </div>
                </div>


                <div class="col-12 qstns">
                    <div class="row align-items-center q-row">

                        <div class="col-8 qs-in"><img src="{{url('/')}}/images/qs3.png">How many persons are traveling?</div>
                        <div class="col-4 text-right">

                            <div class="input-group counter">
                                <input type="button" value="-" class="button-minus plus-minus" data-field="persons">
                                <input type="number" step="1" max="" value="1" name="persons" class="quantity-field">
                                <input type="button" value="+" class="button-plus plus-minus" data-field="persons">
                            </div>
                        </div>

                    </div>
                </div>
                
                <input type="hidden" value="{{$country['id']}}" name="vistingCountry">
            </form>

            <div class="col-sm-12 text-center">
                @guest
                <a href="javascript:void(0)" onclick="$('#connect-modal').modal('show');" class="cntue cntuemargin">Start My Visa Application</a>
                @else
                <a href="javascript:void(0)" id="create-visa" class="cntue cntuemargin">Start My Visa Application</a>
                @endguest
            </div>

        </div>
    </div>
</section>
<section class="more-stories" style="padding: 0 15px">
    <div class="container">
        <div class="row">
            <?php echo $country['description'] ?>
        </div>
    </div>
</section>
<section class="more-stories" style="padding: 0 15px">
    <div class="container">
        <h2>Read More on {{$country['countryName']}} Visa Process</h2>
        <div class="stories owl-carousel owl-theme">
            @if(!empty($feeds['items']))
            <?php $countFeed = 0;?>
            @foreach($feeds['items'] as $feed)
            @if(strpos($feed['title'], $country['countryName']) !== false || strpos($feed['content_text'], $country['countryName']) !== false)
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
            @endif
            @endforeach
            @endif
        </div>
    </div>

</section>
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