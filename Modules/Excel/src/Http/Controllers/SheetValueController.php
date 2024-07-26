<?php

namespace Modules\Excel\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SheetValueController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'Sheet Value';
        $this->pageAccess = config('acceskey.excel');
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

        $apiurl = config('apipath.element-parent');
 
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        return view('Excel::sheetValue.index', collect( $this->data));

    }

    

    
    public function subSheetShow(Request $request,$id)
    {
 
        $this->content = [];
        $parameters = array(
            "page" => '1',
            "perPage" => "2",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'id'=>$id
        );

        $apiurl = config('apipath.element-sub-sheet');
 
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
 
        //   dd($this->data);
        return view('Excel::sheetValue.show', collect( $this->data));
    }




    public function element_value($id)
    {
        $parameters = array(
            "id" => $id,
        );

        $apiurl = config('apipath.element-value');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        // dd($responseData->data);
        return view('Excel::sheetValue.elementValue', collect($responseData->data));
    }

    public function element_value_update(Request $request, $id)
    {

        if ($id) {

            $apiurl = config('apipath.element-update');
            $responseData = Helper::ApiServiceResponse($apiurl, $request->all());

            // dd( $responseData);
            $message = Helper::translation($responseData->message);

            
            return response()->json(['success' => $message]);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }

  

  

    // public function updateLocation(Request $request){
           
    //      $parameters = array(

    //      "id" => $request->id,
    //      "location" => $request->location,

    //      );
 

    //      $apiurl = config('apipath.excel-location-update');
    //      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    //      $message = Helper::translation($responseData->message);


    //      return response()->json(['status' => 1, 'success' => $message]);
    // }

   


}