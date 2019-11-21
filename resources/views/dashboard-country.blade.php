@extends('layouts.app')
@section('title')
Visa Documents
@endsection
@section('content')
<section class="banner inner-2" style="background-image: url({{url('/')}}/images/hero-home.png);">

    <div class="container">
        <div class="row align-items-center justify-content-center pt-4">
            <h1>Visa Documents</h1>
            <div class="col-9 dash-select cntry-selected">
                <div class="media">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    $step = 1;
    
?>
<div class="dasboard-detail-wrap">
    <form id="wizard" class="pt-4 acts wizard clearfix" role="application" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <ul class="tablist">
                <li class="<?php if($step >= 1 ) { echo 'active'; } ?>">
                    <a>
                        <span class="tb-name">Upload Docs</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
                    </a>
                </li>
                <li class="<?php if($step >= 2 ) { echo 'active'; } ?>">
                    <a>
                        <span class="tb-name">Prepare Docs</span>
                        <span class="step-year">
                        </span>
                    </a>
                </li>
                <li class="<?php if($step >= 3 ) { echo 'active'; } ?>">
                    <a>
                        <span class="tb-name">Payment</span>
                        <span class="step-year">
                        </span>
                    </a>
                </li>
                
                <li class="<?php if($step >= 4 ) { echo 'active'; } ?>">
                    <a>
                        <span class="tb-name">Verification</span>
                        <span class="step-year">
                        </span>
                    </a>
                </li>
                <li class="<?php if($step >= 5 ) { echo 'active'; } ?>">
                    <a>
                        <span class="tb-name">Submission</span>
                        <span class="step-year">
                        </span>
                    </a>
                </li>
                <li class="last <?php if($step >= 6 ) { echo 'active'; } ?>">
                    <a>
                        <span class="tb-name">Approval</span>
                        <span class="step-year">
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap right-sidebar"id="document-listing">
                        <?php $count = 1 ?>
                        @foreach($countryDocuments as $k => $document)
                        <?php
                            $class = ($document['display'] == 1) ? 'btn' : 'btn disabled';
                            $out = strlen($document['documenttype']['type']) > 27 ? substr($document['documenttype']['type'], 0, 27) . "..." : $document['documenttype']['type'];
                        ?>
                        <div class="doc-list" data-toggle="tooltip" data-placement="top" title="{{$document['documenttype']['type']}}">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-12 doc-cols">
                                    <div class="dos-name">
                                        <a target="_blank" class="{{$class}}" onclick="$('#connect-modal').modal('show')"> {{sprintf("%02d", $count)}}. {{$out}}</a>
                                        <span class="sm-desc">{{$document['tooltip']}}</span>
                                    </div>
                                    

                                </div>
                                <div class="col-md-3 col-sm-3 col-4 doc-col-2">
                                    <div class="up-btn">
                                        <img src="{{url('/')}}/images/upload-active.png">
                                        <label for="file" class="up-doc">Upload</label>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                                    <div class="up-sucess-btn" data-position="top right">
                                        <span class="up-warning" data-toggle="tooltip" data-placement="top" title="Pending - Customer Review">
                                            <i class="fa fa-exclamation"></i>
                                        </span>
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
</div>
<div style="clear: both"></div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
            $('.add_more').click(function(e){
    e.preventDefault();
    $(".file-upload").clone().insertBefore(".add-file");
    });
    });
</script>
@endsection
