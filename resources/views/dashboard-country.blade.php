@extends('layouts.app')
@section('title')
Visa Documents
@endsection
@section('content')
<section class="banner inner-payment" style="background-image: url({{url('/')}}/images/hero-home.png);">

    <div class="container">
        <div class="row align-items-center justify-content-center pt-4">
            <h2>Upload your passport & payslip to initiate the visa application</h2>
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
                        <span class="tb-name" style="top: -50px; width: 105px">Start my application</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Upload passport & payslip</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
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
                        <span class="tb-name" style="top: -50px; width: 105px">Verification by VisaBadge</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap right-sidebar"id="document-listing">
                        <?php $count = 1 ?>
                        <?php $display = 0 ?>
                        @foreach($countryDocuments as $k => $document)
                        <?php
                            $class = ($document['display'] == 1) ? 'btn' : 'btn disabled';
                            $class1 = ($document['display'] == 1) ? null : "style=display:none";
                            $class2 = ($document['display'] == 1) ? 'col-md-9' : 'col-md-12';
                            if($document['display'] == 0) {
                                $display++;
                            }
                            $out = strlen($document['documenttype']['type']) > 27 ? substr($document['documenttype']['type'], 0, 27) . "..." : $document['documenttype']['type'];
                        ?>
                        @if($display == 1 && $document['display'] == 0)
                        <div class="row mb-2 ">
                            <div class="col-md-10 col-sm-10 col-10 doc-block mt-3">
                                <p class="dir" style="text-align: justify; color: #6483e9; text-decoration: underline; cursor: pointer; margin-bottom: 0" onclick="$('.dir, .display0').toggle()">
                                    Show other documents needed
                                    <i style="padding-left: 5px" class="fa fa-angle-down"></i>
                                </p>
                                <p class="dir" style="display: none; text-align: justify; color: #6483e9; text-decoration: underline; cursor: pointer; margin-bottom: 0" onclick="$('.dir, .display0').toggle()">
                                    Hide other documents
                                    <i style="padding-left: 5px" class="fa fa-angle-up"></i>
                                </p>
                                
                            </div>
                        </div>
                        @endif
                        <div class="doc-list display{{$document['display']}}" {{$class1}} data-toggle="tooltip" data-placement="top">
                            <div class="row">
                                <div class="{{$class2}} col-sm-7 col-12 doc-cols">
                                    <div class="dos-name">
                                        @guest
                                            <a style="padding-left: 0; color: #282828" target="_blank" class="{{$class}}" <?php if(empty($document['document_id']) && $document['display'] == 1) { ?> onclick="mixpanel.track('D1_Upload_Passport'); $('#connect-modal').modal('show');" <?php } ?>>{{$out}}</a>
                                        @else
                                            <a style="padding-left: 0; color: #282828" class="{{$class}}" <?php if(empty($document['document_id']) && $document['display'] == 1) { ?> href="{{url('/')}}/dashboard?uploadType={{$document['documenttype']['id']}}" <?php } ?>>{{$out}}</a>
                                        @endguest
                                        <span class="sm-desc" style="color: #606060">{{$document['tooltip']}}</span>
                                    </div>
                                    

                                </div>
                                @if(empty($document['document_id']) && $document['display'] == 1)
                                <div class="col-md-3 col-sm-3 col-4 doc-col-2">
                                    @guest
                                        <div class="up-btn" onclick="$('#connect-modal').modal('show')">
                                    @else
                                        <div class="up-btn" onclick="location.href='{{url('/')}}/dashboard?uploadType={{$document['documenttype']['id']}}'">
                                    @endguest

                                        <img src="{{url('/')}}/images/upload-active.png">
                                        <label for="file" class="up-doc">Upload</label>
                                    </div>
                                </div>
                                @endif
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
        <input type="hidden" value="{{$countryDocuments[0]['documenttype']['id']}}" name="uploadType" id="uploadType">
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
