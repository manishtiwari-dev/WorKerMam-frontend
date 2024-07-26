<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table = 'mkt_templates_groups'; 

    protected $primaryKey = 'id';

     protected $fillable = [
       'name','description','status'
    ];

    public function emailTemplates()
    {
        return $this->hasOne(EmailTemplates::class, 'group_id', 'group_id');
    }
}
