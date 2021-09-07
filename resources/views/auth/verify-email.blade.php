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
                    <h4 class="">Please verify your email</h4>
                    <p>
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </p>

                    @if (session('status') == 'verification-link-sent')
                    <p>
                    A new verification link has been sent to the email address you provided during registration.
                    </p>
                    @endif
                    
                    <form method="POST"  action="{{ route('verification.send') }}"  class="register-form outer-top-xs" role="form">
                        @csrf

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Resend Verification Email</button>
                        
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