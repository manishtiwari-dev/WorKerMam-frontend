<?php

namespace Modules\Hrm\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Hrm\Models\Designation;
use App\Helper\Helper;

class DesignationController extends BaseController
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


        $apiurl = config('apipath.designation-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;
        // dd($this->data);
        return view('Hrm::designation.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Hrm::designation.create');
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
            "designation_name" => $request->designation_name,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.designation-add');
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
            "designation_id" => $id,
        );
        $apiurl = config('apipath.designation-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if ($responseData->data) {
            return response()->json($responseData->data);
        } else {
            return respomse()->json(['data', $responseData['message']]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    public function desgUpdate(Request $request)
    {
        $parameters = array(
            "designation_id" => $request->designation_id,
            "designation_name" => $request->designation_name,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.designation-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    public function chgdesgStatus(Request $request)
    {
        $parameters = array(
            "designation_id" => $request->designation_id,
            "status" => $request->status


        ); 

        $apiurl = config('apipath.designation-changestatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd( $responseData->data);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }
    public function desgDestroy(Request $request)
    {

        $parameters = array(
            "designation_id" => $request->designation_id,
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.designation-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // if ($responseData->data) {
        //     return response()->json($responseData->message);
        // } else {
        //     return respomse()->json(['data', $responseData['message']]);
        // }
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);
    }
}
