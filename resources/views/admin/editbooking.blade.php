@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Edit Booking</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                @foreach($user as $key => $data)
                <div class="form-group">
                    <label for="form{{$key}}">{{$key}}:</label>
                    <input type="text" value="{{$data}}" name="{{$key}}" class="form-control" id="form{{$key}}">
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
