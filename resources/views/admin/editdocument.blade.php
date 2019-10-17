@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Edit Document Name</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                @foreach($documentType as $key => $data)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="form{{$key}}">{{$key}}:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{$data}}" name="{{$key}}" class="form-control" id="form{{$key}}">
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
