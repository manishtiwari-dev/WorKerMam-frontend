<?php

namespace Modules\UserManage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Helper\Helper;
use App\Http\Requests\Auth\LoginRequest;
use Auth;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function index(Request $request)
    {
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "page" => $request->page ?? 1,
            "perPage" => 24,
        );

         $apiurl = config('apipath.media-list');
       // $apiurl = "/media";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //  dd($responseData->data);

        if ($responseData->data) {
            return view('UserManage::mediaGallery.index', collect($responseData->data));
        } else {
            return view('UserManage::mediaGallery.index', collect($responseData['message']));
        }

        //  return view('UserManage::mediaGallery.index'); 

    }



    public function show($id)
    {
        $parameters = array(
            "images_id" =>  $id
        );

        $apiurl = config('apipath.media-view');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd($responseData) ;

        return json_encode($responseData->data);

        //  return view('UserManage::mediaGallery.index'); 

    }



    public function store(Request $request)
    {
      //  $file = $request->file('file');
        $parameters = array(
            //'image' => $file,
            'api_token' => Helper::getCurrentuserToken(),  
        );

        $files =[];

        
       

        if( $request->hasFile('file')){
            $photo_file = $request->file('file');

            $photo_ary =  [
                'name' => 'file',
                'contents' => file_get_contents($photo_file),
                'filename' => $photo_file->getClientOriginalName()
            ];
    
             array_push($files, $photo_ary);
        }
        



        $apiurl = config('apipath.media-store');

       // $responseData = Helper::ApiServiceResponse($apiurl, $parameters, 'image', $file);

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);

     //  dd($responseData);

        if ($responseData->status == true) {
              return response()->json(['image_data' => '']);
        } else {
               return response()->json(['image_data' => '']);

            // return redirect()->route('media')->with('error', $responseData->message);
        }
    }


    public function destroy($id)
    {

        $parameters = array(
            "images_id" =>  $id

        );

        $apiurl = config('apipath.media-destroy');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd($responseData) ;


        return response()->json(['success' => $responseData->message]);
    }
}
