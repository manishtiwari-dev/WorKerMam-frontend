<?php
use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\EmailGroupController;
use Modules\Setting\Http\Controllers\EmailTemplatesController;
use Modules\Setting\Http\Controllers\ModuleController;
// use Modules\Setting\Http\Controllers\LeadSettingController;
use Modules\Setting\Http\Controllers\CustomFormController;
use Modules\Setting\Http\Controllers\SettingController;
use Modules\Setting\Http\Controllers\SettingGroupController;
use Modules\Setting\Http\Controllers\SettingGroupKeyController;
use Modules\Setting\Http\Controllers\WebLinkController;

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






// Route::group(['middleware' => 'auth'], function () {

	Route::resource('module-management', ModuleController::class);

	// Module management
	Route::controller(ModuleController::class)->group(function () {

	    // Route::resource('module-management');
	    Route::post('add-section', 'addsection')->name('add-section');
	    Route::post('section', 'section')->name('section');
	    Route::post('module-management/ModuleStatus', 'changemoduleStatus')->name('ModuleStatus');
	    Route::post('module-management/ModuleLiveStatus', 'changemoduleLiveStatus')->name('ModuleLiveStatus');
	    Route::post('module-management/module-edit' , 'editmodule')->name('module-edit');
	    Route::post('module-management/moduleupdate' , 'updatemodule')->name('moduleupdate');
	    Route::post('module-management/section-edit' , 'editsection')->name('section-edit');
	    Route::post('module-management/SectionStatus' , 'changesectionStatus')->name('SectionStatus');
	    Route::post('module-management/editdropdownn' , 'sectiondropdown')->name('editdropdownn');
	    Route::post('module-management/sectionupdate' , 'updatesection')->name('sectionupdate');
	    Route::post('module-management/section-sortorder-update' , 'updatesectionsortorder')->name('section-sortorder-update');
	    Route::post('module-management/module-sortorder-update' , 'updatemodulesortorder')->name('module-sortorder-update');
	    Route::post('module-management/SetionLiveStatus' , 'changesectionLiveStatus')->name('SetionLiveStatus');
	});

	//EMAIL GROUP ROUTES
	Route::resource('email-group', EmailGroupController::class);
	Route::post('emails/templateUpdate', [EmailGroupController::class,'templateUpdate'])->name('updatedata');
	Route::post('ajax-groupDelete', [EmailGroupController::class,'groupDestroy'])->name('ajax-groupDelete');
	
	//EMAIL TEMPLATE ROUTES
	Route::resource('email-template-data', EmailTemplatesController::class);
	Route::get('email-template/{id}', [EmailTemplatesController::class,'list'])->name('email-template');
	Route::post('templateDelete', [EmailTemplatesController::class,'templateDelete'])->name('templateDelete');
	Route::get('ajax-template-edit', [EmailTemplatesController::class,'templateEdit'])->name('ajax-template-edit');
	Route::get('store', [EmailTemplatesController::class,'storeId'])->name('storeId');
	Route::post('ajax-templateUpdate', [EmailTemplatesController::class,'templateUpdate'])->name('ajax-templateUpdate');
	Route::get('templateChangeStatus', [EmailTemplatesController::class,'changeStatus'])->name('templateChangeStatus');

	// // lead seting route
	// Route::resource('lead-setting', LeadSettingController::class);
	// Route::controller(LeadSettingController::class)->group(function () {
 //    Route::post('lead-setting-store-status','storeStatus')->name('lead-setting-store-status');
 //    Route::post('lead-setting-store-industry','storeIndustry')->name('lead-setting-store-industry');
 //    Route::post('lead-setting-update','LeadSourceUpdate')->name('lead-setting-update');
 //    Route::post('lead-setting-source','changesourceStatus')->name('lead-setting-source');
 //    Route::post('lead-setting-update-status','LeadStatusUpdate')->name('lead-setting-update-status');
 //    Route::post('lead-setting-status','changeStatus')->name('lead-setting-status');
 //    Route::post('lead-setting-update-industry','LeadIndustryUpdate')->name('lead-setting-update-industry');
 //    Route::post('lead-setting-industry','changeIndustryStatus')->name('lead-setting-industry');
	// });

    Route::resource('custom-form', CustomFormController::class);
    Route::get('changeStatus', [CustomFormController::class, 'changeStatus'])->name('change-status');
	Route::get('perpage', [CustomFormController::class, 'indexParpage'])->name('perpage');

     Route::resource('app-settings', SettingController::class); 

// app setting group route
    Route::resource('app-setting-group', SettingGroupController::class);

	Route::controller(SettingGroupController::class)->group(function () {
    Route::post('app-setting-group-status-change','changeSettineGroupStatus')->name('app-setting-group-status-change');
    Route::post('app-setting-group-update','SettingGroupUpdate')->name('app-setting-group-update');
    Route::post('app-setting-group-sortorder','updatesettinggroupsortorder')->name('app-setting-group-sortorder');
    Route::post('app-setting-group-delete','deleteappseting')->name('app-setting-group-delete');
	
	});




	// aap setting group key route
    Route::resource('app-setting-group-keydata', SettingGroupKeyController::class);
	Route::controller(SettingGroupKeyController::class)->group(function () {
    Route::post('app-setting-group-storekeydata','storekeydata')->name('app-setting-group-storekeydata');
    Route::get('app-setting-group-key/{id}','listing')->name('app-setting-group-key');
     Route::get('ajax-setting-group-key', 'editGroupKey')->name('ajax-setting-group-key');
     Route::get('group-key-store', 'getGroupId')->name('group-key-store');
    Route::post('app-setting-group-key-status','changeSettineGroupKeyStatus')->name('app-setting-group-key-status');
    Route::post('app-setting-group-key-sortorder','updatesettinggroupkeysortorder')->name('app-setting-group-key-sortorder');
    Route::post('app-setting-group-key-update','updateappsettingkey')->name('app-setting-group-key-update');
    Route::post('app-setting-group-key-delete','deleteappsetingkey')->name('app-setting-group-key-delete');
    Route::post('app-setting-group-key-edit','editgroupkey')->name('app-setting-group-key-edit');
	});
// });

