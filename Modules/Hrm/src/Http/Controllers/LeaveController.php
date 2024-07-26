<?php

namespace Modules\Hrm\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Helper\Helper;
use Carbon\Carbon;

class LeaveController extends BaseController
{
    public function __construct()
    {

        $this->pageTitle = 'Leave';
        $this->pageAccess = config('acceskey.hrm-leave');
    }

    public function index()
    {
        $this->content = [];

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        $month = date('m');
        $now = Carbon::now();
        $year = $now->format('Y');
        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "user_id" => "all",
            "month" => $month,
            "year" => $year,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.leave-type');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        if (!empty($responseData))
            $this->content = $responseData->data;
 
        return view('Hrm::leave.index', collect($this->data));
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

        $apiurl = config('apipath.leave-type-create');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return view('Hrm::leave.create', collect($responseData->data));
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
            "leave_date" => $request->leave_date,
            "leave_type_id" => $request->leave_type_id,
            "reason" => $request->reason,
            "user_id" => $request->user_id,
            'api_token' => Helper::getCurrentuserToken(),

        );


        $apiurl = config('apipath.leave-type-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $message = Helper::translation($responseData->message);
        if ($message) {
            return redirect()->route('hrm.leave')->with('success', $message);
        } else {
            return redirect()->route('hrm.leave')->with('error', $message);
        }
    }


    public function edit($id)
    {
        $parameters = array(
            "leave_id" => $id,
            
        );

        $apiurl = config('apipath.leave-type-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return view('Hrm::leave.edit', collect($responseData->data));
    }


    public function update(Request $request, $id)
    {


        $parameters = array(
            "leave_id" => $id,
            "leave_date" => $request->leave_date,
            "leave_type_id" => $request->leave_type_id,
            "reason" => $request->reason,
            "user_id" => $request->user_id,
            "status" => $request->status,
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.leave-type-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $message = Helper::translation($responseData->message);

        if ($message) {
            return redirect()->route('hrm.leave')->with('success', $message);
        } else {
            return redirect()->route('hrm.leave')->with('error', $message);
        }
    }



    public function changeStatus(Request $request)
    {
        $parameters = array(
            "leave_id" => $request->leave_id,
            "status" => $request->status,
        );
 

        $apiurl = config('apipath.leave-type-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['status' => 1, 'message' => $message]);
    }

    public function changeleavePay(Request $request)
    {
        $parameters = array(
            "leave_id" => $request->leave_id,
            "status" => $request->status,
        );
 

        $apiurl = config('apipath.change-leave-pay');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['status' => 1, 'message' => $message]);
    }
    

    public function leaveRecord(Request $request){

        $parameters = array( 
            "user_id" => $request->user_id,
            "month" => $request->month,
            "year" => $request->year,
            'api_token' => Helper::getCurrentuserToken(),
        );
 

        $apiurl = config('apipath.leave-type');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        return response()->json(collect($responseData->data)); 

    }
    

    
}
