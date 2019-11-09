@extends('layouts.adminitr')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h2>Assign Document</h2>
        <div class="table-responsive-sm">
            
            <table class="display compact table-bordered table-hover table-striped table-condensed" id="listTable">
                
                <tbody>
                    @foreach($assignedDocuments as $k => $documentType)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$documentType['documenttype']['type']}}</td>
                        <td>
                            <form method="GET" enctype="multipart/form-data" class="your-dts">
                                <select name="status" onchange="$(this).parents('form:first').submit()">
                                    <option value="0" <?php echo ($documentType['status'] == 0) ? 'selected' : null; ?>>Pending - Customer Review</option>
                                    <option value="1" <?php echo ($documentType['status'] == 1) ? 'selected' : null; ?>>Pending - VisaBadge Review</option>
                                    <option value="2" <?php echo ($documentType['status'] == 2) ? 'selected' : null; ?>>Verified</option>
                                </select>
                                <input type="hidden" name="id" value="{{$documentType['id']}}" />
                            </form>
                        </td>
                        <td>
                            @if($documentType['DriveId'] == '')
                            <form method="POST" enctype="multipart/form-data" class="your-dts">
                                <input type="file" name="pdf" style="float: left" />
                                <input type="hidden" name="id" value="{{$documentType['id']}}" />
                                @if($documentType['DriveId'] == '' && $documentType['pdf'] == '')
                                    <button style="float: left">Upload</button>
                                @elseif($documentType['DriveId'] == '' && $documentType['pdf'] != '')
                                    <button style="float: left">Upload New</button>
                                @endif
                            </form>
                            @endif
                        </td>
                        <td>
                            @if($documentType['DriveId'] == '' && $documentType['pdf'] != '')
                                <a target="_blank" href="{{url('/')}}/uploads/{{$documentType['pdf']}}">View</a>
                            @elseif($documentType['DriveId'] != '')
                                <a target="_blank" href="https://docs.google.com/document/d/{{$documentType['DriveId']}}">View</a>
                            @endif
                        </td>
                        <td>
                            <form method="POST" class="your-dts">
                                @csrf
                                <input type="hidden" name="delete" value="{{$documentType['id']}}" />
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>
<div id="fade"></div>
<div id="loader-modal">
    <img src="{{url('/')}}/images/loading.gif">
</div>
@endsection