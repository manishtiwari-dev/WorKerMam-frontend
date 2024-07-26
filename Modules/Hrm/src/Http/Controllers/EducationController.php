<?php

namespace Modules\Hrm\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Hrm\Models\Designation;
use App\Helper\Helper;

class EducationController extends BaseController
{

    public function __construct()
    {

        $this->pageTitle = 'Setting';
        $this->pageAccess = config('acceskey.setting');
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
            "education_name" => $request->education_name,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.education-add');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
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
            "education_id" => $id,
        );
        $apiurl = config('apipath.education-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if ($responseData->data) {
            return response()->json($responseData->data);
        } else {
            return respomse()->json(['data', $responseData['message']]);
        }
    }
  

    public function updateEducation(Request $request)
    {
        $parameters = array(
            "education_id" => $request->education_id,
            "education_name" => $request->education_name,
            'api_token' => Helper::getCurrentuserToken(),
        );
 

        $apiurl = config('apipath.education-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    public function changeStatus(Request $request)
    {
        $parameters = array(
            "education_id" => $request->education_id,
            "status" => $request->status


        );

        $apiurl = config('apipath.education-changestatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }
    public function DestroyEducation(Request $request)
    {

        $parameters = array(
            "education_id" => $request->education_id,
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.education-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);
    }
}
