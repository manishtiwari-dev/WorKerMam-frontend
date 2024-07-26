<?php

namespace Modules\SystemSetting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helper\Helper;

class TaxGroupController extends BaseController
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



    $apiurl = config('apipath.tax-group-create');
    //  dd( $apiurl);
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


    if (!empty($responseData))
      $this->content = $responseData->data;
    //  dd($this->data);

    return view('SystemSetting::tax-group.create', collect($this->data));
  }


  public function store(Request $request)
  {

    $parameters = array(
      'tax_group_name' => $request->tax_group_name,
      'api_token' => Helper::getCurrentuserToken(),
    );

    $apiurl = config('apipath.tax-group-store');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    $message = Helper::translation($responseData->message);
    return response()->json(['success' => $message, 'data' => $responseData->data]);
  }

  public function update(Request $request, $id)
  {

    $parameters = array(
      'tax_group_id' => $id,
      'tax_group_name' => $request->tax_group_name,
      'api_token' => Helper::getCurrentuserToken(),
    );

    $apiurl = config('apipath.tax-group-update');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    //     dd(  $responseData);
    $message = Helper::translation($responseData->message);

    return response()->json(['success' => $message, 'data' => $responseData->data]);
  }

  public function destroy($id)
  {
    //  dd($id);
    $parameters = array(
      "tax_group_id" => $id,
      'api_token' => Helper::getCurrentuserToken(),

    );

    $apiurl = config('apipath.tax-group-destroy');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    //   dd( $responseData);
    $message = Helper::translation($responseData->message);
    return response()->json(['success' => $message, 'data' => $responseData->data]);
  }
}
