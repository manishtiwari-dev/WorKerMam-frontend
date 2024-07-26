<?php

namespace Modules\Pcapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcCategoryDescription extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $connection='mysqlSuper';
    protected $table = "ecm_pc_categories_description";
    protected $primaryKey = 'categories_id';
    protected $guarded = [
           'categories_id',
    ];

  

}
