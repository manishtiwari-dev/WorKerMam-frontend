<?php
namespace Modules\UserManage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasRoles extends Model
{
    use HasFactory;

    protected $table = 'usr_user_has_roles';
    protected $connection= 'mysqlSuper';
    protected $fillable = [
        'roles_id','users_id'
     ];

     public $timestamps = false;
     public $incrementing = false;
     protected $primaryKey = 'users_id';

     public function userlist(){
        return $this->hasMany(User::class, 'roles_id');
    }

    public function roles(){
        return $this->belongsTo(Role::class , 'roles_id','roles_id');
    }
    
}
