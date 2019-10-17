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
                        <th>City</th>
                        <th>Country</th>
                        <th>Sex</th>
                        <th>Email ID</th>
                        <th>Phone</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $k => $user)
                    <tr>
                        <td>{{$k + 1}}</td>
                        <td>{{$user->FirstName}}</td>
                        <td>{{$user->Surname}}</td>
                        <td>{{$user->CityOfResidence}}</td>
                        <td>{{$user->CountryOfBirth}}</td>
                        <td>{{$user->Sex}}</td>
                        <td>{{$user->EmailID}}</td>
                        <td>{{$user->PhoneNo}}</td>
                        <td>
                            <a href="{!! route('admin.edituser', [$user->id]) !!}">
                                <i class="fas fa-edit"></i>
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
