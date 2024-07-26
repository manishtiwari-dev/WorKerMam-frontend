<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Helper\Helper;

use App\Http\Controllers\Api\SeoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('seo-details',[SeoController::class,'index'])->name('seo-details');

Route::middleware('guest')->group(function () {
    // Route::get('register', [LoginController::class, 'create'])
    //             ->name('register');

    // Route::post('register', [LoginController::class, 'store']);

    Route::get('login', [LoginController::class, 'index'])->name('login');

    Route::post('login', [LoginController::class, 'login']);
    


    Route::get('superadmin/login', [LoginController::class, 'superlanding'])->name('superlogin');;
    Route::post('superadmin/login', [LoginController::class, 'superlogin']);

});

Route::middleware('checklogin')->group(function() {

    //Profile Route
    Route::get('my-profile',[ProfileController::class,'profile'])->name('my-profile');
    Route::post('change-password-profile', [ProfileController::class, 'ProfileUpdatePassword'])->name('change-password-profile');
    Route::post('profile-update', [ProfileController::class, 'ProfileUpdate'])->name('profile-update');
    
 
    //User Section
    Route::resource('user', UserController::class);
    Route::post('user-status-chenge',[UserController::class, 'ChangeUserStatus'])->name('user-status-chenge');
    Route::post('change-password', [UserController::class, 'UpdatePassword'])->name('change-password');
    Route::get('data/delete/{id}', [UserController::class, 'delete'])->name('delete');
    

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
 });
 
 Route::get('/cache-clear', function() {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        return 'Routes cache cleared';
    });

 Route::get('/', function () {
    Helper::essential_config_regenerate();
    Helper::DBConnect();
    return view('auth/login');
});



//require __DIR__.'/auth.php';