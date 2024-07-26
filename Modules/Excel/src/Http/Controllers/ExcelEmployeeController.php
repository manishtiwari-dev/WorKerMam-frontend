<?php

namespace Modules\Excel\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExcelEmployeeController extends BaseController
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

        $apiurl = config('apipath.excel-emp');
 
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
 

        return view('Excel::excel-employee.index', collect( $this->data));
    }

    public function empCreate(){
 

        $parameters = array(
            "page" => '1',
            );
   
            $apiurl = config('apipath.excel-emp-create');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
   
            return response()->json([collect($responseData->data)]);


    }

    public function employeeEdit($id){
         $parameters = array(
         "id" => $id,
         );

         $apiurl = config('apipath.excel-emp-edit');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         return response()->json([collect($responseData->data)]);
    }

    public function store(Request $request){
 
        $parameters =array(
            "employee_name" => $request->employee_name,
            "location" => $request->location,
            "salary" => $request->salary,
            "food" => $request->food,
            "type" => $request->type,
            'designation' => $request->designation

        );



        $apiurl = config('apipath.excel-emp-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

         if($responseData->status == true){
         return response()->json(['status' => 1, 'success' => $message]);
         }else{
         return response()->json(['status' => 2, 'success' => $message]);
         }
       
    }

    public function updateEmployee(Request $request){
           
         $parameters = array(

         "id" => $request->id,
         "employee_name" => $request->employee_name,
         "location" => $request->location,
         "salary" => $request->salary,
         "food" => $request->food,
         "type" => $request->type,
         'designation' => $request->designation



         );
 

         $apiurl = config('apipath.excel-emp-update');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);
        //  dd( $responseData);

         return response()->json(['status' => 1, 'success' => $message]);
    }

    public function changeStatus(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
            "status" => $request->status


        );

        $apiurl = config('apipath.excel-emp-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd( $responseData->data);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }



    public function import(Request $request){

        // $parameters =array(
            
        // );

        // $apiurl = config('apipath.excel-emp-import');

        // $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        return view('Excel::excel-sheet.import');



      //  return view('Excel::excel-sheet.import' , ['employee' =>  $responseData->data]);
    }

    public function importStore(Request $request){


        $parameters =array(
            // 'job_id' => $request->jobs,
        );

        $files = [];
        if( $request->hasFile('import_file')){
            $import_files = $request->file('import_file');
            $import_ary = [
            'name' => 'import_file',
            'contents' => file_get_contents($import_files),
            'filename' => $import_files->getClientOriginalName()
        ];
            array_push($files, $import_ary);
        }
 


        $apiurl = config('apipath.excel-emp-import-store');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
 
        //  dd( $responseData);
        $message = Helper::translation($responseData->message);

        return redirect()->route('excel.settings.index')->with('success',
        $message);       


    }







}