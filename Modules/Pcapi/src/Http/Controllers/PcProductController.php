<?php

namespace Modules\Pcapi\Http\Controllers;


use Auth;
use GuzzleHttp\Client;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\BaseController;



class PcProductController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.pc_product');
        $this->pageTitle = 'PapaChina Product';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $this->content = [];

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        $categories_id='';
        if (isset($_GET["categories_id"]))
        $categories_id = $_GET["categories_id"];

        $parameters = array(
            "page" => $page,
            "perPage" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            "search" => $request->search ?? '',
            'categories_id'=> $categories_id,
        );

        $apiurl = config('apipath.product');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

       //   dd($this->data);
        return view('Pcapi::product.index', collect($this->data));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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

            "products_id" => $id,
            "perPage" => "",
            'api_token' => Helper::getCurrentuserToken(),
            "sortBy" => "",

        );

        $apiurl = config('apipath.product-show');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        return view('Pcapi::product.show', collect($responseData->data));
       
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
            "product_id" => $id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.product-edit');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      // dd( $responseData);
        return view('Pcapi::product.edit', collect($responseData));
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
            "products_id" => $id,
            "formdata" => $request->all(),
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.product-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

      
        if (isset($message)) {
            return redirect()->route('papachina-product.pc-products.index')->with('message', $message);
        } else {
            return view('Pcapi::category.index')->with('error', $responseData['message']);
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
        //
    }

    public function changeStatus(Request $request)
    {
        $parameters = array(
            "status" => $request->status,
            "products_id" => $request->products_id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        // $apiurl = config('apipath.category-changeStatus');

        $apiurl = config('apipath.product-change-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (!empty($message)) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 1, 'success' => $responseData['message']]);
        }
    }
    public function sortOrder(Request $request)
    {
        $parameters = array(
            "sort_order" => $request->sort_order,
            "products_id" => $request->products_id,
            'api_token' => Helper::getCurrentuserToken(),
        );
        // $apiurl = config('apipath.category-changeStatus');
        $apiurl = config('apipath.product-sortOrder');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 1, 'success' => $responseData['message']]);
        }
    }

    public function productSortOrder(Request $request)
    {
        $parameters = array(
            "sort_order" => $request->sort_order,
            "products_id" => $request->products_id,
            'api_token' => Helper::getCurrentuserToken(),
        );



        $apiurl = config('apipath.product-short-order');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if (!empty($message)) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 1, 'success' => $responseData['message']]);
        }
    }





    public function ProductListFilter(Request $request)
    { 

        $parameters = array(
          //  "page" => $page,
           // "perPage" => "50",
         //   "sortBy" => "",
          //  "orderBY" => "",
            "search" => $request->search,
            'products_status'=>$request->products_status,
            'categories_id'=> $request->categories_id,

        );
  

         $content=[];

         $apiurl= config('apipath.product');
  
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
  
         if (!empty($responseData))
          $this->content = $responseData->data;

          if (!empty($responseData)){
            $this->content = $responseData->data;
           }
       
         
        //  dd($this->data);
         $returnHTML = view('Pcapi::product.filter_product_response', collect($this->data))->render();


         return response()->json(['success' => true, 'html'=>$returnHTML]);
    }
    
    


}
