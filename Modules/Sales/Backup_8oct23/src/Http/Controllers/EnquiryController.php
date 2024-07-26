<?php

namespace Modules\Sales\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class EnquiryController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Enquiry';
        $this->pageAccess = config('acceskey.sales-enquiry');
    }


    public function index()
    {
        $this->content = [];
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        $start_date = '';
        $end_date = '';

        if (isset($_GET["start_date"]))
            $start_date = $_GET["start_date"];
        if (isset($_GET["end_date"]))
            $end_date = $_GET["end_date"];

        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date' => $start_date,
            'end_date' => $end_date,
        );

        $apiurl = config('apipath.enquiry');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //dd($responseData->data);

        if (!empty($responseData))
            $this->content = $responseData->data;


        return view('Sales::enquiry.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $parameters = array(
            "enquiry_id" => $request->enquiry_id,
            "message" => $request->message,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.enquiry-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //  dd( $responseData);

        $message = Helper::translation($responseData->message);

        if ($responseData) {
            return redirect()->route('enquiry.index')->with('success', $message);
        } else {
            return redirect()->route('enquiry.index')->with('error', $message);
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
        $parameters = array(
            "enquiry_id" => $id,
        );

        $apiurl = config('apipath.enquiry-details');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //   dd( $responseData->data);

        return view('Sales::enquiry.details', collect($responseData->data));

        //  return view('CRM::enquiry.details');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (Customer::find($id)->exists()) {
        // Customer::find($id)->delete();
        //     return response()->json(['success' => 'Customer Deleted Successfully']);
        // }else{
        //     return response()->json(['error' => 'Customer already deleted!']);
        // }
    }

    public function changeStatus(Request $request)
    {

        $parameters = array(
            "enquiry_id" => $request->enquiry_id,
            "status" => $request->status,

        );

        $apiurl = config('apipath.enquiry-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return response()->json(['success' => $message]);
        } else {
            return response()->json(['success' => $responseData['message']]);
        }
    }

    function enquiryFilter(Request $request)
    {
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );

        $apiurl = config('apipath.enquiry');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $returnHTML = view('Sales::enquiry.filter_response', collect($responseData->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }
}
