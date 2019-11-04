@extends('layouts.app')
@section('title')
Visa Documents
@endsection
@section('content')
<section class="banner inner-2" style="background-image: url({{url('/')}}/images/hero-home.png);">

    <div class="container">
        <div class="row align-items-center justify-content-center pt-4">
            <h1>My visa documents</h1>
            <div class="col-9 dash-select cntry-selected">
                <div class="media">
                    <label class="label-title">Visa status for</label>
                    <select class="selectpicker select-bx  mobile-device" data-style="btn-danger"  data-max-options="1"  title="Choose one of the following...">

                        <optgroup label="Recent applications">
                            @foreach($allVisa as $visa)
                            <option>{{$visa['countryName']}} ({{$visa['BookingID']}}) |  On {{date('d.m.y', strtotime($visa['created_at']))}}</option>
                            @endforeach
                        </optgroup>

                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="dasboard-detail-wrap">
    <form action="" id="wizard" class="pt-4 acts wizard clearfix" role="application">
        <div class="steps clearfix">
            <ul role="tablist">
                <li role="tab" aria-disabled="false" class="first done checked" aria-selected="false">
                    <a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0">
                        <span class="number">1.</span> 
                        <span class="step-text">Login</span>
                        <span class="step-year">{{date('d M, y', strtotime($visaDetails['user']['created_at']))}}</span>
                    </a>
                </li>
                <li role="tab" aria-disabled="false" class="checked">
                    <a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1">
                        <span class="number">2.</span> 
                        <span class="step-text">Upload Docs</span>
                        <span class="step-year">{{date('d M, y', strtotime($visaDetails['created_at']))}}</span>
                    </a>
                </li>
                <li role="tab" aria-disabled="false" class="checked">
                    <a id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2">
                        <span class="number">3.</span> 
                        <span class="step-text">Documentation</span>
                        <span class="step-year">28 Oct</span>
                    </a>
                </li>
                <li role="tab" aria-disabled="false" class="current checked" aria-selected="true">
                    <a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3">
                        <span class="current-info audible">current step: </span>
                        <span class="number">4.</span> 
                        <span class="step-text">Verification</span>
                        <span class="step-year">29 Oct</span>
                    </a>
                </li>
                <li role="tab" aria-disabled="false">
                    <a id="wizard-t-4" href="#wizard-h-4" aria-controls="wizard-p-4">
                        <span class="number">5.</span>
                        <span class="step-text">Submission</span>
                        <span class="step-year">30 Oct</span>
                    </a>
                </li>
                <li role="tab" aria-disabled="false" class="last">
                    <a id="wizard-t-5" href="#wizard-h-5" aria-controls="wizard-p-5">
                        <span class="number">6.</span> 
                        <span class="step-text">Approval</span>
                        <span class="step-year">31 Oct</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mt-4 p-47 dashboard-wrap" id="document-listing">
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


                                <div class="col-lg-3 col-md-3 col-sm-3 row-bgd">
                                    <div class="col-md-12 col-12 row-dta">
                                        <div class="do-ic"><img src="images/track.png"> Track status</div>
                                    </div>
                                </div>
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
                                        <a target="_blank" href="{{url('/') . '/applyvisa/payment/' . $visaDetails['id'] . '?paylater=' . md5($visaDetails['BookingID'])}}"> {{sprintf("%02d", $count)}}. {{$out}}</a>
                                        <span class="sm-desc">{{$toolTip['tooltip']}}</span>
                                    </div>
                                    @elseif($document['DriveId'] == '' && count($document1) == 1)
                                    @if($document['pdf'] != '')
                                    <div class="dos-name">
                                        <a href="{{url('/') . '/uploads/' . $document['pdf']}}"> {{sprintf("%02d", $count)}}. {{$out}}</a>
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
                                        <?php $text = (count($document1) >= 1 && $document['pdf'] != '') ? 'Upload New' : 'Upload'; ?>
                                        <label for="file" class="up-doc" onclick="$('#docTYpe').val({{$k}}); $('.right-sidebar').toggle()">{{$text}}</label>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                                    <div class="up-sucess-btn" data-position="top right">
                                        @if($document['status'] == 1)
                                        <span class="up-succss" data-toggle="tooltip" data-placement="top" title="Verified">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        @else
                                        <span class="up-progrs" data-toggle="tooltip" data-placement="top" title="Verification Ongoing">
                                            <i class="fa fa-clock"></i>
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
                                <div class="col-md-6 pay-dets-in">
                                    @if(!empty($countryPrices))
                                    <p>
                                        Billing Amount: {{number_format($countryPrices['price'] * (count($booking['child']) + 1))}}/-
                                    </p>
                                    @endif
                                    <p>
                                        Amount Paid: 0/-
                                    </p>
                                </div>
                                <div class="col-md-6 pay-dets-in text-right">
                                    <p>
                                        @if($visaDetails['ParentID'] == 0)
                                        <a class="btn btn-outline-primary" href="{{url('/') . '/applyvisa/payment/' . $visaDetails['id'] . '?paylater=' . md5($visaDetails['BookingID'])}}">Make Payment</a>
                                        @else
                                        <a class="btn btn-outline-primary" href="{{url('/') . '/applyvisa/payment/' . $visaDetails['ParentID'] . '?paylater=' . md5($visaDetails['BookingID'])}}">Make Payment</a>
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
                </div>
            </div>
        </div>
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
@endsection
