<?php

namespace Modules\Recruit\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class JobApplicationController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.job_applications');
        $this->pageTitle = 'Job Application';
 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->content = [];
        
        $parameters =array(
            "language" => "1",
            "startDate" => $request->startDate,
            "endDate" => $request->endDate,
            "jobs" => $request->jobs,
            "search"=>$request->search,
            "location" => $request->location,
            "questions"=>$request->questions,
            "question_value" => $request->question_value,
            "skill" => $request->skill,
            "type" => $request->type,
            'api_token' => Helper::getCurrentuserToken(),       
           );
  


           
    
            $apiurl = config('apipath.job-application-index');
            
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
          
  
            if(!empty($responseData))
            $this->content = $responseData->data;


                
            if ($request->ajax()) { 
                $view = view('Recruit::job-applications.board-data', collect($this->data) )->render();
                return response()->json(['view' => $view]);
            }  
                  
            return view('Recruit::job-applications.board', collect($this->data));
            
                
 
    }

    

    public function create(Request $request)
    { 
        $this->content = [];
         $parameters =array(
        'api_token' => Helper::getCurrentuserToken(),      

        ); 

        $apiurl = config('apipath.job-application-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
 
      if(!empty($responseData))
      $this->content = $responseData->data;

         return view('Recruit::job-applications.create', $this->data); 
    }
    

    /**
     * @param $jobID
     * @return mixed
     * @throws \Throwable
     */
    public function jobQuestion($jobID, $applicationId = null)
    {   
         
         $this->content = [];

        $parameters =array(
            'jobID' => $jobID,
            'applicationId' => $applicationId,
            'api_token' => Helper::getCurrentuserToken(),
        );

 
 

        $apiurl = config('apipath.job-application-jobQuestion');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if(!empty($responseData))
        $this->content = $responseData->data;

         $this->gender = [
         'male' => __('modules.front.male'),
         'female' => __('modules.front.female'),
         'others' => __('modules.front.others')
         ];

        $this->jobQuestion = $responseData->data->jobQuestion;
        $this->job = $responseData->data->job;
        $application = $responseData->data->application;
        

    

         $view = view('Recruit::job-applications.job-question',['jobQuestion'=>$this->jobQuestion ,'job'=>$this->job ,'application'=>$application])->render();

         $options = ['job' => $this->job, 'gender' => $this->gender];

         $sections = ['section_visibility' => $this->job->section_visibility];

         if ($application) {
  
         $options = Arr::add($options, 'application', $application);
         $sections = Arr::add($sections, 'application', $application);

         }

         $requiredColumnsView = view('Recruit::job-applications.required-columns', $options)->render();
         $requiredSectionsView = view('Recruit::job-applications.required-sections', $sections)->render();

         $this->count = count($this->jobQuestion);

         $this->data = ['status' => 'success', 'view' => $view, 'requiredColumnsView' => $requiredColumnsView,
         'requiredSectionsView' => $requiredSectionsView, 'count' => $this->count];

         if ($applicationId) {
         $this->data = Arr::add($this->data, 'application', $application);
         }
         
         $message = Helper::translation($responseData->message);
 
         return response()->json(['data' => $this->data]);
    }


    public function edit($id)
    {
        $this->content = [];
         $parameters =array(
            "id" => $id,
            'api_token' => Helper::getCurrentuserToken(),      
        );

        $apiurl = config('apipath.job-application-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 

        if(!empty($responseData))
        $this->content = $responseData->data;
        
         return view('Recruit::job-applications.edit', $this->data); 
    }

    public function data(Request $request)
    {
        
       
        $parameters =array(
          'status' => $request->status,
           'jobs' => $request->jobs,
           'skill' => $request->skill,
           'location' => $request->location,
           'questions' => $request->questions,
           'question_value' => $request->question_value,
           'startDate' => $request->startDate,
           'endDate' => $request->endDate,
            'api_token' => Helper::getCurrentuserToken(),      
           
        ); 

        $apiurl = config('apipath.job-application-data');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        

        return DataTables::of($responseData->data->jobApplications)            
            ->addColumn('action', function ($row) {
                    $action = '';
                    
                     $action .= '<a href="javascript:;" class="btn btn-success btn-circle show-document"
                       data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-modal-name="' . '\\' . get_class($row) . '" data-original-title="' . __('modules.jobApplication.viewDocuments') . '"><i class="fa fa-search" aria-hidden="true"></i></a>';
            
                    $action .= ' <a href="' . route('recruit.job-applications.edit', [$row->id]) . '" class="btn btn-primary btn-circle"
                      data-toggle="tooltip" onclick="this.blur()" data-original-title="' . __('app.edit') . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                
                    $action .= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="' . __('app.delete') . '"><i class="fa fa-times" aria-hidden="true"></i></a>';
              
                return $action;
            })
            
            ->editColumn('date', function ($row) {
                
                 return Carbon::parse($row->created_at)->format('d-M-Y');
            })
            ->editColumn('full_name', function ($row) {
                return  '<h6 class="tx-semibold mg-b-0">' . ucwords($row->full_name) . '</h6> <span
                     class="tx-color-03">' . $row->email . '</span><br />';
            }) 
            ->editColumn('title', function ($row) {
                return ucfirst($row->job->title ?? '');
            })
            ->editColumn('location', function ($row) {
                return ucwords($row->job->location->location ?? '');
            })
            ->editColumn('status', function ($row) {
                 return '<span class="badge badge-pill badge-primary text-white"
                     style="margin-bottom: -3px; height: 15px; background:' . $row->status->color . '"> </span> <span>' .
                     ucwords($row->status->status) .'</span>';
                 
            })
            ->rawColumns(['full_name','status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }


    public function createSchedule(Request $request, $id)
    {
        $parameters = [
            'date' => $request->date,
            'id' => $id,
        ];
 
        $apiurl = config('apipath.job-application-createSchedule');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
       
 
        return view('Recruit::job-applications.interview-create', collect($responseData->data))->render();

    }

    public function storeSchedule(Request $request)
    {

         $parameters =array(
         'scheduleDate' => $request->scheduleDate,
         'scheduleTime' => $request->scheduleTime,
         'interview_type' => $request->interview_type,
         'meeting_title' => $request->meeting_title,
         'end_date' => $request->end_date,
         'end_time' => $request->end_time, 
         'candidates' => $request->candidates,
         'comment' => $request->comment,
         'employees' => $request->employees,
         'all' => $request->all(),
         'api_token' => Helper::getCurrentuserToken(),
         );
         
        $apiurl = config('apipath.schedule-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
            return response()->json(['success' => $message]);
        }
        else{
            return response()->json(['error' => $message]);
        }
    }

   

    public function store(Request $request)
    {   
       
        $parameters = [
            'full_name'=>$request->full_name,
            'job_id'=>$request->job_id,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'cover_letter'=>$request->cover_letter,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'country'=>$request->country,
            'state'=>$request->state,
            'city'=>$request->city,
            'zip_code'=>$request->zip_code, 
            'answer'=> json_encode($request->answer),
        ];

        
        
        $files =[];
        if( $request->hasFile('image_file')){
            $photo_file = $request->file('image_file');

            $photo_ary =  [
                'name' => 'image_file',
                'contents' => file_get_contents($photo_file),
                'filename' => $photo_file->getClientOriginalName()
            ];
    
            array_push($files, $photo_ary);
        } 
        
        if( $request->hasFile('resume')){
            $resume_file = $request->file('resume');
            $resume_ary = [
                'name' => 'resume',
                'contents' => file_get_contents($resume_file),
                'filename' => $resume_file->getClientOriginalName()
            ];
            array_push($files, $resume_ary);
         } 
        $apiurl = config('apipath.job-application-store');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
 
      
        $message = Helper::translation($responseData->message);
        if($responseData->status == true){
            return redirect()->route('recruit.job-applications.index')->with(['success' => $message]);
            
        }
        else{
            return redirect()->route('recruit.job-applications.index')->with('error',$message);
        }  
    }

    public function update(Request $request, $id)
    {
          
        $parameters = [
            'id' => $id,
            'full_name'=>$request->full_name,
            'job_id'=>$request->job_id,
            'status_id'=>$request->status_id,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'cover_letter'=>$request->cover_letter,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'country'=>$request->country,
            'state'=>$request->state,
            'city'=>$request->city,
            'zip_code'=>$request->zip_code,
            'answer'=> json_encode($request->answer),
            'api_token' => Helper::getCurrentuserToken(),   
        ];
        
        $files =[];

        if( $request->hasFile('image_file')){
            $photo_file = $request->file('image_file');

            $photo_ary = [
            'name' => 'image_file',
            'contents' => file_get_contents($photo_file),
            'filename' => $photo_file->getClientOriginalName()
            ];

            array_push($files, $photo_ary);
            
        } 
        if( $request->hasFile('resume')){
            $resume_file = $request->file('resume');
            $resume_ary = [
            'name' => 'resume',
            'contents' => file_get_contents($resume_file),
            'filename' => $resume_file->getClientOriginalName()
            ];
            array_push($files, $resume_ary);

        }
        

        $apiurl = config('apipath.job-application-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters , $files);

        $message = Helper::translation($responseData->message);

        if($responseData->status == true){
            return redirect()->route('recruit.job-applications.table')->with(['success' => $message]);
        }
        else{
            return redirect()->route('recruit.job-applications.table')->with('error',$message);
        }  
       
    
    }

    public function destroy($id)
    { 


         $parameters = array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      

        );
        
        $apiurl = config('apipath.job-application-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);

    }

    public function show($id)
    {
        

        $parameters = array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      

        );
        
        $apiurl = config('apipath.job-application-show'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 

         $view = view('Recruit::job-applications.show', collect($responseData->data))->render(); 

        return response()->json(['status' => 'success', 'view' => $view]);


    }

    public function updateIndex(Request $request)
    {

        $parameters = array(
            
                "applicationIds"=>$request->applicationIds,
                "boardColumnIds" => $request->boardColumnIds,
                "prioritys" => $request->prioritys,
                "startDate"=>$request->startDate,
                "endDate"=>$request->endDate,
                "draggedTaskId"=>$request->draggedTaskId,
                "jobs"=>$request->jobs,
                "search"=>$request->search,
        'api_token' => Helper::getCurrentuserToken(),      
            );

        $apiurl = config('apipath.job-application-updateIndex'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      

        return response()->json(['success' => $responseData->data]);
    }

    public function table()
    {
        
        $parameters =array(

            "language" => "1",
        'api_token' => Helper::getCurrentuserToken(),      
        );
    
        $apiurl = config('apipath.job-application-table');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
   
                        
        return view('Recruit::job-applications.index', collect($responseData->data));

    }

    public function ratingSave(Request $request, $id)
    {  
        $parameters =array(
        'id' => $id,
        'rating' => $request->rating, 
        );


        $apiurl = config('apipath.job-application-ratingSave');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => $message]);


    }

    // Job Applications data Export
    public function export($status, $location, $startDate, $endDate, $jobs)
    {
        

        $parameters =array(
            'status' => $status,
            'location' => $location,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'jobs' => $jobs,
        'api_token' => Helper::getCurrentuserToken(),      
        ); 


        
 
        $apiurl = config('apipath.job-application-export');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 

        $message = Helper::translation($responseData->message);
        if($responseData->status == true){
            return response()->download($responseData->data);
        }else{
           return Redirect::back()->with('error', $message);
        }
    }

    public function getName($arr, $id)
    {
        $result = array_filter($arr, function ($value) use ($id) {
            return $value['id'] == $id;
        });
        return current($result)['name'];
    }

    public function archiveJobApplication(Request $request, $id)
    {
        $parameters =array(
            'id' => $id,    
            'api_token' => Helper::getCurrentuserToken(),       
         );         

        
         $apiurl = config('apipath.job-application-archive-job-application');
 
         $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        
        return response()->json(['status' => 'success']);

    }

    public function unarchiveJobApplication(Request $request, $application_id)
    {

        $parameters =array(
            'application_id' => $application_id,
            'api_token' => Helper::getCurrentuserToken(),
        );
 

        $apiurl = config('apipath.job-application-unarchiveJob');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => $message]);
    }

    public function addSkills(Request $request, $applicationId)
    { 

        $parameters =array(
        'applicationId' => $applicationId,
        'skills' => $request->skills,
        'api_token' => Helper::getCurrentuserToken(),
        );


        $apiurl = config('apipath.job-application-addskill');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         $message = Helper::translation($responseData->message);
        return response()->json(['status' => $message]);
 
 
    }

    public function loadMore(Request $request)
    {

        $parameters =array(
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
        'totalRecord' => $request->totalRecord,
        'columnId' => $request->columnId,
        'currentTotalRecords' => $request->currentTotalRecords,
        'jobs' => $request->jobs,
        'search' => $request->search,
        'location' => $request->location,
        'question_value' =>$request->question_value,
        'questions' => $request->questions,
        'skill' => $request->skill,
        'api_token' => Helper::getCurrentuserToken(),
        ); 
      
        $apiurl = config('apipath.job-application-load_more');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        $currentDate = $responseData->data->currentDate;
        $applications = $responseData->data->applications;
        $loadStatus = $responseData->data->loadStatus;

        $view = view('Recruit::job-applications.load_more', ['applications' => $applications ,
        'currentDate' => $currentDate])->render();

        $count = count($applications);
 

        return response()->json(['view' => $view , 'load_more' => $loadStatus , 'count' => $count]);
    }

    public function import(Request $request){

        $parameters =array(
            
        );

        $apiurl = config('apipath.job-application-import');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        

        return view('Recruit::import-job-application.index' , ['jobs' =>  $responseData->data]);
    }

    public function importStore(Request $request){

        $parameters =array(
            'job_id' => $request->jobs,
        );

        $files = [];
        if( $request->hasFile('import_file')){
            $import_files = $request->file('import_file');
            $import_ary = [
            'name' => 'import_file',
            'contents' => file_get_contents($import_files),
            'filename' => $import_files->getClientOriginalName()
        ];
            array_push($files, $import_ary);
        }
 
        $apiurl = config('apipath.job-application-import-store');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
 

        $message = Helper::translation($responseData->message);

        return redirect()->route('recruit.job-applications.index')->with('success',
        $message);       


    }
}