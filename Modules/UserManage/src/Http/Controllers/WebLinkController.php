<?php

namespace Modules\UserManage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Services\ApiService;
use App\Helper\Helper;
use Cache;


class WebLinkController extends BaseController
{

    public function __construct()
    {
        $this->pageTitle = 'Web-links';
        $this->pageAccess = config('acceskey.custom_link');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    
        $apiurl = config('apipath.web-link-index');
    
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
     
        if(!empty($responseData))
        $this->content = $responseData->data;
    
        // dd($this->data);
        return view('UserManage::web-links.index',collect($this->data));
           
    }

    public function store(Request $request)
    {  
        $parameters =array(
            'link_name'=>$request->link_name,
            'link_url'=>$request->link_url,
            'seometa_title'=>$request->seometa_title,
            'seometa_desc'=>$request->seometa_desc,
            'status'=>$request->status,
            'noindex'=>$request->noindex,
            'api_token' => Cache::get('api_token'),
        );  
   

        $apiurl = config('apipath.web-link-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
   
        if($responseData->status == true){
            return response()->json(['status' => true, 'message' =>"Success"]);          
        }
        else{
            return response()->json(['status' => false, 'message' =>"Failed"]);
        }           
        
    }

    public function edit(Request $request)
    {   
        $parameters =array( 
            "link_id" => $request->link_id,
        );

        $apiurl = config('apipath.web-link-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
     
        return response()->json(['edit_weblinks' => $responseData->data]); 
    }


    public function update(Request $request)
    {
        $parameters =array( 
            'link_name'=>$request->link_name,
            'link_url'=>$request->link_url,
            'seometa_title'=>$request->edit_seometa_title,
            'seometa_desc'=>$request->edit_seometa_desc,
            'link_id'=>$request->link_id,
            'status'=>$request->status,
            'noindex'=>$request->noindex,
            'api_token' => Cache::get('api_token'),
        );
  
        $apiurl = config('apipath.web-link-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
       //  dd($responseData);

        if($responseData->status == true){
            return response()->json(['status' => true, 'message' =>"Success"]);          
        }
        else{
            return response()->json(['status' => false, 'message' =>"Failed"]);
        }    
    }

    public function delete(Request $request)
    {  
        $parameters =array( 
            "link_id" => $request->link_id,
            'api_token' => Cache::get('api_token'),
        );  

        $apiurl = config('apipath.web-link-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        if($responseData->status == true){
            return response()->json(['status' => true, 'message' =>"Success"]);          
        }
        else{
            return response()->json(['status' => false, 'message' =>"Failed"]);
        } 
        
    }
    public function status(Request $request)
    {    
        $parameters =array( 
            "link_id" => $request->link_id,
        );
        $apiurl = config('apipath.web-link-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         
        if($responseData->status == true){
            return response()->json(['status' => true, 'message' =>"Success"]);          
        }
        else{
            return response()->json(['status' => false, 'message' =>"Failed"]);
        } 
    }

    public function filter(Request $request)
    {   
        $parameters = array(
            "search" => $request->search,
        );
  
        $apiurl = config('apipath.web-link-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
        $this->content = $responseData->data;
        
        $returnHTML = view('UserManage::web-links.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

}