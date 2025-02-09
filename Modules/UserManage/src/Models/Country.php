<?php

namespace Modules\UserManage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $primaryKey = 'countries_id';

    protected $table = 'mas_countries';
    protected $connection= 'mysql';

    protected $fillable = ['countries_id','countries_name','countries_iso_code_2','countries_iso_code_3','currencies_id','currencies_code','languages_id','time_zone_id','utc_time','address_format_id','status'];
}
