<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    use HasFactory;
    protected $table = 'app_email_templates'; 

    protected $primaryKey = 'template_id';

     protected $fillable = [
       'template_id','group_id','template_subject','template_content','status'
    ];
}
