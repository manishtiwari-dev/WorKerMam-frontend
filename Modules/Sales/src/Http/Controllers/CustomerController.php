<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;




class CustomerController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Customer';
        $this->pageAccess = config('acceskey.sales-customer');
    }


    public function index()
    {   
        if (isset($_GET["page"])) 
          $page = $_GET["page"];
        else
         $page = 1;

        $start_date='';
        $end_date='';

        if (isset($_GET["start_date"])) 
          $start_date= $_GET["start_date"];
        if (isset($_GET["end_date"])) 
          $end_date= $_GET["end_date"];
 
        $this->content = [];
        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        );

        $apiurl = config('apipath.lead-customer');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        
        return view('Sales::customer.index', collect($this->data));
    }

    

    public function create()
    {
        $parameters = array(
            "page" => '1',
            "perPage" => "2",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",

        );

        $apiurl = config('apipath.lead-customer-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd( $responseData->data);
        return view('Sales::customer.create', collect($responseData->data));
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
            "lead_id" => $request->lead_id,
            "gender" => $request->gender ?? 1,
            "first_name" => $request->first_name,
            "contact" => $request->contact,
            "email" => $request->email,
            "company_name" => $request->company_name ??' ',
            "date_of_birth" => date('Y-m-d', strtotime($request->date_of_birth)),
            "website" => $request->website,
            "street_address" => $request->street_address,
            "city" => $request->city,
            "state" => $request->state,
            "zipcode" => $request->zipcode,
            "countries_id" => $request->countries_id,
            "phone" => $request->phone,
            "tax_id" => $request->tax_id,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.lead-customer-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $message = Helper::translation($responseData->message);

        
        if ($responseData) {
            if($request->cust == 1){
                if ($responseData->status == "true") 
                    return redirect()->route('sales.customer.index')->with('success', $responseData->message);
                else
                     return redirect()->back()->with('error', $message)->withInput();;
                    // return redirect()->route('sales.customer.index')->with('error', $responseData->message);
            }else{
                if ($responseData->status == "true")
                    return redirect()->back()->with('success', $message); 
                else
                    return redirect()->back()->with('error', $message)->withInput();;
            }
            

        } else {
            return redirect()->back()->with('error', $message); 
            //return redirect()->route('sales.customer.index')->with('error', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $parameters = ['customer_id' => $request->cutomer_id];
        $apiurl = config('apipath.lead-customer-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['success' => "Status Changed SuccessFully"]);
    }

    
    public function changeGuest(Request $request)
    {
        $parameters = ['customer_id' => $request->cutomer_id];
        $apiurl = config('apipath.customer-guestChange');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        return response()->json(['success' => "Guest Status Changed SuccessFully"]);
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

        $apiurl = config('apipath.lead-customer-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //     dd( $responseData->data);

        return view('Sales::customer.edit', collect($responseData->data));
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
        $parameters = array(
            "customer_id" => $id,
            "lead_id" => $request->lead_id,
            "gender" => $request->gender,
            "first_name" => $request->customer_name,
            "contact" => $request->contact,
            "email" => $request->customer_email,
            "company_name" => $request->company_name,
            "date_of_birth" => date('Y-m-d', strtotime($request->date_of_birth)),
            "website" => $request->website,
            "street_address" => $request->street_address,
            "city" => $request->city,
            "state" => $request->state,
            "zipcode" => $request->zipcode,
            "countries_id" => $request->countries_id,
            "phone" => $request->phone,
            "tax_id" => $request->tax_id,


        );

        $apiurl = config('apipath.lead-customer-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd( $responseData);


        $message = Helper::translation($responseData->message);


        if ($responseData) {
            return redirect()->route('sales.customer.index')->with('success', $message);
        } else {
            return redirect()->route('sales.customer.index')->with('error', $message);
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
        // if (Customer::find($id)->exists()) {
        // Customer::find($id)->delete();
        //     return response()->json(['success' => 'Customer Deleted Successfully']);
        // }else{
        //     return response()->json(['error' => 'Customer already deleted!']);
        // }
    }


    function customerfilter(Request $request)
    {   
        $this->content = [];

        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );

        $apiurl = config('apipath.lead-customer');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        
        $returnHTML = view('Sales::customer.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function customerDetails(Request $request){
         $parameters = array(
         "lead_id" => $request->lead_id,
         );

         $apiurl = config('apipath.customerDetails');
      
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        

         return response()->json(['datalist' => $responseData->data]);
    }


    public function customerCreate(Request $request){
        return view('Sales::invoice.customer-create');
    }
}