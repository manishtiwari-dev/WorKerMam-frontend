<?php

namespace Modules\Pcapi\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;

class PcCategoryController extends BaseController
{


    public function __construct()
    {
        $this->pageAccess = config('acceskey.pc_category');
        $this->pageTitle = 'PapaChina Category';
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


        $parameters = array(
            "parentId" => $request->parentId ?? 0,
            "search" => $request->search ?? '',
            "page" => $page,        );
        $apiurl = config('apipath.category');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

        return view('Pcapi::category.index', collect($this->data));
    }

    public function changeStatus(Request $request)
    {
        $parameters = array(
            "status" => $request->status,
            "categories_id" => $request->categories_id,
            'api_token' => Helper::getCurrentuserToken(),

        );
        $apiurl = config('apipath.category-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

    public function isFeatureStatus(Request $request)
    {

        $parameters = array(
            "is_featured" => $request->is_featured,
            "categories_id" => $request->categories_id,
            'api_token' => Helper::getCurrentuserToken(),

        );

        $apiurl = "/pcCategory/feature-status";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $this->content = [];
        $parameters = array(
            "id" => $id,
            "search" => $request->search ?? '',
        );

        $apiurl = config('apipath.category-show');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $this->id = $id;

        if (!empty($responseData))

            $this->content = $responseData->data;


        if (isset($this->data)) {
            return view('Pcapi::category.show', collect($this->data));
        } else {
            return view('Pcapi::category.show')->with(['messages' => 'There are no any product']);
        }
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
            "categories_id" => $id,
            'api_token' => Helper::getCurrentuserToken(),

        );
        $apiurl = "/pcCategory/edit";
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //dd($responseData);

        return view('Pcapi::category.edit', collect($responseData));
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
        //  $file = $request->file('image'); 
        //  dd($request->all());
        $parameters = array(
            "categories_id" => $id,
            "formdata" => $request->except('image'),
            'api_token' => Helper::getCurrentuserToken(),
            // "formdata" =>$request->except('image','files','files'),

        );




        $files = [];

        if ($request->hasFile('image')) {
            $photo_file = $request->file('image');

            $photo_ary =  [
                'name' => 'image',
                'contents' => file_get_contents($photo_file),
                'filename' => $photo_file->getClientOriginalName()
            ];

            array_push($files, $photo_ary);
        }

        //  dd( $files );

        $apiurl = config('apipath.category-update');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
        //  dd($responseData);
        $message = Helper::translation($responseData->message);

        if (isset($message)) {
            return redirect()->route('papachina-product.pc-categories.index')->with('message', $message);
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
    public function sortOrder(Request $request)
    {
        $parameters = array(
            "categories_id" => $request->categories_id,
            "sort_order" => $request->sort_order,
            'api_token' => Helper::getCurrentuserToken(),
        );
        $apiurl = config('apipath.category-sortorder');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }


    public function productShow(Request $request, $id)
    {
        $this->content = [];
        $parameters = array(
            "categories_id" => $id,
            "search" => $request->search,
        );


        $apiurl = config('apipath.category-product-show');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $this->id = $id;
        if (!empty($responseData))
            $this->content = $responseData->data;

        return view('Pcapi::category.product-index', collect($this->data));
    }


    public function ProductToCatFilter(Request $request)
    { 

        $parameters = array(
            "search" => $request->search,
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
       
         
        // dd($this->data);
         $returnHTML = view('Pcapi::product.filter_product_to_cat_response', collect($this->data))->render();


         return response()->json(['success' => true, 'html'=>$returnHTML]);
    }





    public function changeProductStatus(Request $request)
    {

        $parameters = array(
            "status" => $request->status,
            "product_id" => $request->products_id,
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.category-changeProductStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }


    public function ProductTocategorySortOrder(Request $request)
    {
        $parameters = array(
            "sort_order" => $request->sort_order,
            "products_id" => $request->products_id,
            'categories_id' => $request->categories_id,
        );
        
        $apiurl = config('apipath.productTocategory-sortOrderupdate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd( $responseData);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 1, 'success' => $responseData['message']]);
        }
    }



    public function categoryFilter(Request $request)
    {   

        if (isset($_GET["page"])) 
        $page = $_GET["page"];
        else
        $page = 1;

    
        $parameters = array(
            "search" => $request->input_search,
           
            // "page" => $page,
            "perPage" => "",
        );
        
       
        $apiurl = config('apipath.category');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

       
        $returnHTML = view('Pcapi::category.filter_response', collect($this->data))->render();
     
        return response()->json(['success' => true, 'html' => $returnHTML]);
    }


    public function subcategoryFilter(Request $request)
    {   

        if (isset($_GET["page"])) 
        $page = $_GET["page"];
        else
        $page = 1;

    
        $parameters = array(
            "search" => $request->input_search,
             "page" => $page,
             "perPage" => "",
             'id'=> $request->id,

        );
        
       
        $apiurl = config('apipath.category-show');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

       
        $returnHTML = view('Pcapi::category.filter_subCat_response', collect($this->data))->render();
     
        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

}
