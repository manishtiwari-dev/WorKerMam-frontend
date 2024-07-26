<?php

use Illuminate\Support\Facades\Route;
use Modules\Marketing\Http\Controllers\SenderListController;
use Modules\Marketing\Http\Controllers\TemplateController;
use Modules\Marketing\Http\Controllers\TemplateListController;
use Modules\Marketing\Http\Controllers\ContactGroupController;
use Modules\Marketing\Http\Controllers\ServerMailController;
use Modules\Marketing\Http\Controllers\ContactController;
use Modules\Marketing\Http\Controllers\CampaignController;
use Modules\Marketing\Http\Controllers\TemplateBuilderController;
use Modules\Marketing\Http\Controllers\NewsLetterController;





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
        ['as' => 'marketing.', 'prefix' => 'marketing', 'middleware' => 'checklogin'],
        function () {
                // Route::resource('server-mail', ServerMailController::class);
                // Route::post('server-update', [ServerMailController::class, 'ServerUpdate'])->name('server-update');

                // Sender List Resource
                Route::resource('sender-list', SenderListController::class);
                Route::get('sender-list-filter', [SenderListController::class, 'senderFilter'])->name('senderFilter');
                Route::post('sender-add', [SenderListController::class, 'AddSender'])->name('sender-add');
                Route::post('sender-delete', [SenderListController::class, 'DeleteSender'])->name('sender-delete');
                Route::post('sender-update', [SenderListController::class, 'SenderUpdate'])->name('sender-update');
                Route::post('sender-status', [SenderListController::class, 'ChangeSenderStatus'])->name('sender-status');
                Route::post('server-status', [ServerMailController::class, 'ChangeServerStatus'])->name('server-status');

                //campaign Route
                Route::resource('campaign', CampaignController::class);
                Route::get('campaign-filter', [CampaignController::class, 'campaignFilter'])->name('campaignFilter');
                Route::post('campaign-status', [CampaignController::class, 'ChangeCampaignStatus'])->name('campaign-status');
                Route::get('campaign/edit/{id}', [CampaignController::class, 'edit'])->name('campaign-edit');
                Route::post('campaign-update', [CampaignController::class, 'CampaignUpdate'])->name('campaign-update');
                Route::post('campaign-delete', [CampaignController::class, 'destroy'])->name('campaign-delete');
                Route::get('campaign/view/{id}', [CampaignController::class, 'CampaignView'])->name('campaign-view');

                // Template Route
                Route::resource('template-group-list', TemplateController::class);
                Route::post('template-status', [TemplateController::class, 'ChangeTemplateStatus'])->name('template-status');
                Route::post('template-delete', [TemplateController::class, 'TemplateDestroy'])->name('template-delete');
                Route::post('template-update', [TemplateController::class, 'TemplateUpdate'])->name('template-update');

                // Template route
                Route::resource('template-list', TemplateListController::class);
                Route::get('email-template-filter', [TemplateListController::class, 'templateFilter'])->name('emailtemplateFilter');
                Route::get('template-lists/{id}', [TemplateListController::class, 'TemplateList'])->name('template-list');
                Route::get('template-lists/create/pro-editor', [TemplateListController::class, 'proEditor'])->name('template.pro-editor');
                Route::post('template-list-status', [TemplateListController::class, 'ChangeTemplateListStatus'])->name('template-list-status');
                Route::post('template-list-delete', [TemplateListController::class, 'TemplateListDestroy'])->name('template-list-delete');
                Route::post('template-list-update/{id}', [TemplateListController::class, 'TemplateListUpdate'])->name('template-list-update');


                // Pro-template-editor

                Route::post('/pro/email-builder/upload', [TemplateBuilderController::class, 'imgUpload'])
                        ->name('pro.template.builder.image_upload');

                Route::get('/pro/email-builder/get-image', [TemplateBuilderController::class, 'getImg'])
                        ->name('pro.template.builder.get.image');

                Route::any('/pro/email-builder/store', [TemplateBuilderController::class, 'store'])
                        ->name('pro.template.builder.store');

                Route::post('/pro/email-builder/edit', [TemplateBuilderController::class, 'edit'])
                        ->name('pro.template.builder.edit');



                //Contact route

                Route::get('contact', [ContactGroupController::class, 'contactSource'])->name('contact');

                Route::get('contact-group', [ContactGroupController::class, 'contactGroups'])->name('contact-group');
                Route::post('contact-group-store', [ContactGroupController::class, 'store'])->name('contact-group-store');
                Route::post('contact-group-edit', [ContactGroupController::class, 'edit'])->name('contact-group-edit');
                Route::get('contact-group-filter', [ContactGroupController::class, 'contactGroupFilter'])->name('contactGroupFilter');
                Route::post('contact-group/changeContactGroupStatus', [ContactGroupController::class, 'changeContactGroupStatus'])->name('changeContactGroupStatus');
                Route::post('contact-group/contactGroupUpdate', [ContactGroupController::class, 'contactGroupUpdate'])->name('contactGroupUpdate');
                Route::get('deleteContactGroup/{id}', [ContactGroupController::class, 'deleteContactGroup'])->name('deleteContactGroup');

                //Contact Lists route 
                Route::get('contact-group/{id}', [ContactGroupController::class, 'contactGroupView'])->name('contact-group-view'); // contact group to contact list

                Route::get('contact-list/{source}', [ContactGroupController::class, 'contacList'])->name('contact-list');
                Route::get('contact-create', [ContactGroupController::class, 'contactCreate'])->name('contact-create');
                Route::post('contact-add', [ContactGroupController::class, 'storeContact'])->name('contact-add');
                Route::get('contact-edit/{id}', [ContactGroupController::class, 'groupContactEdit'])->name('contact-edit');
                Route::put('contact-update', [ContactGroupController::class, 'groupContactUpdate'])->name('contact-update');
                Route::post('contact-delete', [ContactGroupController::class, 'groupDeleteContact'])->name('contact-delete');
                Route::get('contact-import', [ContactGroupController::class, 'contactImport'])->name('contact-import');
                Route::post('contact-import-upload', [ContactGroupController::class, 'contactImportStore'])->name('contact-import-upload');
                Route::get('download-sample-file', [ContactGroupController::class, 'donwloadFile'])->name('simple-download-file');
                Route::post('contact-filter', [ContactGroupController::class, 'contactListFilter'])->name('contactListFilter');

                Route::resource('subscription', NewsLetterController::class);
                Route::post('subscription-filter', [NewsLetterController::class, 'newsletterFilter'])->name('newsletterFilter');


                //Bulk Import of contacts inside group details

                // Route::get('import-contacts', [ContactController::class, 'import'])->name('importcreate');
                // Route::post('import', [ContactController::class, 'uploadContactList'])->name('import');


                //contact list route

                //     Route::get('contact-list/{id}',[ContactController::class,'GetContact'])->name('get-contact-id');
                // Route::get('contact-lists/{id}',[ContactController::class,'GetContactList'])->name('contact-list-show');
                // Route::resource('add-contact', ContactController::class);
                //     Route::get('contact-list/{id}',[ContactController::class,'GetGroupId'])->name('contact-list');
                // Route::get('/contact-list/{id}', [ContactController::class, 'GetContactList']);
                // Route::get('checkgroupbox', [ContactController::class, 'checkgroupbox'])->name('checkgroupbox');

                // Route::post('contact-list/updateContact', [ContactController::class, 'updateContact'])->name('updateContact');
                // Route::post('contact-list/changeContactListStatus', [ContactController::class, 'changeContactListStatus'])->name('changeContactListStatus');
                // Route::post('contact-list/ChangeContactToGroupStatus', [ContactController::class, 'ChangeContactToGroupStatus'])->name('ChangeContactToGroupStatus');
        }
);
