<?php

namespace Modules\Recruit\Http\Controllers;


use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;

class ApplicantNoteController extends BaseController
{
    public function __construct()
    { 

    }

    public function store(Request $request)
    {
        $this->content = [];
         $parameters =array(
            'note' => $request->note, 
            'id' => $request->id,
            'api_token' => Helper::getCurrentuserToken(),
         );
 

         $apiurl = config('apipath.recruite-note-store');
         
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         if(!empty($responseData))
         $this->content = $responseData->data;
 
        $view = view('Recruit::applicant_notes.show', $this->data)->render(); 
        $message = Helper::translation($responseData->message);
         return response()->json(['success' => $message ,'view' => $view]);
    }

    public function update(Request $request, $id)
    {

        $this->content = [];

        $parameters =array(
            'note' => $request->note,
            'id' => $id,
            'api_token' => Helper::getCurrentuserToken(),
        );


        $apiurl = config('apipath.recruite-note-update');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if(!empty($responseData))
        $this->content = $responseData->data;

        $view = view('Recruit::applicant_notes.show', $this->data)->render();

        return response()->json(['success' => $message ,'view' => $view]); 
 
    }

    public function destroy($id)
    {
        
        $this->content = [];

        $parameters =array( 
        'id' => $id,
        'api_token' => Helper::getCurrentuserToken(),
        ); 

        $apiurl = config('apipath.recruite-note-destroy');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if(!empty($responseData))
        $this->content = $responseData->data;
 
        $view = view('Recruit::applicant_notes.show', $this->data)->render();

        return response()->json(['success' => $message ,'view' => $view]);

         
    }

}