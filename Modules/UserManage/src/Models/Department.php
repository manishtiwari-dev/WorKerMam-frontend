<?php

namespace Modules\UserManage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $primaryKey = 'department_id';

    protected $table = 'hrm_department';
    protected $connection= 'mysql';
    
    protected $fillable = [
        'dept_name','dept_details','status','created_by'
     ];

}
