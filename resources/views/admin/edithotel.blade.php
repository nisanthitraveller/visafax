@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Edit Hotel</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                @foreach($hotel as $key => $data)
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="form{{$key}}">{{$key}}:</label>
                    <div class="col-sm-8">
                        @if($key == 'Country')
                        <select name="Country" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->countryName}}</option>
                            @endforeach 
                        </select>
                        @else
                        
                        <input type="text" value="{{$data}}" name="{{$key}}" class="form-control" id="form{{$key}}">
                        @endif
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
