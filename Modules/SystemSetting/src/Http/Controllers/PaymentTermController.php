<?php

namespace Modules\SystemSetting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Services\ApiService;
use App\Helper\Helper;
use Cache;


class PaymentTermController extends BaseController
{

    public function __construct()
    {
        $this->pageTitle = 'Payment Term';
        $this->pageAccess = config('acceskey.payment-term');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->content = [];

        $start_date = '';
        $end_date = '';

        if (isset(request()->start_date))
            $start_date = request()->start_date;
        if (isset(request()->end_date))
            $end_date = request()->end_date;

        $parameters = array(

            "perPage" => "10",

        );

        $apiurl = config('apipath.paymentTerm');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

        // dd($this->data);
        return view('SystemSetting::payment-term.index', collect($this->data));
    }

    public function store(Request $request)
    {
        $parameters = array(
            'terms_name' => $request->terms_name,
            'advance_payment' => $request->advance_payment,
            'balance_payment' => $request->balance_payment,

        );


        $apiurl = config('apipath.paymentTermStore');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            return response()->json(['status' => false, 'message' => $message]);
        }
    }

    public function edit(Request $request)
    {
        $parameters = array(
            "terms_id" => $request->terms_id,
        );

        $apiurl = config('apipath.paymentTermEdit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['edit_data' => $responseData->data]);
    }


    public function update(Request $request)
    {
        $parameters = array(
            'terms_name' => $request->terms_name,
            'advance_payment' => $request->advance_payment,
            'balance_payment' => $request->balance_payment,
            'terms_id' => $request->terms_id,
            'status' => $request->status,

        );

        $apiurl = config('apipath.paymentTermUpdate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        //  dd($responseData);

        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            return response()->json(['status' => false, 'message' => $message]);
        }
    }


    public function status(Request $request)
    {
        $parameters = array(
            "terms_id" => $request->terms_id,
        );
        $apiurl = config('apipath.paymentTermChangeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            return response()->json(['status' => false, 'message' => $message]);
        }
    }
}
