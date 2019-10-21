@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Assign Document</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formCountryName">Country Name:</label>
                    <div class="col-sm-8">
                        <input type="text" readonly value="{{$country->countryName}}" name="countryName" class="form-control" id="formCountryName">
                        <input type="hidden" value="{{$country->id}}" name="country_id" />
                    </div>
                </div>
                @foreach($documentTypes as $k => $documentType)
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="form{{$k}}">{{$documentType->type}}</label>
                        <div class="col-sm-2">
                            <?php $key = array_search($documentType->id, $documentTypeId) ?>
                            <?php $checked = ($key !== false) ? 'checked' : null; ?>
                            <input type="checkbox" {{$checked}} value="{{$documentType->id}}" name="document_type[{{$documentType->id}}]" class="form-control" id="form{{$k}}">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Drive ID" value="<?php if($key !== false) { echo $driveId[$key]; }?>" name="document_id[{{$documentType->id}}]" class="form-control">
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
