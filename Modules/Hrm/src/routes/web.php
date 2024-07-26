<?php
use Illuminate\Support\Facades\Route;
use Modules\Hrm\Http\Controllers\SettingController;
use Modules\Hrm\Http\Controllers\StaffController;
use Modules\Hrm\Http\Controllers\DepartmentController;
use Modules\Hrm\Http\Controllers\DesignationController; 
use Modules\Hrm\Http\Controllers\EducationController;
use Modules\Hrm\Http\Controllers\LeaveController;
use Modules\Hrm\Http\Controllers\AttendenceController;
use Modules\Hrm\Http\Controllers\HolidayController;
use Modules\Hrm\Http\Controllers\DocumentTypeController;
use Modules\Hrm\Http\Controllers\SalaryController; 
use Modules\Hrm\Http\Controllers\HRMReportsController;

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

Route::group(['as'=> 'hrm.', 'prefix' => 'hrm'], function(){

    //Employee Salary
    Route::resource('salary', SalaryController::class);
    
    Route::get('salary-generate', [SalaryController::class,'generateSalary'])->name('salary-generate');
    Route::post('salary-generate-page', [SalaryController::class,'generateSalarySection'])->name('salary-generate-page');
    Route::post('salary-data', [SalaryController::class, 'salaryRecord'])->name('salary-record');
    Route::post('change-status', [SalaryController::class, 'changeStatus'])->name('change-status');

    Route::get('export-salary/{user_id}/{month}/{year}', [SalaryController::class, 'exportSalary'])->name('export-salary');
 

    //setting
   
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::get('setting/leave-create', [SettingController::class,'leave_create'])->name('setting/leave-create');
    Route::get('setting/leave-edit/{id}', [SettingController::class,'leave_edit'])->name('setting/leave-edit');
    Route::post('setting/leave-update/{id}', [SettingController::class,'leave_update'])->name('setting/leave-update');
    Route::post('setting/leave-store', [SettingController::class,'leave_store'])->name('setting/leave-store');


    //leave
    Route::get('leave', [LeaveController::class, 'index'])->name('leave');
    Route::get('leave/create', [LeaveController::class,'create'])->name('leave-create');
    Route::post('leave/store', [LeaveController::class,'store'])->name('leave-store');
    Route::get('leave/edit/{id}', [LeaveController::class,'edit'])->name('leave/edit');
    Route::post('leave/update/{id}', [LeaveController::class,'update'])->name('leave/update');
    Route::post('changeStatus', [LeaveController::class,'changeStatus'])->name('change-leave-Status');
    Route::post('changeleavePay', [LeaveController::class,'changeleavePay'])->name('changeleavePay');
    
    Route::post('leave-record', [LeaveController::class, 'leaveRecord'])->name('leave-record');
    
    
    //attendence
    Route::get('attendance', [AttendenceController::class, 'index'])->name('attendance');
    Route::post('attendance/attendenc_data', [AttendenceController::class, 'attendenc_data'])->name('attendance-data');
    Route::get('attendance/create', [AttendenceController::class,'create'])->name('attendance-create');
    Route::post('attendance/store', [AttendenceController::class,'store'])->name('attendance-store');
    Route::post('attendance/dept', [AttendenceController::class,'select_dept'])->name('attendance-dept');
    Route::post('attendances/store-clock-in', [AttendenceController::class, 'storeClockIn'])->name('attendances.store_clock_in');
    Route::get('attendances/update-clock-in', [AttendenceController::class, 'updateClockIn'])->name('attendances.update_clock_in');
    Route::get('export-attendance/{staff}/{month}/{year}', [AttendenceController::class, 'exportAttendance'])->name('export-attendance');
    Route::post('attend-details', [AttendenceController::class, 'attendDetails'])->name('attendDetails');
    Route::post('attendance-update', [AttendenceController::class, 'attendUpdate'])->name('attendUpdate');

    
    
    


    //Staff
    Route::resource('staff', StaffController::class)->except([
        'edit', 'update', 'destroy'
    ]);
    Route::post('staffStatus', [StaffController::class,'chgStaffStatus'])->name('staffStatus');
    Route::post('updateStaff', [StaffController::class,'updateSaff'])->name('updateStaff');
    Route::post('verifyStaff', [StaffController::class,'verification'])->name('verifyStaff'); 
    Route::post('terminateStaff', [StaffController::class,'terminate'])->name('terminateStaff');
    Route::post('staff-performance', [StaffController::class,'Performance'])->name('staff-performance'); 
    Route::post('staff-performance-update', [StaffController::class,'PerformanceUpdate'])->name('staff-performance-update'); 
    Route::post('staff-remuneration', [StaffController::class,'remunerationAdd'])->name('staff-remuneration'); 
    Route::post('staff-bank-details', [StaffController::class,'BankDetailsAdd'])->name('staff-bank-details'); 
    
    Route::post('bank-details/{id}', [StaffController::class,'bankDetailsEdit'])->name('BankDetailsEdit');
    Route::post('bank-details-update', [StaffController::class,'bankDetailsUpdate'])->name('bank-details-update'); 

    Route::post('staff-search', [StaffController::class, 'searchStaff'])->name('staff-search');

    

    Route::post('download-image', [StaffController::class, 'downloadImage'])->name('download-image');
    Route::post('perform/{id}', [StaffController::class,'performEdit'])->name('performanceEdit');
    Route::post('remuneration/{id}', [StaffController::class,'remunerationEdit'])->name('remuneration');
    Route::post('staff-remuneration-update', [StaffController::class,'RemunerationUpdate'])->name('staff-remuneration-update'); 

    Route::get('staff-import-create', [StaffController::class,'importCreate'])->name('import-create');
    Route::post('staff-import', [StaffController::class,'importStore'])->name('import-store');
    Route::get('download-file', [StaffController::class,'downloadFile'])->name('download-file');
 
    
    
    // department   
    Route::resource('department', DepartmentController::class);
    Route::post('department/dptUpdate', [DepartmentController::class,'dptUpdate'])->name('dptUpdate');
    Route::post('department/dptStatus', [DepartmentController::class,'dptStatus'])->name('dptStatus');
    Route::post('dptdestroy/{id}', [DepartmentController::class,'dptDestroy'])->name('dptdestroy');

      //DESIGNATION ROUTES
      Route::resource('designation', DesignationController::class);
      Route::post('designation/Update', [DesignationController::class,'desgUpdate'])->name('designation-updatedata');
      Route::post('designationDestroy/{id}', [DesignationController::class,'desgDestroy'])->name('designationDestroy');
      Route::post('designation/changedesignationStatus', [DesignationController::class,'chgdesgStatus'])->name('changedesignationStatus');


      //education ROUTES
      Route::resource('education', EducationController::class);
      Route::post('education/Update', [EducationController::class,'updateEducation'])->name('education-updatedata');
      Route::post('educationDestroy/{id}', [EducationController::class,'DestroyEducation'])->name('educationDestroy');
      Route::post('education/changeeducationStatus', [EducationController::class,'changeStatus'])->name('changeeducationStatus');


      //document_type routes
      Route::resource('document-type', DocumentTypeController::class);
      Route::post('document-type/Update', [DocumentTypeController::class,'updatedocumentType'])->name('document-type-updatedata');
      Route::post('document-typeDestroy/{id}', [DocumentTypeController::class,'DestroydocumentType'])->name('documentTypeDestroy');
      Route::post('document-type/changedocumentTypeStatus', [DocumentTypeController::class,'changeStatus'])->name('changedocumentTypeStatus');
      Route::resource('holiday', HolidayController::class);
      Route::post('markDayHoliday', [HolidayController::class,'markDayHoliday'])->name('markDayHoliday');
      Route::post('holiday-delete', [HolidayController::class,'holidayDelete'])->name('holidayDelete');



      //hrm reports route start
      Route::resource('report', HRMReportsController::class); 
      Route::post('report-employee', [HRMReportsController::class,'reportEmployee'])->name('report-employee'); 

      Route::get('reportExport', [HRMReportsController::class, 'reportExport'])->name('reportExport');

      


      
});
   
   
   