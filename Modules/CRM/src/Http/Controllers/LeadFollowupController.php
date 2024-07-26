<?php

namespace Modules\CRM\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BaseController;
use App\Services\ApiService;
use App\Helper\Helper;


class LeadFollowupController extends BaseController
{

     public function __construct()
    {
        $this->pageAccess = config('acceskey.lead-followup');
        $this->pageTitle = 'Lead';
 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
         $this->content = [];


        if(isset($_GET["page"]))
        {
            $page=$_GET["page"];
        }
        else
        {
            $page=1;
        }
        $start_date='';
        $end_date='';

        if(isset(request()->start_date))
            $start_date=request()->start_date;
        if(isset(request()->end_date))
            $end_date=request()->end_date;


        $parameters =array(
            "page" => $page,
            "perPage" => "",
            "search" => $request->search ?? '',
            "sortBy"=> "",
            "orderBY" => "",
            'api_token' => Helper::getCurrentuserToken(), 
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            
        );

        $apiurl = config('apipath.lead-followup');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if(!empty($responseData))
       $this->content = $responseData->data;


        return view('CRM::lead-followup.index',collect($this->data));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
          $parameters =array(
                    "page" => '1',
                    "language" => "1",
                );

        $apiurl = config('apipath.lead-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            //   dd( $responseData);

          return view('CRM::lead-followup.create', collect($responseData->data));
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $this->content = [];

         $parameters =array(
         "id"=>$id,
         );


         $apiurl = config('apipath.lead-show');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         if(!empty($responseData))
         $this->content = $responseData->data;
        //  dd($this->data);
         return view('CRM::lead-followup.show', collect($this->data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lead_id)
    {   
       
         
              
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lead_id)
    { 
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

     

    }

    public function addmoredelete(Request $request)
    {
        $social_link_delete = LeadSocialLink::where('social_link_id',$request->social_link_id)->delete();
        return response()->json(['status'=>1, 'message'=>'Data deleted successfully']);
    }

    public function followStatus(Request $request)
    {
        $parameters =array(
                "quoteId" => $request->lead_id,
            
                "statusId" => $request->status,
            );

            $apiurl = config('apipath.lead-changeStatus');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'message' => $message]);
    }

    public function status_tab()
    {
        $parameters =array(
            "page" => '1',
            "language" => "1",
        );

        $apiurl = config('apipath.lead-status-tab');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
   
        return view('CRM::lead-followup.index', collect($responseData->data));
      
    }

    public function FollowupStore(Request $request){

        //  dd($request->all());
        $parameters = array(
        "lead_id" => $request->lead_id,
      //  "followup_id" => $request->followup_id,
        "source" => $request->source,
        "source_id" => $request->source_id,
        "followupdate" => $request->last_followup,
        "next_followup" => $request->next_followup,
        "followup_status" => $request->followup_status,
        "followup_nos" => 1,
        "followup_tag" => 1,
        "followup_note" => $request->followup_note,
        "api_token" => Helper::getCurrentuserToken(),
        );



        $apiurl = config('apipath.client-followUp-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        // dd($responseData);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function GetFollowup(Request $request){
        $parameters = array(
        "followup_id" => $request->followup_id,
        );

        $apiurl = config('apipath.get-followUp');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['followuplist' => $responseData->data]);
    }

    public function followupHistory(Request $request){
        $parameters = array(
        "enquiry_id" => $request->enquiry_id,
        "type" => $request->type,
        );

        $apiurl = config('apipath.get-followUpHistory');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        // dd($responseData);

        return response()->json(['followuplist' => $responseData->data]);
    }



    public function NoteStore(Request $request){

        $parameters = array(
        "lead_id" => $request->lead_id,
        "note_details" => $request->note_details,
        "note_visibility" => $request->note_visibility,
        "api_token" => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.lead-note-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
        // return redirect()->route('crm.lead-setting', ['tab=source'])->with('success', $responseData->message);
    }

    public function GetFollowupdetails(Request $request , $id){
        $this->content = [];

        $parameters =array(
        "id"=>$id,
        );


        $apiurl = config('apipath.lead-show');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        // dd($responseData);

        if(!empty($responseData))
        $this->content = $responseData->data;

        return view('CRM::lead.show', collect($this->data));
    }
      
    public function followupfilter(Request $request){
          $this->content = [];

          $parameters = array(
          "start_date" => $request->start_date,
          "end_date" => $request->end_date,
          "search" => $request->search,
          "agent_id"=>$request->agent_id,
          "tagSelect" => $request->tagSelect,
          "source_name" => $request->source_name,
          "followup" => $request->followup
          );

          $apiurl = config('apipath.lead-followup');

          $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          if (!empty($responseData))
          $this->content = $responseData->data;
// dd($this->data);
          $returnHTML = view('CRM::lead-followup.filter_response', collect($this->data))->render();

          return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function LeadTagUpdate(Request $request){
        // dd($request->all());
          $parameters = array(
            "tag_id" => $request->tag_id,
            "lead_id" => $request->lead_id,
          );

          $apiurl = config('apipath.lead-tag-update');
          $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          $message = Helper::translation($responseData->message);

          return response()->json(['success' => $message]);
    }

}
 