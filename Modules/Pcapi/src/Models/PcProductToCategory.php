<?php

namespace Modules\Pcapi\Models;

use App\Models\Scopes\StatusScope;
use App\Models\Ecom\Scopes\SortOrderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Pcapi\Models\PcProduct;
use App\Models\Ecom\Product;
use App\Models\Ecom\Brand;
use App\Models\Ecom\Services\CategoryService;

class PcProductToCategory extends Model
{
    use HasFactory;
    protected $connection='mysqlSuper';
    protected $table = 'ecm_pc_products_to_categories';
    protected $fillable = [
        'products_id',
        'categories_id',
    ];
    public function product(){
        return $this->hasOne(PcProduct::class, 'products_id', 'products_id');
    }
    public function productdescription(){
        return $this->hasOne(PcProductDescription::class, 'products_id', 'products_id');
    }
}
