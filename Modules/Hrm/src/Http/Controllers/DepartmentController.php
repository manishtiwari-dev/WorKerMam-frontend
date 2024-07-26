<?php

namespace Modules\Hrm\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Hrm\Models\Department;
use Auth;
use App\Helper\Helper;

class DepartmentController extends BaseController
{

    public function __construct()
    {

        $this->pageTitle = 'Setting';
        $this->pageAccess = config('acceskey.setting');
    }


    public function index(Request $request)
    {
        $this->content = [];

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "search" => $request->search ?? '',
            'api_token' => Helper::getCurrentuserToken(),
        );


        $apiurl = config('apipath.department-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data;
        //  dd($this->data);
        return view('Hrm::department.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            "dept_name" => $request->dept_name,
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.department-add');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $parameters = array(
            "updateId" => $id,
        );

        $apiurl = config('apipath.department-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if ($responseData) {
            return response()->json($responseData);
        } else {
            return response()->json($responseData['message']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }

    public function DptUpdate(Request $request)
    {
        $parameters = array(
            "department_id" => $request->department_id,
            "dept_name" => $request->dept_name, 
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.department-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    public function DptStatus(Request $request)
    {

        $parameters = array(
            "department_id" => $request->department_id,
            "status" => $request->status
        );


        $apiurl = config('apipath.department-changestatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }
    public function DptDestroy(Request $request)
    {

        $parameters = array(
            "deleteId" => $request->department_id,
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.department-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
    }
}
