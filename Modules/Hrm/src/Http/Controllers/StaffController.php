<?php

namespace Modules\Hrm\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Helper\Helper;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Response;

class StaffController extends BaseController
{

    public function __construct()
    {
        //  $this->pageAccess = 'hrm-setting';
        $this->pageTitle = 'Staff';
        $this->pageAccess = config('acceskey.Staff');
    }


    public function index(Request $request)
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
            "sortBy" => "",
            "orderBY" => "",
            "language" => "1",
            "search" => $request->search ?? '',
            "department" => "all",
            "status" => "all",
            'api_token' => Helper::getCurrentuserToken(),
        );

        $apiurl = config('apipath.staff-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        if (!empty($responseData))
            $this->content = $responseData->data;
   
        return view('Hrm::staff.index', collect($this->data));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters = [
            'api_token' => Helper::getCurrentuserToken(),
        ];
        
        $apiurl = config('apipath.staff-create');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);  

        if($responseData->data){
            return view('Hrm::staff.create', collect($responseData->data)); 
        }
        else{
            return view('Hrm::staff.create', collect($responseData['message'])); 
        }  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->staff_photo;
        if (!empty($image)) {
            $data = $image->getClientOriginalName();
            $imagepath = $image->move(public_path('tmp'), $data);
            $imageData = asset('/tmp/' . $data);
        }
 

        $education_id = $request->education_id;
   

        if (!empty($request->education_document)) {
            $eduDocarr = [];
            foreach ($request->education_document as $key => $data) {
                if (!empty($data)) {
                    $getName = $data->getClientOriginalName();
                    $data->move(public_path('tmp'), $getName);
                    $eDocPath = asset('/tmp/' . $getName);
                    array_push($eduDocarr, $eDocPath);
                }
            }
 
        }
        $company_name = $request->company_name;
        if (!empty($company_name)) {
            $workDocarr = [];
            foreach ($company_name as $key => $cdata) {
                if (!empty($request->expWork_document[$key])) {
                    $getname = $request->expWork_document[$key]->getClientOriginalName();
                    $request->expWork_document[$key]->move(public_path('tmp'), $getname);
                    $wDocPath = asset('/tmp/' . $getname);
                    array_push($workDocarr, $wDocPath);
                }
            }
        }

        $identity_proof = $request->identity_proof;
        if (!empty($identity_proof)) { 
                $getname = $identity_proof->getClientOriginalName();
                $identity_proof->move(public_path('tmp'), $getname);
                $identity = asset('/tmp/' . $getname);   
        }
        
        if (!empty($request->address_proof)) {
            if (!empty($request->address_proof)) {
                $getname = $request->address_proof->getClientOriginalName();
                $request->address_proof->move(public_path('tmp'), $getname);
                $address_proof = asset('/tmp/' . $getname); 
            } 
        }
        


        $parameters = array(
            "user_type" => $request->user_type,
            "name" => $request->name ?? '',
            "email" => $request->email ?? '',
            "password" => $request->password ?? '',
            "user_id" => $request->user_id ?? '',
            "role_name" => $request->role_name ?? '',
            "department_id" => $request->department_id,
            "designation_id" => $request->designation_id,
            "fileInfo" => $imageData ?? '',
            "gender" => $request->gender,
            "phone_no" => $request->phone_no,
            "date_of_joining" => $request->staff_date_of_joining,
            "date_of_leaving" => $request->date_of_leaving ?? '',
            "marital_status" => $request->marital_status,
            "date_of_birth" => $request->date_of_birth,
            "staff_id" => $request->staff_id ?? '',
            "street_address" => $request->street_address,
            "city" => $request->city,
            "state" => $request->state,
            "postcode" => $request->postcode,
            "countries_id" => $request->countries_id,
            "permanent_street_address" => $request->permanent_street_address,
            "permanent_city" => $request->permanent_city,
            "permanent_state" => $request->permanent_state,
            "permanent_postcode" => $request->permanent_postcode,
            "education_id" => $request->education_id,
            "university_name" => $request->university_name,
            "admission_at" => $request->admission_at,
            "passing_at" => $request->passing_at,
            "permanent_countries_id" => $request->permanent_countries_id,
            "permanent_phone_no" => $request->permanent_phone_no,
            "education_document_type" => $request->education_document_type, 
            "company_name" => $request->company_name,
            "company_designation" => $request->company_designation,
            "company_address" => $request->company_address,
            "contact_name" => $request->contact_name,
            "contact_email" => $request->contact_email,
            "contact_phone" => $request->contact_phone,
            "work_date_of_joining" => $request->work_date_of_joining,
            "work_date_of_leaving" => $request->work_date_of_leaving,
            "reason_for_leaving" => $request->reason_for_leaving,
            "work_document_type" => $request->work_document_type,
            "work_document" => $workDocarr,
            "education_document" => $eduDocarr ?? '',
            "salary" => $request->salary,
            "address_type" => $request->address_type,
            "account_name" => $request->account_name,
            "account_number" =>  $request->account_number, 
            "bank_name" =>  $request->bank_name, 
            "bank_indetifier_coder" =>  $request->bank_indetifier_coder, 
            "bank_branch" =>  $request->bank_branch,  
            "identity_proof" => $identity ?? "",
            "address_proof" => $address_proof ?? "",
            "api_token" => Helper::getCurrentuserToken(),
        );
  
        // dd($parameters);
        $apiurl = config('apipath.staff-store');
 
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        $message = Helper::translation($responseData->message); 

        if ($responseData->status != false) {
            return redirect()->route('hrm.staff.index')->with('success', $message);
        } else {
            return redirect()->route('hrm.staff.index')->with('error', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parameters = array(
            "staff_id" => $id,
        );

        $apiurl = config('apipath.staff-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
 
        if ($responseData->data) {
            return view('Hrm::staff.show', collect($responseData->data));
        } else {
            return view('Hrm::staff.show', collect($responseData['message']));
        }
    }
    public function chgStaffStatus(Request $request)
    {
        if (!empty($request->status)) {
            if ($request->status == '1') {
                $parameters = array(
                    "staff_id" => $request->staff_id,
                    "type" => $request->type,
                    "verification_status" => $request->verification_status ?? '',
                    "status" => $request->status ?? '',
                    "termination_reason" => $request->termination_reason ?? '',
                    "remark_details" => $request->remark_details ?? '',
                );
            } else {
                $parameters = array(
                    "staff_id" => $request->staff_id,
                    "type" => $request->type,
                    "status" => $request->status ?? '',
                );
            }
        } else {
            $parameters = array(
                "staff_id" => $request->staff_id,
                "type" => $request->type,
                "verification_status" => $request->verification_status ?? '',
                "status" => $request->status ?? '',
                "termination_reason" => $request->termination_reason ?? '',
                "remark_details" => $request->remark_details ?? '',
            );
        }
        $apiurl = config('apipath.staff-changestatus');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);

        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json($responseData);
        } else {
            return response()->json($responseData['message']);
        }
    }
    public function updateSaff(Request $request)
    { 
        
        $image = $request->document_upload;
        if (!empty($image)) {
            
            $data = $image->getClientOriginalName();
            $imagepath = $image->move(public_path('tmp'), $data);
            $imageData = asset('/tmp/' . $data);
        }

        $profileimg = $request->profileimg;
        if (!empty($profileimg)) {
            
            $data = $profileimg->getClientOriginalName();
            $imagepath = $profileimg->move(public_path('tmp'), $data);
            $profileimgData = asset('/tmp/' . $data);
        }
 
        $sectionName = $request->updateSection;
  
        $parameters = [];
        switch ($sectionName) {
            case 'basic_info':
                $parameters = array(
                    "updateSection" => 'basic_info',
                    "staff_id" => $request->staff_id,
                    "staff_name" => $request->staff_name,
                    "employee_id" => $request->employee_id,
                    "staff_email" => $request->staff_email ?? '',
                    "staff_phone" => $request->staff_phone ?? '',
                    "department_id" => $request->department_id ?? '',
                    "designation_id" => $request->designation_id ?? '',
                    "marital_status" => $request->marital_status ?? '',
                    "date_of_birth" => $request->date_of_birth ?? '',
                    "date_of_joining" => $request->date_of_joining ?? '',
                    "date_of_leaving" => $request->date_of_leaving ?? '',
                    "salary" => $request->salary ?? '',
                    "gender" => $request->gender ?? '',
                    "staff_photo" => $profileimgData ?? '',
                );

                break;

            case 'address':
                $parameters = array(
                    "updateSection" => $sectionName,
                    "staff_id" => $request->staff_id ?? '',
                    "address_id" => $request->address_id ?? '',
                    "phone_no" => $request->contact_number ?? '',
                    "street_address" => $request->street_address ?? '',
                    "city" => $request->city ?? '',
                    "state" => $request->state ?? '',
                    "countries_id" => $request->country ?? '',
                    "postcode" => $request->postcode ?? '',
                );
                break;

            case 'education':
                if ($request->updateType == 'new') {
                    $parameters = array(
                        "updateType"   => 'new',
                        "updateSection" => $sectionName,
                        "staff_id" => $request->staff_id ?? '',
                        "education_id" => $request->education_id ?? '',
                        "university_name" => $request->university_name ?? '',
                        "admission_at" => $request->addmission_year ?? '',
                        "passing_at" => $request->passing_year ?? '',
                        "staff_doc_id" => $request->document_type ?? '',
                        "qualification_id" => $request->qualification_id,
                        "document" => $imageData ?? '',
                    );
                } else { 
                    $parameters = array(
                        "updateSection" => $sectionName,
                        "staff_id" => $request->staff_id ?? '',
                        "education_id" => $request->education_id ?? '',
                        "university_name" => $request->university_name ?? '',
                        "admission_at" => $request->addmission_year ?? '',
                        "passing_at" => $request->passing_year ?? '',
                        "staff_doc_id" => $request->document_type ?? '',
                        "qualification_id" => $request->qualification_id,
                        "document" => $imageData ?? '',
                    );
                }
                break;

            case 'workexp':
                if ($request->updateType == 'new') {
                    $parameters = array(
                        "updateType" => 'new',
                        "updateSection" => $sectionName,
                        "staff_id" => $request->staff_id ?? '',
                        "company_name" => $request->company_name ?? '',
                        "company_designation" => $request->company_designation ?? '',
                        "company_address" => $request->company_address ?? '',
                        "contact_name" => $request->contact_name ?? '',
                        "contact_email" => $request->contact_email,
                        "contact_phone" => $request->contact_phone,
                        "date_of_joining" => $request->date_of_joining,
                        "date_of_leaving" => $request->date_of_leaving,
                        "reason_for_leaving" => $request->reason_for_leaving,
                        "document_type" => $request->document_type, 
                        "document" => $imageData ?? '',
                    );
                } else {
                    $parameters = array(
                        "updateSection" => $sectionName,
                        "staff_id" => $request->staff_id ?? '',
                        "experience_id" => $request->experience_id,
                        "company_name" => $request->company_name ?? '',
                        "company_designation" => $request->company_designation ?? '',
                        "company_address" => $request->company_address ?? '',
                        "contact_name" => $request->contact_name ?? '',
                        "contact_email" => $request->contact_email,
                        "contact_phone" => $request->contact_phone,
                        "date_of_joining" => $request->date_of_joining,
                        "date_of_leaving" => $request->date_of_leaving,
                        "reason_for_leaving" => $request->reason_for_leaving,
                        "document_type" => $request->document_type, 
                        "document" => $imageData ??'',
                    );
                }
                break;
        }
 
        $apiurl = config('apipath.staff-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json($message);
        } else {
            return response()->json($responseData['message']);
        }
    }
    public function verification(Request $request)
    {
        $parameters = array(
            "staff_id" => $request->staff_id,
            "remark_details" => $request->remark_details,
        );

        $apiurl = config('apipath.staff-verify');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json($message);
        } else {
            return response()->json($responseData['message']);
        }
    }

    public function Performance(Request $request)
    {
        $parameters = array(
            "staff_id" => $request->staff_id,
            "grade" => $request->grade,
            "remark_details" => $request->remark_details,
        );

        $apiurl = config('apipath.staff-performance');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json($message);
        } else {
            return response()->json($responseData['message']);
        }
    }
    
    public function remunerationAdd(Request $request)
    {
        $parameters = array(
            "staff_id" => $request->staff_id,
            "remuneration_type" => $request->remuneration_type,
            "remuneration_date" => $request->remuneration_date,
            "remuneration_value" => $request->remuneration_value,
        ); 
        $apiurl = config('apipath.staff-remuneration');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    public function BankDetailsAdd(Request $request)
    { 

        $parameters = array(
            "staff_id" => $request->staff_id,
            "account_name" => $request->account_name,
            "account_number" => $request->account_number,
            "bank_name" => $request->bank_name,
            "bank_indetifier_coder" => $request->bank_indetifier_coder,
            "bank_branch" => $request->bank_branch,
        );
 

        $apiurl = config('apipath.staff-bank-details');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    public function bankDetailsEdit(Request $request){
        $parameters = array(
            "bank_details_id" => $request->bank_details_id,
            'api_token' => Helper::getCurrentuserToken(),

        );
 

        $apiurl = config('apipath.bank-details-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
        
        return response()->json(['responseData' => $responseData->data]);
    }

    public function bankDetailsUpdate(Request $request){
        $parameters = array(
            "staff_id" => $request->staff_id,
            "bank_details_id" => $request->bank_details_id,
            "account_name" => $request->account_name,
            "account_number" => $request->account_number,
            "bank_name" => $request->bank_name,
            "bank_indetifier_coder" => $request->bank_indetifier_coder,
            "bank_branch" => $request->bank_branch,
        );

        $apiurl = config('apipath.bank-details-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }


    
    public function terminate(Request $request)
    {
        $parameters = array(
            "staff_id" => $request->staff_id,
            "termination_reason" => $request->termination_reason,
            "date_of_leaving" => $request->date_of_leaving,
            "remark_details" => $request->remark_details,
            "rehire" => $request->rehire,
        );
 

        $apiurl = config('apipath.staff-terminate');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
  
        
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 1, 'success' => $message]);
        }
    }
 
    public function performEdit(Request $request)
    {

        $parameters = array(
            "performance_id" => $request->performance_id,
            'api_token' => Helper::getCurrentuserToken(),

        );
 

        $apiurl = config('apipath.performance-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
        
        return response()->json(['responseData' => $responseData->data]);
    }

    public function remunerationEdit(Request $request)
    {

        $parameters = array(
            "remuneration_id" => $request->remuneration_id,
            'api_token' => Helper::getCurrentuserToken(),

        );
 

        $apiurl = config('apipath.remuneration-edit');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
      
        
        return response()->json(['responseData' => $responseData->data]);
    }
    

    
    public function PerformanceUpdate(Request $request)
    {
        $parameters = array(
            "staff_id" => $request->staff_id,
            "remark_id" => $request->remark_id,
            "grade" => $request->grade,
            "remark_details" => $request->remark_details,
        );

        $apiurl = config('apipath.staff-performance-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    
    public function RemunerationUpdate(Request $request)
    {
        $parameters = array(
            "staff_id" => $request->staff_id,
            "remuneration_type" => $request->remuneration_type,
            "remuneration_value" => $request->remuneration_value,
            "remuneration_date" => $request->remuneration_date,
            "remuneration_id" => $request->remuneration_id,
        ); 
        $apiurl = config('apipath.staff-remuneration-update');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        $message = Helper::translation($responseData->message);

        if ($message) {
            return response()->json(['status' => 1, 'success' => $message]);
        } else {
            return response()->json(['status' => 0, 'error' => $message]);
        }
    }

    public function downloadImage(Request $request)
    {
 
        // Replace 'your-image.jpg' with the actual filename or path of your image
        $filePath = $request->imagFile;
  
        $imageContent = file_get_contents($filePath);
        
        $fileName = time() . 'document.png';
        
        Storage::put('public/' . $fileName, $imageContent);
        
        $localPath = storage_path('app/public/' . $fileName);
        
        return response()->download($localPath, 'document.png');
        // return response()->download($filePath, 'document.jpg');
    }


    public function importCreate(Request $request){
          
        return view('Hrm::staff.import-create');
    }


    public function importStore(Request $request){

 
        $file = $request->importFile;
      
        
 
            // $file = $request->importFile;
            $parameters = array(
                
            );

            $files = [];
            if( $request->hasFile('importFile')){
               $import_files = $request->file('importFile');
               $import_ary = [
               'name' => 'import_file',
               'contents' => file_get_contents($import_files),
               'filename' => $import_files->getClientOriginalName()
               ];
               array_push($files, $import_ary);
            }
 
 

            $apiurl = config('apipath.staff-import');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters , $files);
           
            $message = Helper::translation($responseData->message);
 
            if ($responseData->status != false) {
                return redirect()->route('hrm.staff.index')->with('success', $message);
            } else {
                return redirect()->route('hrm.staff.index')->with('error', $message);
            }
    }


    public function downloadFile(){
        
        $file = asset('staff-file/staff-import.xlsx');
         
            // Fetch the file content from the URL
            $fileContent = file_get_contents($file);

            // Set the appropriate headers for the response
            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="staff-import.xlsx"',
            ];
    
            // Return the file as a downloadable response
            return Response::make($fileContent, 200, $headers);
    }

    public function searchStaff(Request $request){
         

        $parameters = array(
            "department" => $request->department, 
            "status" => $request->status,
            "search" => $request->search,
            'api_token' => Helper::getCurrentuserToken(),
        );
 

        $apiurl = config('apipath.staff-list');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        $returnHTML = view('Hrm::staff.filter_response', collect($responseData->data))->render();
        

        return response()->json(['success' => true, 'html' => $returnHTML]);

 
    }
}
