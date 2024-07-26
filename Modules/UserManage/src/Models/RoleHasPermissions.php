<?php
namespace Modules\UserManage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermissions extends Model
{
    use HasFactory;

    protected $table = 'usr_role_has_permissions';
    protected $connection= 'mysql';
    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'roles_id','section_id','permissions_ids','permission_types_id'
     ];


     public function permission() {
        return $this->hasMany(Permission::class , 'permissions_id', 'permissions_ids');
    }
}
