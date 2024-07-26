<?php

namespace Modules\Support\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends BaseController
{
    
    public function __construct()
    {
        $this->pageTitle = 'Knowdledge';
        $this->pageAccess = config('acceskey.support');
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
 
        $apiurl = config('apipath.categories');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

        return view('Support::category.index', collect( $this->data));
    }

    public function create(){

         $parameters = array( 
         'api_token' => Helper::getCurrentuserToken(),

         );

         $apiurl = config('apipath.categories-create');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
                  


         return view('Support::category.create', collect($responseData->data));
    }

    public function edit($id){
        $parameters = array(
        'id' => $id,
        'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.categories-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 

        return view('Support::category.edit', collect( $responseData->data));
    }

    public function store(Request $request){
 
        $parameters =array(
            'category' => $request->category,
            'priority' => $request->priority,
            'status' => $request->status, 
            'api_token' => Helper::getCurrentuserToken(),
        ); 

        

        $apiurl = config('apipath.categories-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
        return redirect()->route('manage-landing.category.index')->with(['success' => $message]);
        }
        else{
        return redirect()->route('manage-landing.category.index')->with(['error' => $message]);
        }
    }

    public function update(Request $request , $id){

       $parameters =array(
        'id' => $id,
       'category' => $request->category,
       'priority' => $request->priority,
       'status' => $request->status,
       'api_token' => Helper::getCurrentuserToken(),
       );



         $apiurl = config('apipath.categories-update');

         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);

         if($responseData->status == true){
         return redirect()->route('manage-landing.category.index')->with(['success' => $message]);
         }
         else{
         return redirect()->route('manage-landing.category.index')->with(['error' => $message]);
         }

    }

    public function destroy(Request $request)
    {
        $parameters = array(
            "id" => $request->category_id,
            'api_token' => Helper::getCurrentuserToken(),
        );


            $apiurl = config('apipath.categories-destroy');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

            $message = Helper::translation($responseData->message);


        if($responseData){
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $message]);
        }
    }
 
   
}