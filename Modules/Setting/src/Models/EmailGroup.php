<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailGroup extends Model
{
    use HasFactory;
    protected $table = 'app_email_group'; 

    protected $primaryKey = 'group_id';

     protected $fillable = [
       'group_id','group_name','group_key','status'
    ];

    public function emailTemplates()
    {
        return $this->hasOne(EmailTemplates::class, 'group_id', 'group_id');
    }
}
