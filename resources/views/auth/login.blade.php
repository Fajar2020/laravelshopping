@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				<li class='active'>Login</li>
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
                    <h4 class="">Sign in</h4>
                    <p class="">Hello, Welcome to your account.</p>
                    <!-- <div class="social-sign-in outer-top-xs">
                        <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                        <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                    </div> -->
                    <div style="margin-top: 30px">
                    </div>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="forgot-password pull-right">Register new account</a>
                    @endif
                    <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}"  class="register-form outer-top-xs" role="form">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                            <input class="form-control unicase-form-control text-input" id="email" type="email" name="email" :value="old('email')" required autofocus >
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                            <input id="password" class="form-control unicase-form-control text-input"  type="password" name="password" required autocomplete="current-password"  >
                        </div>
                        <div class="radio outer-xs">
                            <label>
                                <input type="radio" id="remember_me" name="remember">Remember me!
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
                            @endif
                            
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                        
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