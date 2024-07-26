<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    use HasFactory;
    protected $primaryKey = 'contact_id';

    protected $table = 'crm_customer_contact';

    protected $fillable = ['contact_id','customer_id','contact_name','contact_email','is_default','status'];
}
