<?php

use Illuminate\Support\Facades\Route; 
use Modules\Excel\Http\Controllers\ExcelController;
use Modules\Excel\Http\Controllers\ExcelDesignationController;
use Modules\Excel\Http\Controllers\ExcelEmployeeController;
use Modules\Excel\Http\Controllers\ExcelLocationController;
use Modules\Excel\Http\Controllers\GenerateController;
use Modules\Excel\Http\Controllers\SheetValueController;


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
    ['as' => 'excel.', 'prefix' => 'excel'],
    function () { 
        Route::resource('settings',ExcelController::class);
        Route::post('excel-update', [ExcelController::class,
        'updateExcel'])->name('excel-update');
        Route::get('excel-edit/{id}', [ExcelController::class,'excelEdit'])->name('excel-edit');
        Route::post('change-status', [ExcelController::class, 'changeStatus'])->name('changeStatus');
        Route::post('element-change-status', [ExcelController::class, 'elementchangeStatus'])->name('element-change-status');
        Route::post('excel-create', [ExcelController::class, 'create'])->name('excel-create');
        Route::post('elementList', [ExcelController::class, 'elementList'])->name('elementList');
        Route::post('elementStore', [ExcelController::class, 'element_store'])->name('elementStore');

        

        Route::resource('sheet-value',SheetValueController::class);
        Route::get('sheet-value/show/{id}', [SheetValueController::class, 'subSheetShow'])->name('subsheetShow');

        Route::get('sheet-value/elemnet/{id}', [SheetValueController::class, 'element_value'])->name('elementValues');
        Route::post('elementUpdate/{id}', [SheetValueController::class, 'element_value_update'])->name('elementUpdate');



         //designation
         Route::resource('excelDesign',ExcelDesignationController::class);
         Route::post('designchangeStatus', [ExcelDesignationController::class, 'changeStatus'])->name('designchangeStatus');
         Route::post('designupdate', [ExcelDesignationController::class,
         'updateDesign'])->name('designupdate');
         Route::get('excel-designedit/{id}', [ExcelDesignationController::class,'designEdit'])->name('excel-designedit');



           //location
           Route::resource('excelLocation',ExcelLocationController::class);
           Route::post('loactionChangeStatus', [ExcelLocationController::class, 'changeStatus'])->name('loactionChangeStatus');
           Route::post('locationupdate', [ExcelLocationController::class,
           'updateLocation'])->name('locationupdate');
           Route::get('excel-locationedit/{id}', [ExcelLocationController::class,'locationEdit'])->name('excel-locationedit');
  
           Route::resource('employee',ExcelEmployeeController::class);
           Route::get('excel-employeeedit/{id}', [ExcelEmployeeController::class,'employeeEdit'])->name('excel-employeeedit');
           Route::post('employeeupdate', [ExcelEmployeeController::class,
           'updateEmployee'])->name('employeeupdate');
           Route::post('employeeChangeStatus', [ExcelEmployeeController::class, 'changeStatus'])->name('employeeChangeStatus');

           Route::post('Employeecreate', [ExcelEmployeeController::class,'empCreate'])->name('excelEmployee-create');


           
            Route::get('employee-import', [ExcelEmployeeController::class,
            'import'])->name('employee-import');
        
            Route::post('employee-import-store', [ExcelEmployeeController::class,
            'importStore'])->name('employee-import-store');

            Route::resource('generate',GenerateController::class);
            Route::get('generate-excel/{id}', [GenerateController::class, 'generate'])->name('generate-excel');

           

    }
);