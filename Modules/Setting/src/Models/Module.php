<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Models\ModuleSection;
use Modules\Setting\Models\IndustryModule;

class Module extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'module_id';
    protected $fillable = [
        'module_id',
        'module_name',
        'module_icon',
        'module_slug',
        'access_priviledge',
        'sort_order',
        'quick_access',
        'status',
        'completion_status',
        'created_at',
        'updated_at',
    ];


    protected $table = 'app_module';

    public function modulesection()
    {
        return $this->hasMany(ModuleSection::class, 'module_id','module_id');
    }

    public function module_list(){
        return $this->hasMany(IndustryModule::class, 'module_id','module_id');
    }
}
