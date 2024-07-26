<?php

namespace Modules\Excel\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExcelController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'Sheet';
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

        $apiurl = config('apipath.excel');
 
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        //   dd($this->data);

        return view('Excel::excel-sheet.index', collect( $this->data));
    }


    


    public function elementList(Request $request){
 
        $parameters = array(
            'sheet_id'=>$request->sheet_id

            );
   
            $apiurl = config('apipath.excel-element-list');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
   
            $view = view('Excel::excel-sheet.renderSheet', ['sheetlist' =>  collect($responseData->data)])->render();


            return response()->json(['view' => $view]);

    }


    public function create(Request $request){
 
        $parameters = array(
            "id" => $request->parent,
            );
   
            $apiurl = config('apipath.excel-element-create');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

            // dd($responseData->data);
   
            return response()->json([collect($responseData->data)]);


    }

    public function excelEdit($id){
         $parameters = array(
         "excel_id" => $id,
         "api_token" => Helper::getCurrentuserToken(),
         );

         $apiurl = config('apipath.excel-edit');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         return response()->json([collect($responseData->data)]);
    }

    public function store(Request $request){
 
        $parameters =array(
        'parent' => $request->parent,
        'sheetName' => $request->sheetName,
        'api_token' => Helper::getCurrentuserToken(),
        );



        $apiurl = config('apipath.excel-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

         if($responseData->status == true){
         return response()->json(['status' => 1, 'success' => $message]);
         }else{
         return response()->json(['status' => 2, 'success' => $message]);
         }
       
    }





    public function element_store(Request $request){
 
        $parameters =array(
        'element_value' => $request->element_value,
        'sheet_id' => $request->sheet_id,
        'column_position' => $request->column_position,
        'row_position'=>$request->row_position,
        'value_type'=>$request->value_type,
        );

        $apiurl = config('apipath.excel-element-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

         if($responseData->status == true){
         return response()->json(['status' => 1, 'success' => $message]);
         }else{
         return response()->json(['status' => 2, 'success' => $message]);
         }
       
    }








    public function updateExcel(Request $request){
           
         $parameters = array(

         "id" => $request->id,
         "parent" => $request->parent,
         "sheetName" => $request->sheetName,

         );
 

         $apiurl = config('apipath.excel-update');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);


         return response()->json(['status' => 1, 'success' => $message]);
    }

    public function destroy(Request $request)
    {
       
    }   

     public function changeStatus(Request $request)
     {

     $parameters = array(
     "sheet_id" => $request->sheet_id,
     "status" => $request->status,
     );

     $apiurl = config('apipath.excel-changeStatus');
     $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
     $message = Helper::translation($responseData->message);

     return response()->json(['status' => 1, 'success' => $message]);
     }


     public function elementchangeStatus(Request $request)
     {

     $parameters = array(
     "id" => $request->id,
     "status" => $request->status,
     );

     $apiurl = config('apipath.excel-element-changestatus');
     $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
     $message = Helper::translation($responseData->message);

     return response()->json(['status' => 1, 'success' => $message]);
     }





}

