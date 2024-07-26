<?php

namespace Modules\SEO\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Services\ApiService;
use App\Helper\Helper;
use Cache;


class SeoWebRedirectorController extends BaseController
{


    public function __construct()
    {
        $this->pageTitle = 'Web-Redirects';
        $this->pageAccess = config('acceskey.web_redirects');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->content = [];

        if (isset(request()->page))
            $page = request()->page;
        else
            $page = 1;

        $start_date = '';
        $end_date = '';

        if (isset(request()->start_date))
            $start_date = request()->start_date;
        if (isset(request()->end_date))
            $end_date = request()->end_date;

        $parameters = array(
            "page" => $page,
            "perPage" => "10",
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date' => $start_date,
            'end_date' => $end_date,
        );

        $apiurl = config('apipath.web-redirector');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data;

        return view('SEO::web_redirector.index', collect($this->data));
    }

    public function store(Request $request)
    {
        $redirect_urls = parse_url($request->redirect_from, PHP_URL_PATH);
        $redirect_to_urls = parse_url($request->redirect_to, PHP_URL_PATH);
        $arrRedirecturls = str_split($redirect_urls); 
        $arrRedirect_to_urls = str_split($redirect_to_urls); 

        if( $arrRedirecturls[0] == "/")
        {
            $redirect_from = substr($redirect_urls, 1);
        }
         else{
            $redirect_from= $redirect_urls;
         }
         if( $arrRedirect_to_urls[0] == "/")
         {
             $redirect_to = substr($redirect_to_urls, 1);
         }
          else{
             $redirect_to = $redirect_to_urls;
          }

        $parameters = array(
            'redirect_from' => $redirect_from,
            'redirect_to' => $redirect_to,
            'redirect_type' => $request->redirect_type,
            "subscription_id" => $request->subscription_id,
            'api_token' => Cache::get('api_token'),
        );

        $apiurl = config('apipath.web-redirector-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => Helper::translation($responseData->message)]);
        } else {
            return response()->json(['status' => false, 'message' => Helper::translation($responseData->message)]);
        }
    }

    public function edit(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
        );
        $apiurl = config('apipath.web-redirector-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        return response()->json(['edit_url' => $responseData->data]);
    }


    public function update(Request $request)
    {
        $redirect_urls = parse_url($request->redirect_from, PHP_URL_PATH);
        $redirect_to_urls = parse_url($request->redirect_to, PHP_URL_PATH);
        $arrRedirecturls = str_split($redirect_urls); 
        $arrRedirect_to_urls = str_split($redirect_to_urls); 

        if( $arrRedirecturls[0] == "/")
        {
            $redirect_from = substr($redirect_urls, 1);
        }
         else{
            $redirect_from= $redirect_urls;
         }
         if( $arrRedirect_to_urls[0] == "/")
         {
             $redirect_to = substr($redirect_to_urls, 1);
         }
          else{
             $redirect_to = $redirect_to_urls;
          }

      //  echo $arr[0];
        
       // dd($arr[0]);
        // $redirect_from = substr($redirect_urls, 1, -1);
     //    $redirect_to = substr($redirect_to_urls, 1, -1);


        $parameters = array(
            'redirect_from' => $redirect_from,
            'redirect_to' => $redirect_to,
            'redirect_type' => $request->redirect_type,
            'id' => $request->id,
            "subscription_id" => $request->subscription_id,
            'api_token' => Cache::get('api_token'),
        );

        $apiurl = config('apipath.web-redirector-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => Helper::translation($responseData->message)]);
        } else {
            return response()->json(['status' => false, 'message' => Helper::translation($responseData->message)]);
        }
    }

    public function delete(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
            'api_token' => Cache::get('api_token'),
        );
        $apiurl = config('apipath.web-redirector-delete');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => "Success"]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed"]);
        }
    }
    public function status(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
        );
        $apiurl = config('apipath.web-redirector-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => Helper::translation($responseData->message)]);
        } else {
            return response()->json(['status' => false, 'message' => Helper::translation($responseData->message)]);
        }
    }

    public function filter(Request $request)
    {
        $parameters = array(
            "website" => $request->website,
            "search" => $request->search,
        );

        $apiurl = config('apipath.web-redirector');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data;

        $returnHTML = view('SEO::web_redirector.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }
}
