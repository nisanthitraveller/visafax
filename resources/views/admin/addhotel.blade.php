@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Add New</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formType">Hotel Name:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="HotelName" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formType">Address:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="HotelAddress" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formType">Place:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="Place" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formType">Country:</label>
                    <div class="col-sm-8">
                        <select name="Country" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->countryName}}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formType">Phone:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="Phone" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Date From:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="DateFrom" class="form-control datepicker2" id="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formType">Date To:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="DateTo" class="form-control datepicker2" id="">
                    </div>
                </div>
                <input type="hidden" required="" name="BookingID" value="{{$bookingId}}" class="form-control" id="">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
