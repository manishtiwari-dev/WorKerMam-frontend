<?php

use Illuminate\Support\Facades\Route;
use Modules\SystemSetting\Http\Controllers\TaxSettingController;
use Modules\SystemSetting\Http\Controllers\TaxTypeController;
use Modules\SystemSetting\Http\Controllers\TaxGroupController;
use Modules\SystemSetting\Http\Controllers\GeneralSettingController;
use Modules\SystemSetting\Http\Controllers\PaymentSettingController;
use Modules\SystemSetting\Http\Controllers\PaymentTermController;



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


Route::group(['as' => 'system-setting.', 'prefix' => 'system-setting'], function () {
    Route::get('/app-settings', [GeneralSettingController::class, 'index'])->name('app-settings');
    Route::post('appSetting/update', [GeneralSettingController::class, 'update'])->name('appSettingUpdate');

    Route::get('/payment-setting', [PaymentSettingController::class, 'index'])->name('payment-settings');
    Route::post('paymentSetting/update', [PaymentSettingController::class, 'update'])->name('paymertSettingUpdate');

    Route::get('/payment-term', [PaymentTermController::class, 'index'])->name('paymentTerm');
    Route::post('/payment-term/edit', [PaymentTermController::class, 'edit'])->name('paymentTermEdit');
    Route::post('/payment-term/update', [PaymentTermController::class, 'update'])->name('paymentTermUpdate');
    Route::post('/payment-term/store', [PaymentTermController::class, 'store'])->name('paymentTermStore');
    Route::post('/payment-term/change-status', [PaymentTermController::class, 'status'])->name('paymentTermchangeStatus');


    Route::get('/tax-setting', [TaxSettingController::class, 'index'])->name('tax-setting');

    Route::post('tax-setting/changeStatus', [TaxSettingController::class, 'ChangeStatus'])->name('changeStatus');
    Route::post('tax-setting/delete', [TaxSettingController::class, 'destroy'])->name('tax-group-delete');
    Route::get('tax-setting/view/{id}', [TaxSettingController::class, 'show'])->name('tax-setting-view');
    Route::get('tax-setting/{id}/edit', [TaxSettingController::class, 'edit'])->name('tax-setting-edit');
    Route::post('tax-group/update', [TaxSettingController::class, 'taxGrpupdate'])->name('taxGrpupdate');


    Route::post('tax-setting/{id}', [TaxSettingController::class, 'update'])->name('taxUpdate');
    Route::resource('tax-group', TaxGroupController::class);
    Route::resource('tax-type', TaxTypeController::class);
});
