<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;
    protected $table = 'crm_lead_status'; 

    protected $primaryKey = 'status_id';

     protected $fillable = [
       'status_name','sort_order','status'
    ];

    public function crmleadsource(){

        return $this->hasOne(CrmLead::class,'source_id','source_id');
    }
}
