<?php

namespace Modules\UserManage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;


class Staff extends Model
{
    use HasFactory;
    protected $primaryKey = 'staff_id';

    protected $table = 'hrm_staff';
    protected $connection= 'mysql';
    
    protected $fillable = [
        'employee_id', 'user_id', 'department_id', 'designation_id', 'gender', 'marital_status', 'staff_name', 'staff_photo', 'staff_email', 'staff_phone', 'date_of_birth', 'date_of_joining','salary'
     ];

      public function department()
    {
        return $this->belongsTo(Department::class,'department_id','department_id');
        
    }  


      public function designation()
    {
        return $this->belongsTo(Designation::class,'designation_id','designation_id');
        
    }  

}
