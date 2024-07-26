<?php

namespace Modules\Recruit\Http\Controllers;



use App\Helper\Reply;
use App\Traits\ZoomSettings;
use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\BaseController;
use App\Helper\Helper;


class InterviewScheduleController extends BaseController
{
     

    public function __construct()
    {
        $this->pageAccess = config('acceskey.interview_schedule');
       
    }


    public function index(Request $request)
    {
         
        $this->content = []; 

      $parameters =array(

        "language" => "1",
        'api_token' => Helper::getCurrentuserToken(),      
       );

        $apiurl = config('apipath.interview-schedule-index');
    
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if(!empty($responseData))
        $this->content = $responseData->data;
       
        if ($request->ajax()) {
            $viewData = view('Recruit::interview-schedule.upcoming-schedule', $data)->render();

            return response()->json(['data' => $viewData, 'scheduleData' => $schedules]);
 
        }
                       
       return view('Recruit::interview-schedule.index', collect($this->data));
    }


    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function create(Request $request)
    {   
        $parameters =array(
           'date' => $request->date,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.interview-schedule-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
 
        
         return view('Recruit::interview-schedule.create', collect($responseData->data));
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function table(Request $request)
    {

         $parameters =array( 
        'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.interview-schedule-table');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
         return view('Recruit::interview-schedule.table', collect($responseData->data));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function data(Request $request)
    {
         
       $this->content = [];
        $parameters =array(
           'status' => $request->status,
           'applicationID' => $request->applicationID,
           'startDate' => $request->startDate,
           'endDate' => $request->endDate,
           'api_token' => Helper::getCurrentuserToken(),      
           
        ); 

        $apiurl = config('apipath.interview-schedule-data');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         if(!empty($responseData))
         $this->content = $responseData->data; 

        return DataTables::of($this->content->shedule)
            ->addColumn('action', function ($row) {   
                if ($this->content->zoomSetting->meeting_app ?? '' == 'in_app') {
                $url = $row->start_link;
                } else {
                $url = $this->user->id ?? '' == $row->created_by ? $row->start_link : $row->end_link;
                }
                $action = '';
                
                    // $action .= '<a href="javascript:;" data-row-id="' . $row->id . '" class="btn btn-info btn-circle view-data"
                    //   data-toggle="tooltip" onclick="this.blur()" data-original-title="' . __('app.view') . '"><i class="fa fa-search" aria-hidden="true"></i></a>';
              
                      
                    $action .= '<a href="javascript:;" style="margin-left:4px" data-row-id="' . $row->id . '" class="btn btn-primary btn-circle edit-data"
                      data-toggle="tooltip" onclick="this.blur()" data-original-title="' . __('app.edit') . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
               
                      
                    $action .= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" id="delete_btn" data-id="' . $row->id . '" data-original-title="' . __('app.delete') . '"><i class="fa fa-times" aria-hidden="true"></i></a>';
                
                      
                if ($row->interview_type == 'online') {
                    $action .= ' <a target="_blank" href="' . $url . '"  class="btn btn-success btn-circle fa fa-play "
                      data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="' . __('modules.zoommeeting.startMeeting') . '"><i class="fa fa-play"></i></a>';
                }
                return $action;
            })->addColumn('checkbox', function ($row) { 
                return '
                    <div class="checkbox form-check">
                        <input id="' . $row->id . '" type="checkbox" name="id[]" class="form-check-input" value="' . $row->id . '" >
                        <label for="' . $row->id . '"></label>
                    </div>
                ';
            })
            ->editColumn('full_name', function ($row) {
                return ucwords($row->full_name);
            })
            ->editColumn('schedule_date', function ($row) {
                return Carbon::parse($row->schedule_date)->format('d F, Y H:i a');
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'pending') {
                    return '<label class="badge bg-warning">' . __('app.pending') . '</label>';
                }
                if ($row->status == 'hired') {
                    return '<label class="badge bg-success">' . __('app.hired') . '</label>';
                }
                if ($row->status == 'canceled') {
                    return '<label class="badge bg-danger">' . __('app.canceled') . '</label>';
                }
                if ($row->status == 'rejected') {
                    return '<label class="badge bg-danger">' . __('app.rejected') . '</label>';
                }
            })
            ->rawColumns(['action', 'status', 'full_name', 'checkbox'])
            ->make(true);
    }

    /**
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    { 
        
        $parameters =array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      
        );

        $apiurl = config('apipath.interview-schedule-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
         return view('Recruit::interview-schedule.edit', collect($responseData->data));
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    public function store(Request $request)
    { 
        
        $parameters =array(
            'scheduleDate' => $request->scheduleDate,
            'scheduleTime' => $request->scheduleTime,
            'interview_type' => $request->interview_type,
            'meeting_title' => $request->meeting_title,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'created_by' => $request->created_by,
            'candidates' => $request->candidates, 
            'comment' => $request->comment,
            'employees' => $request->employees,
            'all' => $request->all(),
            'api_token' => Helper::getCurrentuserToken(),      
        ); 
 

        

        $apiurl = config('apipath.interview-schedule-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       

        $message = Helper::translation($responseData->message);
       
        if($responseData->status == true){
             return response()->json(['success' => $message]);
            
        }
        else{
             return response()->json(['error' => $responseData->message]);
        }  
            
       
    }
    
    public function changeStatus(Request $request)
    {
        
       $parameters = array(
        "id" => $request->id,
        "status" => $request->status,
        "mailToCandidate"=> $request->mailToCandidate,
        'api_token' => Helper::getCurrentuserToken(),

       );

       $apiurl = config('apipath.interview-changeStatus');
       $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

       return response()->json(['success' => $responseData->message]);
 
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        
        $parameters =array(
            'id' => $id,
            'scheduleDate' => $request->scheduleDate,
            'scheduleTime' => $request->scheduleTime,
            'interview_type' => $request->interview_type,
            'meeting_title' => $request->meeting_title,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'created_by' => $request->created_by,
            'candidates' => $request->candidates, 
            'comment' => $request->comment,
            'employees' => $request->employees,
        'api_token' => Helper::getCurrentuserToken(),      
        );  
        
        $apiurl = config('apipath.interview-schedule-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        

         $message = Helper::translation($responseData->message);
       
        if($responseData->status == true){
             return response()->json(['success' => $message]);
            
        }
        else{
             return response()->json(['error' => $responseData->message]);
        }  
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        

         $parameters = array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      

        );
        
        $apiurl = config('apipath.interview-schedule-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
         $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);

    }

    /**
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function show(Request $request, $id)
    { 
        
         $parameters = array(
            "id" => $id,
            'api_token' => Helper::getCurrentuserToken(),      

        ); 
        
        $apiurl = config('apipath.interview-schedule-show'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
           
        return view('Recruit::interview-schedule.show', ["schedule" => $responseData->data->schedule])->render();
    }

    // notify and reminder to candidate on interview schedule
    public function notify($id, $type)
    {

        $parameters = [
            'id' => $id,
            'type' => $type,
            'api_token' => Helper::getCurrentuserToken(),
        ];

        $apiurl = config('apipath.interview-notify');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         
        $message = Helper::translation($responseData->message);

        return response()->json(['success' => $message]);
         
    }

    // Employee response on interview schedule
    public function employeeResponse($id, $res)
    {

        $scheduleEmployee = InterviewScheduleEmployee::find($id);
        $users = User::allAdmins(); // Get All admins for mail
        $type = 'refused';

        if ($res == 'accept') {
            $type = 'accepted';
        }

        $scheduleEmployee->user_accept_status = $res;

        // mail to admin for employee response on refuse or accept
        Notification::send($users, new EmployeeResponse($scheduleEmployee->schedule, $type, $this->user));

        $scheduleEmployee->save();

        return Reply::success(__('messages.responseAppliedSuccess'));
    }

    public function changeStatusMultiple(Request $request)
    { 
        $parameters = array(
            "id" => $request->id,
            "status" => $request->status,
            "mailToCandidate"=> $request->mailToCandidate,
            'api_token' => Helper::getCurrentuserToken(),      

        ); 
        
        $apiurl = config('apipath.interview-changeStatusMultiple');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);
 
        return response()->json(['success' => $message]);
    }

}