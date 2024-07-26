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


class RoleController extends BaseController
{

    public function __construct()
    {
        $this->pageTitle = 'Role';
        $this->pageAccess = config('acceskey.role');
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

            "perPage" => "30",

        );

        $apiurl = config('apipath.role-list');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;

        // dd($this->data);
        return view('UserManage::role.index', collect($this->data));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $parameters = array(
            "formData" => $request->except('role_name'),
            "role_name" => $request->role_name,
        );

        $apiurl = config('apipath.role-list-store');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd( $responseData);
        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    public function edit(Request $request)
    {
        $this->content = [];

        $parameters = array(
            "updateId" => $request->updateId,
        );
        $apiurl = config('apipath.role-list-edit');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        //   dd($responseData);
        if (!empty($responseData))
            $this->content = $responseData->data;

        //  dd($this->data);

        $returnHTML = view('UserManage::role.edit', collect($this->data))->render();
        return response()->json(['success' => true, 'html' => $returnHTML]);
    }


    public function update(Request $request)
    {
        $parameters = array(
            "formData" => $request->except('role_name'),
            "role_name" => $request->role_name,
            "updatedId" => $request->updatedId,
        );

        $apiurl = config('apipath.role-list-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);

        $message = Helper::translation($responseData->message);

        if ($responseData->status == true) {
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            return response()->json(['status' => false, 'message' => $message]);
        }
    }


    public function sortOrder(Request $request)
    {
        $parameters = array(
            "roles_id" => $request->roles_id,
            "sort_order" => $request->sort_order,
        );
        $apiurl = config('apipath.role-sortOrder');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }
}
