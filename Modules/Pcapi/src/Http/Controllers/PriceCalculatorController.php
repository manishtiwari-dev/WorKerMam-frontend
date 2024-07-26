<?php

namespace Modules\Pcapi\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;

class PriceCalculatorController extends BaseController
{


    public function __construct()
    {
        $this->pageAccess = config('acceskey.price_calculator');
        $this->pageTitle = 'Price Calculator';
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
        $apiurl = config('apipath.priceCalculator');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;
        // dd($this->data);

        return view('Pcapi::priceCalculator.index', collect($this->data));
    }


    public function details(Request $request)
    {

        $this->content = [];

        $parameters = array(
            "product_id" => $request->products_id,
            "countries_id" => $request->countries_id,
        );
        $apiurl = config('apipath.priceCalculatorDetails');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        if (!empty($responseData))
            $this->content = $responseData->data;

        // dd($this->data);

        $returnHTML = view('Pcapi::priceCalculator.pricedetails', collect($this->data))->render();
        return response()->json(['success' => true, 'html' => $returnHTML]);
    }


    public function calculateShipping(Request $request)
    {

        $this->content = [];

        $parameters = array(
            "quantity" => $request->qty,
            "imprint_location" => $request->imprint_location,
            "imprint_color" => $request->imprint_color,
            "countries_id" => $request->countries_id,
            "products_id" => $request->products_id,

        );


        $apiurl = config('apipath.priceCalculatorShipping');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);



        if (!empty($responseData))
            $this->content = $responseData->data;


        $returnHTML = view('Pcapi::priceCalculator.calculatorHtml', collect($this->data))->render();
        return response()->json(['success' => true, 'html' => $returnHTML]);
    }
}
