@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Edit Booking</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                @foreach($user as $key => $data)
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="form{{$key}}">{{$key}}:</label>
                    <div class="col-sm-8">
                        <?php
                            $type = 'text';
                            if($key == 'Duration') {
                                $type = 'number';
                            }
                            $calClass = ($key == 'JoiningDate') ? 'datepicker' : null;
                        ?>
                        <input type="{{$type}}" value="{{$data}}" name="{{$key}}" class="form-control {{$calClass}}" id="form{{$key}}">
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
