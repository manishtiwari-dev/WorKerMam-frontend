<?php

namespace Modules\Pcapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Pcapi\Models\PcProductDescription;
use Modules\Pcapi\Models\PcProductAttribute;
use Modules\Pcapi\Models\PcCategory;

class PcProduct extends Model
{
    use HasFactory;
    protected $connection='mysqlSuper';
    protected $table = "ecm_pc_products";
    protected $primaryKey = 'products_id';
    protected $guarded = [
           'products_id',
    ];

    // Relations 

    public function productdescription(){
        return $this->hasMany(PcProductDescription::class, 'products_id', 'products_id');
    }

    public function productAttribute(){
        return $this->hasMany(PcProductAttribute::class, 'products_id', 'products_id');
    }

    public function products_to_categories(){
        return $this->belongsToMany(PcCategory::class,'ecm_pc_products_to_categories','products_id', 'categories_id');
    }
    public function productTocategories(){
        return $this->hasOne(PcProductToCategory::class,'products_id','products_id');
    }  

}
