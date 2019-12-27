@extends('layouts.app')
@section('title')
Visa Documents
@endsection
@section('content')
<section class="banner inner-payment" style="background-image: url({{url('/')}}/images/hero-home.png);">

    <div class="container">
        <div class="row align-items-center justify-content-center pt-4">
            <h2>My Visa Documents</h2>
            <div class="col-9 dash-select cntry-selected">
                <div class="media">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</section>
<div class="dasboard-detail-wrap">
    <form id="wizard" class="pt-4 acts wizard clearfix" role="application" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <ul class="tablist tab1">
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -50px;">Start Visa<br /> Application</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
                    </a>
                </li>
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -50px;">Upload Visa<br /> Documents</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="tb-name" style="top: -50px;">VisaBadge<br /> Verification</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap right-sidebar"id="document-listing">
                        <div class="row mb-2 ">
                            <div class="col-md-12 col-sm-12 col-12 doc-block">
                                <h5><b>21% of visa applications are rejected by Embassies!</b></h5>
                                <p style="text-align: justify">
                                    Yes, 21% of the visa applications are rejected for 3 reasons - missing documents, incomplete applications & simple data errors! Do you really want to be one of those 21% applicants? If not, hire one of our visa experts at just <b>Rs 1999/-</b>
                                </p>
                                <p>
                                    <a href="javascript:void(0)" onclick="mixpanel.track('Paynow_Before_Login'); $('#connect-modal').modal('show');" class="cntue m-0" style="background-color: #ffdf00; color: #000; font-weight: bold; border-radius: 6px; padding: 6px 12px">PAY NOW</a>
                                </p>
                                <p style="text-align: justify">
                                    Use below docs for your visa application completely free. Yes, they are free, if you want to manage your visas yourself. But remember, a little care now can get your visa documentation hassle & error free - so, hire one of our experts for a guaranteed visa approval!
                                </p>
                            </div>
                        </div>
                        <div class="container mb-4 dash-titles">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 row-bg">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12  row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc2.png">{{$request['persons']}} traveller(s)</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6  row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc3.png">{{$request['visaType']}} Visa</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc1.png">{{date('d.m.y')}}</div>
                                    </div>
                                </div>


                                <!--<div class="col-lg-3 col-md-3 col-sm-3 row-bgd">
                                    <div class="col-md-12 col-12 row-dta">
                                        <div class="do-ic"><img src="images/track.png"> Track status</div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <?php $count = 1 ?>
                        <?php $display = 0 ?>
                        @foreach($countryDocuments as $k => $document)
                        <?php
                            $class = ($document['display'] == 1) ? 'btn' : 'btn';
                            $class1 = ($document['display'] == 1) ? null : "style=display:none";
                            $class2 = ($document['display'] == 1) ? 'col-md-9' : 'col-md-12';
                            if($document['display'] == 0) {
                                $display++;
                            }
                            $out = strlen($document['documenttype']['type']) > 27 ? substr($document['documenttype']['type'], 0, 27) . "..." : $document['documenttype']['type'];
                        ?>
                        <div class="doc-list display{{$document['display']}}" data-toggle="tooltip" data-placement="top">
                            <div class="row">
                                <div class="col-md-9 col-sm-7 col-12 doc-cols">
                                    <div class="dos-name">
                                        <a style="padding-left: 0; color: #282828" target="_blank" class="{{$class}}" onclick="$('#connect-modal').modal('show');">{{$out}}</a>
                                        <span class="sm-desc" style="color: #606060">{{$document['tooltip']}}</span>
                                    </div>
                                    

                                </div>
                                <div class="col-md-3 col-sm-3 col-4 doc-col-2">
                                        <div class="up-btn" onclick="$('#connect-modal').modal('show')">
                                        <img src="{{url('/')}}/images/upload-active.png">
                                        <label for="file" class="up-doc">VIEW</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $count++; ?>
                        @endforeach
                        <div>&nbsp;</div>
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="post" id="visaForm">
        <input name="visaType" value="{{$request['visaType']}}" type="hidden">
        <input type="hidden" name="persons" value="{{$request['persons']}}" />
        <input type="hidden" value="{{$request['vistingCountry']}}" name="vistingCountry">
        <input type="hidden" value="{{$request['residenceCountry']}}" name="residenceCountry">
        @if(isset($countryDocuments[0]))
            <input type="hidden" value="{{$countryDocuments[0]['documenttype']['id']}}" name="uploadType" id="uploadType">
        @else
            <input type="hidden" value="" name="uploadType" id="uploadType">
        @endif
    </form>
</div>
<div style="clear: both"></div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.add_more').click(function(e) {
            e.preventDefault();
            $(".file-upload").clone().insertBefore(".add-file");
        });
    });
    $(window).on('load', function () {
        console.log('Dashboard 1');
        mixpanel.track('Dashboard_1');
    });
</script>
@endsection
