<?php

namespace Modules\Excel\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GenerateController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'Generate Excel';
        $this->pageAccess = config('acceskey.generate');
    }

 


    public function index()
    {
 
        $this->content = [];
        $parameters = array(
            "page" => '1',
            "perPage" => "2",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.generate-index');
 
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        if (!empty($responseData))
        $this->content = $responseData->data;
        //  return response()->download($responseData->data);
  
        return view('Excel::generate.index', collect( $this->data));
    }

    public function generate(Request $request){
        $parameters = array(
        "id" => $request->id, 
        );

        $apiurl = config('apipath.generate-excel');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        

        return response()->download($responseData->data);

    }

    public function locationEdit($id){
         
    }

    public function store(Request $request){
 
         
       
    }

    public function updateLocation(Request $request){
           
        
    }

    public function changeStatus(Request $request)
    {
         
    }
}