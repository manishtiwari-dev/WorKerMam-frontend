<?php
namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Models\Module;
use Modules\Department\Models\Permission;

class ModuleSection extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $primaryKey = 'section_id';
    
    protected $fillable = [
        'section_id',
        'module_id',
        'parent_section_id',
        'section_name',
        'section_icon',
        'section_slug',
        'section_url',
        'sort_order',
        'quick_access',
        'status',
        'completion_status',
        'created_at',
        'updated_at',
    ];

    protected $table = 'app_module_section';

    public function module(){
        return $this->belongsTo(Module::class, 'module_id', 'module_id');
    }
}
