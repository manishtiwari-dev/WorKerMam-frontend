<?php

namespace Modules\SEO\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use App\Http\Controllers\BaseController;
use App\Services\ApiService;

class SeoSettingController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.general_setting');
        $this->pageTitle = 'General Settings';
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
            "page" => '1',
            "perPage" => "2",
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
        );



        $apiurl = config('apipath.seo-setting');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

        return view('SEO::seo-settings.index', collect($this->data));
    }


    public function changeWebsiteStatus(Request $request)
    {

        $parameters = array(
            "id" => $request->website_id,
            "status" => $request->status,
        );

        $apiurl = config('apipath.seo-setting-website-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function create()
    {

        $parameters = array(
            "page" => '1',
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.seo-setting-website-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return view('SEO::seo-settings.seo-website.create', collect($responseData->data));
    }

    public function store(Request $request)
    {
        $parameters = array(
            "website_name" => $request->website_name,
            "website_url" => $request->website_url,
            "countries_id" => $request->countries_id,
            "subscription_id" => $request->subscription_id,
            "start_date" => $request->start_date,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.seo-setting-website-store');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);


        if ($responseData) {
            return redirect()->route('seo.workReport', ['tab=website'])->with('success', $message);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }

    public function edit($id)
    {
        $parameters = array(
            "id" => $id,
        );
        $apiurl = config('apipath.seo-setting-website-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return view('SEO::seo-settings.seo-website.edit', collect($responseData->data));
    }

    public function update(Request $request, $id)
    {

        $parameters = array(
            "id" => $id,
            "website_name" => $request->website_name,
            "website_url" => $request->website_url,
            "countries_id" => $request->countries_id,
            "subscription_id" => $request->subscription_id,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            'status' => $request->status,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.seo-setting-website-update');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData) {
            return redirect()->route('seo.workReport', ['tab=website'])->with('success', $message);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }

    public function task_manage($id)
    {
        $parameters = array(
            "id" => $id,
        );

        $apiurl = config('apipath.seo-setting-manage-task-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        // dd($responseData);
        return view('SEO::seo-settings.seo-website.managetask', collect($responseData->data));
    }

    public function task_manage_update(Request $request, $id)
    {
        //  dd( $request->all());
        if ($id) {

            $apiurl = config('apipath.seo-setting-manage-task-update');
            $responseData = Helper::ApiServiceResponse($apiurl, $request->all());
            $message = Helper::translation($responseData->message);

            //  dd($responseData);
            return response()->json(['success' => $message]);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }


    public function changeTaskManageStatus(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
            "status" => $request->status,
        );



        $apiurl = config('apipath.seo-setting-manage-task-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    //website keyword
    public function keyword_manage($id)
    {
        $parameters = array(
            "id" => $id,
        );

        $apiurl = config('apipath.seo-setting-keyword');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        // dd($responseData);
        return view('SEO::seo-settings.seo-website.keyword', collect($responseData->data));
    }



    public function keyword_manage_update(Request $request, $id)
    {
        if ($id) {

            $apiurl = config('apipath.seo-keywords-ranking-update');
            $responseData = Helper::ApiServiceResponse($apiurl, $request->all());
            $message = Helper::translation($responseData->message);

            return response()->json(['success' => $message]);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }


    public function keywords_update(Request $request, $id)
    {
        $parameters = array(
            "id" => $id,
            "website_url" => $request->website_url,
            "keywords" => $request->keywords,
            "website_id" => $request->website_id,
            "formdata" => $request->all(),

        );

        //  dd($request->all());
        $apiurl = config('apipath.seo-keywords-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);

        $message = Helper::translation($responseData->message);


        if ($responseData->status == true) {
            return redirect()->route('seo.workReport', ['tab=website'])->with('success', $message);
        } else {
            return redirect()->route('seo.workReport', ['tab=website'])->with('error', $message);
        }
    }



    public function ranking_manage($id)
    {
        $parameters = array(
            "id" => $id,
        );

        $apiurl = config('apipath.seo-keywords-ranking');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //dd($responseData);
        return view('SEO::seo-settings.seo-website.ranking', collect($responseData->data));
    }


    public function changeTaskPriority(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
            "task_priority" => $request->task_priority,
        );

        $apiurl = config('apipath.seo-setting-manage-task-priority');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
    }


    public function changeTaskSubmission(Request $request)
    {
        $parameters = array(
            "id" => $request->id,
            "no_of_submission" => $request->no_of_submission,
        );

        $apiurl = config('apipath.seo-setting-manage-task-submission');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
    }

    public function task_create()
    {

        $apiurl = config('apipath.seo-setting-task-create');
        $responseData = Helper::ApiServiceResponse($apiurl, []);

        return view('SEO::seo-settings.seo-task.create', collect($responseData->data));
    }

    public function task_store(Request $request)
    {
        $parameters = array(
            "seo_task_title" => $request->seo_task_title,
            "task_priority" => $request->task_priority,
            "task_frequency" => $request->task_frequency,
            "no_of_submission" => $request->no_of_submission,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.seo-setting-task-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);



        if ($responseData) {
            return redirect()->route('seo.workReport', ["tab=task"])->with('success', $message);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }

    public function task_edit($id)
    {
        $parameters = array(
            "id" => $id,
        );

        $apiurl = config('apipath.seo-setting-task-edit');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return view('SEO::seo-settings.seo-task.edit', collect($responseData->data));
    }

    public function task_update(Request $request, $id)
    {
        $parameters = array(
            "id" => $id,
            "seo_task_title" => $request->seo_task_title,
            "task_priority" => $request->task_priority,
            "task_frequency" => $request->task_frequency,
            "no_of_submission" => $request->no_of_submission,
            'status' => $request->status,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.seo-setting-task-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {

            return redirect()->route('seo.workReport', ["tab=task"])->with('success', $message);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }

    public function task_destroy($id)
    {

        $parameters = array(
            "id" => $id,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.seo-setting-task-destroy');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
    }

    public function changeTaskStatus(Request $request)
    {
        $parameters = array(
            "id" => $request->task_id,
            "status" => $request->status,
        );

        $apiurl = config('apipath.seo-setting-task-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }


    public function changeDuplicateStatus(Request $request)
    {
        $parameters = array(
            "id" => $request->task_id,
            "duplicate" => $request->duplicate,
        );

        $apiurl = config('apipath.seo-setting-task-changeduplicate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function result_create()
    {

        $parameters = array(
            "page" => '1',
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.seo-setting-result-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['seoresult' => collect($responseData->data)]);
    }

    public function result_store(Request $request)
    {
        $parameters = array(
            "title_name" => $request->title,
            "parent_id" => $request->parent_section_id,
            'api_token' => Cache::get('api_token'),
        );

        $apiurl = config('apipath.seo-setting-result-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //    dd($responseData->message);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }

    public function result_edit($id)
    {
        $parameters = array(
            "id" => $id,
        );

        $apiurl = config('apipath.seo-setting-result-edit');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return json_encode($responseData->data);
    }

    public function resultUpdate(Request $request)
    {

        $parameters = array(
            "id" => $request->id,
            "title_name" => $request->title,
            "parent_id" => $request->section_type,
            'status' => $request->status,
            'api_token' => Cache::get('api_token'),
        );

        $apiurl = config('apipath.seo-setting-result-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //  dd( $responseData);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return redirect()->back()->withErrors($message)->withInput();
        }
    }

    public function result_destroy($id)
    {
        $parameters = array(
            "id" => $id,

        );

        $apiurl = config('apipath.seo-setting-result-destroy');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
    }

    public function changeResultStatus(Request $request)
    {

        $parameters = array(
            "result_id" => $request->result_id,
            "status" => $request->status,
        );

        $apiurl = config('apipath.seo-setting-result-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }



    public function changeResultSortOrder(Request $request)
    {

        $parameters = array(
            "result_id" => $request->result_id,
            "sort_order" => $request->sort_order,
        );

        $apiurl = config('apipath.seo-setting-result-changeSortOrder');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }
}
