<?php

namespace Modules\Pcapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Pcapi\Models\PcCategoryDescription;

class PcProductTypeToField extends Model
{
    use HasFactory;


    protected $connection='mysqlSuper';
    protected $table = "ecm_product_type_to_fieldsgroup";
    protected $primaryKey = 'id';
    protected $guarded = [
           'id',
    ];

  
  

}
