<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Frontend\IndexController;

use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.index');
// });


Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){

    Route::get('/login',[AdminController::class,'loginForm']);

    Route::post('/login',[AdminController::class,'store'])->name('admin.login');

    Route::get('/change/password',[AdminController::class,'changePassword'])->name('admin.change.password');

});


Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');

Route::get('/admin/profile',[AdminController::class,'profile'])->name('admin.profile');

Route::get('/admin/profile/edit',[AdminController::class,'adminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/update',[AdminController::class,'adminProfileUpdate'])->name('admin.profile.store');

Route::post('/admin/profile/update',[AdminController::class,'adminProfileUpdate'])->name('admin.profile.store');

Route::get('/admin/change/password',[AdminController::class,'changePassword'])->name('admin.change.password');

Route::post('/admin/update/password',[AdminController::class,'updatePassword'])->name('admin.update.password');




Route::middleware(['auth:sanctum,admin','verified',])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});




Route::middleware(['auth:sanctum,web','verified',])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user_data = User::find($id);
        return view('dashboard',compact('user_data'));
    })->name('dashboard');
});


//............Frontend All Routes...................



Route::get('/',[IndexController::class,'index']);

Route::get('/user/logout',[IndexController::class,'userLogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'userProfile'])->name('user.profile');

Route::post('/user/profile/update',[IndexController::class,'userProfileUpdate'])->name('user.profile.update');

Route::get('/user/change/password',[IndexController::class,'userChangePassword'])->name('user.change.password');

Route::post('/user/change-password/update',[IndexController::class,'userUpdatePassword'])->name('user.change.password.store');