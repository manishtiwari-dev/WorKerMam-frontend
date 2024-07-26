<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateList extends Model
{
    use HasFactory;
    protected $table = 'mkt_templates'; 

    protected $primaryKey = 'id';

     protected $fillable = [
       'subject','content','status','id'
    ];

    public function emailTemplates()
    {
        return $this->hasOne(EmailTemplates::class, 'group_id', 'group_id');
    }
}
