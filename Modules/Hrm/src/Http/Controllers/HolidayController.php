<?php

namespace Modules\Hrm\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Hrm\Models\Designation;
use App\Helper\Helper;

class HolidayController extends BaseController
{
    public function __construct()
    {

        $this->pageTitle = 'Holiday';
        $this->pageAccess = config('acceskey.hrm-holiday');
    }

    public function index()
    {
        $this->content = [];
        $parameters = array(
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.holiday');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if (!empty($responseData))
            $this->content = $responseData->data;
        //   dd($this->data);
        return view('Hrm::holiday.index', collect($this->data));
    }


    public function create()
    {
        $parameters = array();

        $apiurl = config('apipath.holiday-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);


        return view('Hrm::holiday.create', collect($responseData->data));
    }

    public function show()
    {
    }

    public function store(Request $request)
    {
        $parameters = array(
            "holiday_date" => $request->holiday_date,
            'occasion' => $request->occasion,
            'api_token' => Helper::getCurrentuserToken(),

        );


        $apiurl = config('apipath.holiday-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        if ($message) {
            return redirect()->route('hrm.holiday.index')->with('success', $message);
        } else {
            return redirect()->route('hrm.holiday,index')->with('error', $message);
        }
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {

        $parameters = [
            "id" => $id,
        ];


        $apiurl = config('apipath.holiday-destroy');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json($message);
    }

    public function markDayHoliday(Request $request)
    {

        $parameters = array(
            "office_holiday_days" => $request->office_holiday_days,
            'office_saturday_days' => $request->office_saturday_days,
            'api_token' => Helper::getCurrentuserToken(),

        );



        $apiurl = config('apipath.holiday-markDayHoliday');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);
    }
}
