@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				<li class='active'>Reset Password</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->
                <div class="col-md-3"></div>			
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Reset Password</h4>
                    
                    <form method="POST" action="{{ route('password.update') }}"  class="register-form outer-top-xs" role="form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                            <input class="form-control unicase-form-control text-input" id="email" type="email" name="email" :value="old('email')" required autofocus >
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                            <input id="password" class="form-control unicase-form-control text-input"  type="password" name="password" required autocomplete="new-password"  >
                        </div>
                        
                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Confirm Password <span>*</span></label>
                            <input id="password_confirmation" class="form-control unicase-form-control text-input"  type="password" name="password_confirmation" required autocomplete="new-password" >
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
                        
                    </form>					
                </div>
                <div class="col-md-3"></div>
            <!-- Sign-in -->
		    </div><!-- /.sigin-in-->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands');
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
        </div>
    </div>
</div><!-- /.body-content -->

@endsection