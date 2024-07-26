<?php

namespace Modules\Sales\Http\Controllers;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class TransactionController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Transaction';
        $this->pageAccess = config('acceskey.sales-transaction');
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

      $apiurl = config('apipath.transaction');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

      if (!empty($responseData))
      $this->content = $responseData->data;

      return view('Sales::transaction.index', collect($this->data));
     
    }

    public function create(Request $request){ 
       $this->content = [];
       $parameters = array(
       );
 

       $apiurl = config('apipath.transaction-create');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
       if (!empty($responseData))
       $this->content = $responseData->data;
      $this->type = $request->type;
      

       return view('Sales::transaction.create', collect($this->data));
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
         "account_id" => $request->account_id, 
         "txn_type" => $request->txn_type,
         "txn_head" => $request->txn_head, 
         "txn_category" => $request->txn_category, 
         "txn_date" => $request->txn_date,  
         "txn_title" => $request->txn_title, 
         "amount" => $request->amount, 
         "note" => $request->note,  
         "customer_id" => $request->customer_id, 
         "invoice_id" => $request->invoice_id, 
         "order_id" => $request->order_id,  
         "txn_id" => $request->txn_id,
         "payment_method_id" => $request->payment_method_id,
         "sent_amt" => $request->sent_amt,
         "received_amt" => $request->received_amt,
         "charges" => $request->charges,
         "exchange_rate" => $request->exchange_rate,
         "bank_charge" => $request->bank_charge, 
         "radioInput" =>$request->radioInput,
         "invoicePage" => $request->invoicePage,
         "source" => $request->source,
         "source_id" => $request->source_id,
         'api_token' => Helper::getCurrentuserToken(),
      );
      
       $files =[];

       if( $request->hasFile('attachment')){
       $photo_file = $request->file('attachment');

       $photo_ary = [
       'name' => 'attachment',
       'contents' => file_get_contents($photo_file),
       'filename' => $photo_file->getClientOriginalName()
       ];

       array_push($files, $photo_ary);

       }

       $apiurl = config('apipath.transaction-store');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters , $files);
 
       $message = Helper::translation($responseData->message);


       if($responseData){
         if($request->invoicePage != 'inv'){
            return redirect()->route('accounts.transaction.index')->with('success', $message);
         }else{
            return redirect()->route('sales.invoice.index')->with('success', $message);
         }
       } else {
       return redirect()->back()->with('success', $message);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
   {
   $parameters = array(
   "expense_id" => $id,
   );

   $apiurl = config('apipath.transaction-edit');
   $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    

   if($responseData){
   return view('Sales::transaction.edit', collect($responseData->data));
   }else{
   return view('Sales::transaction.edit', collect($responseData->data));
   }
   }

   /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {

     
 
      $parameters = array(
         "id" => $id,
         "account_id" => $request->account_id, 
         "txn_type" => $request->txn_type,
         "txn_head" => $request->txn_head, 
         "txn_category" => $request->txn_category, 
         "txn_date" => $request->txn_date,  
         "txn_title" => $request->txn_title, 
         "amount" => $request->amount, 
         "note" => $request->note,  
         "customer_id" => $request->customer_id, 
         "invoice_id" => $request->invoice_id, 
         "order_id" => $request->order_id,  
         "txn_id" => $request->txn_id,
         "payment_method_id" => $request->payment_method_id,
         "sent_amt" => $request->sent_amt,
         "received_amt" => $request->received_amt,
         "charges" => $request->charges,
         "exchange_rate" => $request->exchange_rate,
         "bank_charge" => $request->bank_charge, 
         "radioInput" =>$request->radioInput,
         "source" => $request->source,
         "source_id" => $request->source_id,
         'api_token' => Helper::getCurrentuserToken(),
      );

    
       

      $files =[];

       if( $request->hasFile('attachment')){
       $photo_file = $request->file('attachment');

       $photo_ary = [
       'name' => 'attachment',
       'contents' => file_get_contents($photo_file),
       'filename' => $photo_file->getClientOriginalName()
       ];

       array_push($files, $photo_ary);

       }
 


   $apiurl = config('apipath.transaction-update');
   $responseData = Helper::ApiServiceResponse($apiurl, $parameters ,$files);
  

   $message = Helper::translation($responseData->message);


   if($responseData){
   return redirect()->route('accounts.transaction.index')->with('success', $message);
   } else {
   return redirect()->back()->with('success', $message);
   }
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
   public function destroy(Request $request)
   {
   $parameters = array(
   "id" => $request->transaction_id,
   'api_token' => Helper::getCurrentuserToken(),
   );


   $apiurl = config('apipath.transaction-destroy');
   $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

   $message = Helper::translation($responseData->message);


   if($responseData){
   return response()->json(['success' => $message]);
   } else {
   return response()->json(['success' => $message]);
   }
   }


   public function calendar() {
      
      $parameters = array(
         
      );


      $apiurl = config('apipath.transaction-calendar');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
     
// dd($responseData);
       return view('Sales::transaction.calendar' , collect($responseData->data));
   }
    
   public function txnFilter(Request $request)
   {

   $parameters = array(
   "start_date" => $request->start_date,
   "end_date" => $request->end_date,
   "txnhead" => $request->txnhead,
   "txncategory" => $request->txncategory,
   "accounts" => $request->accounts,
   'api_token' => Helper::getCurrentuserToken(), 
 
   );



   $apiurl = config('apipath.transaction');

   $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

   $this->content = $responseData->data;


   $returnHTML = view('Sales::transaction.filter_response', collect($this->data))->render();


   return response()->json(['success' => true, 'html' => $returnHTML]);
   }


   public function export($txnhead, $txncategory, $accounts , $startDate , $endDate)
   {
     

   $parameters =array(
      'txnhead' => $txnhead,
      'txncategory' => $txncategory,
      'accounts' => $accounts,
      'startDate' => $startDate,
      'endDate' => $endDate,
      'api_token' => Helper::getCurrentuserToken(),
   ); 
  


   $apiurl = config('apipath.transaction-export');
   $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

    

    $message = Helper::translation($responseData->message);
   if($responseData->status == true){
      return response()->download($responseData->data);
   }else{
   return Redirect::back()->with('error', $message);
   }
   }
 
}