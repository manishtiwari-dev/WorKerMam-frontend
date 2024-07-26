<?php

namespace Modules\SEO\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use Cache;
use App\Http\Controllers\BaseController;


class SeoSubmissionController extends BaseController
{
    public function __construct()
    {
        $this->pageAccess = config('acceskey.submission_url');
        $this->pageTitle = 'Seo Submission Url';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $urlPage=false;

      if (isset($_GET["page"])){ 
        $page = $_GET["page"];
        $urlPage=true;
      }
      else
       $page = 1;

      $website_id='';
      $seo_task_id='';

      if (isset($_GET["website_id"])) 
        $website_id= $_GET["website_id"];
      if (isset($_GET["seo_task_id"])) 
        $seo_task_id= $_GET["seo_task_id"];

        $this->content = [];

        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'website_id'=>$website_id,
            'seo_task_id'=>$seo_task_id,
            "search" => $request->input_search,

        );

        $apiurl = config('apipath.seo-submission');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

        //   dd($this->data);
        return view('SEO::seo-submission-url.index', collect($this->data),compact('urlPage'));
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters = array();
        $apiurl = config('apipath.seo-submission-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        return view('SEO::seo-submission-url.create', collect($responseData->data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $parameters = array(
            "website_id" => $request->website_id,
            "seo_task_id" => $request->seo_task_id,
            "website_url" => $request->website_url,
            "username" => $request->username,
            "password" => $request->password,
            "email" => $request->email,
            "spam_score" => $request->spam_score,
            "dofollow" => $request->dofollow,
            "book_mark" => $request->book_mark,
            "da" => $request->da,
            "status" => $request->status,
            'api_token' => Cache::get('api_token'),
        );

 
        $apiurl = config('apipath.seo-submission-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);


        if ($responseData->status == true) {
            return redirect()->route('seo.submission-url.index')->with(['success' => $message, 'response_data' => $responseData->data]);
            // return redirect()->route('seo.submission-url.index', ['website_id=' . $request->website_id, 'seo_task_id=' . $request->seo_task_id])->with(['success' => $message, 'response_data' => $responseData->data]);
        } else {
            return redirect()->route('seo.submission-url.index')->withErrors($message)->withInput();
        }
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
        $parameters = array(
            "id" => $id,
        );

        $apiurl = config('apipath.seo-submission-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        return view('SEO::seo-submission-url.edit', collect($responseData->data));
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
       // dd($request->all());
        $parameters = array(
            "id" => $id,
            "website_id" => $request->website_id,
            "seo_task_id" => $request->seo_task_id,
            "website_url" => $request->website_url,
            "username" => $request->username,
            "password" => $request->password,
            "email" => $request->email,
            "spam_score" => $request->spam_score,
            "dofollow" => $request->dofollow,
            "book_mark" => $request->book_mark,
            "da" => $request->da,
            'api_token' => Cache::get('api_token'),
        );

        $apiurl = config('apipath.seo-submission-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return redirect()->route('seo.submission-url.index')->with('success', $message);
            // return redirect()->route('seo.submission-url.index', ['website_id=' . $request->website_id, 'seo_task_id=' . $request->seo_task_id])->with('success', $message);
        } else {
            return redirect()->route('seo.submission-url.index')->withErrors($message)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parameters = array(
            "id" => $id,
        );
        $apiurl = config('apipath.seo-submission-destroy');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json($message);
    }

    public function getSubmissionUrl(Request $request)
    {
        $parameters = array(
            "website_id" => $request->website_id,
            "seo_task_id" => $request->seo_task_id,
            "input_search" => $request->input_search,
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
        );
        $apiurl = config('apipath.seo-submission-url');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return response()->json(collect($responseData->data));
    }


    public function submissionFilter(Request $request)
    {   

        if (isset($_GET["page"])) 
        $page = $_GET["page"];
        else
        $page = 1;

    
        $parameters = array(
            "website_id" => $request->website_id,
            "seo_task_id" => $request->seo_task_id,
            "search" => $request->input_search,
            'api_token' => Helper::getCurrentuserToken(),
            "page" => $page,
            "perPage" => "",
        );
        
        // $apiurl = config('apipath.seo-submission-url');

       $apiurl = config('apipath.seo-submission');


        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $this->content = $responseData->data;
       
        $returnHTML = view('SEO::seo-submission-url.filter_response', collect($this->data))->render();
     
        return response()->json(['success' => true, 'html' => $returnHTML]);
    }



    public function ChangeSubmissionStatus(Request $request)
    {
        // dd($request->all());
        $parameters = array(
            "id" => $request->id,
            "status" => $request->status,
        );

        $apiurl = config('apipath.seo-submission-changeStatus');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }
}
