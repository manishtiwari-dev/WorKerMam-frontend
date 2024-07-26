<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;




class ReportsController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Report';
        $this->pageAccess = config('acceskey.sales-customer');
    }


    public function index()
    {   
         
 
        $this->content = [];

        $parameters = array(
            
        );

        $apiurl = config('apipath.reports');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        
        return view('Sales::reports.index', collect($this->data));
    }


    public function store(Request $request){
        

        $parameters = array(
            "month" => $request->month,
            "year" => $request->year,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.download-reports');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    
            
        $message = Helper::translation($responseData->message);
        
        if($responseData->status == true){
            return response()->download($responseData->data);
        }else{
            return Redirect::back()->with('error', $message);
        } 
    }


    public function AnualReport(Request $request){
        
        $parameters = array( 
            "year" => $request->year,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.download-annual-report');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    
            
        $message = Helper::translation($responseData->message);
        
        if($responseData->status == true){
            return response()->download($responseData->data);
        }else{
            return Redirect::back()->with('error', $message);
        } 
    }

     
}