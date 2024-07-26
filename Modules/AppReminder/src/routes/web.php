<?php

use Illuminate\Support\Facades\Route;

use Modules\AppReminder\Http\Controllers\AppReminderSettingController;


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
    ['as' => 'app-reminder.', 'prefix' => 'app-reminder'],
    function () {
      

        Route::resource('setting', AppReminderSettingController::class);
        Route::post('app-reminder-status', [AppReminderSettingController::class, 'ChangeStatus'])->name('app-reminder-status');
        Route::post('app-reminder-delete', [AppReminderSettingController::class, 'appReminderListDestroy'])->name('app-reminder-delete');

        Route::get('setting-filter', [AppReminderSettingController::class, 'Filter'])->name('ReminderFilter');
    }
);
