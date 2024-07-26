<?php

namespace Modules\Pcapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Pcapi\Models\PcCategoryDescription;

class PcProductDescription extends Model
{
    use HasFactory;


    protected $connection='mysqlSuper';
    protected $table = "ecm_pc_products_description";
    protected $primaryKey = 'products_description_id';
    protected $guarded = [
           'products_description_id',
    ];

  
  

}
