<?php


use Modules\Recruit\Http\Controllers\JobsController;
use Modules\Recruit\Http\Controllers\LocationsController;
use Modules\Recruit\Http\Controllers\SkillsController;
use Modules\Recruit\Http\Controllers\JobCategoryController;
use Modules\Recruit\Http\Controllers\JobOnboardController;
use Modules\Recruit\Http\Controllers\JobTypeController;
use Modules\Recruit\Http\Controllers\WorkExperienceController;
use Modules\Recruit\Http\Controllers\QuestionController;
use Modules\Recruit\Http\Controllers\InterviewScheduleController;
use Modules\Recruit\Http\Controllers\JobApplicationController;
use Modules\Recruit\Http\Controllers\ApplicationArchiveController;
use Modules\Recruit\Http\Controllers\DocumentController;
use Modules\Recruit\Http\Controllers\ApplicationSettingsController;
use Modules\Recruit\Http\Controllers\ApplicationStatusController;
use Modules\Recruit\Http\Controllers\DepartmentController;
use Modules\Recruit\Http\Controllers\DesignationController;
use Modules\Recruit\Http\Controllers\SettingController;
use Modules\Recruit\Http\Controllers\FrontJobsController;
use Modules\Recruit\Http\Controllers\ReportController;
use Modules\Recruit\Http\Controllers\ApplicantNoteController;
use Modules\Recruit\Http\Controllers\JobOfferQuestionController;

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

