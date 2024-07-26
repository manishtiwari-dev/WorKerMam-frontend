<?php

namespace Modules\Recruit\Http\Controllers;


use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class LocationsController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.job_location');
        $this->pageTitle = 'Job Locations';
 
    }
     
    public function index()
    {  

        $this->content = [];


        $parameters =array(

        "language" => "1",
        'api_token' => Helper::getCurrentuserToken(),      
       );

        $apiurl = config('apipath.location-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 

        if(!empty($responseData))
       $this->content = $responseData->data;
 

       return view('Recruit::locations.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters =array(
        'api_token' => Helper::getCurrentuserToken(),      

        ); 

        $apiurl = config('apipath.recruite-job-location-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
         return view('Recruit::locations.create', collect($responseData->data));
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
            'locations' => $request->locations,
            'country_id' => $request->country_id,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 


       $apiurl = config('apipath.recruite-job-location-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if($responseData->status == true){
            return redirect()->route('recruit.setting.index', ['tab=location'])->with(['success' => $message]);
            
        }
        else{
            return redirect()->route('recruit.setting.index', ['tab=location'])->with('error',$message);
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
        $parameters =array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      
        );

        // dd($parameters);

        $apiurl = config('apipath.recruite-job-location-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
         return view('Recruit::locations.edit', collect($responseData->data));
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
        
         $parameters =array(
            'id' => $id,
            'location' => $request->location,
            'country_id' => $request->country_id,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 


        $apiurl = config('apipath.recruite-job-location-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

       if($responseData->status == true){
            return redirect()->route('recruit.setting.index', ['tab=location'])->with(['success' => $message]);
            
        }
        else{
            return redirect()->route('recruit.setting.index', ['tab=location'])->with('error',$message);
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
       
        

        $parameters = array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      

        );
        
        $apiurl = config('apipath.recruite-job-location-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);
    }

}