@extends('layouts.app')
@section('title')
Visa Documents
@endsection
@section('content')

<section class="banner inner-2" style="background-image: url({{url('/')}}/images/hero-home.png);">

    <div class="container">
        <div class="row align-items-center justify-content-center pt-4">
            @if(!isset($request['uploadType']) && $request['uploadType'] != 0)
                <h1>My Visa Documents</h1>
            @else
                <h1 class="uploadTitle">Upload your {{$documents[$request['uploadType']][0]['documenttype']['type']}}</h1>
            @endif
            
            <div class="col-9 dash-select cntry-selected">
                <div class="media">
                    <label class="label-title">Visa status for</label>
                    <select id="visa-change" class="selectpicker select-bx  mobile-device" data-style="btn-danger"  data-max-options="1"  title="Choose one of the following...">

                        <optgroup label="Recent applications">
                            @foreach($allVisa as $visa)
                            <option value="{{$visa['id']}}" <?php if ($visa['id'] == $visaDetails['id']) {
    echo 'selected';
} ?>>{{$visa['countryName']}} ({{$visa['BookingID']}}) |  On {{date('d.m.y', strtotime($visa['created_at']))}}</option>
                            @endforeach
                        </optgroup>

                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$step = 1;

if (!empty($visaDetails['assign_date'])) {
    $step = 2;
}

if ($visaDetails['paid'] == 1) {
    $step = 3;
}

if ($visaDetails['status'] == 1) {
    $step = 4;
}

if ($visaDetails['status'] == 2) {
    $step = 5;
}

if ($visaDetails['status'] == 3) {
    $step = 6;
}
?>
<div class="dasboard-detail-wrap">
    <form id="wizard" class="pt-2 acts wizard clearfix" role="application" method="post" enctype="multipart/form-data">
        @csrf
        @if(!isset($request['uploadType']) && !isset($request['form']))
        <div class="container">
            <ul class="tablist tab1">
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Start my application</span>
                        <span class="tb-year">{{date('d M, y', strtotime($visaDetails['created_at']))}}</span>
                    </a>
                </li>
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Upload passport & payslip</span>
                        <span class="tb-year">{{date('d M, y', strtotime($visaDetails['created_at']))}}</span>
                    </a>
                </li>
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Save my information</span>
                        <span class="tb-year">{{date('d M, y', strtotime($visaDetails['created_at']))}}</span>
                    </a>
                </li>

                <li>
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">View my documents</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
                    </a>
                </li>
                <li class="last">
                    <a>
                        <span class="tb-name" style="top: -50px; width: 105px">Verification by VisaBadge</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif
        <div class="content clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap right-sidebar"id="document-listing">
                        @if($response['payStat'] == 'Payment Failed')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed!</strong> Payment failed, please try later.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @elseif($response['payStat'] == 'Payment Success')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Please complete the process.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(!empty($visaDetails))
<?php $count1 = 0; ?>
                        @foreach($documents as $document11)
                        @foreach($document11 as $document22)
                        @if($document22['DriveId'] != '')
<?php $count1++; ?>
                        @endif
                        @endforeach
                        @endforeach
                        @if($count1 == 0)
                        <div class="row mb-2 ">
                            <div class="col-md-12 col-sm-12 col-12 doc-block">
                                <b>Upload below travel documents to initiate visa processing.</b>
                                <p style="text-align: justify">
                                    The below is a list of mandatory documents that you will have to share with us to initiate your visa application. You can upload them here, by clicking on the UPLOAD button. More details are available below each item. Once you share them, leave the rest of the hassles to us - we will get your complete bunch of visa documents ready and quickly share them here for you to review (usually in less than a couple of hours).
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="container mb-4 dash-titles">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 row-bg">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12  row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc2.png">{{$visaDetails['user']['FirstName']}} {{$visaDetails['user']['Surname']}}</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6  row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc3.png">{{$visaDetails['BookingID']}}</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc1.png">{{date('d.m.y', strtotime($visaDetails['created_at']))}}</div>
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
                        @foreach($documents as $k => $document1)
