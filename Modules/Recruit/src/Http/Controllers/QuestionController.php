<?php

namespace Modules\Recruit\Http\Controllers;


use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;



class QuestionController extends BaseController
{
    public function __construct()
    {
        
        $this->pageAccess = config('acceskey.jobs');
        $this->pageTitle = 'Jobs';
 
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

        $apiurl = config('apipath.questions-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        if(!empty($responseData))
       $this->content = $responseData->data;
        
       return view('Recruit::question.index', collect($this->data));
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

        $apiurl = config('apipath.questions-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      

         return view('Recruit::question.create', collect($responseData->data));
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
            'question' => $request->question,
            'required' => $request->required,
            'type' => $request->type,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.questions-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);
        if($responseData->status == true){
            return redirect()->route('recruit.questions.index')->with(['success' => $message]);
            
        }
        else{
            return redirect()->route('recruit.questions.index')->with('error',$message);
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
        $apiurl = config('apipath.questions-edit');
     
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
       
        
         return view('Recruit::question.edit', collect($responseData->data));
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
            'question' => $request->question,
            'required' => $request->required,
            'type' => $request->type,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.questions-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
       if($responseData->status == true){
            return redirect()->route('recruit.questions.index')->with(['success' => $message]);
            
        }
        else{
            return redirect()->route('recruit.questions.index')->with('error',$message);
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
        
        $apiurl = config('apipath.questions-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);
    }

    

}