<?php

namespace Modules\Sales\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class IncomeController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Income';
        $this->pageAccess = config('acceskey.sales-expense');
    }


    public function index()
    {
       $this->content = [];
       $parameters = array(
       );

       $apiurl = config('apipath.income');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

       if (!empty($responseData))
       $this->content = $responseData->data;
      //   dd($this->data);
       return view('Sales::income.index', collect($this->data));
     
    }

    public function create(Request $request){
       $this->content = [];
       $parameters = array(
       );
 

       $apiurl = config('apipath.incomes-create');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
       if (!empty($responseData))
       $this->content = $responseData->data;

       return view('Sales::income.create', collect($this->data));
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
         "date" => $request->date, 
         "account" => $request->account, 
         "amount" => $request->amount, 
         "name" => $request->name,
         "category" => $request->category,
         "number" => $request->number,
         "customer" => $request->customer,
         "note" => $request->note,
         "currency" => $request->currency,
         "payer_payee_id" => $request->payer_payee_id,
         "payment_method_id"=>$request->payment_method_id,
         "reference" => $request->reference,
         "recurring" => $request->recurring,
         "no_of_rotaion" => $request->no_of_rotaion,
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
 
       $apiurl = config('apipath.incomes-store');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters , $files);
       $message = Helper::translation($responseData->message);
  
 
       if($responseData){ 
             return redirect()->route('sales.income.index')->with('success', $message);
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
    public function show($id)
    {
        
      

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
         "income_id" => $id, 
     );
 
     $apiurl = config('apipath.incomes-edit');
     $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
    // dd( $responseData );
       if($responseData){
         return view('Sales::income.edit', collect($responseData->data));
       }else{
         return view('Sales::income.edit', collect($responseData->data));
       }

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

      //dd( $request->all());
      $parameters = array(
         'id' => $id,
         "date" => $request->date,
         "account" => $request->account,
         "amount" => $request->amount,
         "name" => $request->name,
         "category" => $request->category,
         "number" => $request->number,
         "customer" => $request->customer,
         "note" => $request->note,
         "currency" => $request->currency,
         "payer_payee_id" => $request->payer_payee_id,
         "payment_method_id"=>$request->payment_method_id,
         "reference" => $request->reference,
         "recurring" => $request->recurring,
         "no_of_rotaion" => $request->no_of_rotaion,
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
 
 
       $apiurl = config('apipath.incomes-update');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters ,$files);
       
      // dd( $responseData);
       $message = Helper::translation($responseData->message);
  
 
       if($responseData){ 
             return redirect()->route('sales.income.index')->with('success', $message);
       } else {
         return redirect()->back()->with('success', $message);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteIncome(Request $request)
    { 
      $parameters = array(
         "id" => $request->income_id,
         'api_token' => Helper::getCurrentuserToken(),
       );
 
 
       $apiurl = config('apipath.incomes-destroy');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
      
       $message = Helper::translation($responseData->message);
  
 
       if($responseData){ 
         return response()->json(['success' => $message]);
       } else {
         return response()->json(['success' => $message]);
       }
    }


   public function calendar() {
//    $transactions = Transaction::where("company_id", company_id())
//    ->where("type", "income")
//    ->orderBy("id", "desc")->get();
    return view('Sales::income.calendar');
   }

 
}