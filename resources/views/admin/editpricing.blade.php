@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Edit Pricing Master</h2>
        <div class="table-responsive-sm">          
            <form method="post" enctype="multipart/form-data">
                @foreach($pricingType as $key => $data)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="form{{$key}}">{{$key}}:</label>
                    <div class="col-sm-10">
                        @if($key == 'description')
                            <textarea id="form{{$key}}" class="ckeditor form-control" name="{{$key}}">{{$data}}</textarea>
                        @elseif($key == 'icon')
                            <input type="file" class="form-control" name="icon" />
                        @elseif($key == 'status')
                            <select class="form-control" id="form{{$key}}" name="{{$key}}">
                                <option value="0" <?php echo ($data == 0) ? 'selected' : null; ?>>In active</option>
                                <option value="1" <?php echo ($data == 1) ? 'selected' : null; ?>>Active</option>
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
