<?php

namespace Modules\Recruit\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\BaseController;

class SettingController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.recruit-setting');
        $this->pageTitle =  'Setting';
 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->content = [];
        
            $parameters =array( 
                'api_token' => Helper::getCurrentuserToken(),       
           );
 
    
            $apiurl = config('apipath.setting-index');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
  
            if(!empty($responseData))
            $this->content = $responseData->data;

        return view('Recruit::zoom.setting', collect($this->data));
           
          
 
    }
    



    public function update(Request $request)
    { 
        $parameters = [
            'id' => $request->id ?? '',
            'enable_zoom' => $request->enable_zoom,
            'api_key' => $request->api_key,
            'secret_key' => $request->secret_key,
            'meeting_app'=>$request->meeting_app,
            'api_token' => Helper::getCurrentuserToken(),  
        ];
 
        
        $apiurl = config('apipath.setting-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
        $message = Helper::translation($responseData->message);



        if($responseData->status == true){
            return redirect()->route('recruit.setting.index',['tab=zoom-setting'])->with(['success' => $message]);
            
        }
        else{
            return redirect()->route('recruit.setting.index')->with('error',$message);
        }  
       
    
    }


}