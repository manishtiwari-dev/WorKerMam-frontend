<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateToGroup extends Model
{
    use HasFactory;
    protected $table = 'mkt_templates_to_groups'; 

    protected $primaryKey = 'id';

     protected $fillable = [
       'group_id','template_id','status'
    ];

    public function templategroup()
    {
        return $this->belongsTo(Template::class, 'group_id', 'id');
    }
    public function templatecontent()
    {
        return $this->belongsTo(TemplateList::class, 'template_id', 'id');
    }

}
