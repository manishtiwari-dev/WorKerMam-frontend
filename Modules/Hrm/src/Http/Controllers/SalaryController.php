<?php

namespace Modules\Hrm\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request; 
use App\Helper\Helper;
use Carbon\Carbon;

class SalaryController extends BaseController
{
    public function __construct()
    {

        $this->pageTitle = 'Salary';
        $this->pageAccess = config('acceskey.hrm-salary');
    }

    public function index()
    {
        $this->content = [];

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 10;
        }

        $month = date('m');
        $now = Carbon::now();
        $year = $now->format('Y');
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "user_id" => "all",
            "month" => $month,
            "year" => $year,
            "page" => $page,
            "perPage" => "", 
            "orderBY" => "",
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.salary');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        if (!empty($responseData))
            $this->content = $responseData->data;
 
        return view('Hrm::salary.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters = array(
            "language" => "1",
        );

        $apiurl = config('apipath.salary-create');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return view('Hrm::salary.create', collect($responseData->data));
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
            'employee' => $request->employee,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_status' => $request->payment_status,
            'api_token' => Helper::getCurrentuserToken(),

        ); 

     
 

        $apiurl = config('apipath.salary-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);
        if ($message) {
            return redirect()->route('hrm.salary.index')->with('success', $message);
        } else {
            return redirect()->route('hrm.salary.index')->with('error', $message);
        }
    }


    public function edit($id)
    {
        $parameters = array(
            "salary_id" => $id,
            
        );

        $apiurl = config('apipath.salary-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return view('Hrm::salary.edit', collect($responseData->data));
    }


    public function update(Request $request, $id)
    { 
        $parameters = array(
            "salary_id" => $id, 
            'employee' => $request->employee, 
            "total_days" => $request->total_days,
            "total_leave" => $request->total_leave,
            "paid_leave" => $request->paid_leave,
            "paid_days" => $request->paid_days,
            'month' => $request->month,
            'year' => $request->year, 
            'net_salary' => $request->net_salary,
            'payment_date' => $request->payment_date,
            'payment_status' => $request->payment_status,
            'api_token' => Helper::getCurrentuserToken(),

        );
        

        $apiurl = config('apipath.salary-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $message = Helper::translation($responseData->message);

        if ($message) {
            return redirect()->route('hrm.salary.index')->with('success', $message);
        } else {
            return redirect()->route('hrm.salary.index')->with('error', $message);
        }
    }



    public function changeStatus(Request $request)
    { 
        $parameters = array(
            "salary_id" => $request->salary_id, 
            "status" => $request->status
        );
 
        $apiurl = config('apipath.salary-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        $message = Helper::translation($responseData->message);
        return response()->json(['status' => 1, 'message' => $message]);
    }

    public function generateSalary(Request $request){

        $parameters = array(
            
        );

        $apiurl = config('apipath.salary-generate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
 
        return view('Hrm::salary.generate-salary', collect($responseData));
    }

    public function generateSalarySection(Request $request){
     
        $parameters = array(
            'month' => $request->month,
            'year' => $request->year,
        ); 
        $apiurl = config('apipath.salary-generate-section');
  
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 

        // dd($responseData);
       
        $message = Helper::translation($responseData->message);
        
        
        if ($message) {
            return redirect()->route('hrm.salary.index')->with('success', $message);
        } else {
            return redirect()->route('hrm.salary.index')->with('error', $message);
        }
    }


    public function salaryRecord(Request $request){
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "user_id" => $request->user_id,
            "month" => $request->month,
            "year" => $request->year,
            'api_token' => Helper::getCurrentuserToken(),
        );
 

        $apiurl = config('apipath.salary');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        return response()->json(collect($responseData->data)); 
    }

    public function exportSalary($user_id, $month, $year){
 
        $parameters = array( 
            'user_id' =>$user_id,
            'month' => $month,
            'year' => $year,
            'api_token' => Helper::getCurrentuserToken(),
        ); 
 

        $apiurl = config('apipath.export-salary');
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
