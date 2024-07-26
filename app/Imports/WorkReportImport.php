<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str;
use Modules\SEO\Models\WorkReport;
use Modules\SEO\Models\SeoSubmissionWebsites;
use Illuminate\Support\Facades\Validator;
use Session;

class WorkReportImport implements ToModel, WithHeadingRow
{
    /** 
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    
        // $data = Session::get(['website_id','seo_task_id']);
        
        // dd($row);
        Validator::make($row, [
             'website_url'        => 'required',
             'landing_url'        => 'required',
             'submission_url'     => 'required',
            
         ])->validate();
         $data_id        = Session::get('data_id');
         $website_id     = Session::get('website_id');
         $seo_task_id    = Session::get('seo_task_id');
         $UserId         = Session::get('UserId');



            if($data_id == null){

                $SeoSubmission = SeoSubmissionWebsites::create([
                    'website_id'       =>  $website_id ,
                    'seo_task_id'      =>  $seo_task_id,
                    'website_url'      =>  $row['website_url'],
                    'website_username' =>  $row['website_username'],
                    'website_password' =>  $row['website_password'],
                    'da'               =>  $row['da'],
                    'status'           =>  $row['status'],
                ]);
                 $data_id = $SeoSubmission->id;
                return new WorkReport([
                    'landing_url'            => $row['landing_url'],
                    'website_url'            => $row['website_url'],
                    'website_id'             => $website_id,
                    'seo_task_id'            => $seo_task_id,
                    'user_id'                => $UserId ,
                    'submission_websites_id' =>  $data_id,
                ]);
            }else{

                return new WorkReport([
                    'landing_url'            => $row['landing_url'],
                    'website_url'            => $row['website_url'],
                    'website_id'             => $website_id,
                    'seo_task_id'            => $seo_task_id,
                    'user_id'                => $UserId ,
                    'submission_websites_id' => $data_id,
                ]);
            }
           
           
    }
}
