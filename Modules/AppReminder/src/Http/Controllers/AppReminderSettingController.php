<?php

namespace Modules\AppReminder\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Redirect;
use App\Helper\Helper;

class AppReminderSettingController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'App Reminder';
        $this->pageAccess = config('acceskey.app_reminder');
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
            'start_date'=>$start_date,
            'end_date'=>$end_date,
           
        );
        $apiurl = config('apipath.app-reminder-list');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template"; 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        if (!empty($responseData))
        $this->content = $responseData->data;
  
     
        return view('AppReminder::appReminderSetting.index',collect($this->data)); 

       // return view('Marketing::templatelist.index', collect($this->data)); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('AppReminder::appReminderSetting.create');
    }

    public function proEditor()
    {
        return view('Marketing::templatelist.pro_editor');
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
            "source" => $request->source,
            "interval" => $request->interval,
            "subject" => $request->subject,
            "content" => $request->content,
        );

        $apiurl = config('apipath.app-reminder-store');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/store"; 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);

        // if($request->editor=="pro")
        // return view('Marketing::templatelist.pro_editor',['data'=>$responseData->data]);
        // else
        // return view('Support::appReminderSetting.text_editor',['data'=>$responseData->data]);
        
        
        if ($responseData->status == true) {
            return redirect()->route('app-reminder.setting.index')->with('success', $message);
        } else {
            return redirect()->route('app-reminder.setting.index')->with('error', $message);
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
        );
        $apiurl = config('apipath.app-reminder-edit');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/edit";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
        
        if($responseData)
        return view('AppReminder::appReminderSetting.edit',['data'=>$responseData->data]); 

        
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
            "source" => $request->source,
            "interval" => $request->interval,
            "subject" => $request->subject,
            "content" => $request->content,
        );


        $apiurl = config('apipath.app-reminder-update');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/update";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);
 
       // dd($message);
        
        if (isset($message)) {
            return redirect()->route('app-reminder.setting.index')->with('success', $message); 
        } else {
            return redirect()->route('app-reminder.setting.index')->with('success', $responseData['message']);
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
        //
    }

    public function appReminderListDestroy(Request $request)
    {  
        $parameters =array( 
            "id" => $request->id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.app-reminder-destroy');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/destroy";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        $message = Helper::translation($responseData->message);

        if ($responseData) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $message]);
        }
        
    }
  

    public function ChangeStatus(Request $request)
    {
        $parameters =array( 
            "id" => $request->id, 
        ); 
        $apiurl = config('apipath.app-reminder-changeStatus');
        // $apiurl = "https://e-nnovation.net/backend/public/api/marketing-template/changeStatus";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);    
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]); 
        } 
    }

    public function Filter(Request $request)
    {
      
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );
        $apiurl= config('apipath.app-reminder-list');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

        $returnHTML = view('AppReminder::appReminderSetting.filter_response', collect($this->data))->render();
     //   dd(  $returnHTML);
        return response()->json(['success' => true, 'html'=>$returnHTML]);

    }
  
    
}
