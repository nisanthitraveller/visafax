@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Assign Document</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formCountryName">Country Name:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly value="{{$country->countryName}}" name="countryName" class="form-control" id="formCountryName">
                        <input type="hidden" value="{{$country->id}}" name="country_id" />
                    </div>
                </div>
                @foreach($pricingTypes as $k => $documentType)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="form{{$k}}">{{$documentType->title}}</label>
                        <div class="col-sm-2">
                            <?php $key = array_search($documentType->id, $priceId) ?>
                            <?php $checked = ($key !== false) ? 'checked' : null; ?>
                            <input type="checkbox" {{$checked}} value="{{$documentType->id}}" name="plan_id[]" class="form-control" id="form{{$k}}">
                        </div>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Price" value="<?php if($key !== false) { echo $price[$key]; }?>" name="price[]" class="form-control">
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
