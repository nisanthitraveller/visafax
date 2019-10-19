@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Add New</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Hotel Name:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="HotelName" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Address:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="HotelAddress" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Place:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="Place" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Country:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="Country" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Phone:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="Phone" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Date From:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="DateFrom" class="form-control" id="formType">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Date To:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="DateTo" class="form-control" id="formType">
                    </div>
                </div>
                <input type="text" required="" name="BookingID" value="{{$bookingId}}" class="form-control" id="formType">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
