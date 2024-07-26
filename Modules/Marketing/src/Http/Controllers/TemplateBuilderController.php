<?php

namespace Modules\Marketing\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Helper;




class TemplateBuilderController extends Controller
{
    public function create()
    {
        return view('maildoll_editor.create');
    }

    /*
    *   Image Upload
    *   @param $request
    *   @return json
    */
    public function imgUpload(Request $request)
    {
        $file = $request->file('file');
        $fileName = time().'.'.$file->extension();
        $file->move(public_path('editor_images'), $fileName);
        return response()->json(['success' => $fileName]);
    }

    /*
    *   Get all images from the folder
    *   @param $request
    *   @return json
    */
    public function getImg(Request $request)
    {
        $upload_dir = public_path('editor_images/');
        //get all files in uploads folder
        $files = array_diff(scandir($upload_dir), ['.', '..']);

        //creating response
        $response = [];

        $response['code'] = 0;
        $response['files'] = $files;
        // $response['directory']= $upload_dir;
        $response['directory'] = url('/editor_images/');
        //convert to json
        return json_encode($response);
    }

    /*
    *   Store template to the database and create a HTML copy
    *   @param $request
    *   @return json
    */
    public function store(Request $request)
    {   
        $parameters =array( 
            "id" => $request->id,
            "content" => $request->content,
            "subject" => $request->subject,
            "source" =>"add",
            "editor_type" =>$request->editor_type,
        );

        $apiurl = config('apipath.marketing-template-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
      
        if($responseData->data->editor_type==2)
        {
            $pagename = $responseData->data->id;

            $newFileName = base_path('public/asset/pro-editor/templates/saved/'.$pagename.".html");
            $newFileContent = $responseData->data->content;

            file_put_contents($newFileName, $newFileContent);
        }

        if ($responseData) {
            return redirect()->route('marketing.template-list.index')->with('success', $responseData->message);
        } else {
            return redirect()->route('marketing.template-list.index')->with('error', $responseData->message);
        }
    }

}
