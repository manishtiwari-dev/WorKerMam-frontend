<?php

namespace Modules\Hrm\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Hrm\Models\Designation;
use App\Helper\Helper;

class DocumentTypeController extends BaseController
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
            "document_type" => $request->document_type_id,
            "document_name" => $request->document_name,
            'api_token' => Helper::getCurrentuserToken(),
        );
 

        $apiurl = config('apipath.doc-type-add');
 
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
            "document_id" => $id,
        );
        $apiurl = config('apipath.doc-type-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if ($responseData->data) {
            return response()->json($responseData->data);
        } else {
            return respomse()->json(['data', $responseData['message']]);
        }
    }
  

    public function updatedocumentType(Request $request)
    {
        $parameters = array(
            "document_id" => $request->document_id,
            "document_type" => $request->document_type,
            "document_name" => $request->document_name,
            'api_token' => Helper::getCurrentuserToken(),
        );
 
 

        $apiurl = config('apipath.doc-type-update');
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
            "document_id" => $request->document_id,
            "status" => $request->status
        );
 
        $apiurl = config('apipath.doc-type-changestatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }
    public function DestroydocumentType(Request $request)
    {

        $parameters = array(
            "document_id" => $request->document_id,
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.doc-type-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);
    }
}
