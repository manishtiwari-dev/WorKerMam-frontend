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


class SeoWorkController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.daily_work');
        $this->pageTitle = 'Daily Work';
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

            "page" => '1',
            "perPage" => "2",
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.seo-dailyWork');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

        return view('SEO::seo-daily-report.index', collect($this->data));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $parameters = array(
                "id" => $id,
            );

            $apiurl = config('apipath.seo-dailyWork-edit');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

            return view('SEO::seo-daily-report.edit', collect($responseData->data));
        } else {

            return redirect()->route('daily-work')->withErrors('Something Error!')->withInput();
        }
    }


    public function duplicate_checker($id)
    {
        if ($id) {

            $parameters = array(
                "id" => $id,
            );

            $apiurl = config('apipath.seo-dailyWork-duplicate-checker');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

            return view('SEO::seo-daily-report.duplicateCheker', collect($responseData->data));
        } else {
            return redirect()->route('daily-work')->withErrors('Something Error!')->withInput();
        }
    }



    public function duplicate_checker_update(Request $request, $id)
    {
        
        if ($id) {
            $apiurl = config('apipath.seo-dailyWork-duplicate-checker-update');
            $responseData = Helper::ApiServiceResponse($apiurl, $request->all());
            $message = Helper::translation($responseData->message);

            return response()->json(collect($responseData->data));
        }

    }






    public function work_report_update(Request $request, $id)
    {
        if ($id) {
            $apiurl = config('apipath.seo-dailyWork-update');
            $responseData = Helper::ApiServiceResponse($apiurl, $request->all());
            $message = Helper::translation($responseData->message);

            return response()->json(['success' => $message]);
        } else {
            return response()->json(['error' => $message]);
        }
    }

    public function landingUrlCheck(Request $request)
    {
        $parameters = array(
            "landing_url" => $request->landing_url,
            "reportId" => $request->reportId,
            "website_id" => $request->website_id,
            "seo_task_id" => $request->seo_task_id,
        );
 
        $apiurl = config('apipath.seo-dailyWork-landingUrl-check');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
       if(!empty($responseData)){
        $message = Helper::translation($responseData->message);
        return response()->json(['status' => 1, 'success' => $message]);
       }
    }


    public function dailyWorkStatus(Request $request)
    {
        $parameters = array(

            "website_id" => $request->website_id,
            "status" => $request->status,

        );

        $apiurl = config('apipath.seo-dailyWork-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['work_report' => collect($message)]);
    }

    public function changeDofollowStatus(Request $request)
    {
        $parameters = array(
            "id" => $request->work_id,
            "status" => $request->status,
        );

        $apiurl = config('apipath.dofollow');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function PostingUpdate(Request $request)
    {
        $parameters = array(
            'task_id' => $request->id,
            'web_name' => $request->web_name
        );

        $apiurl = config('apipath.postingupdate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return view('SEO::seo-daily-report.posting-modal', collect($responseData->data));
    }

    public function postingstore(Request $request)
    {

        $parameters = array(
            'website_id' => $request->website_id,
            'seo_task_id' => $request->seo_task_id,
            'website_url' => $request->website_url,
            'username' => $request->website_username,
            'email' => $request->email,
            'password' => $request->website_password,
            'do_follow' => $request->do_follow,
            'book_mark' => $request->book_mark,
            'da' => $request->da,
            'spam_score' => $request->spam_score,
        );
  

        $apiurl = config('apipath.work-posting-store');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
      
        return response()->json(['status' => 1, 'success' => $message,'data' => $responseData->data]);
    }
}