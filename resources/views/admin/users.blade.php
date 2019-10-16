@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="container">
        <h2>Users</h2>
        <div class="table-responsive-sm">          
            <table class="table table-bordered table-striped">
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
                    @foreach($users as $user)
                    <tr>
                        <td>1</td>
                        <td>{{$user->FirstName}}</td>
                        <td>{{$user->Surname}}</td>
                        <td>{{$user->CityOfResidence}}</td>
                        <td>{{$user->CountryOfBirth}}</td>
                        <td>{{$user->Sex}}</td>
                        <td>{{$user->EmailID}}</td>
                        <td>{{$user->PhoneNo}}</td>
                        <td>
                            <a href="{!! route('admin.edituser', [$user->id]) !!}" class='btn btn-default btn-xs'>
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
