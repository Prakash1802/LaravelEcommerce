@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
         <div class="row">
             <div  class="col-md-2"><br>
                <img class="card-img-top" style="border-radius: 50%;" src="{{ (!empty($user_data->profile_photo_path)) ? url('uploads/user_images/'.$user_data->profile_photo_path) : url('uploads/no_image.png') }}" height="100%" width="100%"><br><br>

                <ul class="list-group list-group-flush">
                    
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    
                </ul>
                 
             </div>

              <div  class="col-md-2">
                 
             </div>

              <div  class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hii...<strong>{{Auth::user()->name}}</strong>  Update Your Profile</span></h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label class="info-title">Name <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="name" name="name" value="{{$user_data->name}}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                         <div class="form-group">
                            <label class="info-title">Email<span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="email" name="email" value="{{$user_data->email}}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif

                        </div>

                         <div class="form-group">
                            <label class="info-title">Phone<span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="phone" name="phone" value="{{$user_data->phone}}">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label class="info-title">Image</label>
                            <input type="file" class="form-control unicase-form-control text-input" id="profile_photo_path" name="profile_photo_path">

                        </div>

                         <div class="form-group mb-3">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button ">Update</button>
                         </div>
                    </form> 
                </div>
                 
             </div>
         </div>
    </div>
</div>

@endsection