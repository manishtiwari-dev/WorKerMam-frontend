<?php
use Illuminate\Support\Facades\Route;
use Modules\CRM\Http\Controllers\LeadFollowupController;
use Modules\CRM\Http\Controllers\LeadSettingController;
// use Modules\CRM\Http\Controllers\QuotationController;
// use Modules\CRM\Http\Controllers\CustomerController;
use Modules\CRM\Http\Controllers\EnquiryController;
use Modules\CRM\Http\Controllers\LeadController;
use Modules\CRM\Http\Controllers\LeadAgentController;



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
    ['as' => 'crm.', 'prefix' => 'crm'],
    function () {
        
    //lead followup route
    Route::resource('lead-followup', LeadFollowupController::class);
    Route::post('lead/remove', [LeadFollowupController::class,'addmoredelete'])->name('remove');
    Route::get('status_tab', [LeadFollowupController::class,'status_tab'])->name('status_tab');
    Route::post('client-followup-store',
    [LeadFollowupController::class,'FollowupStore'])->name('client-followup-store');
    Route::post('get-followup', [LeadFollowupController::class,'GetFollowup'])->name('get-followup');
    Route::post('get-followupHistory', [LeadFollowupController::class,'followupHistory'])->name('get-followupHistory');
    Route::post('client-note-store', [LeadFollowupController::class,'NoteStore'])->name('client-note-store');
    Route::post('get-followup-details',
    [LeadFollowupController::class,'GetFollowupdetails'])->name('get-followup-details');

    Route::get('followup-filter', [LeadFollowupController::class, 'followupfilter'])->name('followup-filter');
    Route::post('lead-tag-update', [LeadFollowupController::class, 'LeadTagUpdate'])->name('lead-tag-update'); 

  
  
    // lead seting route
    Route::resource('lead-setting', LeadSettingController::class);
    Route::controller(LeadSettingController::class)->group(function () {
    Route::post('lead-setting-store-status','storeStatus')->name('lead-setting-store-status');
    Route::post('lead-setting-store-industry','storeIndustry')->name('lead-setting-store-industry');
    Route::post('lead-setting-update','LeadSourceUpdate')->name('lead-setting-update');
    Route::post('lead-setting-source','changesourceStatus')->name('lead-setting-source');
    Route::post('lead-setting-update-status','LeadStatusUpdate')->name('lead-setting-update-status');
    Route::post('lead-setting-status','changeStatus')->name('lead-setting-status');
    Route::post('lead-setting-update-industry','LeadIndustryUpdate')->name('lead-setting-update-industry');
    Route::post('lead-setting-industry','changeIndustryStatus')->name('lead-setting-industry');

    Route::post('lead-status-sort-order','sortOrder')->name('lead-status-sort-order');
    Route::post('lead-source-sort-order','SourceSortOrder')->name('lead-source-sort-order');
    Route::post('lead-status-color','statusColor')->name('lead-status-color');
 
  
    
    });

    Route::controller(LeadAgentController::class)->group(function () {
        Route::post('dept-user','departmentUser')->name('dept-user');
        Route::post('lead-agent-store','AgentStore')->name('lead-agent-store');
        Route::post('lead-tags-store','TagStore')->name('lead-tags-store');
        Route::get('lead-tags-edit/{id}', 'tags_edit')->name('lead-tags-edit');
        Route::post('lead-tags-update','TagUpdate')->name('lead-tags-update');
        Route::post('lead-tags-status','changeTagStatus')->name('lead-tags-status');
        Route::post('lead-tags-sortOrder','tagSortOrder')->name('lead-tags-sortOrder');


        
        
        Route::get('lead-agent-edit/{id}', 'agent_edit')->name('lead-agent-edit');
        Route::post('lead-agent-update','LeadAgentUpdate')->name('lead-agent-update');
        Route::post('lead-agent-status','changeStatus')->name('lead-agent-status');
        Route::post('lead-agent-sortOrder','sortOrder')->name('lead-agent-sortOrder');

        
    });



    Route::get('lead-source-edit/{id}', [LeadSettingController::class,'source_edit'])->name('lead-source-edit');
    Route::get('lead-status-edit/{id}', [LeadSettingController::class,'status_edit'])->name('lead-status-edit');
    Route::get('lead-industry-edit/{id}', [LeadSettingController::class,'industry_edit'])->name('lead-indusrty-edi');
    Route::post('lead-industry-sort-order',
    [LeadSettingController::class,'industrySortOrder'])->name('lead-industry-sort-order');


    //lead route
    Route::resource('lead', LeadController::class);
    Route::post('lead-update', [LeadController::class,'leadUpdate'])->name('leadUpdate');
    Route::post('lead-status', [LeadController::class,'leadStatus'])->name('lead-status');
    Route::post('agent-update', [LeadController::class,'agentUpdate'])->name('agent-update');
    Route::get('lead-filter', [LeadController::class, 'leadfilter'])->name('lead-filter');
    Route::get('lead-import-create', [LeadController::class, 'leadImportCreate'])->name('lead-import-create');

    Route::post('lead-import-store', [LeadController::class, 'leadImportStore'])->name('lead-import-store');

    Route::get('download-sample-file', [LeadController::class, 'donwloadFile'])->name('simple-download-file');

    Route::post('source-update', [LeadController::class, 'sourceUpdate'])->name('source-update');
    Route::post('group-update', [LeadController::class, 'groupUpdate'])->name('group-update');
    Route::get('lead-edit/{id}', [LeadController::class,'leadEdit'])->name('lead-edit');
});
 