Route::group(['as' => 'recruit.', 'prefix' => 'recruit'], function () {


// recruite jobs
    Route::get('jobs/data', [JobsController::class, 'data'])->name('jobs.data');
    Route::post('jobs/refresh-date',  [JobsController::class, 'refreshDate'])->name('jobs.refreshDate');
    Route::get('jobs/application-data', [JobsController::class, 'applicationData'])->name('jobs.applicationData');
    Route::post('jobs/send-emails', [JobsController::class, 'sendEmails'])->name('jobs.sendEmails');
    Route::get('jobs/send-email', [JobsController::class, 'sendEmail'])->name('jobs.sendEmail');
    Route::resource('jobs', JobsController::class);

    Route::post('sort-order', [JobsController::class, 'changeSortOrder'])->name('changeSortOrder');

//recruite job location
    Route::get('locations/data', [LocationsController::class, 'data'])->name('locations.data');
    Route::resource('job-location', LocationsController::class);

//recruite job skills
    Route::get('skills/data', [SkillsController::class, 'data'])->name('skills.data');
    Route::resource('skills', SkillsController::class);


//recruite jobcategory
    Route::get('job-categories/data', [JobCategoryController::class, 'data'])->name('job-categories.data');
    Route::get('job-categories/getSkills/{categoryId}', [JobCategoryController::class, 'getSkills'])->name('job-categories.getSkills');
    Route::resource('job-categories', JobCategoryController::class);


//recruit jon onboard
    Route::get('job-onboard/data', [JobOnboardController::class, 'data'])->name('job-onboard.data');
    Route::get('job-onboard/send-offer/{id?}', [JobOnboardController::class, 'sendOffer'])->name('job-onboard.send-offer');
    Route::get('job-onboard/update-status/{id?}', [JobOnboardController::class, 'updateStatus'])->name('job-onboard.update-status');
    Route::resource('job-onboard', JobOnboardController::class);

    Route::get('job-onboard-questions/data', [JobOfferQuestionController::class,
    'data'])->name('job-onboard-questions.data');

    Route::resource('job-onboard-questions',JobOfferQuestionController::class);


//recruit job type 
    Route::resource('job-type',JobTypeController::class);

//recruite work experience
    Route::resource('work-experience', WorkExperienceController::class);

//recruit question
    Route::get('questions/data', [QuestionController::class, 'data'])->name('questions.data');
    Route::resource('questions', QuestionController::class);

//recruit interview shedule
    Route::get('interview-schedule/data', [InterviewScheduleController::class, 'data'])->name('interview-schedule.data');
    Route::get('interview-schedule/table-view', [InterviewScheduleController::class, 'table'])->name('interview-schedule.table-view');
    Route::post('interview-schedule/change-status', [InterviewScheduleController::class, 'changeStatus'])->name('interview-schedule.change-status');
    Route::post('interview-schedule/change-status-multiple', [InterviewScheduleController::class, 'changeStatusMultiple'])->name('interview-schedule.change-status-multiple');
    Route::get('interview-schedule/notify/{id}/{type}', [InterviewScheduleController::class, 'notify'])->name('interview-schedule.notify');
    Route::get('interview-schedule/response/{id}/{type}', [InterviewScheduleController::class, 'employeeResponse'])->name('interview-schedule.response');
    Route::resource('interview-schedule', InterviewScheduleController::class);


//recruite job application
    Route::post('job-applications/rating-save/{id?}', [JobApplicationController::class, 'ratingSave'])->name('job-applications.rating-save');
    Route::get('job-applications/create-schedule/{id?}', [JobApplicationController::class, 'createSchedule'])->name('job-applications.create-schedule');
    Route::post('job-applications/store-schedule', [JobApplicationController::class, 'storeSchedule'])->name('job-applications.store-schedule');
    Route::get('job-applications/question/{jobID}/{applicationId?}', [JobApplicationController::class, 'jobQuestion'])->name('job-applications.question');
    Route::get('job-applications/export/{status}/{location}/{startDate}/{endDate}/{jobs}', [JobApplicationController::class, 'export'])->name('job-applications.export');
    Route::get('job-applications/data', [JobApplicationController::class, 'data'])->name('job-applications.data');
    Route::get('job-applications/load-more', [JobApplicationController::class, 'loadMore'])->name('job-applications.loadMore');
    Route::get('job-applications/table-view', [JobApplicationController::class, 'table'])->name('job-applications.table');
    Route::post('job-applications/updateIndex', [JobApplicationController::class, 'updateIndex'])->name('job-applications.updateIndex');
    Route::post('job-applications/archive-job-application/{application}', [JobApplicationController::class, 'archiveJobApplication'])->name('job-applications.archiveJobApplication');
    Route::post('job-applications/unarchive-job-application/{application}', [JobApplicationController::class, 'unarchiveJobApplication'])->name('job-applications.unarchiveJobApplication');
    Route::post('job-applications/add-skills/{applicationId}', [JobApplicationController::class, 'addSkills'])->name('job-applications.addSkills');
    Route::resource('job-applications', JobApplicationController::class);

    //recruit Job application
    Route::get('job-application-import', [JobApplicationController::class,
    'import'])->name('job-application-import');
 
    Route::post('job-application-import-store', [JobApplicationController::class,
    'importStore'])->name('job-application-import-store');

        
//recrute candidate database
    Route::get('candidate-database/data', [ApplicationArchiveController::class, 'data'])->name('candidate-database.data');
    Route::get('candidate-database/export/{skill}', [ApplicationArchiveController::class, 'export'])->name('candidate-database.export');
    Route::resource('candidate-database', ApplicationArchiveController::class);
    Route::post('candidate-database/{id}', [ApplicationArchiveController::class, 'deleteRecords'])->name('candidate-database.deleteRecords');


//recruit document
    Route::get('documents/data', [DocumentController::class, 'data'])->name('documents.data');
    Route::get('documents/download-document/{document}', [DocumentController::class, 'downloadDoc'])->name('documents.downloadDoc');
    Route::resource('documents',  DocumentController::class);


    //recruit application setting
     Route::resource('application-setting', ApplicationSettingsController::class);


     //recruit application status
    Route::resource('application-status', ApplicationStatusController::class); 

    //recruit applicant store
    Route::resource('applicant-note',  ApplicantNoteController::class);  

    //recruit department 
    Route::resource('departments', DepartmentController::class);

    //recruit designation
    Route::resource('designations', DesignationController::class);


    //recruit setting controller
    Route::resource('setting',SettingController::class);
    Route::post('setting/updateZoom', [SettingController::class, 'update'])->name('setting.updateZoom');
 
    Route::post('zoom-setting/change-status/{id}', [SettingController::class, 'changeStatus'])->name('zoom-setting.change-status');


 

    Route::post('/', [FrontJobsController::class, 'jobOpenings'])->name('jobOpenings');
    Route::post('/more-data', [FrontJobsController::class, 'moreData'])->name('more-data');
    Route::post('/search-job', [FrontJobsController::class, 'searchJob'])->name('search-job');
    Route::post('/job-offer/{slug?}', [FrontJobsController::class, 'index'])->name('job-offer');
    Route::post('/save-offer', [FrontJobsController::class, 'saveOffer'])->name('save-offer');
    Route::post('/job/saveApplication', [FrontJobsController::class, 'saveApplication'])->name('saveApplication');
    Route::post('/job/fetch-country-state', [FrontJobsController::class,
    'fetchCountryState'])->name('fetchCountryState');

    Route::post('/job/{slug}/{hash?}', [FrontJobsController::class, 'jobDetail'])->name('jobDetail');
    Route::post('/jobapply/{slug}', [FrontJobsController::class, 'jobApply'])->name('jobApply');
  
    Route::post('change-language/{code}', [FrontJobsController::class, 'changeLanguage'])->name('changeLanguage');
    Route::post('auth/callback/{provider}', [FrontJobsController::class, 'callback'])->name('linkedinCallback');
    Route::post('auth/redirect/{provider}', [FrontJobsController::class, 'redirect'])->name('linkedinRedirect');
    Route::post('job-alert', [FrontJobsController::class, 'jobAlert'])->name('jobAlert');
    Route::post('save-job-alert', [FrontJobsController::class, 'saveJobAlert'])->name('saveJobAlert');
    Route::post('disable-job-alert/{id}', [FrontJobsController::class, 'disableJobAlert'])->name('disableJobAlert'); 



    //recruit report 
    Route::resource('report',ReportController::class);


    //applicant-note
    Route::resource('applicant-note',ApplicantNoteController::class);
});