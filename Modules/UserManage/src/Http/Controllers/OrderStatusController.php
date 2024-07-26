<?php

namespace Modules\UserManage\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class OrderStatusController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Order Status';
        $this->pageAccess = config('acceskey.order_status');
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

        $apiurl = config('apipath.order-status-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        return view('UserManage::orderStatus.index', collect($this->data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function template_update(Request $request)
     {
    //   dd( $request->all());
         $parameters = array(
        
             "formdata" => $request->except('order_id'),
             'api_token' => Helper::getCurrentuserToken(),
         );
 
         $apiurl = config('apipath.order-status-template-update');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
     //    dd( $responseData);
        //  if ($responseData->status == true) {
 
        //      return redirect()->route('order-status')->with('success', $responseData->message);
        //  } else {
        //      return redirect()->route('order-status')->with('error', $responseData->message);
        //  }
        return response()->json(['status' => 1, 'success' => $responseData->message]);


     }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $parameters = array(
            "id" => $request->id,
            "status" => $request->status,
        );
        $apiurl = config('apipath.order-setting-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);



        return response()->json(['status' => 1, 'success' => $responseData->message]);
    }

    public function sortOrder(Request $request)
    {
        $parameters =array(
            "id" => $request->id,
            "sort_order" => $request->sort_order,
        );
        $apiurl = config('apipath.order-status-sortOrder');
        // $apiurl = "/pcCategory/sort-order";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
      //  dd( $responseData);
        return response()->json(['status'=>'true', 'success'=> $responseData->message]);

    }

    public function shippmentStatus(Request $request)
    {  
        // dd($request->all());
        $parameters =array(
            "shipment" => $request->shipment,
            "id" => $request->id,
          
           ); 
        $apiurl = config('apipath.order-setting-shippmentchange');
      //  $apiurl = "/pcCategory/feature-status";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
     //   dd( $responseData);
        return response()->json(['status'=>'true', 'success'=>$responseData->message]);
    }
}
