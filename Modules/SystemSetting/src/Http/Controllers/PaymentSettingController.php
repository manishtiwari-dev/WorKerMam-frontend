<?php

namespace Modules\SystemSetting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helper\Helper;
use Cache;


class PaymentSettingController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Payment Setting';
        $this->pageAccess = config('acceskey.payment-setting');
    }


    public function index()
    {

        $this->content = [];
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
        );

        $apiurl = config('apipath.paymentMethod-index');


        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data;
        //   dd($this->data);
        return view('SystemSetting::payment-setting.index', collect($this->data));
    }



    public function update(Request $request)
    {
        $parameters = array(
            "formData" => $request->all(),

        );

        $apiurl = config('apipath.paymentMethod-Update');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }
}
