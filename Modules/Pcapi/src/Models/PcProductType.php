<?php

namespace Modules\Pcapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Pcapi\Models\PcCategoryDescription;

class PcProductType extends Model
{
    use HasFactory;


    protected $connection='mysqlSuper';
    protected $table = "ecm_product_type";
    protected $primaryKey = 'product_type_id';
    protected $guarded = [
           'product_type_id',
    ];

  
  

}
