<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSocialLink extends Model
{
    use HasFactory;
    protected $table = 'crm_lead_social_link'; 

    protected $primaryKey = 'social_link_id';

     protected $fillable = [
        'social_link_id','lead_id','social_type','social_link','status'
    ];

    public function lead(){

        return $this->belongsTo(Lead::class,'lead_id','lead_id');
    }
}
