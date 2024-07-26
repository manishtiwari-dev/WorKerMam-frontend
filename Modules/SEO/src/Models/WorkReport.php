<?php

namespace Modules\SEO\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkReport extends Model
{
    use HasFactory;

    protected $table = 'seo_work_report';
    protected $connection= 'mysqlSuper'; 
    
    protected $fillable = ['id','website_id', 
    'user_id', 'seo_task_id', 'website_url','submission_websites_id','landing_url','updated_at','created_at'];

    
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }
    
    protected $appends = ['formattedDate'];

    
    public function Users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function SeoSetting()
    {
        return $this->belongsTo(SeoTask::class,'seo_task_id','id');
    }
    public function SubmissionWebsite()
    {
        return $this->belongsTo(SeoSubmissionWebsites::class,'submission_websites_id','id');
    }
}
