<?php

namespace Modules\Excel\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExcelDesignationController extends BaseController
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

        $apiurl = config('apipath.excel-design');
 
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
      //  dd($this->data);

        return view('Excel::excel-sheet.index', collect( $this->data));
    }

    public function create(){
 
    }

    public function designEdit($id){
         $parameters = array(
         "id" => $id,
         );

         $apiurl = config('apipath.excel-design-edit');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         return response()->json([collect($responseData->data)]);
    }

    public function store(Request $request){
 
        $parameters =array(
        'designation' => $request->designation,
        
        );



        $apiurl = config('apipath.excel-design-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        // dd($responseData);
         if($responseData->status == true){
         return response()->json(['success' => $message,'data' => $responseData->data]);
         }else{
         return response()->json([ 'success' => $message,'data' => $responseData->data]);
         }
       
    }

    public function updateDesign(Request $request){
           
         $parameters = array(

         "id" => $request->id,
         "designation" => $request->designation,

         );
 

         $apiurl = config('apipath.excel-design-update');
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

        $apiurl = config('apipath.excel-design-changeStatus');
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