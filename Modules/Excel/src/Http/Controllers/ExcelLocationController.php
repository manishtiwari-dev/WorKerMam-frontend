<?php

namespace Modules\Excel\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExcelLocationController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'Employee';
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

        $apiurl = config('apipath.excel-location');
 
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
 

        return view('Excel::excel-sheet.index', collect( $this->data));
    }

    public function create(){
 
    }

    public function locationEdit($id){
         $parameters = array(
         "id" => $id,
         );

         $apiurl = config('apipath.excel-location-edit');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         return response()->json([collect($responseData->data)]);
    }

    public function store(Request $request){
 
        $parameters =array(
        'location' => $request->location,
        
        );



        $apiurl = config('apipath.excel-location-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

         if($responseData->status == true){
        //  return response()->json(['status' => 1, 'success' => $message]);
        return response()->json(['success' => $message,'data' => $responseData->data]);

         }else{
         return response()->json(['status' => 2, 'success' => $message]);
         }
       
    }

    public function updateLocation(Request $request){
           
         $parameters = array(

         "id" => $request->id,
         "location" => $request->location,

         );
 

         $apiurl = config('apipath.excel-location-update');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);


         return response()->json(['status' => 1, 'success' => $message]);
    }

    public function changeStatus(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
            "status" => $request->status


        );

        $apiurl = config('apipath.excel-location-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd( $responseData->data);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }
}