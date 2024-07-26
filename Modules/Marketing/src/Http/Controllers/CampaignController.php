<?php

namespace Modules\Marketing\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Helper\Helper;


use Illuminate\Support\Facades\Hash;
// use Modules\UserManage\Models\UserHasRoles;
use Auth;

class CampaignController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Campaign';
        $this->pageAccess = config('acceskey.marketing-campaign');
    }


    
    public function index()
    {     
        $this->content = [];

        if(isset(request()->page))
        $page=request()->page;
        else
        $page=1;

        $start_date='';
        $end_date='';

        if(isset(request()->start_date))
            $start_date=request()->start_date;
        if(isset(request()->end_date))
            $end_date=request()->end_date;

        $parameters =array(
            "page" => $page,
            "perPage" => "10",
            "search" => "",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        );
        
        $apiurl = config('apipath.marketing-campaign-list'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
        if (!empty($responseData))
        $this->content = $responseData->data;

        return view('Marketing::campaign.index', collect( $this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $parameters =array();
        $apiurl = config('apipath.marketing-campaign-create'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
       
        return view('Marketing::campaign.create', collect($responseData->data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $parameters =array( 
            "campaign_name" => $request->campaign_name,
            "campaign_subject" =>  $request->campaign_subject,
            "template_id" =>  $request->template_id,
            "sender_id" =>  $request->sender_id,
            "group_ids" =>  $request->group_ids,
            "description" =>  $request->description,
            "source" =>  $request->source,
            "description" =>  $request->description,
            "start_date" =>  $request->start_date,
            "from_time" =>  $request->from_time,
            "to_time" =>  $request->to_time,
            "time_zone" =>  $request->time_zone,
            'api_token' => Helper::getCurrentuserToken(),
        );
 

        $apiurl = config('apipath.marketing-campaign-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
  
        $message = Helper::translation($responseData->message);
        if(isset($responseData->status) && ( $responseData->status == 'validation')) {
            return redirect()->back()->withErrors($message)->withInput();
        } else {
            return redirect()->route('marketing.campaign.index')->with('success', $message);
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
        $parameters =array('id'=>$id);
        $apiurl = config('apipath.marketing-campaign-edit'); 
        // $apiurl="https://e-nnovation.net/backend/public/api/campaign/edit";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  

        return view('Marketing::campaign.edit', collect($responseData));      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CampaignUpdate(Request $request)
    {   
        $parameters =array( 
            "campaign_name" => $request->name,
            "campaign_subject" =>  $request->subject,
            "template_id" =>  $request->campaign_template,
            "sender_id" =>  $request->sender_id,
            "group_ids" =>  $request->group,
            "description" =>  $request->description,
            "source" =>  $request->source,
            "description" =>  $request->description,
            "campaign_id" =>  $request->campaign_id,
            "start_date" =>  $request->start_date,
            "from_time" =>  $request->from_time,
            "to_time" =>  $request->to_time,
            "time_zone" =>  $request->time_zone,
            "status" =>  $request->status,
            'api_token' => Helper::getCurrentuserToken(),
        );

        // dd($parameters);
        
        $apiurl = config('apipath.marketing-campaign-update');
        // $apiurl="https://e-nnovation.net/backend/public/api/campaign/update";

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        // dd($responseData);

        $message = Helper::translation($responseData->message);
        if(isset($responseData->message)) {
            return redirect()->route('marketing.campaign.index')->with('success', $message);
        } else {
            return redirect()->route('marketing.campaign.index')->with('error', $responseData['message']);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $parameters =array(
            'id'=>$request->campaign_id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.marketing-campaign-delete');
        // $apiurl="https://e-nnovation.net/backend/public/api/campaign/delete";

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);
        if(isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]); 
        }
    }

    public function ChangeCampaignStatus(Request $request)
    {   
        $parameters =array( 
            "id" => $request->campaign_id, 
        ); 
        $apiurl = config('apipath.marketing-campaign-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        $message = Helper::translation($responseData->message); 
        
        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]); 
        } 
    }

    
    public function CampaignView($id)
    {
        if(isset(request()->page))
        $page=request()->page;
        else
        $page=1;

       $parameters =array(
            'id'=>$id,
            "page" => $page,
            "perPage" => "10",
            'api_token' => Helper::getCurrentuserToken(),
        );  
        $apiurl = config('apipath.marketing-campaign-view');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
        // dd($responseData);
        return view('Marketing::campaign.show', collect($responseData->data));
    }

    public function campaignFilter(Request $request)
    {   
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );

        $apiurl = config('apipath.marketing-campaign-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        $returnHTML = view('Marketing::campaign.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }


    

}
