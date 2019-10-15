@extends('layouts.app')
@section('title')
Visa Payement
@endsection
@section('content')
<section class="banner inner-payment" style="background-image: url(images/hero-home.jpg);">

    <div class="container">
        <div class="col-sm-12 pt-4 pb-4">
            <h2>Dashboard</h2>
        </div>
    </div>
</section>
<section class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-4 col-sm-4 left-sidebar">

                <div class="wrapper center-block">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                        <div class="panel panel-default">
                            <div class="panel-heading active" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Ongoing orders
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <ul>
                                        <li class="active">
                                            <a href="#">
                                                <span class="title-ac">Switzerland visa</span>
                                                <span class="id-ac">ID: 4585 2569</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Australian visa</span>
                                                <span class="id-ac">ID: 4585 2563</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Singapore visa</span>
                                                <span class="id-ac">ID: 8562 3649</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Completed orders
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Switzerland visa</span>
                                                <span class="id-ac">ID: 4585 2569</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Australian visa</span>
                                                <span class="id-ac">ID: 4585 2563</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Singapore visa</span>
                                                <span class="id-ac">ID: 8562 3649</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Payment history
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Switzerland visa</span>
                                                <span class="id-ac">ID: 4585 2569</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Australian visa</span>
                                                <span class="id-ac">ID: 4585 2563</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="title-ac">Singapore visa</span>
                                                <span class="id-ac">ID: 8562 3649</span>
                                            </a>
                                        </li>
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
                    <div class="col-md-6 col-sm-5 col-3 link text-right">

                        <div class="doc-need  ui right pointing dropdown">
                            <div class="btn-link">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="menu">

                                <div class="item"><a href="#">Cancel Application</a></div>
                                <div class="item "><a href="#">Buy add-on services</a></div>
                                <div class="item"><a href="#">Report an issue</a></div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-bg">
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-4 row-dta">
                            <div class="do-ic"><img src="images/doc1.png"> From 16 Sep</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 row-dta">
                            <div class="do-ic"><img src="images/doc2.png"> 4 prople</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 row-dta">
                            <div class="do-ic"><img src="images/doc3.png"> Business visa</div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#"> 1. Application</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn" data-position="top right" data-tooltip="Verification done"  data-inverted="">

                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#"> 2. Cover Letter</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#"> 3. Intro</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">4. Invite</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">5. Agenda</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">6. Address Proof</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">7. NOC - Office</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">8. NOC - School</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">9. Authorisation</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">10. Sponsorship</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">11. Offer Letter</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">12. Pay Slips</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn" data-position="top right" data-tooltip="Verification ongoing"  data-inverted="">
                                <span class="up-progrs">
                                    <i class="fa fa-clock"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">13. Bank Statement</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">14. ITR</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">15. Flights</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">16. Hotels</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">17. Appointment</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">18. Old Visa</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">19. Insurance</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-list not-border">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-6 doc-cols">
                            <div class="dos-name"><a href="#">20. Passport Copies</a></div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-4 doc-col-2">
                            <div class="up-btn"> <img src="images/upload-active.png">
                                <input type="file" name="file" id="file" class="inputfile">
                                <label for="file" class="up-doc">Upload</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-2 doc-col-3">
                            <div class="up-sucess-btn">
                                <span class="up-succss">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 pay-dets">
                    <div class="row">
                        <div class="col-md-8 pay-dets-in">
                            <h4>Payment details</h4>
                            <p>Basic plan of 1,900  |  Paid on 16 Sep</p>
                        </div>
                        <div class="col-md-4 sub-btn-dash">

                            <a href="#" class="cntue">Upgrade</a>


                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-left down-bnch">

                    <a href="#" class="cntue">Download as a bunch</a>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(window).on('load', function () {
        $('#logind').modal('show');
    });
</script>
@endsection
