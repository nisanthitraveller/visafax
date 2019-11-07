@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Users</h2>
        <div class="container-fluid">          
            <table class="display compact table-bordered table-hover table-striped table-condensed" id="listTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email ID</th>
                        <th>Phone</th>
                        <th>Enquiry Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $k => $user)
                    <tr>
                        <td>{{$k + 1}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{date('d.m.y H:i', strtotime($user->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
