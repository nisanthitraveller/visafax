@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Add New</h2>
        <div class="table-responsive-sm">          
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Title:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="title" class="form-control" id="formType">
                    </div>
                    <label class="col-sm-4 col-form-label" for="formType">Description:</label>
                    <div class="col-sm-8">
                        <textarea name="description" class="form-control ckeditor"></textarea>
                    </div>
                    <label class="col-sm-4 col-form-label" for="formType">Icon:</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="icon" />
                    </div>
                    <label class="col-sm-4 col-form-label">Default Price:</label>
                    <div class="col-sm-8">
                        <input type="text" value="" required="" name="default_price" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
