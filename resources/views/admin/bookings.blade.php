@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Bookings</h2>
        <div class="container-fluid">          
            <table class="display compact table-bordered table-hover table-striped table-condensed" id="listTable">
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
                        <th>Hotels</th>
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
                            <a href="{!! route('admin.editbooking', [$booking->id]) !!}">
                                Booking Info
                            </a>
                        </td>
                        <td>
                            <a href="{!! route('admin.assigndoc', [$booking->id]) !!}">
                                Assign Documents
                            </a>
                        </td>
                        <th>
                            <a href="{!! route('admin.hotels', [$booking->id]) !!}">
                                Hotels
                            </a>
                        </th>
                        <td>
                            <a href="{!! route('admin.viewdoc', [$booking->id]) !!}">
                                View Documents
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
