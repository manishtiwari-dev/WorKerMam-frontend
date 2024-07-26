<?php

namespace Modules\Hrm\Http\Controllers;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;

class SettingController extends BaseController
{
    public function __construct()
    {
        //  $this->pageAccess = 'hrm-setting';
        $this->pageTitle = 'Setting';
        $this->pageAccess = config('acceskey.setting');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->content = [];

        $parameters = array(
            'api_token' => Helper::getCurrentuserToken(),
            "language" => "1",
        );

        $apiurl = config('apipath.leave-setting');
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        if (!empty($responseData))
            $this->content = $responseData->data;

        return view('Hrm::setting.index', collect($this->data));
    }


    public function leave_create()
    {

        return view('Hrm::setting.leavesetting.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function leave_store(Request $request)
    {


        $parameters = array(
            'api_token' => Helper::getCurrentuserToken(),
            'leave_type_name' => $request->leave_type_name,
            'leave_info' => $request->leave_info,
            'no_of_days' => $request->no_of_days,
            'max_allowed' => $request->max_allowed,
        );

        $apiurl = config('apipath.leave-setting-store');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
        $message = Helper::translation($responseData->message);


        if ($responseData) {
            return redirect()->route('hrm.setting', ['tab=leave-setting'])->with('success', $message);
        } else {
            return redirect()->route('hrm.setting', ['tab=leave-setting'])->with('error', $message);
        }
    }


    public function leave_edit($id)
    {

        $parameters = array(
            "leave_type_id" => $id,
        );

        $apiurl = config('apipath.leave-setting-edit');

        // $apiurl = "https://e-nnovation.net/backend/public/api/leaveType/edit";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return view('Hrm::setting.leavesetting.edit', collect($responseData->data));
    }

    public function leave_update(Request $request, $id)
    {
        $parameters = array(
            'leave_type_id' => $id,
            'leave_type_name' => $request->leave_type_name,
            'leave_info' => $request->leave_info,
            'no_of_days' => $request->no_of_days,
            'max_allowed' => $request->max_allowed,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.leave-setting-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData) {
            return redirect()->route('hrm.setting', ['tab=leave-setting'])->with('success', $message);
        } else {
            return redirect()->route('hrm.setting', ['tab=leave-setting'])->with('error', $message);
        }
    }
}