<?php
$document = $document1[0];
$toolTip = App\Models\Document::where('country_id', $visaDetails['VisitingCountry'])->where('document_type', $document['DocumentID'])->select('body_business as tooltip')->first()->toArray();
$out = strlen($document['documenttype']['type']) > 27 ? substr($document['documenttype']['type'], 0, 27) . "..." : $document['documenttype']['type'];
?>
                        <div class="doc-list" data-toggle="tooltip" data-placement="top">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-12 doc-cols">
                                    @if($document['DriveId'] != '')
                                    <div class="dos-name">
                                        <a target="_blank" href="{{'https://docs.google.com/document/d/' . $document['DriveId']}}">{{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @elseif($document['DriveId'] == '' && count($document1) == 1)
                                    @if($document['pdf'] != '')
                                    <div class="dos-name">
                                        <a target="_blank" href="{{url('/') . '/uploads/' . $document['pdf']}}">{{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @else
                                    <div class="dos-name">
                                        <a href="javascript:void(0)" title="No files uploaded">{{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @endif
                                    @elseif($document['DriveId'] == '' && count($document1) > 1)
                                    <div class="dos-name">
                                        <a data-toggle="collapse" href="#connect-modal{{$k}}" role="button" aria-expanded="false" aria-controls="connect-modal{{$k}}">{{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                        <div class="collapse" id="connect-modal{{$k}}">
                                            <div>
                                                <ol>
                                                    @foreach($document1 as $k2 => $document2)
                                                    <li>
                                                        <a target="_blank" href="{{url('/') . '/uploads/' . $document2['pdf']}}">File {{$k2 + 1}}</a>
                                                    </li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                                <div class="col-md-3 col-sm-3 col-4 doc-col-2">
                                    @if($document['DriveId'] == '')
                                    <?php $text = (count($document1) >= 1 && $document['pdf'] != '') ? 'Uploaded' : 'Upload'; ?>
                                    <div class="up-btn {{$text}}">
                                        <img src="{{url('/')}}/images/upload-active.png">
                                        <label for="file" class="up-doc" onclick="$('#docTYpe').val({{$k}}); $('.right-sidebar').toggle()">{{$text}}</label>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                                    <div class="up-sucess-btn" data-position="top right">
                                        @if($document['status'] == 2)
                                        <span class="up-succss" data-toggle="tooltip" data-placement="top" title="Verified & Ready to Download">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        @elseif($document['status'] == 0)
                                        <span class="up-progrs" data-toggle="tooltip" data-placement="top" title="Pending - VisaBadge Review">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                        @else
                                        <span class="up-warning" data-toggle="tooltip" data-placement="top" title="Pending - Customer Review">
                                            <i class="fa fa-exclamation"></i>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php $count++; ?>
                        @endforeach
                        <div>&nbsp;</div>
                        @if($visaDetails['paid'] == 1)
                        <div class="col-sm-12 pay-dets">
                            <div class="row">
                                <div class="col-md-12 pay-dets-in">
                                    <h4>Payment details</h4>
                                    <p>Amount paid {{number_format($visaDetails['amount_paid'])}}  |  Paid on {{date('d M, y', strtotime($visaDetails['payment_date']))}}</p>
                                    <p>Mode of payment {{$visaDetails['payment_response']}}</p>
                                </div>
                            </div>
                        </div>
                        @else
<?php
$booking = $visaDetails;
if ($visaDetails['ParentID'] != 0) {
    $booking = \App\Models\Bookings::where("id", $visaDetails['ParentID'])->with('child')->first()->toArray();
}
$countryPrices = \App\Models\Pricing::where('country_id', $booking['VisitingCountry'])->with('master')->select('plan_id', 'price')->orderBy('plan_id', 'asc')->first();
?>
                        <div class="col-sm-12 pay-dets">
                            <div class="row">
                                <div class="col-md-8 align-self-center pay-dets-in">
                                    <p>Want a visa expert to get your documents perfect?</p>
                                </div>
                                <div class="col-md-4 pay-dets-in text-right">
                                    <p>
                                        @if($visaDetails['ParentID'] == 0)
                                        <a class="btn btn-outline-primary" href="{{url('/') . '/applyvisa/payment/' . $visaDetails['id'] . '?paylater=' . md5($visaDetails['BookingID'])}}">Show Details</a>
                                        @else
                                        <a class="btn btn-outline-primary" href="{{url('/') . '/applyvisa/payment/' . $visaDetails['ParentID'] . '?paylater=' . md5($visaDetails['BookingID'])}}">Show Details</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @else
                        <div class="row mb-2">
                            <div class="col-md-12 col-sm-12 col-12">
                                <p>
                                    No visas found! <a href="{{url('/')}}">Apply New</a>
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if(!empty($visaDetails))
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap right-sidebar" id="file-upload" style="margin-top: 0 !important; display: none">
                        @if(!isset($request['uploadType']))
                        <div class="container mb-4 dash-titles">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 row-bg">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12  row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc2.png">{{$visaDetails['user']['FirstName']}} {{$visaDetails['user']['Surname']}}</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6  row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc3.png">{{$visaDetails['BookingID']}}</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 row-dta">
                                        <div class="do-ic"><img src="{{url('/')}}/images/doc1.png">{{date('d.m.y', strtotime($visaDetails['created_at']))}}</div>
                                    </div>
                                </div>


                                <!--<div class="col-lg-3 col-md-3 col-sm-3 row-bgd">
                                    <div class="col-md-12 col-12 row-dta">
                                        <div class="do-ic">
                                            <img src="images/track.png"> Track status
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        @endif
                        @if(!isset($request['uploadType']))
                        <div class="col-sm-12 mb-2 ">
                            <div class="row mb-2 ">
                                <a href="javascript:void(0)" class="back-btn" onclick="$('.right-sidebar').toggle()">Back</a>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12 mb-2 " style="padding-left: 0">
                            <div class="alert" id="message" style="display: none"></div>
                        </div>
                        <?php $uploadTypes = []; ?>
                        @if(isset($request['uploadType']) && $request['uploadType'] != 0)
                        <?php
                            $cnt = 0;
                            foreach ($countryDocuments as $key2 => $document2) {
                                if ($document2['display'] == 1 && in_array($document2['documenttype']['id'], $arrayDiff)) {
                                    $uploadTypes[$cnt]['Name'] = $document2['documenttype']['type'];
                                    $uploadTypes[$cnt]['Key'] = $document2['documenttype']['id'];
                                    $cnt++;
                                }
                            }
                            //unset($uploadTypes[$request['uploadType']])
                        ?>
                        <div class="container mb-4 dash-titles">
                            
                            @foreach($uploadTypes as $key => $uploadType)
                            @if($uploadType['Key'] != $request['uploadType'])
                            <div class="row up-type" id="uploadType-{{$key}}" style="display: none">
                                <div class="col-md-12 col-sm-12 row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12  row-dta" style="text-align: justify">
                                        @if(stripos($uploadType['Name'], 'passport') !== false)
                                            <h5 style="color: #282828">Are you ready to upload your passport ?</h5>
                                            <small class="sml" style="color: #606060; line-height: 18px !important; display: block;">Upload the front & back side copies of your passport in <b>PDF</b> format. Start uploading by clicking the 'Choose File'. To add more files, click on 'Add More Files'.</small>
                                            <br />
                                        @elseif(stripos($uploadType['Name'], 'offer letter') !== false || stripos($uploadType['Name'], 'payslip') !== false)
                                            <h5 style="color: #282828">Are you ready to upload your payslip ?</h5>
                                            <small style="color: #606060; line-height: 18px !important; display: block;">Please upload your recent payslip to find your company name & employment details. If you don't have your payslip ready, click 'Not now' and you can upload it later.</small>
                                            <small style="display: none" class="sml">Upload your latest month's payslip copy in <b>PDF</b> format. Start uploading by clicking the 'Choose File'. If you don't have your payslip ready, click 'Cancel' and you can upload it later.</small>
                                            <br />
                                        @endif
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-6 col-6 mt-2 row-dta text-right">
                                        <a href="javascript:void(0)" onclick="$(this).parent().parent().parent().remove(); showNext()" class="btn btn-light">Not now</a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-2 row-dta">
                                        <a href="javascript:void(0)" onclick="$('.uploadText').html($('#uploadType-{{$key}} .sml').html()); $(this).parent().parent().parent().remove(); $('#docTYpe').val({{$uploadType['Key']}}); $('.uploadTitle').html('Upload your <?=$uploadType['Name']?>');$('.file-show').show();" class="btn btn-success add_more">Yes, upload now</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endif
                        <div class="row mb-2 file-show">
                            <div class="col-md-12 col-sm-10 col-9">
                                @if(!isset($request['uploadType']))
                                    <h2 class="uploadTitle" style="color: #282828">Upload your documents</h2>
                                @else
                                    @if(stripos($documents[$request['uploadType']][0]['documenttype']['type'], 'passport') !== false)
                                    <h5 class="uploadTitle" style="color: #282828">Upload front and back sides of your passport in PDF format</h5>
                                    <small style="color: #606060; line-height: 18px !important; display: block; text-align: justify" class="uploadText">Upload the front & back side copies of your passport in <b>PDF</b> format. Start uploading by clicking the 'Choose File'. To add more files, click on 'Add More Files'.</small>
                                    @elseif(stripos($documents[$request['uploadType']][0]['documenttype']['type'], 'offer letter') !== false || stripos($documents[$request['uploadType']][0]['documenttype']['type'], 'payslip') !== false)
                                    <h5 class="uploadTitle" style="color: #282828">Upload your payslip in PDF format</h5>
                                    <small style="color: #606060; line-height: 18px !important; display: block; text-align: justify" class="uploadText">Please upload your recent payslip to find your company name & employment details. If you don't have your payslip ready, click 'Not now' and you can upload it later.</small>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="doc-list up-doc-file file-show mt-2">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-4">
                                    @if(isset($request['uploadType']) && stripos($documents[$request['uploadType']][0]['documenttype']['type'], 'passport') !== false)
                                        <input type="file" onclick="mixpanel.track('Browse_Passport');" accept="application/pdf" name="booking_documents[]" />
                                    @else
                                        <input type="file" accept="application/pdf" name="booking_documents[]" />
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        <div class="file-upload" style="display:none">
                            <div class="doc-list up-doc-file file-show mt-2">
                                <div class="row">
                                    <div class="col-md-3 col-sm-4 col-4">
                                        <input type="file" accept="application/pdf" name="booking_documents[]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="doc-list add-file file-show mt-2">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-4 doc-cols" style="padding-left: 0;">
                                    <input type="hidden" id="docTYpe" name="docType" />
                                    
                                    <button type='button' class="btn btn-link pull-right add_more" disabled>Add More Files</button>
                                </div>
                                <div class="col-md-8 col-sm-8 col-8 doc-cols text-right">
                                    <a href="javascript:void(0)" onclick="showForm({{$visaDetails['id']}})" class="btn btn-light">Cancel</a>
                                    <input onclick="mixpanel.track('Confirm_Upload');" type="submit" name="upload" id="upload" class="btn btn-success" disabled value="Confirm Upload">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <input type="hidden" id="visaID" name="visaID" value="{{$visaDetails['id']}}" />
        <input type="hidden" value="0" id="uploadType" name="uploadType" />
        <input type="hidden" value="{{count($uploadTypes)}}" name="totaluploadType" id="totaluploadType" />
    </form>
</div>
<div style="clear: both"></div>
@if(isset($request['popup']) && $request['popup'] == 1)
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
                    <a href="javascript:void(0)" onclick="$('#connect-modal-signup').modal('hide')">Upload My Travel Documents</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(isset($request['popup']) && $request['popup'] == 2)
<div class="modal fade popus" id="connect-modal-signup2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <img src="{{url('/')}}/images/modal-img.png">
                <h3>Get started with your new visa</h3>
                <p>Get started with your new visa, by uploading your travel documents</p>
                <div class="col-sm-12 logind-links">
                    <a href="javascript:void(0)" onclick="$('#connect-modal-signup2').modal('hide')">Upload My Travel Documents</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip()
        $('.add_more').click(function(e){
            e.preventDefault();
            $(".file-upload .doc-list").clone().insertBefore(".add-file");
        });
    });
</script>
@if(isset($request['uploadType']) && $request['uploadType'] != 0)
<script type="text/javascript">
    $(window).on('load', function () {
        $('#docTYpe').val({{$request['uploadType']}});
        $('.right-sidebar').toggle();
    });
</script>
@endif
@if(isset($request['form']) && $request['form'] == 1)
<script type="text/javascript">
    $(window).on('load', function () {
        $('.right-sidebar').toggle();
        showForm($('#visaID').val());
        console.log('show form');
    });
</script>
@endif
<script>
    $(document).ready(function(){
        $('input[type=file]').change(function() {
            if($(this).val() == '') {
                $('#upload, .add_more').attr('disabled', true)
            } else {
                $('#upload, .add_more').attr('disabled', false);
            }
        })
        $('#wizard').on('submit', function(event) {
            openModal();
            event.preventDefault();
            $.ajax({
                url:"{{ route('my-visas') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data) {
                    $(".up-doc-file:nth-child(1)").remove();
                    $('.file-show').hide();
                    $('input[type=file]').val(null);
                    var val = parseInt($('#uploadType').val()) + 1;
                    console.log('VAL' + val);
                    console.log('Toatal VAL' + $('#totaluploadType').val());
                    if($('#totaluploadType').val() > 0 && $('#totaluploadType').val() > val) {
                        $('#uploadType').val(val);
                    }
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    $("#message").fadeTo(2000, 500).slideUp(500, function(){
                        $("#message").slideUp(500);
                    });
                    $.each(data.JobId, function(i, item) {
                        fetchdata(item, $('#visaID').val());
                    });
                    if(data.redirect == 1) {
                        location.href = '/dashboard';
                    }
                }
            })
        });
    });
    
    function showForm(visaID) {
        $.ajax({
            url:"{{ route('show-form') }}",
            method:"POST",
            data:{visaID: visaID},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data) {
                $('#file-upload').html(data);
                $('.uploadTitle').html('Verify & Confirm');
            }
        })
    }
    
    function fetchdata(JobId, visaID) {
        $.ajax({
            url: '/readdoc',
            type: 'GET',
            dataType:'JSON',
            data:{visaID: visaID, JobId: JobId},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data) {
                if(data.status == 'failed') {
                    fetchdata(JobId, visaID);
                } else {
                    if($('.up-type').first().length) {
                        $('.up-type').first().show();
                    } else {
                        showForm($('#visaID').val());
                        console.log('show form');
                    }
                    closeModal();
                }
                // Perform operation on return value
                console.log(data);
            }
        });
   }
   function showNext() {
        if($('.up-type').first().length) {
            $('.up-type').first().show();
        } else {
            showForm({{$visaDetails['id']}});
            console.log('show form');
        }
    }
</script>
@endsection

