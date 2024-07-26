<?php

namespace Modules\Pcapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Pcapi\Models\PcCategoryDescription;
use Modules\Pcapi\Models\Services\CategoryService;
use Modules\Pcapi\Models\SiteToCategory;

class PcCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection='mysqlSuper';
    protected $table = "ecm_pc_categories";
    protected $primaryKey = 'categories_id';
    protected $guarded = [
           'categories_id',
    ];

    public function categorydescription(){
        return $this->hasMany(PcCategoryDescription::class, 'categories_id', 'categories_id');
    }


    // Services
    public static function getProductByCatID($ID){
        return CategoryService::getProductByCatID($ID);
    }

    public static function ProductAddStatusUpdate($request,$pccate_id,$sitecate){
        return CategoryService::ProductAddStatusUpdate($request,$pccate_id,$sitecate);
    }

    public static function cateChildAry($ID){
        return CategoryService::cateChildAry($ID);
    }

    public static function CategoryAddStatusUpdate($request,$pcCategory,$parent_id=0){
        return CategoryService::CategoryAddStatusUpdate($request,$pcCategory,$parent_id);
    }

    public static function CheckProductSlug($products_id,$name){
        return CategoryService::CheckProductSlug($products_id,$name);
    }

    public static function CheckCategorySlug($cate_id,$name){
        return CategoryService::CheckCategorySlug($cate_id,$name);
    }

}
