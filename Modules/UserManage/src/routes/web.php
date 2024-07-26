<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManage\Http\Controllers\MediaController;
use Modules\UserManage\Http\Controllers\OrderStatusController;

use App\Helper\Helper;
use Modules\UserManage\Http\Controllers\WebLinkController;
use Modules\UserManage\Http\Controllers\UserController;
use Modules\UserManage\Http\Controllers\RoleController;





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
// Route::group(['as'=> 'hrm.', 'prefix' => 'hrm'], function(){


// });

Route::group(
    ['as' => 'website-setting.', 'prefix' => 'website-setting'],
    function () {

        Route::get('media', [MediaController::class, 'index'])->name('media');
        Route::get('media/view/{id}', [MediaController::class, 'show'])->name('media-view');
        Route::post('media/delete/{id}', [MediaController::class, 'destroy'])->name('media-delete');
        Route::post('media/store', [MediaController::class, 'store'])->name('media-store');
        Route::post('media/temp', [MediaController::class, 'temp_store'])->name('temp-store');
        Route::post('orderChangeStatus', [OrderStatusController::class, 'changeStatus'])->name('orderChangeStatus');
        Route::get('order-status', [OrderStatusController::class, 'index'])->name('order-status');
        Route::post('orderStatusSortOrder', [OrderStatusController::class, 'sortOrder'])->name('orderStatusSortOrder');
        Route::post('shippmentStatus', [OrderStatusController::class, 'shippmentStatus'])->name('shippmentStatus');
        Route::post('order_template_update', [OrderStatusController::class, 'template_update'])->name('order_template_update');

        // Web Link Routes

        Route::group(['as' => 'custom-link.', 'prefix' => 'custom-link'], function () {
            Route::get('/', [WebLinkController::class, 'index'])->name('customUrl');
            Route::post('/edit', [WebLinkController::class, 'edit'])->name('customUrlEdit');
            Route::post('/update', [WebLinkController::class, 'update'])->name('customUrlUpdate');
            Route::post('/store', [WebLinkController::class, 'store'])->name('customUrlStore');
            Route::post('/delete', [WebLinkController::class, 'delete'])->name('customUrlDelete');
            Route::post('/change-status', [WebLinkController::class, 'status'])->name('customUrlchangeStatus');
            Route::post('/web-link-filter', [WebLinkController::class, 'filter'])->name('webLinkFilter');
        });
    }
);



Route::group(['as' => 'user-manage.', 'prefix' => 'user-manage'], function () {

    Route::get('/user', [UserController::class, 'index'])->name('userList');
    Route::post('/user/edit', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/user/update', [UserController::class, 'update'])->name('userUpdate');
    Route::post('/user/store', [UserController::class, 'store'])->name('userStore');
    Route::post('/user/change-status', [UserController::class, 'status'])->name('userChangeStatus');

    Route::get('/role', [RoleController::class, 'index'])->name('roleList');
    Route::post('/role/edit', [RoleController::class, 'edit'])->name('roleListEdit');
    Route::post('/role/update', [RoleController::class, 'update'])->name('roleListUpdate');
    Route::post('/role/store', [RoleController::class, 'store'])->name('roleStore');
    Route::post('/role/sortOrder', [RoleController::class, 'sortOrder'])->name('roleListSortorder');
});
