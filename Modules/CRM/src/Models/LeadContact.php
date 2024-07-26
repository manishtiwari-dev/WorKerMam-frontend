<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadContact extends Model
{
    use HasFactory;
    protected $table = 'crm_lead_contact'; 

    protected $primaryKey = 'lead_contact_id';

     protected $fillable = [
       'lead_contact_id','lead_id','contact_name','contact_email','status','created_by'
    ];
}
