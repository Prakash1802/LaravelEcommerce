<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class IndexController extends Controller
{
   public function index(){

        return view('frontend.index');
   }

   public function userLogout(){

      Auth::logout();

      return redirect()->route('login');
   }

   public function userProfile(){

      $id = Auth::user()->id;
      $user_data = User::find($id);

      return view('frontend.profile.user_profile',compact('user_data'));
   }

   public function userProfileUpdate(Request $request){

      $user  = User::find(Auth::user()->id);

         if ($request->hasFile('profile_photo_path')) {

            $image = $request->file('profile_photo_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            @unlink(public_path('uploads/user_images/'.$user->profile_photo_path));
            if($image->move(public_path('uploads/user_images'), $imageName)) {

               $user_image = $imageName;
            
            }
         }else{

            $user_image = $user->profile_photo_path;
     

         }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->profile_photo_path = $user_image;

            $result = $user->save();

            $notification = [
                    'message'=>'User Profile updated successfully!',
                    'alert-type'=>'success',
               ];

           return redirect()->route('dashboard')->with($notification);
   }


   public function userChangePassword(){

      // $id = Auth::user()->id;
      // $user_data = User::find($id);

      return view('frontend.profile.change_password');
   }

   public function userUpdatePassword(Request $request){

      $validateData = $request->validate([

            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;


        if(Hash::check($request->oldpassword,$hashedPassword)){

            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('user.logout');

        }else{

            $notification = [
                    'message'=>'User password updated successfully!',
                    'alert-type'=>'success',
                ];
            return redirect()->back()->with($notification);
        }
   }
}

