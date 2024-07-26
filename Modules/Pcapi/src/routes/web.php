<?php

use Illuminate\Support\Facades\Route;
use Modules\Pcapi\Http\Controllers\PcCategoryController;
use Modules\Pcapi\Http\Controllers\PcProductController;
use Modules\Pcapi\Http\Controllers\PriceCalculatorController;
use Modules\Pcapi\Http\Controllers\DigitalProofController;
use Modules\Pcapi\Http\Controllers\CustomShippingController;



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


Route::group(
    ['as' => 'papachina-product.', 'prefix' => 'papachina-product'],
    function () {
        // Route::group(['middleware' => 'auth'], function () {
        // Route::get('category', [PcApiController::class, 'index'])->name('category');
        Route::resource('pc-categories', PcCategoryController::class);
        Route::post('category-filter', [PcCategoryController::class, 'categoryFilter'])->name('category-filter');
        Route::post('sub-category-filter', [PcCategoryController::class, 'subcategoryFilter'])->name('sub-category-filter');
        
        Route::resource('pc-products', PcProductController::class);
        Route::post('changeStatus', [PcCategoryController::class, 'changeStatus'])->name('changeStatus');
        Route::post('pchangeStatus', [PcProductController::class, 'changeStatus'])->name('pchangeStatus');
        Route::post('changeProductStatus', [PcCategoryController::class, 'changeProductStatus'])->name('changeProductStatus');
        Route::post('pSortOrder', [PcProductController::class, 'sortOrder'])->name('pSortOrder');
        Route::post('productSortOrder', [PcProductController::class, 'productSortOrder'])->name('productSortOrder');
        Route::post('pcCategrySortOrder', [PcCategoryController::class, 'sortOrder'])->name('pcCategrySortOrder');
        Route::post('pc-categories/{$id}', [PcCategoryController::class, 'catProduct'])->name('category-product');
        Route::post('isFeatureStatus', [PcCategoryController::class, 'isFeatureStatus'])->name('isFeatureStatus');

        Route::get('category/product/{id}', [PcCategoryController::class, 'productShow'])->name('productShownew');
        Route::post('productCategorySortOrder', [PcCategoryController::class, 'ProductTocategorySortOrder'])->name('productCategorySortOrder');

        Route::post('product-filter', [PcProductController::class, 'ProductListFilter'])->name('ProductListFilter');
        Route::post('product-cat-filter', [PcCategoryController::class, 'ProductToCatFilter'])->name('ProductToCatFilter');

        
        Route::resource('price-calculator', PriceCalculatorController::class);
        Route::post('price-calculator/details/', [PriceCalculatorController::class, 'details'])->name('priceproductDetails');
        Route::post('price-calculator/shipping/', [PriceCalculatorController::class, 'calculateShipping'])->name('calculateShipping');

        Route::resource('digital-proof', DigitalProofController::class);
        Route::post('digital-proof/details', [DigitalProofController::class, 'details'])->name('digitalProofdetails');


        Route::resource('custom-shipping', CustomShippingController::class);
        Route::post('custom-shipping/update/', [CustomShippingController::class, 'shippingUpdate'])->name('shippingUpdate');
    }
);
