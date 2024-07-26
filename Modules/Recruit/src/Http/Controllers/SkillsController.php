<?php

namespace Modules\Recruit\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SkillsController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.skills');
        $this->pageTitle = 'Skills';
 
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

        $apiurl = config('apipath.recruit-skills');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if(!empty($responseData))
       $this->content = $responseData->data;
 
                       
       return view('Recruit::skills.index', collect($this->data));

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

        $apiurl = config('apipath.recruite-skills-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      

         return view('Recruit::skills.create', collect($responseData->data));
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
            'category_id' => $request->category_id,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.recruite-skills-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
            return redirect()->route('recruit.setting.index', ['tab=skills'])->with(['success' => $message]);
        }
        else{
            return redirect()->route('recruit.setting.index', ['tab=skills'])->with(['error' => $message]);
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

        $apiurl = config('apipath.recruite-skills-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
         return view('Recruit::skills.edit', collect($responseData->data));
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
            'category_id' => $request->category_id,
            'api_token' => Helper::getCurrentuserToken(),      
        ); 


        $apiurl = config('apipath.recruite-skills-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);


       if($responseData->status == true){
            return redirect()->route('recruit.setting.index', ['tab=skills'])->with(['success' => $message]);
        }
        else{
            return redirect()->route('recruit.setting.index', ['tab=skills'])->with('error',$message);
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
        $apiurl = config('apipath.recruite-skills-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

 
 
        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
            return response()->json(['success' => $message]);
        }else{
            return response()->json(['error' => $message]);
        }
    }

}