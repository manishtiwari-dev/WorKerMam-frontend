<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;
use PDF;

class QuotationController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Quotation';
        $this->pageAccess = config('acceskey.sales-quotation');
        $this->pageCustomAccess = config('acceskey.sales-custom-quote');

        
    }


    public function index()
    {   
        $this->content = [];

        if(isset(request()->page))
          $page=request()->page;
        else
         $page=1;

        $start_date='';
        $end_date='';

        if(isset(request()->start_date))
          $start_date=request()->start_date;
        if(isset(request()->end_date))
          $end_date=request()->end_date;



        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'source'=>1,
        );

        $apiurl = config('apipath.lead-quotation');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
        return view('Sales::quotation.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $parameters = array(
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.lead-quotation-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        return view('Sales::quotation.create', collect($responseData->data));
    }


    public function SearchSuggestion(Request $request)
    {

        $parameters = array(
            "search" => $request->search,
            "language" => "1",
        );

        $apiurl = config('apipath.lead-quotation-searchSuggestion');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json([$responseData->data]);
    }

    public function SearchServices(Request $request)
    {

        $parameters = array(
        "search" => $request->search,
        "language" => "1",
        );

        $apiurl = config('apipath.invoice-search-services');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json([$responseData->data]);
    }


    // Search Item Details

    public function SearchItemDetail(Request $request)
    {
        $parameters = array(
            "product_id" => $request->product_id,
            "language" => "1",
        );

        $apiurl = config('apipath.lead-quotation-search-details');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json($responseData->data);
    }

    public function SearchServiceDetail(Request $request)
    {
        $parameters = array(
        "services_id" => $request->services_id,
        "language" => "1",
        );

        $apiurl = config('apipath.services-search-details');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
 

        return response()->json($responseData->data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (quotation::where("quotation_no", "=", $code)->first());

        return $code;
        // return view('CRM::quotation.create',compact('code'));

    }
    public function store(Request $request)
    {      
        $parameters = array(
            "customer_id" => $request->customer_id,
            "currency" => $request->currency,
            "item_name" => $request->item_name,
            "item_id" => $request->item_id,
            "quantity" => $request->quantity,
            "unit_price" => $request->unit_price,
            "tax" => $request->tax,
            "item_cost" => $request->item_cost,
            "item_attributes" => $request->item_attributes,
            "note" => $request->note,
            "subtotal" => $request->sub_total,
            "discount" => $request->total_discount,
            "item_discount" => $request->discount,
            "shipping_cost" => $request->shipping_cost,
            "final_cost" => $request->final_cost,
            "payment_term_id" => $request->payment_term_id,
            "tax_group_id" => $request->tax_group_id,
            'default_tax_group' => $request->default_tax_group,
            'tax_type' => $request->tax_type,
            'total_tax' => $request->total_tax,
            'billing_address_id' => $request->billing_address_id,
            'api_token' => Helper::getCurrentuserToken(),
            'source'=>$request->source,
        );

        // dd($parameters);

        $apiurl = config('apipath.lead-quotation-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
  
        $message = Helper::translation($responseData->message);

        if ($responseData) {
            if($request->source==1)
            return redirect()->route('sales.quotation.index')->with('success', $message);
            else
            return redirect()->route('sales.custom-quote')->with('success', $message);
        } else {
            
            if($request->source==1)
            return redirect()->route('sales.quotation.index')->with('success', $message);
            else
            return redirect()->route('sales.custom-quote')->with('success', $message);    
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
            "quotation_id" => $id,
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.lead-quotation-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if($responseData->data->quotation->source==1) // If source is products
        return view('Sales::quotation.edit', collect($responseData->data));
        else // If source is service
        return view('Sales::custome_quotation.edit', collect($responseData->data));
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
            "quotation_id" => $id,
            "customer_id" => $request->customer_id,
            "currency" => $request->currency,
            "item_name" => $request->item_name,
            "item_id" => $request->item_id,
            "quantity" => $request->quantity,
            "unit_price" => $request->unit_price,
            "tax" => $request->tax,
            "item_cost" => $request->item_cost,
            "item_attributes" => $request->item_attributes,
            "note" => $request->note,
            "subtotal" => $request->sub_total,
            "discount" => $request->total_discount,
            "item_discount" => $request->discount,
            "shipping_cost" => $request->shipping_cost,
            "final_cost" => $request->final_cost,
            "payment_term_id" => $request->payment_term_id,
            "tax_group_id" => $request->tax_group_id,
            'default_tax_group' => $request->default_tax_group,
            'tax_type' => $request->tax_type,
            'total_tax' => $request->total_tax,
            'billing_address_id' => $request->billing_address_id,
            'api_token' => Helper::getCurrentuserToken(),
            'sac_code'=>$request->sac_code,
        );

        $apiurl = config('apipath.lead-quotation-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        $message = Helper::translation($responseData->message);
        if ($responseData) {
            if($request->source==1)
            return redirect()->route('sales.quotation.index')->with('success', $message);
            else
            return redirect()->route('sales.custom-quote')->with('success', $message);
        } else {
            
            if($request->source==1)
            return redirect()->route('sales.quotation.index')->with('success', $message);
            else
            return redirect()->route('sales.custom-quote')->with('success', $message);    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //    
    }
    public function DeleteQuotation(Request $request)
    {
        if (Quotation::where('quotation_id', $request->quotation_id)->exists()) {
            $quotation = Quotation::where('quotation_id', $request->quotation_id)->delete();
            $quotationitem = Quotationitem::where('quotation_id', $request->quotation_id)->delete();
            return response()->json(['quotation', 'quotationitem' => $quotation, $quotationitem, 'success' => 'Quotation Deleted Successfully']);
        } else {
            return response()->json(['success' => "Quotation can't beDeleted"]);
        }
    }

    // View Quotaion Detail in PDF view 

    public function details(Request $request, $id)
    {
        $parameters = array(
            "quotation_id" => $id,
        );

        if ($id) {
            $apiurl = config('apipath.lead-quotation-edit');
            
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


            if($responseData->data->quotation->source==1) // If source is products
            return view('Sales::quotation.view', collect($responseData->data));
            else // If source is service
            return view('Sales::custome_quotation.view', collect($responseData->data));
        }
    }


    public function quotationDetailspdf(Request $request, $id)
    {
        $parameters = array(
            "quotation_no" => $id,
        );

        $apiurl = config('apipath.lead-quotation-pdf');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
   
        if(!empty($responseData)){
            if($responseData->data->quote_detail->source==1)
            $pdf = PDF::loadView('Sales::quotation.quotation-details-pdf.quote_pdf', ['data' =>$responseData->data]);
            else
            $pdf = PDF::loadView('Sales::custome_quotation.quotation-details-pdf.quote_pdf', ['data' =>$responseData->data]);

            $pdf->setPaper('a4')->setOption('margin-bottom', 0);
            return $pdf->download('Quotation_'.$responseData->data->quote_detail->quotation_no.'.pdf');
        }
    }


    public function changeStatus(Request $request)
    {
        $parameters = array(
            "quoteId" => $request->quotation_id,
            "statusId" => $request->status,
        );

        $apiurl = config('apipath.lead-quotation-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['status' => 1, 'message' => $responseData->message]);
    }


    public function quoteFilter(Request $request)
    {   
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
            'api_token' => Helper::getCurrentuserToken(),
            'source'=>$request->source,
        );

        $apiurl = config('apipath.lead-quotation');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $this->content = $responseData->data;

        if($request->source==1)
            $returnHTML = view('Sales::quotation.filter_response', collect($this->data))->render();
        else
            $returnHTML = view('Sales::custome_quotation.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }


    //  Custome Quotation Works Start

    public function custQuoteIndex()
    {
        $this->content = [];
        if(isset(request()->page))
          $page=request()->page;
        else
         $page=1;

        $start_date='';
        $end_date='';

        if(isset(request()->start_date))
          $start_date=request()->start_date;
        if(isset(request()->end_date))
          $end_date=request()->end_date;


        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'source'=>2,
        );

        $apiurl = config('apipath.lead-quotation');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

        return view('Sales::custome_quotation.index', collect($this->data));

    }


    //  Create  function for custome quoate

    public function createCustomeQuote()
    {
        $parameters = array(
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.lead-quotation-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
        return view('Sales::custome_quotation.create', collect($responseData->data));
    }

}