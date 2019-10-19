@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Assign Document</h2>
        <div class="table-responsive-sm">          
            <form method="post" id="visaForm" name="visaForm">
                @foreach($countryDocuments as $k => $documentType)
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label" for="form{{$k}}">{{$documentType['documenttype']['type']}}</label>
                        <div class="col-sm-2">
                            <?php $checked = in_array($documentType['document_type'], $selected) ? 'checked disabled' : null; ?>
                            <input type="checkbox" {{$checked}} value="{{$documentType['document_type']}}" name="document_type[]" class="form-control" id="form{{$k}}">
                        </div>
                    </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-sm-4">
                    <input type="hidden" name="bookingId" value="{{$booking['id']}}" />
                    <div class="my-signin2" id="my-signin2" data-width="260" data-height="50" data-theme="dark" data-longtitle="true" data-onsuccess="onSignIn"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="alert alert-warning" role="alert">
                            Please authenticate using google to create drive
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="fade"></div>
<div id="loader-modal">
    <img src="{{url('/')}}/images/loading.gif">
</div>
@endsection
