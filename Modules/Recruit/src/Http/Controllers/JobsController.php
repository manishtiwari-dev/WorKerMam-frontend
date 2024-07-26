<?php

namespace Modules\Recruit\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\BaseController;
use Arr;

class JobsController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.jobs');
        $this->pageTitle = 'Jobs';
 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->content = [];        

        $parameters =array(

        "language" => "1",
        'api_token' => Helper::getCurrentuserToken(),      
       );

        $apiurl = config('apipath.recruit-index');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
  

        if(!empty($responseData))
        $this->content = $responseData->data;
 
        
       return view('Recruit::jobs.index', collect($this->data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->content = [];

        $parameters =array(
            'duplicate_job' => request()['duplicate_job'],
            'api_token' => Helper::getCurrentuserToken(),      
        ); 

        $apiurl = config('apipath.recruit-create');
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if(!empty($responseData))
        $this->content = $responseData->data;
        $this->title = "Add Job";
        

        return view('Recruit::jobs.create', collect($this->data)); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $required_columns = [
        'gender' => false,
        'dob' => false,
        'country' => false,
        'address' => false
        ];

        foreach ($required_columns as $key => $value) {
        if ($request->has($key)) {
        $required_columns[$key] = true;
        }
        }

        $section_visibility = [ 
        'profile_image' => 'no',
        'resume' => 'no',
        'cover_letter' => 'no',
        'terms_and_conditions' => 'no', 
        ];

        foreach ($section_visibility as $key => $value) {
        if ($request->has($key)) {
        $section_visibility[$key] = 'yes';
        }
        }

          $details_visibility = [
          'show_salary' => 'no',
          'show_work_experience' => 'no',
          'show_job_type' => 'no',
          'show_job_location' => 'no',
          'show_job_category' => 'no',
          'show_job_skills' => 'no',
          'show_closing_date' => 'no',
          ];

         foreach ($details_visibility as $key => $value) {
         if ($request->has($key)) {
         $details_visibility[$key] = 'yes';
         }
         }
 
        $parameters =array( 
                'slug' => 'null',
                'company_id' => $request->company,
                'title' => $request->title,
                'job_description' => $request->job_description,
                'job_requirement' => $request->job_requirement,
                'total_positions' => $request->total_positions,
                'location_id' => $request->location_id,
                'category_id' => $request->category_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'job_type_id' => $request->job_type_id,
                'work_experience_id' => $request->work_experience_id,
                'pay_type' => $request->pay_type,
                'pay_according' => $request->pay_according,
                'sort_order' => $request->sort_order,
                'starting_salary' => $request->starting_salary,
                'maximum_salary' => $request->maximum_salary,
                'required_columns' => $request->required_columns,
                'section_visibility' => $request->section_visibility,
                'show_job_type'=>$request->show_job_type,
                'show_work_experience'=>$request->show_work_experience,
                'show_salary'=>$request->show_salary,
                'skill_id'=>$request->skill_id,
                'question'=>$request->question,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'required_columns'=>$required_columns,
                'section_visibility'=>$section_visibility,
                'details_visibility'=> $details_visibility,
                'api_token' => Helper::getCurrentuserToken(),      
            );  

            
            
                // dd($parameters);

                $apiurl = config('apipath.recruit-store');
                $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
                $message = Helper::translation($responseData->message);
 
                if($responseData->status == true){
                    return redirect()->route('recruit.jobs.index')->with(['success' => $message]);
                    
                }
                else{
                    return redirect()->route('recruit.jobs.index')->with('error',$message);
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
         $parameters =array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      
        );
 

        $apiurl = config('apipath.recruit-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
         return view('Recruit::jobs.edit', collect($responseData->data));


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

        $required_columns = [
        'gender' => false,
        'dob' => false,
        'country' => false,
        'address' => false
        ];

        foreach ($required_columns as $key => $value) {
        if ($request->has($key)) {
            $required_columns[$key] = true;
        }
        }

        $section_visibility = [ 
            'profile_image' => 'no',
            'resume' => 'no',
            'cover_letter' => 'no',
            'terms_and_conditions' => 'no', 
        ];

        foreach ($section_visibility as $key => $value) {
            if ($request->has($key)) {
            $section_visibility[$key] = 'yes';
            }
        }
 
         $details_visibility = [
             'show_salary' => 'no',
             'show_work_experience' => 'no',
             'show_job_type' => 'no',
             'show_job_location' => 'no',
             'show_job_category' => 'no',
             'show_job_skills' => 'no',
             'show_closing_date' => 'no',
         ];

         foreach ($details_visibility as $key => $value) {
            if ($request->has($key)) {
                $details_visibility[$key] = 'yes';
            }
         }

        
        $parameters =array( 
                'id' => $id,
                'slug' => 'null',
                'company_id' => $request->company,
                'title' => $request->title,
                'job_description' => $request->job_description,
                'job_requirement' => $request->job_requirement,
                'total_positions' => $request->total_positions,
                'location_id' => $request->location_id,
                'category_id' => $request->category_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'job_type_id' => $request->job_type_id,
                'work_experience_id' => $request->work_experience_id,
                'pay_type' => $request->pay_type,
                'pay_according' => $request->pay_according,
                'sort_order' => $request->sort_order,
                'starting_salary' => $request->starting_salary,
                'maximum_salary' => $request->maximum_salary,
                'required_columns' => $request->required_columns,
                'section_visibility' => $request->section_visibility,
                'show_job_type'=>$request->show_job_type,
                'show_work_experience'=>$request->show_work_experience,
                'show_salary'=>$request->show_salary,
                'skill_id'=>$request->skill_id,
                'question'=>$request->question,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'section_visibility' => $section_visibility,
                'details_visibility' => $details_visibility,
                'required_columns' => $required_columns,
                'api_token' => Helper::getCurrentuserToken(), 
                'slug' => $request->slug,    
                'jobs' => $request->all(),
            );
 

                $apiurl = config('apipath.recruit-update');
                $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
                $message = Helper::translation($responseData->message);
                if($responseData->status == true){
                    return redirect()->route('recruit.jobs.index')->with(['success' => $message]);
                    
                }
                else{
                    return redirect()->route('recruit.jobs.index')->with('error',$message);
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
        
        $parameters = array(
            "id" => $id,
        'api_token' => Helper::getCurrentuserToken(),      

        );
        
        $apiurl = config('apipath.recruit-destroy'); 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        // dd($responseData);
        $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);

    }

    public function data(Request $request)
    { 
        $parameters =array(
           'filter_company' => $request->filter_company,
           'filter_status' => $request->filter_status,
           'filter_location' => $request->filter_location,
            'api_token' => Helper::getCurrentuserToken(),      
           
        ); 

        $apiurl = config('apipath.recruit-data');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        // dd($responseData);

        return DataTables::of($responseData->data->categories)
            ->addColumn('action', function ($row) {
                $action = '';

                 $action .= '<a href="' . route('recruit.jobs.edit', [$row->id]) . '" class="btn btn-primary btn-circle"
                      data-toggle="tooltip" onclick="this.blur()" data-original-title="' . __('app.edit') . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
               
                    $action .= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="' . __('app.delete') . '"><i class="fa fa-times" aria-hidden="true"></i></a>';
               

                 $action .= ' <a href="' . route('recruit.jobs.create') . '?duplicate_job=' . $row->id . '" class="btn btn-circle duplicate_job" style="background: #e1b32c; color: white;"
                data-toggle="tooltip" onclick="this.blur()" data-original-title="' . __('app.duplicate') . '"><i class="fa fa-clone" aria-hidden="true"></i></a>';
                return $action;
            })
            ->editColumn('title', function ($row) {
                return ucfirst($row->title);
            })
            ->editColumn('location_id', function ($row) {
                return ucfirst($row->location->location ?? '');
            })
            ->editColumn('start_date', function ($row) {
                return \Carbon\Carbon::parse($row->start_date)->format('Y-m-d');
            })
            ->editColumn('end_date', function ($row) {
                return \Carbon\Carbon::parse($row->end_date)->format('Y-m-d');
            })
            ->editColumn('applicants', function ($row) {
                
            return count($row->application_job);
            })
            ->editColumn('sort_order', function ($row) {
                return '<input type="number" name="sort_order" style="width:50px;" value="'.$row->sort_order.'"
                    data-id="'. $row->id .'"
                    class="sort_orders" />';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'active') {
                    return '<span class="badge badge-primary">' . __('app.active') . '</span>';
                }
                if ($row->status == 'inactive') {
                    return '<span class="badge badge-danger">' . __('app.inactive') . '</span>';
                }
                if ($row->status == 'expired') {
                    return '<label class="badge" style="background: #FF8C00;">' . __('app.expired') . '</label>';
                }
            })
            ->rawColumns(['sort_order' , 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function sendEmail(Request $request)
    { 
      
        $parameters =array(
 
        );

        $apiurl = config('apipath.recruit-send-email');
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
    
            
       return view('Recruit::jobs.send-email', collect($responseData->data)); 
    }

    public function applicationData(Request $request)
    {   
        $filterData = $this->filterJobApplications($request);
        
        return DataTables::of($filterData)
        ->editColumn('full_name', function ($row) { 
        return '<a href="javascript:;" class="show-detail" data-widget="control-sidebar" data-slide="true"
            data-row-id="' . $row->id . '">' . ucwords($row->full_name) . '</a>';
        })
        ->editColumn('title', function ($row) {
        return ucfirst($row->title);
        })
        ->editColumn('location', function ($row) {
        return ucwords($row->location);
        })
        ->editColumn('status', function ($row) {
        return '<span>' . ucwords($row->status) . '</span>
        <span class="badge badge-pill badge-primary text-white"
            style="margin-bottom: -3px; height: 15px; background:' . $row->color . '"> </span>';
        })  
       ->addColumn('mail_status', function ($row) use ($request) {
   
          $filtered = Arr::where($row->jobs, function ($value, int $key) {
              if($key == 'job_id' && $value == $request->jobId){
                if($key == $request->jobId){
                     return 1;
                }
              }
          });

            return ( count( $filtered ) == 0) ? '<label class="badge bg-danger">' .
             __('modules.newJobEmail.mailNotSent') . '</label>' : '<label class="badge bg-success">' .
            __('modules.newJobEmail.mailSent') . '</label>';

        })
        ->addColumn('checkbox', function ($row) {
        return '
        <div class="checkbox form-check">
            <input id="' . $row->id . '" type="checkbox" value="' . $row->id . '" class="form-check-input mail-sent">
            <label for="' . $row->id . '"></label>
        </div>
        ';
        })
        ->rawColumns(['action', 'resume', 'full_name', 'checkbox', 'mail_status', 'status'])
        ->addIndexColumn()
        ->make(true);
    }


    public function sendEmails(Request $request)
    {

        $parameters =array(
            "allSelected" => $request->allSelected,
            "selectedIds" => $request->selectedIds,
            "job_for_email" => $request->job_for_email,
            "excludeSent" => $request->excludeSent,
        );

        $apiurl = config('apipath.recruit-sendEmails');

        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
         
         $message = Helper::translation($responseData->message);
        return response()->json(['success' => $message]);
    }

    public function filterJobApplications($request)
    {  
          
         $parameters =array(
            'data' => $request->all(), 
            'skill' => $request->skill,
            'api_token' => Helper::getCurrentuserToken(),      
        );
 
 
         

        $apiurl = config('apipath.recruit-filterJobApplications');
        
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        return $responseData->data;
    }

    public function changeSortOrder(Request $request){
        $parameters = array(
            "result_id" => $request->result_id,
            "sort_order" => $request->sort_order,
        );

        $apiurl = config('apipath.recruit-changeSortOrder');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        return response()->json(['status' => 1, 'success' => $message]);
    }

   
}