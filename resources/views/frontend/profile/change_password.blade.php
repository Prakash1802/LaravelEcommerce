@extends('frontend.main_master')
@section('content')

@php

$user_data  = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp

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
                    <h3 class="text-center"><span class="text-danger">Hii...<strong>{{Auth::user()->name}}</strong>  Change Your Password</span></h3>
                </div>

                <div class="card-body">
                <form method="POST" action="{{ route('user.change.password.store') }}" >
                    @csrf
                        <div class="form-group">
                            <label class="info-title">Current Password <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="current_password" name="oldpassword">
                            
                        </div>

                         <div class="form-group">
                            <label class="info-title">New Password<span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="password" name="password">
                          
                        </div>

                         <div class="form-group">
                            <label class="info-title">Confirm Password<span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="password_confirmation" name="password_confirmation">
                        
                        </div>

                         <div class="form-group mb-3">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button"> Update Password</button>
                         </div>
                    </form> 
                </div>
                 
             </div>
         </div>
    </div>
</div>

@endsection