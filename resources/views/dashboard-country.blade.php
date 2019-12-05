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
        <div class="content clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap right-sidebar"id="document-listing">
                        <?php $count = 1 ?>
                        <?php $display = 0 ?>
                        @foreach($countryDocuments as $k => $document)
                        <?php
                            $class = ($document['display'] == 1) ? 'btn' : 'btn disabled';
                            if($document['display'] == 0) {
                                $display++;
                            }
                            $out = strlen($document['documenttype']['type']) > 27 ? substr($document['documenttype']['type'], 0, 27) . "..." : $document['documenttype']['type'];
                        ?>
                        @if($display == 1 && $document['display'] == 0)
                        <div class="doc-list" data-toggle="tooltip" data-placement="top">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-12 doc-cols">
                                    <h2>Other Documents</h2>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="doc-list" data-toggle="tooltip" data-placement="top" title="{{$document['documenttype']['type']}}">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-12 doc-cols">
                                    <div class="dos-name">
                                        <a target="_blank" class="{{$class}}" <?php if(empty($document['document_id']) && $document['display'] == 1) { ?> onclick="$('#connect-modal').modal('show')" <?php } ?>> {{sprintf("%02d", $count)}}. {{$out}}</a>
                                        <span class="sm-desc">{{$document['tooltip']}}</span>
                                    </div>
                                    

                                </div>
                                <div class="col-md-3 col-sm-3 col-4 doc-col-2">
                                    @if(empty($document['document_id']) && $document['display'] == 1)
                                        <div class="up-btn" onclick="$('#connect-modal').modal('show')">
                                            <img src="{{url('/')}}/images/upload-active.png">
                                            <label for="file" class="up-doc">Upload</label>
                                        </div>
                                    @endif
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
    <form method="post" id="visaForm">
        <input name="visaType" value="{{$request['visaType']}}" type="hidden">
        <input type="hidden" name="persons" value="{{$request['persons']}}" />
        <input type="hidden" value="{{$request['vistingCountry']}}" name="vistingCountry">
        <input type="hidden" value="{{$request['residenceCountry']}}" name="residenceCountry">
        <input type="hidden" value="{{$countryDocuments[0]['documenttype']['id']}}" name="uploadType" id="uploadType">
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
</script>
@endsection
