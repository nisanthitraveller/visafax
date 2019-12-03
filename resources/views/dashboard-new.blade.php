@extends('layouts.app')
@section('title')
Visa Documents
@endsection
@section('content')
<section class="banner inner-2" style="background-image: url({{url('/')}}/images/hero-home.png);">

    <div class="container">
        <div class="row align-items-center justify-content-center pt-4">
            <h1>My Visa Documents</h1>
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
    <form id="wizard" class="pt-4 acts wizard clearfix" role="application" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <ul class="tablist">
                <li class="<?php if ($step >= 1) {
    echo 'active';
} ?>">
                    <a>
                        <span class="tb-name">Upload Docs</span>
                        <span class="tb-year">{{date('d M, y', strtotime($visaDetails['created_at']))}}</span>
                    </a>
                </li>
                <li class="<?php if ($step >= 2) {
    echo 'active';
} ?>">
                    <a>
                        <span class="tb-name">Prepare Docs</span>
                        <span class="step-year">
                            @if($step >= 2 && !empty($visaDetails['assign_date']))
                            {{date('d M, y', strtotime($visaDetails['assign_date']))}}
                            @endif
                        </span>
                    </a>
                </li>
                <li class="<?php if ($step >= 3) {
    echo 'active';
} ?>">
                    <a>
                        <span class="tb-name">Payment</span>
                        <span class="step-year">
                            @if($step >= 3 && !empty($visaDetails['payment_date']))
                            {{date('d M, y', strtotime($visaDetails['payment_date']))}}
                            @endif
                        </span>
                    </a>
                </li>

                <li class="<?php if ($step >= 4) {
    echo 'active';
} ?>">
                    <a>
                        <span class="tb-name">Verification</span>
                        <span class="step-year">
                            @if($step >= 4 && !empty($visaDetails['verified_at']))
                            {{date('d M, y', strtotime($visaDetails['verified_at']))}}
                            @endif
                        </span>
                    </a>
                </li>
                <li class="<?php if ($step >= 5) {
    echo 'active';
} ?>">
                    <a>
                        <span class="tb-name">Submission</span>
                        <span class="step-year">
                            @if($step >= 5 && !empty($visaDetails['submission_at']))
                            {{date('d M, y', strtotime($visaDetails['submission_at']))}}
                            @endif
                        </span>
                    </a>
                </li>
                <li class="last <?php if ($step >= 6) {
    echo 'active';
} ?>">
                    <a>
                        <span class="tb-name">Approval</span>
                        <span class="step-year">
                            @if($step >= 6 && !empty($visaDetails['approval_at']))
                            {{date('d M, y', strtotime($visaDetails['approval_at']))}}
                            @endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
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
                        <div class="doc-list" data-toggle="tooltip" data-placement="top" title="{{$document['documenttype']['type']}}">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-12 doc-cols">
                                    @if($visaDetails['paid'] == 1 && $document['DriveId'] != '')
                                    <div class="dos-name">
                                        <a target="_blank" href="{{'https://docs.google.com/document/d/' . $document['DriveId']}}"> {{sprintf("%02d", $count)}}. {{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @elseif($visaDetails['paid'] == 0 && $document['DriveId'] != '')
                                    <div class="dos-name">
                                        <a href="{{url('/') . '/applyvisa/payment/' . $visaDetails['id'] . '?paylater=' . md5($visaDetails['BookingID'])}}"> {{sprintf("%02d", $count)}}. {{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @elseif($document['DriveId'] == '' && count($document1) == 1)
                                    @if($document['pdf'] != '')
                                    <div class="dos-name">
                                        <a target="_blank" href="{{url('/') . '/uploads/' . $document['pdf']}}"> {{sprintf("%02d", $count)}}. {{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @else
                                    <div class="dos-name">
                                        <a href="javascript:void(0)" title="No files uploaded"> {{sprintf("%02d", $count)}}. {{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @endif
                                    @elseif($document['DriveId'] == '' && count($document1) > 1)
                                    <div class="dos-name">
                                        <a data-toggle="collapse" href="#connect-modal{{$k}}" role="button" aria-expanded="false" aria-controls="connect-modal{{$k}}"> {{sprintf("%02d", $count)}}. {{$out}}</a>
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
                                    <div class="up-btn">
                                        <img src="{{url('/')}}/images/upload-active.png">
<?php $text = (count($document1) >= 1 && $document['pdf'] != '') ? 'Uploaded' : 'Upload'; ?>
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
                                        @elseif($document['status'] == 1)
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
                                <div class="col-md-6 align-self-center pay-dets-in">
                                    <p>Know more about offerings & prices</p>
                                </div>
                                <div class="col-md-6 pay-dets-in text-right">
                                    <p>
                                        @if($visaDetails['ParentID'] == 0)
                                        <a class="btn btn-outline-primary" href="{{url('/') . '/applyvisa/payment/' . $visaDetails['id'] . '?paylater=' . md5($visaDetails['BookingID'])}}">Show List of Services</a>
                                        @else
                                        <a class="btn btn-outline-primary" href="{{url('/') . '/applyvisa/payment/' . $visaDetails['ParentID'] . '?paylater=' . md5($visaDetails['BookingID'])}}">Show List of Services</a>
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
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap right-sidebar" id="file-upload" style="display: none">
                        <div class="container mb-4 dash-titles">
                            <div class="row">
                                <div class="col-md-9 col-sm-12 row-bg">

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
                        <div class="col-sm-12 mb-2 ">
                            <div class="row mb-2 ">
                                <a href="javascript:void(0)" class="back-btn" onclick="$('.right-sidebar').toggle()">Back</a>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2 ">
                            <div class="alert" id="message" style="display: none"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-7 col-9">
                                <h2>Upload Files</h2>
                            </div>
                        </div>
                        <div class="doc-list file-upload">
                            <div class="row">
                                <div class="col-md-6 col-sm-4 col-4 doc-cols">File</div>
                                <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                                    <input type="file" accept="application/pdf" name="booking_documents[]" />
                                </div>
                            </div>
                        </div>
                        <div class="doc-list add-file">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 doc-cols">
                                    <input type="hidden" id="docTYpe" name="docType" />
                                    <input type="hidden" id="visaID" name="visaID" value="{{$visaDetails['id']}}" />
                                    <button type='button' class="btn btn-light pull-right add_more">Add More Files</button>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 doc-cols text-right">
                                    <input type="submit" name="upload" id="upload" class="btn btn-secondary" value="Upload">
                                </div>
                            </div>
                        </div>
                        <?php $uploadTypes = []; ?>
                        @if(isset($request['uploadType']) && $request['uploadType'] != 0)
                        <?php
                            $cnt = 0;
                            foreach ($documents as $key2 => $document2) {
                                if ($document2[0]['document']['display'] == 1) {
                                    $uploadTypes[$cnt]['Name'] = $document2[0]['documenttype']['type'];
                                    $uploadTypes[$cnt]['Key'] = $key2;
                                    $cnt++;
                                }
                            }
                            //unset($uploadTypes[$request['uploadType']])
                        ?>
                        <div class="container mb-4 dash-titles">
                            
                            @foreach($uploadTypes as $key => $uploadType)
                            @if($uploadType['Key'] != $request['uploadType'])
                            <div class="row up-type" id="uploadType-{{$key}}" style="display:none">
                                <div class="col-md-9 col-sm-12 row-bg">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12  row-dta">
                                        Upload {{$uploadType['Name']}}
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6  row-dta">
                                        <a href="javascript:void(0)" onclick="$(this).parent().parent().remove(); $('#docTYpe').val({{$uploadType['Key']}});" class="btn btn-success">Yes</a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6  row-dta">
                                        <a href="javascript:void(0)" onclick="$(this).parent().parent().remove(); showNext()" class="btn btn-danger">No</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
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
            $(".file-upload").clone().insertBefore(".add-file");
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
<script>
    $(document).ready(function(){
        $('#wizard').on('submit', function(event) {
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
                    var val = parseInt($('#uploadType').val()) + 1;
                    console.log('VAL' + val);
                    console.log('Toatal VAL' + $('#totaluploadType').val());
                    if($('#totaluploadType').val() > 0 && $('#totaluploadType').val() > val) {
                        $('#uploadType').val(val);
                        showNext();
                    }
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    $.each(data.JobId, function(i, item) {
                        setTimeout(function() {
                            fetchdata(item, $('#visaID').val());
                        }, 5000)
                    });
                }
            })
        });
    });
    
    function showNext() {
        if($('.up-type').first().length) {
            $('.up-type').first().show();
        } else {
            showForm({{$visaDetails['id']}});
            console.log('show form');
        }
    }
    
    function showForm(visaID) {
        $.ajax({
            url:"{{ route('show-form') }}",
            method:"POST",
            data:{visaID: visaID},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data) {
                $('#file-upload').html(data);
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
                    setTimeout(function() {
                        fetchdata(JobId, visaID);
                    }, 5000)
                }
                // Perform operation on return value
                console.log(data);
            }
        });
   }
</script>
@endsection

