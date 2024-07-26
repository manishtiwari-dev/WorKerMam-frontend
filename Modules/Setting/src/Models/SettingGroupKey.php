<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGroupKey extends Model
{
    use HasFactory;
    protected $table = 'app_setting_group_key'; 

    protected $primaryKey = 'setting_id';

    protected $fillable = [
    'setting_id','group_id','setting_key','setting_name','setting_options','option_type','setting_hint','setting_hint','sort_order','status'
    ]; 
}
