<?php

namespace Modules\AddOnManager\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddOnController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'AddOn Manager';
        $this->pageAccess = config('acceskey.add-on');
    }


  
     public function getShippingPortDetails($country_id)
     {

         $parameters = array(
             "country_id" => $country_id,
          
         );
 
          $apiurl = "https://promo-enterprise.com/api/shipping-port_details";
           $response = Http::post($apiurl, $parameters);
          // dd($response);
            $shipdetails= json_decode($response->getBody());
 
           return $shipdetails;

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

        $apiurl = config('apipath.addOn');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

       // dd( $this->data);

        return view('AddOnManager::add-on-manager.index', collect( $this->data));
    }

    public function edit(Request $request,$id)
    {

        
        $parameters = array(
            "id" => $id
        );

        $apiurl = config('apipath.addOn-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $shipdetails= [];
        
        foreach($responseData->data->country as $key => $country) {
            $responseData->data->country[$key]->seapoprt = (new self)->getShippingPortDetails($country->countries_id);
        }

       //  dd( $responseData);

        if ($responseData) {
            return response()->json($responseData);
        } else {
            return response()->json($responseData['message']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $parameters = array(
            "formData" => $request->except('add_on_id'),
            "add_on_id" => $request->add_on_id,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.addOn-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        //  dd($responseData);
        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

 

    public function changeStatus(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
            "status" => $request->status,
        );
        $apiurl = config('apipath.addOn-updatestatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }
}

