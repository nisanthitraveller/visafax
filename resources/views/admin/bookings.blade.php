@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="container">
        <h2>Bookings</h2>
        <div class="table-responsive-sm">          
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Booking ID</th>
                        <th>Country</th>
                        <th>Passport #</th>
                        <th>First Name</th>
                        <th>Email ID</th>
                        <th>Phone #</th>
                        <th>Booking Info</th>
                        <th>Assign Documents</th>
                        <th>View Documents</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $k => $booking)
                    <tr>
                        <td>{{$k + 1}}</td>
                        <td>{{$booking->BookingID}}</td>
                        <td>{{$booking['country']['countryName']}}</td>
                        <td>{{$booking['user']['PassportNo']}}</td>
                        <td>{{$booking['user']['FirstName']}}</td>
                        <td>{{$booking['user']['EmailID']}}</td>
                        <td>{{$booking['user']['PhoneNo']}}</td>
                        <td>
                            <a href="{!! route('admin.editbooking', [$booking->id]) !!}" class='btn btn-default btn-xs'>
                                Booking Info
                            </a>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
