<?php

namespace Modules\Hrm\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request; 
use App\Helper\Helper;
use Carbon\Carbon;

class HRMReportsController extends BaseController
{
    public function __construct()
    {

        $this->pageTitle = 'Reports';
        $this->pageAccess = config('acceskey.hrm-report');
    }

    public function index()
    {
        $this->content = [];
        $month = date('m');
        $now = Carbon::now();
        $year = $now->format('Y');
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "user_id" => "all",
            "month" => $month,
            "year" => $year,
            'api_token' => Helper::getCurrentuserToken(),
        );
        

        $apiurl = config('apipath.hrm-reports');
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        if (!empty($responseData))
            $this->content = $responseData->data;
            // dd($this->data);
        return view('Hrm::reports.index', collect($this->data));
    }

    public function reportEmployee(Request $request){
        
        $parameters = array( 
            "user_id" => $request->user_id,
            "year" => $request->year,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.hrm-reports');
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return response()->json([$responseData->data]);

    }

    public function reportExport(Request $request){
        $parameters = array(  
            'api_token' => Helper::getCurrentuserToken(),
        ); 
 

        $apiurl = config('apipath.export-reports');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);
        
        if($responseData->status == true){
            return response()->download($responseData->data);
        }else{
            return Redirect::back()->with('error', $message);
        } 
    }
 
 
}
