<?php

namespace Modules\Recruit\Http\Controllers;


use Modules\Recruit\Models\Helper\Reply;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use ApiHelper;
use App\Helper\Helper;


class JobTypeController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
         $parameters =array(

        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.job-type-create');
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        

         return view('Recruit::jobType.create', collect($responseData->data)); 
    }


    public function edit($id)
    {
       //
    }

    public function store(Request $request)
    {
         
         $parameters =array(
            'job_type' => $request->job_type, 
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.job-type-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message , 'data' => $responseData->data]); 
    }

    public function update(Request $request, $id)
    {
       
        $parameters =array(
            'id' => $id, 
            'job_type' =>$request->job_type,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.job-type-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
         return response()->json(['success' => $message , 'data' => $responseData->data]);
    }

    public function destroy($id)
    {
        $parameters = array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      

        );
        
        $apiurl = config('apipath.job-type-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message , 'data' => $responseData->data]);
    }

    public function show($id)
    {
        //
    }
}