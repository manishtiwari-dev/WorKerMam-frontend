<?php

namespace Modules\AddOnManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnManager extends Model
{
    use HasFactory;


    protected $connection= 'mysql';
    protected $table = "app_addon_manager";
    protected $primaryKey = 'id';
    protected $guarded = [
           'id',
    ];

  

}
