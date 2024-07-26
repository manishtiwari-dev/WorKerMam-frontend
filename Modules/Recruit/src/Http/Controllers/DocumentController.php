<?php

namespace Modules\Recruit\Http\Controllers;


use App\Helper\Files;
use App\Helper\Reply; 
use Illuminate\Http\Request;
use App\Helper\Helper;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
     

    public function index(Request $request)
    {
         $parameters =array(
            'documentable_type' => $request->documentable_type,
            'documentable_id' => $request->documentable_id,
        'api_token' => Helper::getCurrentuserToken(),      
       );

        $apiurl = config('apipath.documents-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
                       
       return view('Recruit::documents.index', collect($responseData->data));
       
    }

    public function store(Request $request)
    {  
         
 
        $parameters =array(
            'name' => $request->input('name'),
            'documentable_type' => $request->input('documentable_type'),
            'documentable_id' => $request->input('documentable_id'),
            'api_token' => Helper::getCurrentuserToken(),
        );  
  
         $files =[];
         if( $request->file){
            $photo_file = $request->file;

            $photo_ary = [
            'name' => 'file',
            'contents' => file_get_contents($photo_file),
            'filename' => $photo_file->getClientOriginalName()
            ];

            array_push($files, $photo_ary);
         } 
 
 


        $apiurl = config('apipath.documents-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters , $files);
  
        $message = Helper::translation($responseData->message);

         return response()->json(['success' => $message]);

    }

    public function destroy($id)
    {
          $parameters =array(
            'id' => $id,
            'api_token' => Helper::getCurrentuserToken(),
          );

          $apiurl = config('apipath.documents-destroy');

          $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


          $message = Helper::translation($responseData->message);

          return response()->json(['success' => $message]); 
    }

    public function data(Request $request)
    {
       
         $parameters =array(
         'documentable_type' => $request->documentable_type,
         'documentable_id' => $request->documentable_id,
         ); 

         $apiurl = config('apipath.documents-data');

         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
         
        return DataTables::of($responseData->data)
            ->addColumn('action', function ($row) {
                
                $action = '';                
                    $action .= '<a href="' . route('recruit.documents.downloadDoc', $row->id) . '" class="btn btn-success btn-circle"
                      data-toggle="tooltip" onclick="this.blur()" data-original-title="' . __('app.download') . '"><i class="fa fa-download" aria-hidden="true"></i></a>';
                      
                      
                    $action .= ' <a href="javascript:;" class="btn btn-danger btn-circle delete-document"
                      data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="' . __('app.delete') . '"><i class="fa fa-times" aria-hidden="true"></i></a>';
                

                return $action;
            })
            ->editColumn('name', function ($row) {
                return ucwords($row->name);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function downloadDoc($id)
    {
         $parameters =array(
         'id' => $id,
         'api_token' => Helper::getCurrentuserToken(),
         );

         $apiurl = config('apipath.documents-downloadDoc');

         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);



        $path = $responseData->data->filePath;
        Storage::disk('local')->put($responseData->data->extension, file_get_contents($path));

        $path = Storage::path($responseData->data->extension);

        return response()->download($path);

         
    }
}