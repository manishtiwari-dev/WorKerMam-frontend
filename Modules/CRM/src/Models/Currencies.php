<?php

namespace Modules\CRM\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    use HasFactory;
    protected $primaryKey = 'currencies_id';

    protected $table = 'mas_currencies';

    protected $fillable = [
        'sort_order','currencies_id','currencies_name','currencies_code','symbol_left','symbol_right',
        'decimal_point','decimal_places','value','updated_at','status'
    ];
}
