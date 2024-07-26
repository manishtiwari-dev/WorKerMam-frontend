<?php

namespace Modules\Sales\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\BaseController;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdersController extends BaseController
{

    public function __construct()
    {
        $this->pageTitle = 'Orders';
        $this->pageAccess = config('acceskey.sales-order');
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
            "search" => "",
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            'api_token' => Helper::getCurrentuserToken(),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        );

        $apiurl = config('apipath.order-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;
  
        return view('Sales::order.index',collect($this->data));

    }

    public function details(Request $request, $id)
    {

        $parameters = array(
            "order_number" => $id,
        );

        if ($id) {
        
            $apiurl = config('apipath.order-detail');

            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            // dd($responseData->data);
            return view('Sales::order.view', collect($responseData->data));
        }
    }

    public function orderDetailspdf(Request $request, $id)
    {
        $parameters = array(

            "order_number" => $id,

        );

        if ($id) {
          
            $apiurl = config('apipath.order-details-pdf');

            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            //dd($responseData);
            $order = collect($responseData->data);

            // dd($order);
             //return view('Sales::order.order-details-pdf.pdf', compact  ('order'));
             
            $pdf = PDF::loadView('Sales::order.order-details-pdf.pdf', compact('order'));


            return $pdf->download('invoice.pdf');
         
           
            // $pdf = Pdf::loadView('Sales::order.order-details-pdf.pdf', compact('order'));

            // $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // $pdf->setMargins(0, 0, 0, 0);

            return $pdf->download();
        }
    }

    function filter(Request $request)
    {
        $parameters = array(
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "search" => $request->search,
        );
        $apiurl=config('apipath.order-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
        $this->content = $responseData->data;

        $returnHTML = view('Sales::order.filter_response', collect($this->data))->render();

        return response()->json(['success' => true, 'html'=>$returnHTML]);
    }


    public function orderStatus(Request $request,$order_number)
    {   
        $this->content = [];
        
        $parameters = array(
            "order_number" => $order_number,
        );

        if ($order_number) {
        
            $apiurl = config('apipath.order-detail');

            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
            // dd($responseData->data);
            return view('Sales::order.order_timeline', collect($responseData->data));
        }
    }

    public function updateOrdStatus(Request $request)
    {      
        $file=$request->attachments;
       
        $parameters = array(
            'order_status_id'=> $request->order_status_id,
            'ordernotes'=> $request->ordernotes,
            'order_id'=> $request->order_id,
            'shipment_carrier'=>$request->shipment_carrier,
            'shipment_no'=>$request->shipment_no,
            'attachment'=>$file,
            'api_token' => Helper::getCurrentuserToken(),
        );
      
        $apiurl=config('apipath.order-updates');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters,'attachment', $file);

        return response()->json(['status'=>'true','data'=>$responseData->data,'message' =>"Status Updated SuccessFully"]);
    }

}