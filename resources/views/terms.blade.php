@extends('layouts.app')

@section('content')
<!-- style="background-image: url(images/hero-home.jpg);" -->
<section class="banner" style="background-image: url({{url('/')}}/images/hero-home.png);">
    <div class="container">
        <div class="col-sm-12">
            <div class="row align-items-center justify-content-center pt-5">
                <div class="card-body">
                    <h1>Terms</h1>
                    <p>Terms and conditions</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
