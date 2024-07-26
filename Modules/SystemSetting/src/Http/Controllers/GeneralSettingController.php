<?php

namespace Modules\SystemSetting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helper\Helper;
use Cache;
use GuzzleHttp\Psr7;


class GeneralSettingController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'System Setting';
        $this->pageAccess = config('acceskey.general-setting');
    }


    public function index()
    {

        $this->content = [];
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
        );

        $apiurl = config('apipath.setting');


        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data;
        //   dd($this->data);
        return view('SystemSetting::general-setting.index', collect($this->data));
    }



    public function update(Request $request)
    {
        //dd($request->all());
        $parameters = array(
            "formData" => $request->all(),

        );

        $all_image_key = ["invoice_logo", "application_favicon", "application_logo", "landing_logo", "landing_favicon ", "landing_footer_logo"];

        $files = [];


        // if ($all_image_key) {
        //     foreach ($all_image_key as $key) {

        //         if ($request->hasFile($key)) {
        //             $photo_file = $request->file($key);
        //             // dd($photo_file);
        //             $extension = $photo_file->get();

        //             $photo_ary =  [
        //                 'name' => 'file',
        //                 'contents' => $photo_file->get(),
        //                 'filename' => $photo_file->getClientOriginalName()
        //             ];
        //             // dd($extension);
        //             array_push($files, $photo_ary);
        //         }
        //     }
        // }


        $apiurl = config('apipath.setting-store');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);

        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }
}
