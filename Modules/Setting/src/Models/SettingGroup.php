<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Models\SettingGroupKey;

class SettingGroup extends Model
{
    use HasFactory;
    protected $table = 'app_settings_group'; 

    protected $primaryKey = 'group_id';

     protected $fillable = [
       'group_id','group_name','access_privilege','sort_order'
    ];

    // public function AppSettingGroupKey()
    // {
    //     return $this->hasOne(AppSettingGroupKey::class, 'group_id', 'group_id');
    // }

    public function setting_grp_key()
    {
        return $this->hasMany(SettingGroupKey::class,'group_id','group_id');
    }
}

