<?php
use Illuminate\Support\Facades\Route;
use Modules\Pcapi\Http\Controllers\PcCategoryController;
use Modules\Pcapi\Http\Controllers\PcProductController;



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


// Route::group(['middleware' => 'auth'], function () {
    // Route::get('category', [PcApiController::class, 'index'])->name('category');
    Route::resource('pc-categories', PcCategoryController::class);
    Route::resource('pc-products', PcProductController::class);
    Route::post('changeStatus', [PcCategoryController::class, 'changeStatus'])->name('changeStatus');
    Route::post('pchangeStatus', [PcProductController::class, 'changeStatus'])->name('pchangeStatus');
    Route::post('pSortOrder', [PcProductController::class, 'sortOrder'])->name('pSortOrder');
    Route::post('pcCategrySortOrder', [PcCategoryController::class, 'sortOrder'])->name('pcCategrySortOrder');
    Route::post('pc-categories/{$id}', [PcCategoryController::class, 'catProduct'])->name('category-product');
   

