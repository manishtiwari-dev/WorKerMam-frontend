<?php

namespace Modules\Recruit\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Helper\Helper; 
use App\Http\Controllers\Controller;

class ApplicationStatusController extends Controller
{
    public function __construct()
    { 
        $this->pageTitle = __('menu.myProfile');
        $this->pageIcon = 'ti-user';
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $parameters =array(
        'api_token' => Helper::getCurrentuserToken(),      

        ); 

        $apiurl = config('apipath.application-status-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
        return view('Recruit::job-applications.create-status', collect($responseData->data)); 
    }

    public function store(Request $request)
    {
        
        $parameters =array(
            'status_position' => $request->status_position,
            'status_name' => $request->status_name,
            'status_color' => $request->status_color,
             'api_token' => Helper::getCurrentuserToken(),      

        ); 

        $apiurl = config('apipath.application-status-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
         return response()->json(['success' => $message]);

    }

    public function edit($id)
    {
       
 
        $parameters =array(
            'id' => $id,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.application-status-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
        return view('Recruit::job-applications.edit-status', collect($responseData->data)); 
    }

    public function update(Request $request, $id)
    {
       

        $parameters =array(
            'id' => $id,
            'status_position' => $request->status_position,
            'status_name' => $request->status_name,
           'status_color' => $request->status_color,
            'api_token' => Helper::getCurrentuserToken(),      

        ); 

        $apiurl = config('apipath.application-status-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
         return response()->json(['success' => $message]);

    }

    public function destroy(Request $request, $id)
    { 
       

       $parameters =array(
            'id' => $id, 
            'applicationIds' => $request->applicationIds,
            'api_token' => Helper::getCurrentuserToken(),      

        ); 

        $apiurl = config('apipath.application-status-destroy');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
         return response()->json(['success' => $message]);
    }
}