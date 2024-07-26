<?php

use Illuminate\Support\Facades\Route;

use Modules\AddOnManager\Http\Controllers\AddOnController;


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
    ['as' => 'add-on.', 'prefix' => 'add-on'],
    function () {
        Route::post('addOnChangeStatus', [AddOnController::class, 'changeStatus'])->name('addOnChangeStatus');
        Route::get('add-on-manager', [AddOnController::class, 'index'])->name('add-on-manager');
        Route::get('add-on-manager/edit/{id}', [AddOnController::class, 'edit'])->name('addOnedit');
        Route::post('add-on-manager-update', [AddOnController::class, 'update'])->name('add-on-managerUpdate');
    }
);
