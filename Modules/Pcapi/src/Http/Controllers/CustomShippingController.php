<?php

namespace Modules\Pcapi\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;

class CustomShippingController extends BaseController
{


    public function __construct()
    {
        $this->pageAccess = config('acceskey.price_calculator');
        $this->pageTitle = 'Custom Shipping';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {

        $this->content = [];

        $parameters = array(
            "search" => $request->search ?? '',
        );
        $apiurl = config('apipath.customShipping');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;
        // dd($this->data);

        return view('Pcapi::customShipping.index', collect($this->data));
    }


    public function shippingUpdate(Request $request,)
    {
        //dd($request->all());

        $parameters = array(
            'shipping_type' => $request->shipping_type,
            'air_start_weight' => $request->air_start_weight,
            'air_end_weight' => $request->air_end_weight,
            'air_rate' => $request->air_rate,
            'old_air_start_weight' => $request->old_air_start_weight ?? '',
            'old_air_end_weight' => $request->old_air_end_weight ?? '',
            'old_air_rate' => $request->old_air_rate ?? '',
            'cbm_low_range' => $request->cbm_low_range,
            'cbm_high_range' => $request->cbm_high_range,
            'sea_rate' => $request->sea_rate,
            "formdata" => $request->all(),
            'air_shipping_id' => $request->air_shipping_id,
            'sea_shipping_id' => $request->sea_shipping_id,



        );

        $apiurl = config('apipath.customShippingUpdate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);

        return redirect()->route('papachina-product.custom-shipping.index')->with("success", $message);
    }
}
