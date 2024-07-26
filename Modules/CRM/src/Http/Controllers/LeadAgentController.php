<?php

namespace Modules\CRM\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;

class LeadAgentController extends BaseController
{

     public function __construct()
    {
        $this->pageAccess = config('acceskey.lead_setting');
        $this->pageTitle = 'Lead Setting';
 
    }


    public function departmentUser(Request $request){
        $dept_id = $request->dept_id;
         
        $parameters = array(
            "dept_id" => $dept_id,
        );

        $apiurl = config('apipath.lead-dept-user');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {
        return response()->json(['responseData' => $responseData->data ,'success' => $message]);
        } else {
        return response()->json(['success' => $responseData['message']]);
        }

    }

    public function AgentStore(Request $request){ 

         $parameters = array(
            "agent_name" => $request->agent_name,
            "user_id" => $request->user_id,
            "communication" => $request->communication,
            "api_token" => Helper::getCurrentuserToken(),
         );

         $apiurl = config('apipath.lead-agent-store');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         $message = Helper::translation($responseData->message);


         if($responseData->status == true){
         return response()->json(['status' => 1, 'success' => $message]);
         }else{
         return response()->json(['status' => 2, 'success' => $message]);
         }

    }

    public function agent_edit($id)
    {

    $parameters = array(
    "agent_id" => $id,
    "api_token" => Helper::getCurrentuserToken(),

    ); 

    $apiurl = config('apipath.lead-agent-edit');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 


    return response()->json([collect($responseData->data)]);
    }

    public function LeadAgentUpdate(Request $request)
    {


    $parameters = array(   
        "agent_id" => $request->id,
        "agent_name" => $request->agent_name,
        "user_id"=>$request->user_id,
        "communication" => $request->communication,
        "api_token" => Helper::getCurrentuserToken(),
 

    );
    // dd($parameters);
 

    $apiurl = config('apipath.lead-agent-update');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    // dd($responseData);
    $message = Helper::translation($responseData->message);


    if($responseData->status == true){
    return response()->json(['status' => 1, 'success' => $message]);
    }else{
    return response()->json(['status' => 2, 'success' => $message]);
    }
    }


    public function changeStatus(Request $request){
        $parameters = array(
            "agent_id" => $request->agent_id,
            "status" => $request->status
        );

        $apiurl = config('apipath.lead-agent-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {
        return response()->json(['success' => $message]);
        } else {
        return response()->json(['success' => $responseData['message']]);
        }

    }

    public function TagStore(Request $request){
        $parameters = array(
            "tags_name" => $request->tags_name,
            "tags_color" => $request->tags_color,
            "api_token" => Helper::getCurrentuserToken(),
         );

         $apiurl = config('apipath.lead-tags-store');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);

        if($responseData->status == true){
        return response()->json(['status' => 1, 'success' => $message]);
        }else{
        return response()->json(['status' => 2, 'success' => $message]);
        }
    }

    public function tags_edit($id){
        $parameters = array(
            "tags_id" => $id,
            "api_token" => Helper::getCurrentuserToken(),
            );
        
            $apiurl = config('apipath.lead-tags-edit');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        
            return response()->json([collect($responseData->data)]);
    }

    public function TagUpdate(Request $request){
        $parameters = array(
            "tag_id" => $request->id,
            "tags_name" => $request->tags_name,
            "tags_color" => $request->tags_color,
            "api_token" => Helper::getCurrentuserToken(),
         );

         $apiurl = config('apipath.lead-tags-update');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);
      //   dd($message);
         if (isset($responseData)) {
            return response()->json(['success' => $message]);
         } else {
             return response()->json();
         }
    }


     public function changeTagStatus(Request $request){
        $parameters = array(
        "tag_id" => $request->tag_id,
        "status" => $request->status
        );

        $apiurl = config('apipath.lead-tags-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {
        return response()->json(['success' => $message]);
        } else {
        return response()->json(['success' => $responseData['message']]);
        }

     }


    public function sortOrder(Request $request)
    {
        $parameters = array(
            "status_id" => $request->status_id,
            "sort_order" => $request->sort_order,
            'api_token' => Helper::getCurrentuserToken(),
        );

            $apiurl = config('apipath.lead-agent-sortorder');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function tagSortOrder(Request $request)
    {
        $parameters = array(
            "status_id" => $request->status_id,
            "sort_order" => $request->sort_order,
            'api_token' => Helper::getCurrentuserToken(),
        );

            $apiurl = config('apipath.lead-tags-sortorder');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

}