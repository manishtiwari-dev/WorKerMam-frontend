<?php

use Illuminate\Support\Facades\Route;

use Modules\SEO\Http\Controllers\SeoWorkController;

use Modules\SEO\Http\Controllers\SeoResultController;

use Modules\SEO\Http\Controllers\SeoSettingController;
use Modules\SEO\Http\Controllers\SeoReportController;
use Modules\SEO\Http\Controllers\SeoSubmissionController;
use Modules\SEO\Http\Controllers\SeoWebRedirectorController;

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


// Route::group(['middleware' => 'auth'], function () {
// Route::middleware('checklogin')->group(function () {
Route::group(['as' => 'seo.', 'prefix' => 'seo'], function () {

    Route::resource('daily-work', SeoWorkController::class);
    Route::post('work-report-update/{id}', [SeoWorkController::class, 'work_report_update'])->name('work-report-update');
    Route::post('duplicate-checker-update/{id}', [SeoWorkController::class, 'duplicate_checker_update'])->name('duplicate-checker-update');

    Route::get('duplicate-checker/{id}', [SeoWorkController::class, 'duplicate_checker'])->name('duplicate-checker');

    

    Route::post('/landing-url-check', [SeoWorkController::class, 'landingUrlCheck'])->name('landingUrlCheck');


    Route::get('work-posting-update', [SeoWorkController::class, 'PostingUpdate'])->name('work-posting-update');
    Route::post('daily-work-status', [SeoWorkController::class, 'dailyWorkStatus'])->name('dailyWorkStatus');
    Route::post('work-posting-store', [SeoWorkController::class, 'postingstore'])->name('work-posting-store');

    Route::post('/change-dofollow-status', [SeoWorkController::class, 'changeDofollowStatus'])->name('changedofollowStatus');




    Route::resource('work-report', SeoReportController::class);
    Route::get('import', [SeoReportController::class, 'importData'])->name('work-report.import');
    Route::post('export', [SeoReportController::class, 'exportData'])->name('work-report.export');
    Route::post('work-report-url', [SeoReportController::class, 'workReportUrl'])->name('work-report-url');
    Route::post('work-report/import', [SeoReportController::class, 'importStore'])->name('work-report.import.store');



    //Seo task
    Route::post('task/change-task-status', [SeoSettingController::class, 'changeTaskStatus'])->name('changeTaskStatus');
    Route::post('task/change-task-duplicate', [SeoSettingController::class, 'changeDuplicateStatus'])->name('changeDuplicateStatus');


    Route::post('task-delete/{id}', [SeoSettingController::class, 'task_destroy'])->name('seo_task');
    Route::get('task-edit/{id}', [SeoSettingController::class, 'task_edit'])->name('seo-task-edit');
    Route::post('task-update/{id}', [SeoSettingController::class, 'task_update'])->name('seo-task-update');
    Route::get('task-create', [SeoSettingController::class, 'task_create'])->name('seo-task-create');
    Route::post('task-store', [SeoSettingController::class, 'task_store'])->name('seo-task-store');
    //end seo task

    //Seo result route
    Route::post('child-delete/{id}', [SeoSettingController::class, 'result_destroy'])->name('child-delete');
    Route::post('seo-results-update', [SeoSettingController::class, 'resultUpdate'])->name('seo-results-update');
    Route::post('results-store', [SeoSettingController::class, 'result_store'])->name('seo-results-store');
    Route::get('results-edit/{id}', [SeoSettingController::class, 'result_edit'])->name('seo-results-edit');
    Route::post('results-create', [SeoSettingController::class, 'result_create'])->name('seo-results-create');
    Route::post('change-result-status', [SeoSettingController::class, 'changeResultStatus'])->name('changeResultStatus');
    //end result


    //start website
    Route::get('/general-setting', [SeoSettingController::class, 'index'])->name('workReport');
    Route::resource('website', SeoSettingController::class);
    Route::post('website/change-website-status', [SeoSettingController::class, 'changeWebsiteStatus'])->name('changeWebsiteStatus');
    Route::get('general-setting/manage-task/{id}', [SeoSettingController::class, 'task_manage'])->name('manage-task');
    Route::post('task_manage_update/{id}', [SeoSettingController::class, 'task_manage_update'])->name('task_manage_update');
    Route::post('manage-task/change-task-manage-status', [SeoSettingController::class, 'changeTaskManageStatus'])->name('changeTaskManageStatus');
    Route::post('task-priority', [SeoSettingController::class, 'changeTaskPriority'])->name('changeTaskPriority');
    Route::post('change-task-submission', [SeoSettingController::class, 'changeTaskSubmission'])->name('changeTaskSubmission');
    Route::get('general-setting/website-keyword/{id}', [SeoSettingController::class, 'keyword_manage'])->name('manage-keyword');
    Route::get('general-setting/website-ranking/{id}', [SeoSettingController::class, 'ranking_manage'])->name('manage-ranking');

    Route::post('website-keyword/{id}', [SeoSettingController::class, 'keywords_update'])->name('keywordUpdate');

    Route::post('website-ranking/{id}', [SeoSettingController::class, 'keyword_manage_update'])->name('rankingUpdate');



    //end website

    Route::resource('monthly-result', SeoResultController::class);
    Route::post('get-monthly-result', [SeoResultController::class, 'getMonthlyResult'])->name('get-monthly-result');
    Route::post('export-monthly-result', [SeoResultController::class, 'exportMonthlyResult'])->name('export-monthly-result');
    Route::post('store', [SeoResultController::class, 'store'])->name('save-website-update');
    Route::resource('submission-url', SeoSubmissionController::class);
    Route::post('getsubmissionurl', [SeoSubmissionController::class, 'getsubmissionurl'])->name('get-subission-url');
    Route::post('submission-filter', [SeoSubmissionController::class, 'submissionFilter'])->name('submission-filter');

    Route::post('submission-status', [SeoSubmissionController::class, 'ChangeSubmissionStatus'])->name('submission-status-chenge');

    Route::post('sort-order', [SeoSettingController::class, 'changeResultSortOrder'])->name('change_short_order');

    // });

    // Web Redirector 

    Route::get('/redirection', [SeoWebRedirectorController::class, 'index'])->name('redirection');
    Route::post('/redirection/store', [SeoWebRedirectorController::class, 'store'])->name('redirectionStore');
    Route::post('/redirection/edit', [SeoWebRedirectorController::class, 'edit'])->name('redirectionEdit');
    Route::post('/redirection/update', [SeoWebRedirectorController::class, 'update'])->name('redirectionUpdate');
    Route::post('/redirection/delete', [SeoWebRedirectorController::class, 'delete'])->name('redirectionDelete');
    Route::post('/redirection/status', [SeoWebRedirectorController::class, 'status'])->name('redirectionStatus');
    Route::get('/redirection/filter', [SeoWebRedirectorController::class, 'filter'])->name('redirectionFilter');
});
// });