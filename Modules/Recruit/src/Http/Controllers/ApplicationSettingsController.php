<?php

namespace Modules\Recruit\Http\Controllers;


use App\Helper\Reply; 
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Helper\Helper;

class ApplicationSettingsController extends Controller
{
 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->meta_details = json_decode($this->global->meta_details);
        abort_if(! $this->user->cans('manage_settings'), 403);

        $this->timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        if(!$this->setting){
            abort(404);
        }  
       // dd($this->setting);
        return view('admin.application-setting.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $parameters = array(
        'api_token' => Helper::getCurrentuserToken(),      
        );
        
        $apiurl = config('apipath.application-setting-create'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

          return $responseData->data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        
        $mailSetting = [];

        foreach ($this->setting->mail_setting as $id => $setting) {
            $setting['status'] = false;
            if ($request->has('checkBoardColumn') && in_array($id, $request->checkBoardColumn)) {
                $setting['status'] = true;
            }
            $mailSetting = Arr::add($mailSetting, $id, $setting);
        }

        $this->setting->legal_term = $request->input('legal_term');
        $this->setting->mail_setting = $mailSetting;
        $this->setting->google_map_api_key = $request->google_map_api_key;
        $this->setting->job_application_limitation = $request->job_application_limitation;

        $this->setting->save();
        $this->global->meta_details = [
            'title' => $request->meta_title,
            'description' => $request->meta_description ,
        ];
        $this->global->save();

        return Reply::success(__('messages.applicationSetting.settingUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}