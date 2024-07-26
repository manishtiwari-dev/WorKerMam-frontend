<?php

namespace Modules\Sales\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function __construct()
    {
        $this->pageTitle = 'Account Setting';
        $this->pageAccess = config('acceskey.account-setting');
    }


    public function index()
    {
      
      $this->content = [];
      $parameters = array(
      );

      $apiurl = config('apipath.expanse-setting');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
      if (!empty($responseData))
      $this->content = $responseData->data; 
      return view('Sales::setting.index', collect($this->data));
    }

    public function create(Request $request)
    {
      $this->content = [];
      $parameters = array(
      );

      $apiurl = config('apipath.expenses-create');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

      if (!empty($responseData))
      $this->content = $responseData->data;
      
      return view('Sales::expenses.create', collect($this->data));
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
            "expense_name" => $request->expense_name,
            "expense_category" => $request->expense_category,
            'api_token' => Helper::getCurrentuserToken(),
            "category_type" => $request->category_type,
        );
 

        $apiurl = config('apipath.expanse-setting-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
             return response()->json(['status' => 1, 'success' => $message]);
        }else{
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
            "expense_id" => $id, 

        ); 
        
        $apiurl = config('apipath.sales-expense-edit');
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
    public function updateExpense(Request $request)
    {  
        $parameters = array(

            "id" => $request->id,
            "expense_name" => $request->expense_name,
            "editexpense_description" => $request->editexpense_description,
            "update_category_type" => $request->update_category_type,

        );

        $apiurl = config('apipath.sales-expense-update');
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
    public function deleteExpenseSetting(Request $request)
    { 
      $parameters = array(
        "id" => $request->expense_id,
        'api_token' => Helper::getCurrentuserToken(),
      );

      


      $apiurl = config('apipath.sales-expense-destroy');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  
     
     
      $message = Helper::translation($responseData->message);
 

      if($responseData){ 
        return response()->json(['success' => $message]);
      } else {
        return response()->json(['success' => $message]);
      }
    }

    public function deleteExpenseAcc(Request $request)
    {
      $parameters = array(
      "id" => $request->Account_id,
      'api_token' => Helper::getCurrentuserToken(),
      );




      $apiurl = config('apipath.sales-account-destroy');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


      $message = Helper::translation($responseData->message);


      if($responseData){
      return response()->json(['success' => $message]);
      } else {
      return response()->json(['success' => $message]);
      }
    }



    public function accountStore(Request $request){
      
      $parameters = array(
        "account_title" => $request->account_title,
        "type" => $request->type,
        "opening_date" => $request->opening_date,
        "account_number" => $request->account_number,
        "account_currency" => $request->account_currency,
        "opening_balence" => $request->opening_balence,
        "note" => $request->note, 

        'api_token' => Helper::getCurrentuserToken(),
      );

        $apiurl = config('apipath.account-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        $message = Helper::translation($responseData->message);


        if($responseData->status == true){
        return response()->json(['status' => 1, 'success' => $message]);
        }else{
        return response()->json(['status' => 2, 'success' => $message]);
        }
    }

    public function accountEdit($id){

      $parameters = array(
        "account_id" => $id,
        "api_token" => Helper::getCurrentuserToken(),
      );

      $apiurl = config('apipath.sales-account-edit');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);      

      return response()->json([collect($responseData->data)]);
    }

    public function updateAccount(Request $request){

      $parameters = array(
        "id" => $request->id,
        "edit_account_title" => $request->edit_account_title,
        "edit_type" => $request->edit_type,
        "edit_opening_date" => $request->edit_opening_date,
        "edit_account_number" => $request->edit_account_number,
        "edit_account_currency" => $request->edit_account_currency,
        "edit_opening_balence" => $request->edit_opening_balence,
        "edit_note" => $request->edit_note,
        "closing_balance" => $request->edit_closing_balence,
        "api_token" => Helper::getCurrentuserToken(),
      );

      

      $apiurl = config('apipath.sales-account-update');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      $message = Helper::translation($responseData->message);
      
      return response()->json(['status' => 1, 'success' => $message]);

    }


    public function changeCateStatus(Request $request){
      $parameters = array(
        "cate_id" => $request->cate_id,
        "status" => $request->status
      );
 

        $apiurl = config('apipath.cate-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

      if (isset($responseData)) {
        return response()->json(['success' => $message]);
      } else {
        return response()->json(['success' => $responseData['message']]);
      }

    }

    public function changeAccStatus(Request $request){
      $parameters = array(
        "account_id" => $request->account_id,
        "status" => $request->status
      );


      $apiurl = config('apipath.account-changeStatus');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      $message = Helper::translation($responseData->message);

      if (isset($responseData)) {
        return response()->json(['success' => $message]);
      } else {
        return response()->json(['success' => $responseData['message']]);
      }

    }


    public function txnHeadStore(Request $request){
 
      $parameters = array(
        "title_name" => $request->title,
        "parent_id" => $request->parent_section_id, 
        "head_type" => $request->head_type,
      );

      $apiurl = config('apipath.sales-setting-head-store');
       
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
      
      $message = Helper::translation($responseData->message);

      if ($responseData->status == true) {
          return response()->json(['status' => 1, 'success' => $message]);
      } else {
          return redirect()->back()->withErrors($message)->withInput();
      }

    }


    public function headResultCreate()
    {

        $parameters = array(
            "page" => '1',
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.txn-head-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['headresult' => collect($responseData->data)]);
    }

    public function HeadEdit(Request $request, $id){

      $parameters = array(
        "id" => $id,
      );

      $apiurl = config('apipath.sales-txt-head-edit');

      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 

      return json_encode($responseData->data);

    }

    public function headUpdate(Request $request){
 
      $parameters = array(
          "id" => $request->id,
          "title_name" => $request->title,
          "parent_id" => $request->parent_id ,
          "head_type" => $request->head_type,
          'status' => $request->status, 
      );
 
 
      $apiurl = config('apipath.txt-head-update');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

      //  dd( $responseData);
      $message = Helper::translation($responseData->message);

      if ($responseData->status == true) {
          return response()->json(['status' => 1, 'success' => $message]);
      } else {
          return redirect()->back()->withErrors($message)->withInput();
      }
    }


    public function HeadDestroy($id){
      $parameters = array(
        "id" => $id,

    );

    $apiurl = config('apipath.txt-head-destroy');
    $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    $message = Helper::translation($responseData->message);

    return response()->json(['success' => $message]);
    }


    public function changeHeadStatus(Request $request)
    {

        $parameters = array(
            "result_id" => $request->result_id,
            "status" => $request->status,
        );

        $apiurl = config('apipath.txt-setting-head-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
    }

    public function changeSortOrder(Request $request)
    {

        $parameters = array(
            "result_id" => $request->result_id,
            "sort_order" => $request->sort_order,
        );

        $apiurl = config('apipath.txt-setting-head-sort-order');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function changeCategorySortOrder(Request $request){

      $parameters = array(
          "category_id" => $request->category_id,
          "sort_order" => $request->sort_order,
      );

      $apiurl = config('apipath.category-sort-order');
      $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      $message = Helper::translation($responseData->message);

      return response()->json(['status' => 1, 'success' => $message]);

    }
}