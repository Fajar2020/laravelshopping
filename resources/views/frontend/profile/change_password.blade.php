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
                        Change Password
                    </h3>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.password.update') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                <input id="password" class="form-control unicase-form-control text-input"  type="password" name="current_password" required>
                                @error("current_password")
                                    <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">New Password <span>*</span></label>
                                <input id="password" class="form-control unicase-form-control text-input"  type="password" name="password" required >
                                @error("password")
                                    <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Confirm Password <span>*</span></label>
                                <input id="password" class="form-control unicase-form-control text-input"  type="password" name="password_confirmation" required >
                                @error("password_confirmation")
                                    <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Change Password</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div> <!-- end col md 8-->
        </div><!--  end row -->
    </div>
</div>

@endsection