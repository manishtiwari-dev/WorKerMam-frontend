<?php

namespace Modules\Sales\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Invoice';
        $this->pageAccess = config('acceskey.sales-invoice');
    }


    public function index()
    {
      
      $this->content = [];


      if(isset(request()->page))
      $page=request()->page;
      else
      $page=1;

      $start_date= $end_date= $client=$status= $search='';
     

      if(isset(request()->start_date))
        $start_date=request()->start_date;

      if(isset(request()->end_date))
        $end_date=request()->end_date;

      if(isset(request()->search))
        $search=request()->search;

      if(isset(request()->status))
        $status=request()->status;

      if(isset(request()->client))
        $client=request()->client;

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
         "client" => $client,
         'status' => $status,
         "search" => $search,
      );

      $apiurl = config('apipath.invoice-index');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    
      
      
      if (!empty($responseData))
      $this->content = $responseData->data;
      
      return view('Sales::invoice.index', collect($this->data));
    }

    public function create(Request $request){
      $this->content = [];
      $parameters = array(
      );

      $apiurl = config('apipath.invoice-create');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      // dd($responseData);
      if (!empty($responseData))
      $this->title = 'Add Invoice';
      $this->content = $responseData->data; 
      return view('Sales::invoice.create', collect($this->data));
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
      $invoice_Details = [
        'contact' => 'no',
        'bank_account' => 'no',
        'notes' =>  'no',
        'declaration' =>  'no',
        'term_and_condition' => 'no',
        'footer_info' =>  'no',
        ];

       foreach ($invoice_Details as $key => $value) {
        if ($request->has($key)) {
          $invoice_Details[$key] = 'yes';
        }
       }

 
      $parameters = array( 
        "invoice_number" => $request->invoice_number,
        "invoice_date" => $request->invoice_date,
        "due_date" => $request->due_date,   
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
        'source'=>$request->source,
        'sac_code'=>$request->sac_code,
        'taxable_amount' => $request->taxable_amount,
        'tax_component' => $request->tax_component,
        'total_taxable_amount' => $request->total_taxable_amount,
        'details'=> $invoice_Details,
        'api_token' => Helper::getCurrentuserToken(),
        );
 
 
 
        
 
 

        $apiurl = config('apipath.invoice-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
 
        
        $message = Helper::translation($responseData->message); 

        if($responseData->status == true){
              return redirect()->route('sales.invoice.index')->with('success', $message);
        }else{
              return redirect()->back()->with('error', $message);
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
        
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {  

      $refferer = $request->server('HTTP_REFERER');
      $request->session()->put('httpReferer', $refferer);

      
      $this->content = [];
       
      $parameters = array(
            "invoice_id" => $id, 
        ); 
        $apiurl = config('apipath.invoice-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
        if (!empty($responseData))
        $this->content = $responseData->data;
        $this->Title = "Update Invoice";
        
        if($responseData){
          return view('Sales::invoice.edit', collect($this->data));
        }else{
          return view('Sales::invoice.edit', collect($this->data));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {   

      

      $invoice_Details = [
        'contact' => 'no',
        'bank_account' => 'no',
        'notes' =>  'no',
        'declaration' =>  'no',
        'term_and_condition' => 'no',
        'footer_info' =>  'no',
        ];

      foreach ($invoice_Details as $key => $value) {
        if ($request->has($key)) {
          $invoice_Details[$key] = 'yes';
        }
      }


        $parameters = array(
          "invoice_id" => $id,
          "invoice_number" => $request->invoice_number,
          "invoice_date" => $request->invoice_date,
          "due_date" => $request->due_date,
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
          "discount" => $request->total_Descount_price,
          "item_discount" => $request->discount,
          "shipping_cost" => $request->shipping_cost,
          "final_cost" => $request->final_cost,
          "payment_term_id" => $request->payment_term_id,
          "tax_group_id" => $request->tax_group_id,
          'default_tax_group' => $request->default_tax_group,
          'tax_type' => $request->tax_type,
          'total_tax' => $request->total_tax,
          'billing_address_id' => $request->billing_address_id,
          'source'=>$request->source,
          'api_token' => Helper::getCurrentuserToken(),
          'sac_code'=>$request->sac_code, 
          'taxable_amount' => $request->taxable_amount,
          'total_taxable_amount' => $request->total_taxable_amount,
          'details'=> $invoice_Details,
          ); 

         
 
        $apiurl = config('apipath.invoice-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
        $message = Helper::translation($responseData->message);
 

        if($responseData->status == true){
        // return redirect()->route('sales.invoice.index')->with('success', $message);
        $value = $request->session()->get('httpReferer'); 

          return redirect()->away($value)->with('success', $message);

        }else{
        return redirect()->back()->with('error', $message);
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
      $parameters = array(
        "id" => $request->expense_id,
        'api_token' => Helper::getCurrentuserToken(),
      );

      $apiurl = config('apipath.invoice-destroy');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
     
      $message = Helper::translation($responseData->message);
 
      if($responseData){ 
        return response()->json(['success' => $message]);
      } else {
        return response()->json(['success' => $message]);
      }
    }

     public function details(Request $request, $id)
     {
        $this->content = [];

        $parameters = array(
        "invoice_id" => $id,
        );
        $apiurl = config('apipath.invoice-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
        $this->content = $responseData->data;

        if($responseData){
        return view('Sales::invoice.view', collect($this->data));
        }else{
        return view('Sales::invoice.view', collect($this->data));
        }
     }

     public function invoFilter(Request $request)
     {

      $parameters = array(
      "start_date" => $request->start_date,
      "end_date" => $request->end_date,
      "search" => $request->search,
      'api_token' => Helper::getCurrentuserToken(), 
      "source" => $request->source,
      "client" => $request->client,
      'status' => $request->status
      );

     

     $apiurl = config('apipath.invoice-index');

     $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
     $this->content = $responseData->data;
  
     $returnHTML = view('Sales::invoice.filter_response', collect($this->data))->render();
     

     return response()->json(['success' => true, 'html' => $returnHTML]);
     }


     public function invoiceDetailspdf(Request $request , $id){

        $parameters = array(
          "invoice_no" => $id,
        );

        

        $apiurl = config('apipath.invoice-invoice-pdf');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        

        if(!empty($responseData)){ 

            $pdf = PDF::loadView('Sales::invoice.invoice-details-pdf.invoice_pdf', ['data' =>$responseData->data]);
            // $pdf = PDF::loadView('Sales::invoice.invoice-details-pdf.invoice_template_1', ['data' =>$responseData->data]);
            

            $pdf->setPaper('a4')->setOption('margin-bottom', 0);

            return $pdf->download('Invoice_'.$responseData->data->quote_detail->invoice_number.'.pdf');
        }
     }

      public function changeStatus(Request $request)
      {
        $parameters = array(
          "invoiceId" => $request->quotation_id,
          "statusId" => $request->status,
        );

        $apiurl = config('apipath.Invoice-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['status' => 1, 'message' => $responseData->message]);
      }


      public function changeDate(Request $request){
         $parameters = array(
          "invoice_date" => $request->invoice_date,
         );
         

         $apiurl = config('apipath.changeDate');
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
         return response()->json([ 'dueDate' => $responseData->data]);
      }


      public function servicesAdd(Request $request){
 
          $parameters = array(
          "service_name" => $request->service_name,
          "item_saccode" => $request->item_saccode,
          "item_price" => $request->item_price,
          "tax_group" => $request->tax_group,
          );


          $apiurl = config('apipath.services-add');
          $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

         $message = Helper::translation($responseData->message);


         if($responseData->status == true){
           return response()->json(['status' => 1, 'message' => $message]);
         }else{
           return response()->json(['status' => 0, 'message' => $message]);
         }
      }


      public function invoiceDownload(Request $request, $id){

        
        $parameters = array(
          "invoice_no" => $id,
        );


        $apiurl = config('apipath.invoice-comp-download');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
  //  dd($responseData);
        
 
        if(!empty($responseData)){ 
 
            $pdf = PDF::loadView('Sales::invoice.invoice-details-pdf.invoice_template_1', ['data' =>$responseData->data]);
            
            $pdf->setPaper('a4')->setOption('margin-bottom', 0);

            return $pdf->download('Invoice_'.$responseData->data->quote_detail->invoice_number.'.pdf');
            // return view('Sales::invoice.invoice-details-pdf.invoice_template_1', ['data' =>$responseData->data ]);
        }

      }

      public function getTaxInfoByTaxGroupId($taxGroupArray, $targetTaxGroupId) {
        foreach ($taxGroupArray as $taxGroup) {
            if ($taxGroup->tax_group_id === $targetTaxGroupId) { 
                return $taxGroup->tax_info;
            }
        }
        return null; // Return null if tax_group_id is not found
    }


    public function dublicate(Request $request)
    {  
      $this->content = [];
       
      $parameters = array(
            "invoice_id" => $request->duplicate_inv, 
        ); 
        $apiurl = config('apipath.invoice-dublicate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
      
        
        if (!empty($responseData))
        $this->content = $responseData->data;
        $this->Title = "Update Invoice"; 
        if($responseData){
          return view('Sales::invoice.dublicate', collect($this->data));
        }else{
          return view('Sales::invoice.dublicate', collect($this->data));
        }
    }
}