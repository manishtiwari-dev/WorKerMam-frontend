<?php

use Illuminate\Support\Facades\Route;
use Modules\Support\Http\Controllers\SupportController;
use Modules\Support\Http\Controllers\CategoryController;
use Modules\Support\Http\Controllers\AppReminderSettingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your aaplication. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// Route::get('/', function () {
//     return view('auth/login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');




Route::group(
    ['as' => 'manage-landing.', 'prefix' => 'manage-landing'],
    function () {
        Route::resource('knowledge', SupportController::class);
        Route::post('delete', [SupportController::class, 'destroy'])->name('delete');

        Route::resource('category', CategoryController::class);
        Route::post('category-delete', [CategoryController::class, 'destroy'])->name('category-delete');

      
    }
);
