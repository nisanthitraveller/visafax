@extends('layouts.app')
@section('title')
Visa Payement
@endsection
@section('content')
<section class="banner inner-payment">

    <div class="container">
        <div class="col-sm-12 pt-4 pb-4">
            <h2>Dashboard</h2>
        </div>
    </div>
</section>
<section class="dashboard">
    <div class="container">
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
        <div class="row">
            <div class="col-xl-4 col-md-4 col-sm-4 left-sidebar">

                <div class="wrapper center-block">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                        <div class="panel panel-default">
                            <div class="panel-heading active" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Visa Applications
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($allVisa as $visa)
                                        <li class="active">
                                            <a href="{{url('/')}}/dashboard?bookingID={{$visa['id']}}">
                                                <span class="title-ac">{{$visa['countryName']}} {{$visa['BookingID']}}</span>
                                                <span class="id-ac">{{$visa['FirstName']}} {{$visa['Surname']}}</span>
                                                <span class="id-ac">on {{date('d M, y', strtotime($visa['created_at']))}}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Payment History
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($allVisa as $visa)
                                        @if($visa['paid'] == 1)
                                        <li class="active">
                                            <a href="{{url('/')}}/dashboard?bookingID={{$visa['id']}}">
                                                <span class="title-ac">{{$visa['countryName']}} {{$visa['BookingID']}}</span>
                                                <span class="id-ac">on {{date('d M, y', strtotime($visa['created_at']))}}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-8 col-sm-8 right-sidebar">
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-7 col-9">
                        <h2>Needed documents</h2>
                    </div>
                </div>
                <div class="row-bg">
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-4 row-dta">
                            <div class="do-ic"><img src="{{url('/')}}/images/doc1.png">On {{date('d M, y', strtotime($visaDetails['created_at']))}}</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 row-dta">
                            <div class="do-ic"><img src="{{url('/')}}/images/doc2.png"> {{count($visaDetails['child']) + 1}} people</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 row-dta">
                            <div class="do-ic"><img src="{{url('/')}}/images/doc3.png"> {{$visaDetails['VisaType']}} visa</div>
                        </div>
                    </div>
                </div>
                <?php $count = 1 ?>
                @foreach($documents as $k => $document)
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <?php $link = ($visaDetails['paid'] == 1 || $document['drive'] == false) ? $document['link'] : url('/') . '/applyvisa/payment/' . $visaDetails['id'] . '?paylater=' . md5($visaDetails['BookingID']); ?>
                            <div class="dos-name"><a target="_blank" href="{{$link}}"> {{$count}}. {{$document['type']}}</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            @if($document['drive'] == false)
                            <div class="up-btn"> 
                                <img src="{{url('/')}}/images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn" data-position="top right" data-tooltip="Verification done"  data-inverted="">
                                @if($document['status'] == 1)
                                    <span class="up-succss">
                                        <i class="fa fa-check"></i>
                                    </span>
                                @else
                                    <span class="up-progrs">
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
                @endif
<!--                <div class="col-sm-12 text-left down-bnch">
                    <a href="#" class="cntue">Download as a bunch</a>
                </div>-->

            </div>
        </div>

    </div>
</section>
@endsection
