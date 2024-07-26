<?php

namespace Modules\AddOnManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    use HasFactory;


    protected $connection='mysqlSuper';
    protected $table = "app_addons";
    protected $primaryKey = 'id';
    protected $guarded = [
           'id',
    ];

  

}
