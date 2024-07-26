<?php

namespace Modules\SystemSetting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helper\Helper;
use Cache;


class TaxSettingController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Tax Setting';
        $this->pageAccess = config('acceskey.tax-setting');
    }


    public function index()
    {

        $this->content = [];
        $parameters = array(
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
        );

        $apiurl = config('apipath.tax-setting');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data;
        //  dd($this->data);
        return view('SystemSetting::taxSetting.index', collect($this->data));
    }

    public function show($id)
    {
        $parameters = array(
            "tax_group_id" => $id,

            //    "language" => "1",
        );

        $apiurl = config('apipath.tax-setting-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd( $responseData);
        return view('SystemSetting::taxSetting.edit', collect($responseData->data));
    }



    public function edit($id)
    {
        $parameters = array(
            "tax_group_id" => $id,
        );
        $apiurl = config('apipath.tax-group-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if ($responseData->data) {
            return response()->json($responseData->data);
        } else {
            return respomse()->json(['data', $responseData['message']]);
        }
    }



    public function taxGrpupdate(Request $request,)
    {

        $parameters = array(
            'tax_group_id' => $request->tax_group_id,
            'tax_group_name' => $request->tax_group_name,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.tax-group-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //     dd(  $responseData);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message, 'data' => $responseData->data]);
    }


    public function ChangeStatus(Request $request)
    {

        $parameters = array(
            "tax_group_id" => $request->id,
            "status" => $request->status
        );


        $apiurl = config('apipath.tax-setting-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }


    public function update(Request $request, $tax_id)
    {
        $parameters = array(
            "tax_id" => $tax_id,
            "tax_type_id" => $request->tax_type_id,
            "tax_percent" => $request->tax_percent,
            "tax_group_id" => $request->group_id,
            "formdata" => $request->all(),

        );

        //  dd($request->all());
        $apiurl = config('apipath.tax-setting-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //   dd(  $responseData);
        $message = Helper::translation($responseData->message);


        if ($responseData->status == true) {
            return redirect('system-setting/tax-setting')->with('success', $message);
        } else {
            return redirect('system-setting/tax-setting')->with('error', $message);
        }
    }

    public function destroy(Request $request)
    {
        $parameters = array(
            "tax_group_id" => $request->tax_group_id,

        );

        $apiurl = config('apipath.tax-setting-destroy');
        //    dd( $apiurl);
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        ///   dd( $responseData);
        $message = Helper::translation($responseData->message);



        return response()->json(['success' => $message]);
    }
}
