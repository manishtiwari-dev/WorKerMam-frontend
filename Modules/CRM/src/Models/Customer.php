<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\CRM\Models\CustomerContact;
use Modules\CRM\Models\CostomerAddress;


class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';

    protected $table = 'crm_customer';

    protected $fillable = ['customer_id','lead_id','first_name','last_name','gender','email','company_name','website','password','status','email_verified_at','api_token','remember_token','profile_photo','is_guest','contact','date_of_birth','created_by'];

    public function customerContact(){

        return $this->hasOne(CustomerContact::class, 'customer_id', 'customer_id');
    }

    public function customerAddress(){

        return $this->hasOne(CustomerAddress::class, 'customer_id', 'customer_id');
    }
    public function lead(){

        return $this->belongsTo(Lead::class, 'lead_id', 'lead_id');
    }
    
}
