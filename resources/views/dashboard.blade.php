@extends('frontend.main_master')
@section('content')

<div class="body-content">
	<div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('frontend.body.sidebar_profile') 
            </div> <!-- end col md 2-->
            <div class="col-md-2"></div> <!-- end col md 2-->
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi......</span>
                        <strong>{{Auth::user()->name}}</strong>
                        Welcome to simple ecommerce
                        
                    </h3>
                </div>
            </div> <!-- end col md 8-->
        </div><!--  end row -->
    </div>
</div>

@endsection