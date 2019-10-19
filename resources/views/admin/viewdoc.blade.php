@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Assign Document</h2>
        <div class="table-responsive-sm">
            <table class="display compact table-bordered table-hover table-striped table-condensed" id="listTable">
                
                <tbody>
                    @foreach($countryDocuments as $k => $documentType)
                    <?php $checked = in_array($documentType['document_type'], $selected) ? 'checked' : null; ?>
                    <?php $driveKey = array_search($documentType['document_type'], $driveId) ?>
                    @if($checked != null)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$documentType['documenttype']['type']}}</td>
                        <td>
                            <select>
                                <option value="0">Verification Ongoing</option>
                                <option value="1">Verified</option>
                            </select>
                        </td>
                        <td>
                            @if($driveKey === false)
                                Upload
                            @endif
                        </td>
                        <td>
                            @if($driveKey !== false)
                            <a target="_blank" href="https://docs.google.com/document/d/{{$driveKey}}">View</a>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="fade"></div>
<div id="loader-modal">
    <img src="{{url('/')}}/images/loading.gif">
</div>
@endsection
