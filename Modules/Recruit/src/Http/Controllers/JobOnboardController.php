<?php

namespace Modules\Recruit\Http\Controllers;


use App\Helper\Files;
use App\Helper\Reply;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;
use ApiHelper;
use App\Http\Controllers\BaseController;
use App\Helper\Helper;
use Carbon\Carbon;


class JobOnboardController extends BaseController
{
    public function __construct()
    {
        $this->pageAccess = config('acceskey.job_onboard');
       
    }


    public function index(Request $request)
    {
        $this->content = []; 
        $parameters =array(
        'api_token' => Helper::getCurrentuserToken(),      
          );

        $apiurl = config('apipath.recruit-job-onboard');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        if(!empty($responseData))
        $this->content = $responseData->data;               


       return view('Recruit::job-onboard.index', collect( $this->data));


    }

    public function create(Request $request)
    {
        
        

        $parameters =array(
        'api_token' => Helper::getCurrentuserToken(),
        'id' => $request->id,
        );

        $apiurl = config('apipath.recruite-job-onboard-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 

        return view('Recruit::job-onboard.create', collect( $responseData->data));

    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    public function store(Request $request)
    {

 

        $parameters =array(
            'candidate_id' => $request->candidate_id,
            'department' => $request->department,
            'designation' => $request->designation,
            'currency_id' => $request->currency_id,
            'salary' => $request->salary,
            'join_date' => $request->join_date,
            'report_to' => $request->report_to,
            'employee_status' => $request->employee_status,
            'last_date' => $request->last_date,
            'question' => json_encode($request->question),
            'name' => json_encode($request->name), 
            'send_email' => $request->send_email,
            'api_token' => Helper::getCurrentuserToken(),
        );    
         $files =[];


         if( $request->hasFile('file')){
            $photo_files = $request->file('file');
            
            foreach($photo_files as $key=>$photo){
                if(file_get_contents($photo)){
                    $photo_ary = [
                        'name' => 'photo-'.$key,
                        'contents' => file_get_contents($photo),
                        'filename' => $photo->getClientOriginalName()
                    ];
                    array_push($files, $photo_ary);
                }
            }
         }
         
 

         $apiurl = config('apipath.recruite-job-onboard-store');

         $responseData = Helper::ApiServiceResponse($apiurl, $parameters ,$files);
          
 
         $message = Helper::translation($responseData->message);
         if($responseData->status == true){
         return redirect()->route('recruit.job-onboard.index')->with(['success' => $message]);

         }
         else{
         return redirect()->route('recruit.job-onboard.index')->with('error',$message);
         }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $parameters =array(
        'id' => $id,
        'api_token' => Helper::getCurrentuserToken(),
        );


        $apiurl = config('apipath.recruite-job-onboard-edit');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters );
        // dd($responseData);

        return view('Recruit::job-onboard.edit', collect($responseData->data));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function data(Request $request)
    { 
        $parameters =array(
           
            
         ); 
 
         $apiurl = config('apipath.recruite-job-onboard-data');
 
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 


        return DataTables::of($responseData->data->jobApplications)
            ->addColumn('action', function ($row) {
                $action = '<div class="btn-group m-r-10 dropdown">
                <button aria-expanded="false" data-bs-toggle="dropdown" class="btn btn-sm btn-info dropdown-toggle" id="dropdownMenuButton" type="button">' . __('app.action') . ' <span class="caret"></span></button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

                $action .= '<a href="' . route('recruit.job-onboard.show', [$row->id]) . '" class="dropdown-item"><i class="fa fa-search" aria-hidden="true"></i>  ' . __('app.view') . '  ' . __('app.offer') . '</a>';
                $action .= '<a href="' . route('recruit.job-onboard.edit', [$row->id]) . '" class="dropdown-item"><i class="fa fa-pencil" aria-hidden="true"></i> ' . __('app.edit') . '</a>';
                $action .= '<a href="javascript:;" data-row-id="' . $row->application_id . '" class="dropdown-item send-offer "><i class="fa fa-mail-forward" aria-hidden="true"></i> ' . __('app.send') . ' ' . __('app.offer') . '</a>';
                if ($row->hired_status != 'canceled') {
                    $action .= '<a href="javascript:;" data-row-id="' . $row->id . '" class="dropdown-item sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . __('app.cancel') . '</a>';
                }
                $action .= '</div> </div>';

                return $action;
            })
            ->editColumn('full_name', function ($row) {
                return '<a href="javascript:;" class="show-detail" data-widget="control-sidebar" data-slide="true" data-row-id="' .  $row->application_id . '">' . ucwords($row->full_name) . '</a>';
            })
            ->editColumn('title', function ($row) {
                return ucfirst($row->title);
            })
            ->editColumn('location', function ($row) {
                return ucwords($row->location);
            })
            ->editColumn('joining_date', function ($row) {
                return (!is_null($row->joining_date)) ? Carbon::parse($row->joining_date)->format('d M Y') : '-';
            }) 
            ->editColumn('accept_last_date', function ($row) {
                return (!is_null($row->accept_last_date)) ? Carbon::parse($row->accept_last_date)->format('d M
                Y') : '-';
            })
            ->editColumn('hired_status', function ($row) {

                if ($row->hired_status == 'accepted') {
                    return '<label class="badge bg-success">' . __('app.accepted') . '</label>';
                } else if ($row->hired_status == 'offered') {
                    return '<label class="badge bg-warning">' . __('app.offered') . '</label>';
                } else if ($row->hired_status == 'canceled') {
                    return '<label class="badge bg-danger">' . __('app.canceled') . '</label>';
                } else {
                    return '<label class="badge bg-danger">' . __('app.rejected') . '</label>';
                }
            })
            ->rawColumns(['action', 'full_name', 'hired_status'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * @param StoreRequest $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {

         $file = $request->file('file');

         $parameters =array(
            'id' => $id,
         'candidate_id' => $request->candidate_id,
         'department' => $request->department,
         'designation' => $request->designation,
         'currency_id' => $request->currency_id,
         'salary' => $request->salary,
         'join_date' => $request->join_date,
         'report_to' => $request->report_to,
         'employee_status' => $request->employee_status,
         'last_date' => $request->last_date,
         'question' => json_encode($request->question),
         'name' => json_encode($request->name), 
         'send_email' => $request->send_email,
         'status' => $request->status,
         'api_token' => Helper::getCurrentuserToken(),

         );
 

         $files =[];


         if( $request->hasFile('file')){
            $photo_files = $request->file('file');
            
            foreach($photo_files as $key=>$photo){
                if(file_get_contents($photo)){
                    $photo_ary = [
                        'name' => 'photo-'.$key,
                        'contents' => file_get_contents($photo),
                        'filename' => $photo->getClientOriginalName()
                    ];
                    array_push($files, $photo_ary);
                }
            }
         }
 
         $apiurl = config('apipath.recruite-job-onboard-update');

         $responseData = Helper::ApiServiceResponse($apiurl, $parameters ,$files);
         
         $message = Helper::translation($responseData->message);
         if($responseData->status == true){
         return redirect()->route('recruit.job-onboard.index')->with(['success' => $message]);

         }
         else{
         return redirect()->route('recruit.job-onboard.index')->with('error',$message);
         }
  
    
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $parameters =array( 
            'id' => $id,
        );

        $apiurl = config('apipath.recruite-job-onboard-destroy');
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {


        $parameters =array(
            'id' => $id, 
            'api_token' => Helper::getCurrentuserToken(),
        );

        // dd($parameters);
        $apiurl = config('apipath.recruite-job-onboard-show');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters );

        // dd($responseData);

        if($responseData->status == true){ 
            return view('Recruit::job-onboard.show', collect($responseData->data));
        }
        else{
        return view('Recruit::job-onboard.show', collect($responseData->data));
        }
         
    }

    /**
     * @param $userID
     */
    public function sendOffer($id)
    { 
        $parameters =array( 
            'userID' => $id,
        );

        $apiurl = config('apipath.recruite-job-onboard-send-offer');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message , 'data' => $responseData->data]);
    }

    /**
     * @param $id
     * @return array
     */
    public function updateStatus(Request $request, $id)
    {
        $parameters =array(
        'id' => $id,
        'cancel_reason' => $request->cancel_reason,
        );

        $apiurl = config('apipath.recruite-job-onboard-update-status');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message , 'data' => $responseData->data]);

    }
}