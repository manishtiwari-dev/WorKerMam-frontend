<?php

namespace Modules\SystemSetting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helper\Helper;

class TaxTypeController extends BaseController
{
  public function __construct()
  {
    $this->pageTitle = 'Tax Setting';
    $this->pageAccess = config('acceskey.tax-setting');
  }


  public function create()
  {
    $this->content = [];
    $parameters = array(
      "search" => "",
      "sortBy" => "",
      "orderBY" => "",
    );



    $apiurl = config('apipath.tax-type-create');
    //  dd( $apiurl);
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


    if (!empty($responseData))
      $this->content = $responseData->data;
    //  dd($this->data);

    return view('SystemSetting::tax-type.create', collect($this->data));
  }


  public function store(Request $request)
  {

    $parameters = array(
      'tax_name' => $request->tax_name,
      'api_token' => Helper::getCurrentuserToken(),
    );

    $apiurl = config('apipath.tax-type-store');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    $message = Helper::translation($responseData->message);
    return response()->json(['success' => $message, 'data' => $responseData->data]);
  }

  public function update(Request $request, $id)
  {

    $parameters = array(
      'id' => $id,
      'tax_name' => $request->tax_name,
      'api_token' => Helper::getCurrentuserToken(),
    );

    $apiurl = config('apipath.tax-type-update');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    //     dd(  $responseData);
    $message = Helper::translation($responseData->message);

    return response()->json(['success' => $message, 'data' => $responseData->data]);
  }

  public function destroy($id)
  {
    //  dd($id);
    $parameters = array(
      "id" => $id,
      'api_token' => Helper::getCurrentuserToken(),

    );

    $apiurl = config('apipath.tax-type-destroy');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    //   dd( $responseData);
    $message = Helper::translation($responseData->message);
    return response()->json(['success' => $message, 'data' => $responseData->data]);
  }
}
