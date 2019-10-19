@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Hotels</h2>
        <div class="container-fluid">          
            <table class="display compact table-bordered table-hover table-striped table-condensed" id="listTable">
                <thead>
                    <tr>
                        <td colspan="10">
                            <a href="{!! route('admin.addhotel', [$bookingId]) !!}" class="btn btn-danger">
                                Add New
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Booking ID</th>
                        <th>Hotel Name</th>
                        <th>Address</th>
                        <th>Place</th>
                        <th>Country</th>
                        <th>Phone #</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotels as $k => $hotel)
                    <tr>
                        <td>{{$k + 1}}</td>
                        <td>{{$hotel['booking']['BookingID']}}</td>
                        <td>{{$hotel['HotelName']}}</td>
                        <td>{{$hotel['HotelAddress']}}</td>
                        <td>{{$hotel['Place']}}</td>
                        <td>{{$hotel['country']['countryName']}}</td>
                        <td>{{$hotel['Phone']}}</td>
                        <td>{{$hotel['DateFrom']}}</td>
                        <td>{{$hotel['DateTo']}}</td>
                        <td>
                            <a href="{!! route('admin.edithotel', [$hotel['id']]) !!}">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
