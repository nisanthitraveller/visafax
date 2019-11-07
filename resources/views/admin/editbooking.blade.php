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
                            $calClass = (in_array($key, ['JoiningDate', 'payment_date'])) ? 'datepicker2' : null;
                            $data = (in_array($key, ['JoiningDate', 'payment_date'])) ? date('d/m/Y', strtotime($data)) : $data;
                        ?>
                        @if($key == 'status')
                            <select class="form-control" id="form{{$key}}" name="{{$key}}">
                                <option value="0" <?php echo ($data == 0) ? 'selected' : null; ?>>NA</option>
                                <option value="0" <?php echo ($data == 1) ? 'selected' : null; ?>>Documentation</option>
                                <option value="0" <?php echo ($data == 2) ? 'selected' : null; ?>>Verification</option>
                                <option value="1" <?php echo ($data == 3) ? 'selected' : null; ?>>Approval</option>
                            </select>
                        @else
                            <input type="{{$type}}" value="{{$data}}" name="{{$key}}" class="form-control {{$calClass}}" id="form{{$key}}">
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
