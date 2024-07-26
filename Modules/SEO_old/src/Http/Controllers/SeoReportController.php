<?php
namespace Modules\SEO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Files;
use App\Imports\WorkReportImport;
use App\Jobs\ImportWorkReportJob;
use Illuminate\Support\Facades\Bus;
use App\Helper\Reply;
use Artisan;
use App\Http\Requests\FileRequest\ImportProcessRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Helper\Helper;
use App\Http\Controllers\BaseController;




class SeoReportController extends BaseController
{

    public function __construct()
    {
        $this->pageAccess = config('acceskey.work_report');
        $this->pageTitle = 'Work Report';
 
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
           
            "page" => '1',
            "perPage" => "2",
            "search" => "",
            "sortBy"=> "",
            "orderBY" => "",
            "language" => "1",

        );
    
        $apiurl = config('apipath.seo-workReport');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters);
        
        if(!empty($responseData))
        $this->content = $responseData->data;
           
        
        return view('SEO::seo-work-report.index', collect($this->data)  );

    }



    public function workReportUrl(Request $request)
    {
        $parameters =array(
           
            "startdate" => $request->startDate,
            "enddate" => $request->endDate,
            "website_id"=>$request->website_id
        );
    
        $apiurl = config('apipath.seo-workReportUrl');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
          
            //dd($responseData);
        return response()->json(['work_report' => collect($responseData->data)]);
           
    }



    public function importData()
    {
               
        $apiurl = config('apipath.seo-workReport-import-add');
        $responseData = Helper::ApiServiceResponse($apiurl, []); 

        return view('SEO::seo-work-report.import.import', collect($responseData->data));
    }

   

    public function importStore(Request $request)
    { 
     
        $request->validate([
            'website_id' => 'required',
            'seo_task_id' => 'required'
        ]);

            $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

       if($_FILES['import_file']['name']) {

            
        // $file_ext=$file->getClientOriginalExtension();
        // $file_name= 'report-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$file_ext;
  
        // $file->move(public_path('uploads'), $file_name);

        // $arr_file = asset('uploads/'.$file_name);

        //    } else{
        //     $arr_file = '';
        //    }

         
            
            $parameters =array(
                'website_id'  => $request->website_id,
                'seo_task_id' => $request->seo_task_id,  
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


            $apiurl = config('apipath.seo-workReport-import-store');
            $responseData = Helper::ApiServiceResponse($apiurl, $parameters, $files);
            $message = Helper::translation($responseData->message);

            return redirect()->route('seo.work-report.index' , ['website='.$request->website_id])->with('success', $message); 

         } else{
            return redirect()->route('seo.work-report.index')->with('error', $message);
         }



    }

    
    public function importProcess(ImportProcessRequest $request)
    {
        
        // clear previous import
        Artisan::call('queue:clear database --queue=import_work_report');
        Artisan::call('queue:flush');
        // Get index of an array not null value with key
        $columns = array_filter($request->columns, function ($value) {
            return $value !== null;
        });

        $excelData = Excel::toArray(new WorkReportImport, public_path('user-uploads/import-files/' . $request->file))[0];

        if ($request->has_heading) {
            array_shift($excelData);
        }

        $jobs = [];
        
        $columns[3] = 'user_id';
        $excelData[0][3] = 'user_id';
        $columns[4] = 'website_id';
        $excelData[0][4] = 'website_id';
        $columns[5] = 'seo_task_id';
        $excelData[0][5] = 'seo_task_id';

        foreach ($excelData as $key=>$row) {
            if($key != 0){
                $row[3] = $request->user_id;
                $row[4] = $request->website_id;
                $row[5] = $request->seo_task_id;
            }
           
            $jobs[] = (new ImportWorkReportJob($row, $columns));
        }
        // dd('');
        $batch = Bus::batch($jobs)->onConnection('database')->onQueue('import_work_report')->name('import_work_report')->dispatch();

        Files::deleteFile($request->file, 'import-files');

        return Reply::successWithData(__('messages.importProcessStart'), ['batch' => $batch]);
    }


    public function exportData(Request $request){
         $parameters =array(
           
            "startdate" => $request->start_date,
            "enddate" => $request->end_date,
            "website_id"=>$request->website
        );  
    
        $apiurl = config('apipath.seo-workReport-export');
        $responseData = Helper::ApiServiceResponse($apiurl, $parameters); 
        
        return response()->download($responseData->data);
        //return response()->json(['work_report' => collect($responseData->data)]);
    }

}