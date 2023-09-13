<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;


use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;

use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;

use App\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

use App\Models\Admin;

use Auth;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    public function loginForm(){

        return view('auth.admin_login',['guard'=>'admin']);
    }

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;

       
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return app(LogoutResponse::class);
    }

    public function profile(){

        $data = Admin::find(1);
        return view('admin.admin_profile',compact('data'));
    }


    public function adminProfileEdit(){
         $data = Admin::find(1);
        return view('admin.change_profile',compact('data'));
    }

    public function adminProfileUpdate(Request $request){
        $admin = Admin::find(1);

        if ($request->hasFile('profile_photo_path')) {

            $image = $request->file('profile_photo_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            @unlink(public_path('uploads/admin_images/'.$admin->profile_photo_path));
            if($image->move(public_path('uploads/admin_images'), $imageName)) {

                
                $admin->name = $request->name;
                $admin->email = $request->email;
                $admin->profile_photo_path = $imageName;
                $result = $admin->save();

                $notification = [
                    'message'=>'Admin Profile updated successfully!',
                    'alert-type'=>'success',
                ];

               return redirect()->route('admin.profile')->with($notification);
            }
        }
         
    }


    public function changePassword(){
        $data = Admin::find(1);
        return view('admin.admin_change_password',compact('data'));
    }

    public function updatePassword(Request $request){

        $validateData = $request->validate([

            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ]);

        $hashedPassword = Admin::find(1)->password;


        if(Hash::check($request->oldpassword,$hashedPassword)){

            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');

        }else{

            $notification = [
                    'message'=>'Admin password updated successfully!',
                    'alert-type'=>'success',
                ];
            return redirect()->back()->with($notification);
        }
        
    }
}

