<?php

namespace Modules\Recruit\Http\Controllers;


use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;



class ApplicationArchiveController extends BaseController
{

   public function __construct()
   {
   $this->pageAccess = config('acceskey.candidate_database');
   $this->pageTitle = 'Candidate Archive';

   }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $parameters =array(

        "language" => "1",
        'api_token' => Helper::getCurrentuserToken(),
       );

        $apiurl = config('apipath.candidate-database-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //dd($responseData);
        
       return view('Recruit::applications-archive.index', collect($responseData->data)); 
    }


    public function data(Request $request)
    {

        $parameters =array(
            'skill' => $request->skill,
            'filter_status' => $request->filter_status,
            'location_id' => $request->location_id,      
        'api_token' => Helper::getCurrentuserToken(),       
         ); 

 
         $apiurl = config('apipath.candidate-database-data');
 
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //  dd($responseData);

        return DataTables::of($responseData->data->jobApplications)
             ->addColumn('select_orders', function ($row) {
                 return '<input type="checkbox"  name="check[]" class="checkBoxClass" value="'.$row->id.'"/>';
             })
            ->editColumn('full_name', function ($row) {
                return '<a href="javascript:;" class="show-detail" data-widget="control-sidebar" data-slide="true" data-row-id="' . $row->id . '">' . ucwords($row->full_name) . '</a>';
            })
            ->editColumn('title', function ($row) {
                return ucfirst($row->job->title ?? '');
            })
            ->editColumn('location', function ($row) {
                return ucwords($row->job->location->location ?? '');
            })
            ->rawColumns(['action', 'full_name','title', 'location','select_orders'])
            ->make(true);
    }

   

    public function destroy($id)
    {
        $parameters =array(
            'id' => $id,    
            'api_token' => Helper::getCurrentuserToken(),       
         ); 
 
         $apiurl = config('apipath.candidate-database-destroy');
 
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         
       return view('Recruit::applications-archive.index', collect($responseData->data));
    }

    public function show($id)
    {
        $this->content = [];

        $parameters =array(
            'id' => $id,    
            'api_token' => Helper::getCurrentuserToken(),       
         ); 
 

        
         $apiurl = config('apipath.candidate-database-show');
 
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if(!empty($responseData))
        $this->content = $responseData->data;
         
        $view = view('Recruit::applications-archive.show', $this->data)->render();

        
        return response()->json(['status' => 'success', 'view' => $view]);
    }

    public function export($skill)
    {
        $parameters = [
            'skill' => $skill,
        'api_token' => Helper::getCurrentuserToken(),
        ];

        
        $apiurl = config('apipath.candidate-database-export');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
            return response()->download($responseData->data);
        }else{
           return Redirect::back()->with('error', $message);
        }

    }
    public function deleteRecords(Request $request, $id){
     
        $parameters =array(
            'id' => $id,    
            'api_token' => Helper::getCurrentuserToken(),       
         ); 

        
         $apiurl = config('apipath.candidate-database-delete-record');
 
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);
        return response()->json(['status' => $message , 'data' => $responseData->data]);

    }
}