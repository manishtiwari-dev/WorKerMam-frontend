<?php

namespace Modules\UserManage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Services\ApiService;
use App\Helper\Helper;
use Cache;


class UserController extends BaseController
{

    public function __construct()
    {
        $this->pageTitle = 'User Manage';
        $this->pageAccess = config('acceskey.user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->content = [];

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        $parameters = array(
            "page" => $page,
            "perPage" => "",

        );

        $apiurl = config('apipath.user-list');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

        // dd($this->data);
        return view('UserManage::user-manage.index', collect($this->data));
    }

    public function store(Request $request)
    {
        $parameters = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_name' => $request->role_name,
            'userType' => $request->userType,

        );



        $apiurl = config('apipath.user-list-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
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
            "user_id" => $request->user_id,
        );

        $apiurl = config('apipath.user-list-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        return response()->json(['edit_data' => $responseData->data]);
    }


    public function update(Request $request)
    {
        $parameters = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'role_name' => $request->role_name,

        );


        $apiurl = config('apipath.user-list-Updateuser');
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
            "user_id" => $request->id,
        );
        $apiurl = config('apipath.user-list-changeStatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            return response()->json(['status' => false, 'message' => $message]);
        }
    }
}
