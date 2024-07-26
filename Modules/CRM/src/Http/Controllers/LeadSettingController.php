<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;

class LeadSettingController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.lead_setting');
        $this->pageTitle = 'Lead Setting';
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
            "perPage" => "10",

            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.lead-setting');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      

        if (!empty($responseData))
            $this->content = $responseData->data;


        return view('CRM::lead-setting.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('designation.create');
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

            "source_name" => $request->source_name,


        );

        $apiurl = config('apipath.lead-source-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 2, 'success' => $message]);
        }
    }

    public function storeStatus(Request $request)
    { 
        $parameters = array(

            "status_name" => $request->status_name,
            "status_color" => $request->status_color


        );

        $apiurl = config('apipath.lead-status-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);


        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 2, 'success' => $message]);
        }
    }

    public function storeIndustry(Request $request)
    {
        $parameters = array(

            "industry_name" => $request->industry_name,


        );

        $apiurl = config('apipath.lead-industry-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        $message = Helper::translation($responseData->message);


        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 2, 'success' => $message]);
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
    public function source_edit($id)
    {
        // dd($id);

        $parameters = array(
            "source_id" => $id,
            // "status_id" => $id,

            // "industry_id"=>$id,

        );

        $apiurl = config('apipath.lead-source-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd( $responseData->data);
        //  return view('CRM::lead-setting.index', collect($responseData->data));




        return response()->json([collect($responseData->data)]);
    }

    public function status_edit($id)
    {

        $parameters = array(

            "status_id" => $id,



        );

        $apiurl = config('apipath.lead-status-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd( $responseData->data);
        //  return view('CRM::lead-setting.index', collect($responseData->data));



        return response()->json([collect($responseData->data)]);
    }




    public function industry_edit($id)
    {

        $parameters = array(


            "industry_id" => $id,

        );

        $apiurl = config('apipath.lead-industry-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return response()->json([collect($responseData->data)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function LeadSourceUpdate(Request $request)
    {

        $parameters = array(

            "source_name" => $request->source_name,
            "source_id" => $request->id,

        );

        $apiurl = config('apipath.lead-source-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);


        return response()->json(['status' => 1, 'success' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }

    public function changesourceStatus(Request $request)
    {
        $parameters = array(
            "source_id" => $request->source_id,
            "status" => $request->status


        );

        $apiurl = config('apipath.lead-source-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd( $responseData->data);
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }



    public function LeadStatusUpdate(Request $request)
    {

        $parameters = array(

            "status_name" => $request->status_name,
            "status_id" => $request->id,
            "status_color" => $request->status_color

        ); 

        $apiurl = config('apipath.lead-status-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
 
        if (isset($responseData)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }


        //   return response()->json(['status'=>1, 'success'=>$responseData->message]);

    }


    public function changeStatus(Request $request)
    {

        $parameters = array(
            "status_id" => $request->status_id,
            "status" => $request->status

        );

        $apiurl = config('apipath.lead-status-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }

        //  return response()->json(['status'=>1, 'message'=>$responseData->message]); 


    }

    public function LeadIndustryUpdate(Request $request)
    {


        $parameters = array(

            "industry_name" => $request->industry_name,
            "industry_id" => $request->id,

        );

        $apiurl = config('apipath.lead-industry-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);


        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function changeIndustryStatus(Request $request)
    {

        $parameters = array(
            "group_id" => $request->group_id,
            "status" => $request->status


        ); 

        $apiurl = config('apipath.lead-industry-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd( $responseData->data);
        $message = Helper::translation($responseData->message);

        if (isset($responseData)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }

        //   return response()->json([$responseData->message]); 


    }

    public function sortOrder(Request $request)
    {
        $parameters = array(
            "status_id" => $request->status_id,
            "sort_order" => $request->sort_order,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.lead-sortorder');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function SourceSortOrder(Request $request)
    {
        $parameters = array(
            "status_id" => $request->status_id,
            "sort_order" => $request->sort_order,
            'api_token' => Helper::getCurrentuserToken(),
        );
 
            $apiurl = config('apipath.lead-SourceSortOrder');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            $message = Helper::translation($responseData->message);

            return response()->json(['status' => 1, 'success' => $message]);
    }
    
    public function industrySortOrder(Request $request)
    {
        $parameters = array(
            "status_id" => $request->status_id,
            "sort_order" => $request->sort_order,
            'api_token' => Helper::getCurrentuserToken(),
        );

            $apiurl = config('apipath.lead-industrySortOrder');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }
     
     
 

    public function statusColor(Request $request)
    {
        $parameters = array(
            "color_id" => $request->color_id,
            "status_color" => $request->status_color,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.lead-status-color');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }
}
