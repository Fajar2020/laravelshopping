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
                        Update Your Profile
                    </h3>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="name">Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="name" name="name" value="{{$user->name}}" autofocus autocomplete="name" required  >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email" name="email" value="{{$user->email}}" required >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="phone">Phone <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="phone" name="phone" value="{{$user->phone}}" required >
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="phone">User Profile</label>
                                <input type="file" name="profile_photo_path" class="form-control unicase-form-control text-input" >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div> <!-- end col md 8-->
        </div><!--  end row -->
    </div>
</div>

@endsection