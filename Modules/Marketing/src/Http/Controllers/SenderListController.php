<?php

namespace Modules\Marketing\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Helper\Helper;

class SenderListController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'Sender List';
        $this->pageAccess = config('acceskey.marketing-sender-list');
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
            "perPage" => "",
            "search" => "",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        );
        $apiurl = config('apipath.marketing-sendermail');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        
        if (!empty($responseData))
        $this->content = $responseData->data;
  
        
        return view('Marketing::settings.index', collect( $this->data));  
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function senderFilter(Request $request)
    {
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );

        $apiurl = config('apipath.marketing-sendermail');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
        $this->content = $responseData->data;

        $returnHTML = view('Marketing::settings.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([ 'success'=>'Sender Added successfully']);

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
        $parameters =array( 
            "sender_id" => $id,
        );
        $apiurl = config('apipath.marketing-sendermail-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
        return response()->json(['edit_sender' => $responseData->data]); 
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
       
        
    }
    public function AddSender(Request $request)
    {
        $parameters =array( 
            "sender_name" => $request->sender_name,
            "sender_email" => $request->sender_email,
            "reply_name" => $request->reply_name,
            "reply_email" => $request->reply_email,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.marketing-sendermail-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        $message = Helper::translation($responseData->message);
        if(isset($message)){
            return response()->json(['success'=>$message]);
        }
        else{
            return response()->json(['success'=>$responseData['message']]);
        }
        // return response()->json(['success'=>'Sender Status Changed Successfully']);
    }
    public function SenderUpdate(Request $request)
    {
        $parameters =array( 
            "sender_id" => $request->sender_id,
            "sender_name" => $request->sender_name,
            "sender_email" => $request->sender_email,
            "reply_name" => $request->reply_name,
            "reply_email" => $request->reply_email,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.marketing-sendermail-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);   
        $message = Helper::translation($responseData->message);
        if(isset($message)){
            return response()->json(['success'=>$message]);
        }
        else{
            return response()->json(['success'=>$responseData['message']]);
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
        
        
    }
    public function DeleteSender(Request $request)
    {  
        $parameters =array( 
            "sender_id" => $request->id,
            'api_token' => Helper::getCurrentuserToken(),
        );  
        $apiurl = config('apipath.marketing-sendermail-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if(isset($message)){
            return response()->json(['success'=>$message]);
        }
        else{
            return response()->json(['success'=>$responseData['message']]);
        }
        
    }
    public function ChangeSenderStatus(Request $request)
    {    
        $parameters =array( 
            "status" => $request->status,
            "sender_id" => $request->sender_id,
        );
        $apiurl = config('apipath.marketing-sendermail-change-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if(isset($message)){
            return response()->json(['success'=>$message]);
        }
        else{
            return response()->json(['success'=>$responseData['message']]);
        } 
    }
}
