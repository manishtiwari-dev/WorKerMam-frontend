<?php

namespace Modules\CRM\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Helper\Helper;




class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $parameters =array(
           
            "perPage" => "",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.lead-customer'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        return view('CRM::customer.index', collect($responseData->data));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $parameters =array(
            "page" => '1',
            "perPage" => "2",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",
        );

        $apiurl = config('apipath.lead-customer-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd( $responseData->data);
        return view('CRM::customer.create', collect($responseData->data));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $parameters =array(
            "lead_id"=>$request->lead_id,
            "gender"=>$request->gender,
            "first_name"=>$request->first_name,
            "contact" =>$request->contact,
            "email"=>$request->email,
            "company_name"=>$request->company_name,
            "date_of_birth"=>$request->date_of_birth,
            "website"=>$request->website,
             "street_address"=>$request->street_address,
             "city"=>$request->city,
             "state"=>$request->state,
             "zipcode"=>$request->zipcode,
             "countries_id"=>$request->countries_id,
             "phone" =>$request->phone
            
             
              );

              $apiurl = config('apipath.lead-customer-store');
              $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
           dd( $responseData);

         if ($responseData) {
            return redirect()->route('customer.index')->with('success',$responseData->message);
        } else {
            return redirect()->route('customer.index')->with('error',$responseData->message);
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
      


        $parameters =array(
            "id" => $id,
           
        );

        $apiurl = config('apipath.lead-customer-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    //     dd( $responseData->data);
    
        return view('CRM::customer.edit', collect($responseData->data));

     
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
         
        $parameters =array(
            "customer_id" => $id,
            "lead_id"=>$request->lead_id,
            "gender"=>$request->gender,
            "first_name"=>$request->customer_name,
            "contact" =>$request->contact,
            "email"=>$request->customer_email,
            "company_name"=>$request->company_name,
            "date_of_birth"=>$request->date_of_birth,
            "website"=>$request->website,
             "street_address"=>$request->street_address,
             "city"=>$request->city,
             "state"=>$request->state,
             "zipcode"=>$request->zipcode,
             "countries_id"=>$request->countries_id,
             "phone" =>$request->phone
            
             
              );

              $apiurl = config('apipath.lead-customer-update');
              $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          //  dd( $responseData);

          if ($responseData) {
            return redirect()->route('customer.index')->with('success',$responseData->message);
        } else {
            return redirect()->route('customer.index')->with('error',$responseData->message);
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
}