<?php

namespace Modules\Pcapi\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;




class DigitalProofController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'Digital Proof';
        $this->pageAccess = config('acceskey.sales-customer');
    }



    public function index(Request $request)
    {
        $this->content = [];
        $parameters =array(
           
            "perPage" => "",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",
        );

         $apiurl = config('apipath.digitalProof'); 
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
         if (!empty($responseData))
        $this->content = $responseData->data;
         
        // dd($this->data);
        return view('Pcapi::digitalProof.index',collect($this->data));

       
    }

 

   
    public function details(Request $request)
    {
        // dd($request->all());
        $parameters =array( 
            "customer_id" => $request->id,
        );

        $apiurl = config('apipath.digitalProofDetails');
      
       

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
        // dd($responseData->data);

        return response()->json(['view_customer' => $responseData->data]); 
        
        // return view('Pcapi::digitalProof.details');

    }

  

 
}