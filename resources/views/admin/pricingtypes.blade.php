@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Pricing Master</h2>
        <div class="container-fluid"> 
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <table class="display compact table-bordered table-hover table-striped table-condensed" id="listTable">
                <thead>
                    <tr>
                        <td colspan="4">
                            <a href="{!! route('admin.addpricingtype') !!}" class="btn btn-danger">
                                Add New
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Tilte</th>
                        <th>Description</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pricingTypes as $k => $documentType)
                    <tr>
                        <td>{{$k + 1}}</td>
                        <td>{{$documentType->title}}</td>
                        <td>{{$documentType->description}}</td>
                        <td>
                            <a href="{!! route('admin.editpricingtype', [$documentType->id]) !!}">
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
