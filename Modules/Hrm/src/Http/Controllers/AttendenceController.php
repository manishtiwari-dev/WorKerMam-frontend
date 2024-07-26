<?php

namespace Modules\Hrm\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Helper\Helper;

class AttendenceController extends BaseController
{
    public function __construct()
    {

        $this->pageTitle = 'Attendence';
        $this->pageAccess = config('acceskey.hrm-attendance');
    }

    public function index(Request $request)
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
        

        $apiurl = config('apipath.attendance-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data; 

           
        return view('Hrm::attendence.index', collect($this->data));
    }



    public function attendenc_data(Request $request)
    {
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "user_id" => $request->user_id,
            "month" => $request->month,
            "year" => $request->year,
            'api_token' => Helper::getCurrentuserToken(),
        ); 

        $apiurl = config('apipath.attendance-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        return response()->json(collect($responseData->data));
        // return view('Hrm::attendence.index', collect($responseData->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parameters = array(
            "language" => "1",
            "date" => $request->date,
        );

        $apiurl = config('apipath.attendance-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);

        return view('Hrm::attendence.create', collect($responseData->data));
    }


    public function select_dept(Request $request)
    {
        $parameters = array(
            "department_id" => $request->dept_id,
        );

        $apiurl = config('apipath.attendance-dept');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json([$responseData->data]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $parameters = array(
            "user_id" => $request->user_id,
            "working_from" => $request->working_from,
            "attendence_date" => $request->attendence_date,
            "year" => $request->year,
            "month" => $request->month,
            "clock_in_time" => $request->clock_in_time,
            "clock_out_time" => $request->clock_out_time,
            "mark_attendence" => $request->mark_attendence,
            "late" => $request->late,
            "half_day" => $request->half_day,
            'api_token' => Helper::getCurrentuserToken(),
        ); 
 
       
 
        $apiurl = config('apipath.attendance-mark');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
//  dd($responseData);
        $message = Helper::translation($responseData->message);

        
        if ($message) {
            return redirect()->route('hrm.attendance')->with('success', $message);
        } else {
            return redirect()->route('hrm.attendance')->with('error', $message);
        }
    }


    public function storeClockIn(Request $request)
    {

     

        $parameters = array(
            "user_id" => $request->user_id,
            "working_from" => $request->working_from,
            "currentLatitude" => $request->currentLatitude,
            "currentLongitude" => $request->currentLongitude,
        ); 
       
 
        $apiurl = config('apipath.attendance-clockIn');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
       // return response()->json(['success' => $message , 'data' => $responseData->data]);

    }


    public function updateClockIn(Request $request)
    {

    //    dd( $request->all());

        $parameters = array(
            "id" => $request->id,
           
        ); 
       
 
        $apiurl = config('apipath.attendance-clockOut');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
       // return response()->json(['success' => $message , 'data' => $responseData->data]);

    }


    public function exportAttendance($staff, $month, $year){
 
        $parameters = array( 
            'staff' =>$staff,
            'month' => $month,
            'year' => $year,
            'api_token' => Helper::getCurrentuserToken(),
        ); 
 

        $apiurl = config('apipath.export-attendance');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);
        
        if($responseData->status == true){
            return response()->download($responseData->data);
        }else{
            return Redirect::back()->with('error', $message);
        } 

    }

    public function attendDetails(Request $request){
         
        $parameters = array( 
            "staff_id" => $request->staff_id,
            "date" => $request->date, 
            "req_month"=>$request->req_month,
            "req_year"=>$request->req_year,

            'api_token' => Helper::getCurrentuserToken(),
        );
         

        $apiurl = config('apipath.details-attendance');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $message = Helper::translation($responseData->message);
        
        if($responseData->status == true){
            return response()->json(['status' => 1, 'data' => $responseData->data]);
        }else{
            return Redirect::back()->with('error', $message);
        } 

    }

    public  function attendUpdate(Request $request){
  
        $parameters = array( 
            "attend_id" => $request->attend_id,
            "clock_in" => $request->clock_in,
            "clock_out" => $request->clock_out,
            "clock_in_ip" => $request->clock_in_ip,
            "clock_out_ip" => $request->clock_out_ip,
            "working_from" => $request->working_from,
            "status" => $request->present_status,
            "half_day" => $request->half_day_input,
            "late" => $request->lateInput,
            "req_month"=>$request->req_month,
            "req_year"=>$request->req_year,
            "mart_attend_date" => $request->mart_attend_date,
           'api_token' => Helper::getCurrentuserToken(),
       );   
 
  

       $apiurl = config('apipath.attendance-updates');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    
       $message = Helper::translation($responseData->message);
        if ($message) {
            return redirect()->route('hrm.attendance')->with('success', $message);
        } else {
            return redirect()->route('hrm.attendance')->with('error', $message);
        }
    }
}