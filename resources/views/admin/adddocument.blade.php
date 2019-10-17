@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Add New</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="formType">Type:</label>
                    <div class="col-sm-10">
                        <input type="text" value="" required="" name="type" class="form-control" id="formType">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
