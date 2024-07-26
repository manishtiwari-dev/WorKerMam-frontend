<?php

namespace Modules\Support\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SupportController extends BaseController
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

        $apiurl = config('apipath.knowledge');
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
 

        return view('Support::knowledge.index', collect( $this->data));
    }

    public function create(){

         $parameters = array( 
         'api_token' => Helper::getCurrentuserToken(),

         );

         $apiurl = config('apipath.knowledge-create');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
                  


         return view('Support::knowledge.create', collect($responseData->data));
    }

    public function edit($id){
        $parameters = array(
        'id' => $id,
        'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = config('apipath.knowledge-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);



        return view('Support::knowledge.edit', collect( $responseData->data));
    }

    public function store(Request $request){

        $parameters =array(
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'tags' => $request->tags,
            'status' => $request->status,
            'privacy' => $request->privacy,
            'api_token' => Helper::getCurrentuserToken(),
        ); 

        $files =[];

            if( $request->hasFile('featureImage')){
                $photo_file = $request->file('featureImage');

                $photo_ary = [
                'name' => 'featureImage',
                'contents' => file_get_contents($photo_file),
                'filename' => $photo_file->getClientOriginalName()
                ];
                array_push($files, $photo_ary);
            }

            if( $request->hasFile('uploadImage')){
                $uploadImage_ary = $request->file('uploadImage');

                $uploadImage_ary = [
                'name' => 'uploadImage',
                'contents' => file_get_contents($uploadImage_ary),
                'filename' => $photo_file->getClientOriginalName()
                ];
                array_push($files, $uploadImage_ary);
            }

        $apiurl = config('apipath.knowledge-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
        return redirect()->route('manage-landing.knowledge.index')->with(['success' => $message]);
        }
        else{
        return redirect()->route('manage-landing.knowledge.index')->with(['error' => $message]);
        }
    }

    public function update(Request $request , $id){
        $parameters =array(
        'id' => $id,
        'title' => $request->title,
        'category' => $request->category,
        'description' => $request->description,
        'tags' => $request->tags,
        'status' => $request->status,
        'privacy' => $request->privacy,
        'api_token' => Helper::getCurrentuserToken(),
        );

        $files =[];

        if( $request->hasFile('featureImage')){
        $photo_file = $request->file('featureImage');

        $photo_ary = [
        'name' => 'featureImage',
        'contents' => file_get_contents($photo_file),
        'filename' => $photo_file->getClientOriginalName()
        ];
        array_push($files, $photo_ary);
        }

        if( $request->hasFile('uploadImage')){
        $uploadImage_ary = $request->file('uploadImage');

        $uploadImage_ary = [
        'name' => 'uploadImage',
        'contents' => file_get_contents($uploadImage_ary),
        'filename' => $photo_file->getClientOriginalName()
        ];
        array_push($files, $uploadImage_ary);
        }

         $apiurl = config('apipath.knowledge-update');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
         $message = Helper::translation($responseData->message);

         if($responseData->status == true){
         return redirect()->route('manage-landing.knowledge.index')->with(['success' => $message]);
         }
         else{
         return redirect()->route('manage-landing.knowledge.index')->with(['error' => $message]);
         }

    }

    public function destroy(Request $request)
    {
        $parameters = array(
            "id" => $request->artical_id,
            'api_token' => Helper::getCurrentuserToken(),
        );


            $apiurl = config('apipath.knowledge-destroy');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

            $message = Helper::translation($responseData->message);


        if($responseData){
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $message]);
        }
    }


    public function categoryList(){

         $this->content = [];
         $parameters = array(
         "page" => '1',
         "perPage" => "2",
         "sortBy" => "",
         "orderBY" => "",
         "language" => "1",
         'api_token' => Helper::getCurrentuserToken(),
         );

         $apiurl = config('apipath.knowledge');

         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         if (!empty($responseData))
         $this->content = $responseData->data;

        return view('Support::category.index', collect( $this->data));
    }

   
}