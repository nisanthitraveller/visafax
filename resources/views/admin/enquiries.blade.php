@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <form method="get">
            <div class="row">
                <div class="col-md-2">
                    Add user
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" required name="first_name" placeholder="First name">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" required name="last_name" placeholder="Last name">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
            </div>
        </form>
        <h2>Enquiries</h2>
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
                        <th></th>
                        <th></th>
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
                        <td>{{date('d.m.y H:i', strtotime($user->created_at) + (5.5 * 60 * 60))}}</td>
                        <td>
                            <a href="{!! route('admin.editenquiry', [$user->id]) !!}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{!! route('admin.deleteenquiry', [$user->id]) !!}">
                                <i class="fas fa-trash"></i>
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
