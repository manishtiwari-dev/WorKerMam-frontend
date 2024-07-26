<?php
namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModuleSection extends Model
{
    use HasFactory;
    protected $table = 'app_module_section'; 

    protected $primaryKey = 'section_id';

     protected $fillable = [
       'section_id','module_id','parent_section_id','section_name','section_slug','section_icon','section_url','sort_order','quick_access','completion_status','status'
    ];
}
