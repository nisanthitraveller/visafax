<div class="container">
            <ul class="tablist tab1">
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -40px;">Start my application</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
                    </a>
                </li>
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -40px;">Upload Passport and payslip</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
                    </a>
                </li>
                <li class="active">
                    <a>
                        <span class="tb-name" style="top: -40px;">Save my informations</span>
                        <span class="tb-year">{{date('d M, y')}}</span>
                    </a>
                </li>

                <li>
                    <a>
                        <span class="tb-name" style="top: -40px;">View all documents</span>
                    </a>
                </li>
                <li class="last">
                    <a>
                        <span class="tb-name" style="top: -40px;">Verify by VisaBadge</span>
                    </a>
                </li>
            </ul>
        </div>
<div class="container-fluid">
    <div class="card p-3">
        <div class="card-body">
            <h5 class="card-title">Check the details below</h5>
            <div class="table-responsive-sm">          
                @foreach($user as $key => $data)
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="form{{$key}}">{{$key}}:</label>
                    <div class="col-sm-8">
                        <?php
                            $calClass = (in_array($key, ['PassportDOI', 'PassportDOE'])) ? 'datepicker3' : null;
                            $calClass2 = (in_array($key, ['DOB'])) ? 'datepicker' : null;
                        ?>
                        <input type="text" value="{{$data}}" name="user[{{$key}}]" class="form-control {{$calClass}} {{$calClass2}}" id="form{{$key}}">
                    </div>
                </div>
                @endforeach
                @foreach($booking as $key1 => $data1)
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="form{{$key1}}">{{$key1}}:</label>
                    <div class="col-sm-8">
                        <?php
                            $type = 'text';
                            //dd($booking);
                            if($key == 'Duration') {
                                $type = 'number';
                            }
                            $calClass = (in_array($key1, ['JoiningDate', 'payment_date'])) ? 'datepicker2' : null;
                            $data1 = (in_array($key, ['JoiningDate', 'payment_date'])) ? date('d/m/Y', strtotime($data1)) : $data1;
                        ?>
                        <input type="{{$type}}" value="{{$data1}}" name="booking[{{$key1}}]" class="form-control {{$calClass}}" id="form{{$key1}}">
                        
                    </div>
                </div>
                @endforeach
                <input type="hidden" id="save_user_id" name="save_user_id" value="{{$userId}}" />
                <input type="hidden" id="save_booking_id" name="save_booking_id" value="{{$bookingId}}" />
                <button type="submit" class="btn btn-primary">Save & Show My Visa Documents</button>
        </div>
        </div>
    </div>
</div>