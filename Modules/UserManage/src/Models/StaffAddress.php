<?php

namespace Modules\UserManage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAddress extends Model
{
    use HasFactory;
    protected $primaryKey = 'address_id';

    protected $table = 'hrm_staff_address';
    protected $connection= 'mysql';
    
    protected $fillable = [
        'staff_id', 'address_type', 'street_address', 'city', 'state', 'postcode',
        'countries_id', 'phone_no'
     ];

}
