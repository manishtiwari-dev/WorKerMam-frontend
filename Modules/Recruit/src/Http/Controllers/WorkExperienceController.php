<?php

namespace Modules\Recruit\Http\Controllers;

use App\Helper\Helper;
use App\Helper\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkExperienceController extends Controller
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

        $apiurl = config('apipath.work-experience-create');
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        

         return view('Recruit::work-experience.create', collect($responseData->data)); 
    }


    public function edit($id)
    {
       //
    }

    public function store(Request $request)
    { 

         $parameters =array(
            'work_experience' => $request->work_experience, 
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.work-experience-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message , 'data' => $responseData->data]); 

    }

    public function update(Request $request, $id)
    { 

       $parameters =array(
            'id' => $id, 
            'work_experience' =>$request->work_experience,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.work-experience-update');
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
        
        $apiurl = config('apipath.work-experience-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message , 'data' => $responseData->data]);
    }

    public function show($id)
    {
        //
    }
}