<?php

namespace Modules\Recruit\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreJobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Reply;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\BaseController;

class JobCategoryController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.job_categories');
        $this->pageTitle = 'Job Category';
 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $this->content = [];

        $parameters =array(

        "language" => "1",
        'api_token' => Helper::getCurrentuserToken(),      
       );

        $apiurl = config('apipath.recruit-job-category');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if(!empty($responseData))
       $this->content = $responseData->data;
 
        
       return view('Recruit::job-category.index',  collect($this->data));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $parameters =array(
        'api_token' => Helper::getCurrentuserToken(),      

        ); 

        $apiurl = config('apipath.recruite-job-category-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      

         return view('Recruit::job-category.create', collect($responseData->data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $parameters =array(
            'name' => $request->name,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.recruite-job-category-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
            return redirect()->route('recruit.setting.index',['tab=job-category'])->with(['success' =>
            $message]);
        }
        else{
            return redirect()->route('recruit.setting.index',['tab=job-category'])->with('error',$message);
        } 


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parameters =array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      
        );

        $apiurl = config('apipath.recruite-job-category-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        // dd($responseData);
         return view('Recruit::job-category.edit', collect($responseData->data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $parameters =array(
            'id' => $id,
            'name' => $request->name,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 
 

        $apiurl = "/job-categories/update";
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
     

       
        if($responseData->status == true){
            return redirect()->route('recruit.setting.index',['tab=job-category'])->with(['success' => $message]);
        }
        else{
            return redirect()->route('recruit.setting.index',['tab=job-category'])->with('error',$message);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $parameters = array(
            "id" => $id,
            'api_token' => Helper::getCurrentuserToken(),      

        );
        
        

        $apiurl = config('apipath.recruite-job-category-destroy');
       
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
    }

   
    

    public function getSkills($categoryId){

        

         $parameters =array(
            'categoryId' => $categoryId,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 
 

        $apiurl = config('apipath.recruite-job-category-getSkills');

        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData) {
            return response()->json(['data'=>$responseData->data , 'success' => $message]);
        } else {
            return response()->json(['error'=>$message]);
        } 

    }

}