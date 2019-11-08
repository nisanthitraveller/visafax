@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Edit Country</h2>
        <div class="table-responsive-sm">          
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formCountryName">Country Name:</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{$country->countryName}}" name="countryName" class="form-control" id="formCountryName">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formVisa">Display Price:</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{$country->visa_cost}}" name="visa_cost" class="form-control" id="formVisa">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formStatus">Status:</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="formStatus" name="status">
                            <option value="0" <?php echo ($country->status == 0) ? 'selected' : null; ?>>In active</option>
                            <option value="1" <?php echo ($country->status == 1) ? 'selected' : null; ?>>Active</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formDescription">Visa Process:</label>
                    <div class="col-sm-8">
                        <textarea class="ckeditor form-control" id="formDescription" name="description">{{$country->description}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formDescription2">Document Checklist :</label>
                    <div class="col-sm-8">
                        <textarea class="ckeditor form-control" id="formDescription2" name="description2">{{$country->description2}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="formDescription3">FAQ:</label>
                    <div class="col-sm-8">
                        <textarea class="ckeditor form-control" id="formDescription3" name="description3">{{$country->description3}}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
