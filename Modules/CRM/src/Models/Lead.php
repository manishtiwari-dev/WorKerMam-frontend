<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
     use HasFactory;
    protected $table = 'crm_lead'; 

    protected $primaryKey = 'lead_id';

     protected $fillable = ['lead_id','source_id','industry_id','agent_id','priority','folllow_up','followup_schedule','company_name','website','phone'
    ];
        
    public function leadcontact(){

        return $this->hasOne(LeadContact::class,'lead_id','lead_id');
    }

    public function leadsociallink(){

        return $this->hasOne(LeadSocialLink::class,'lead_id','lead_id');
    }

    public function industry(){

        return $this->belongsTo(LeadSocialLink::class,'industry_id','lead_id');
    }
    
    public function leadsource(){

        return $this->belongsTo(LeadSource::class,'source_id','lead_id');
    }
}
