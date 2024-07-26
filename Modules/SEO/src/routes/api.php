<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\SEO\Http\Controllers\SeoDailyWorkController;
use Modules\SEO\Http\Controllers\SeoTaskController;
use Modules\SEO\Http\Controllers\SeoWebsiteResultController;
use Modules\SEO\Http\Controllers\SeoResultController;  
use Modules\SEO\Http\Controllers\SeoWebsiteController;
use Modules\SEO\Http\Controllers\SeoWorkReportController;
use Modules\SEO\Http\Controllers\SubmissionController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['ApiTokenCheck'],'prefix'=>"api/"], function() {
    
      
      //custom form
      Route::group(['prefix'=>'form'], function(){
        Route::post('/', [SeoWebsiteController::class,'index']);
      
    }); 



        

});

