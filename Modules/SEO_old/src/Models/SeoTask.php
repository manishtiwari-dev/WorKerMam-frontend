<?php

namespace Modules\SEO\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTask extends Model
{
    use HasFactory;

    protected $table = 'seo_settings_task';
    protected $connection= 'mysqlSuper';
    protected $primaryKey='id';
    
    protected $fillable=[
        'seo_task_title',
        'seo_task_id',
        'seo_task_description',
        'no_of_submission',
        'task_priority',
        'status',

       
    ];




    
    // public function WebReport()
    // {
    //     return $this->belongsTo(WorkReport::class, 'id','seo_task_id');
    // }
}
