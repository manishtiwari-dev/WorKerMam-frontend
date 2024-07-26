<?php

namespace Modules\CRM\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;
use Carbon\Carbon;




class LeadController extends BaseController
{

    public function __construct()
    {
    $this->pageAccess = config('acceskey.lead');
    $this->pageTitle = 'Lead';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $parameters =array(
            "page" => $page,
            "perPage" => "",
            "search" => $request->search ?? '',
            "sortBy"=> "",
            "orderBY" => "",
            'api_token' => Helper::getCurrentuserToken(),

        );
 

        $apiurl = config('apipath.lead-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 

        if(!empty($responseData))
        $this->content = $responseData->data;  
        // dd($this->data);
        return view('CRM::lead.index', collect($this->data));

       
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

           return view('CRM::lead.create', collect($responseData->data));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $formate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
       $parameters =array(
        "created_at" =>$formate,
        "source_id"=>$request->source_id,
        "contact_name"=>$request->contact_name,
        "contact_email"=>$request->contact_email,
        "phone"=>$request->phone,
        "industry_id"=>$request->industry_id,
        "company_name"=>$request->company,
        "website"=>$request->website,
        "street_address"=>$request->street_address,
        "city"=>$request->city,
        "state"=>$request->state,
        "zipcode"=>$request->zipcode,
        "countries_id"=>$request->countries_id,
        "social_link" =>$request->social_link,
        "social_type" =>$request->social_type,
        "tags" => $request->tags,
        "note" => $request->note

       );
       
    //    dd($parameters);

       $apiurl = config('apipath.lead-store');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
       $message = Helper::translation($responseData->message);

 
       if ($responseData->status == true) {
            return redirect('crm/lead')->with('success',$message);
       }else{
            return redirect('crm/lead')->with('error',$message);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request , $id)
    {

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lead_id)
    {
           $parameters =array(
           "lead_id" => $lead_id,

           "language" => "1",
           );

           $apiurl = config('apipath.lead-edit');
           $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          
           return view('CRM::lead.edit', collect($responseData->data));
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
        $formate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
          $parameters =array(
            "created_at" =>$formate,
          "lead_id"=> $lead_id,
          "source_id"=>$request->source_id,
          "contact_name"=>$request->contact_name,
          "contact_email"=>$request->contact_email,
          "phone"=>$request->phone,
          "industry_id"=>$request->industry_id,
          "company_name"=>$request->company,
          "website"=>$request->website,
          "street_address"=>$request->street_address,
          "city"=>$request->city,
          "state"=>$request->state,
          "zipcode"=>$request->zipcode,
          "countries_id"=>$request->countries_id,
          "social_link" =>$request->social_link,
          "social_type" =>$request->social_type,
          "tags" => $request->tags

          ); 

          $apiurl = config('apipath.lead-update');
          $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          $message = Helper::translation($responseData->message);


          if ($responseData) {
          return redirect('crm/lead')->with('success',$message);
          } else {
          return redirect('crm/lead')->with('error',$message);
          }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parameters =array(
            "id" => $id,
        );

       $apiurl = config('apipath.client-destroy');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       $message = Helper::translation($responseData->message);

       return response()->json([$message]);
    }

    public function leadStatus(Request $request){

        $parameters = array(
        "leadId" => $request->lead_id,
        "statusId" => $request->status_id


        );

        $apiurl = config('apipath.lead-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {
        return response()->json(['success' => $message]);
        } else {
        return response()->json(['success' => $responseData['message']]);
        }
    }

    public function agentUpdate(Request $request){
        
         $parameters = array(
            "agent_id" => $request->value, 
            "lead_id" => $request->lead_id,
         );

         

         $apiurl = config('apipath.lead-agent');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //  dd($responseData);
        $message = Helper::translation($responseData->message);

         if (isset($responseData)) {
         return response()->json(['success' => $message]);
         } else {
         return response()->json(['success' => $responseData['message']]);
         }
    }

    public function leadfilter(Request $request){
        $this->content = [];

        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
            "category" => $request->category,
            "agent_id" => $request->agent_id,
            "tag_select" => $request->tag_select,
            "source_name" => $request->source_name,
        );
        
        

        $apiurl = config('apipath.lead-index');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

        // dd($this->data);

        $returnHTML = view('CRM::lead.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }


    public function leadImportCreate(Request $reqest)
    {
       $parameters =array(
       "page" => '1',
       "language" => "1",
       );

       $apiurl = config('apipath.lead-import-create');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

       return view('CRM::lead.import-create', collect($responseData->data));

    }


    public function leadImportStore(Request $request){
        

        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream',
        'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv',
        'application/excel', 'application/vnd.msexcel', 'text/plain',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if($_FILES['import_lead_crm']['name']) {
        $file = $request->import_lead_crm;
        $parameters =array(
        'source_id' => $request->source_id,
        'industry_id' => $request->industry_id,
        'import_file' => $file,
        );


        $apiurl = config('apipath.crm-lead-import-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, 'import_file', $file);
      
        $message = Helper::translation($responseData->message);

        return redirect()->route('crm.lead.index' )->with('success',
        $message);

        } else{
        return redirect()->route('crm.lead.index')->with('error', $message);
        }
    }

    public function donwloadFile(){
       
        $myFile = public_path("/importLead.xlsx");

        return response()->download($myFile);
    }

    public function sourceUpdate(Request $request){
        $parameters = array(
            "lead_id" => $request->lead_id,
            "source_id" => $request->source_id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        


        $apiurl = config('apipath.lead-source-name-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {

            return response()->json(['success' => $message]);
            
        } else {

            return response()->json(['success' => $responseData['message']]);

        }
    }

    public function groupUpdate(Request $request){
        $parameters = array(
            "lead_id" => $request->lead_id,
            "group_id" => $request->group_id,
            'api_token' => Helper::getCurrentuserToken(),
        );



        $apiurl = config('apipath.lead-group-name-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {

            return response()->json(['success' => $message]);

        } else {

            return response()->json(['success' => $responseData['message']]);

        }
    }


    public function leadEdit(Request $request ,$id){
        
        $parameters = array(
            "lead_id" => $id,
            'api_token' => Helper::getCurrentuserToken(),
        );  

        $apiurl = config('apipath.lead-edit-modal');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    
        
        return response()->json([collect($responseData->data)]);
    }


    public function leadUpdate(Request $request)
    { 
        $formate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $parameters =array(
            "created_at" =>$formate,
            "lead_id"=> $request->leadId,
            "source_id"=>$request->source_id,
            "contact_name"=>$request->contact_name,
            "contact_email"=>$request->contact_email,
            "phone"=>$request->phone,
            "industry_id"=>$request->industry_id,
            "company_name"=>$request->company,
            "website"=>$request->website,
            "street_address"=>$request->street_address,
            "city"=>$request->city,
            "state"=>$request->state,
            "zipcode"=>$request->zipcode,
            "countries_id"=>$request->countries_id,
            "social_link" =>$request->social_link,
            "social_type" =>$request->social_type,
            "tags" => $request->tags,
            "note" => $request->note

        );
 
        $apiurl = config('apipath.lead-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);


        if ($responseData) {
            return redirect('crm/lead')->with('success',$message);
        } else {
            return redirect('crm/lead')->with('error',$message);
        }
    }


    
}