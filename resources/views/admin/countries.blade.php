@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Countries</h2>
        <div class="container-fluid">          
            <table class="display compact table-bordered table-hover table-striped table-condensed" id="listTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Country Name</th>
                        <th>Status</th>
                        <th>Display Fees</th>
                        <th>Pricing</th>
                        <th>Documents</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $k => $country)
                    <tr>
                        <td>{{$k + 1}}</td>
                        <td>{{$country->countryName}}</td>
                        <td>{{$status[$country->status]}}</td>
                        <td>{{$country->visa_cost}}</td>
                        <td>
                            <a href="{!! route('admin.countryprice', [$country->id]) !!}">
                                <i class="fas fa-rupee-sign"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{!! route('admin.countrydocuments', [$country->id]) !!}">
                                <i class="fa fa-file"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{!! route('admin.editcountry', [$country->id]) !!}">
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
