<!doctype html>
<html lang="{{ app()->getLocale() }}">
   <head>
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Laravel S3</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
       <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
       <style>
           body, .card{
               background: #ededed;
           }
       </style>
   </head>
   <body>
       <div class="container">
           <div class="row pt-5">
               <div class="col-sm-12">
                   @if ($errors->any())
                       <div class="alert alert-danger">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <ul>
                               @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                       </div>
                   @endif
                   @if (Session::has('success'))
                       <div class="alert alert-info">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <p>{{ Session::get('success') }}</p>
                       </div>
                   @endif
               </div>
               <div class="col-sm-8">
                   @if (count($images) > 0)
                       <div>
                           <div class="carousel-inner">
                               @foreach ($images as $image)
                                       <img class="d-block w-100" src="{{ $url . $image['Key'] }}" alt="First slide">
                                       <a href="{{url('deleteimage/' . $image['Key']}}">View Details</a>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   @else
                       <p>Nothing found</p>
                   @endif
               </div>
               <div class="col-sm-4">
                   <div class="card border-0 text-center">
                       <form action="{{ url('/s3/store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                           {{ csrf_field() }}
                           <div class="form-group">
                               <input type="file" name="image" id="image">
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-primary">Upload</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   </body>
</html>