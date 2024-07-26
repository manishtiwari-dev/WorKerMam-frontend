<?php

namespace Modules\Pcapi\Models\Services;
use Illuminate\Database\Eloquent\Builder;
use Modules\Pcapi\Models\PcCategory;
use Modules\Pcapi\Models\PcProduct;
use Illuminate\Support\Str;


// Ecom

use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductToCategory;

use App\Models\Category;
use App\Models\CategoryDescription;


class CategoryService
{
    public static function getProductByCatID($ID = '')
    {   
        $language=1;
        $products = [];
        $cat = PcCategory::where('categories_id', $ID)->firstOrFail();
    
        $products =  PcProduct::with('productdescription', 'productAttribute', 'products_to_categories')->whereHas(
            'products_to_categories',
            function (Builder $query) use ($cat) {
                $query->where('ecm_pc_products_to_categories.categories_id', $cat->categories_id);
             })->get();

        if(!empty($products)){
            $products->map(function ($product) use ($language) {
                    $desc = $product->productdescription()->where('language_id', $language)->first();
                    $product->products_name = ($desc == null) ? '' : $desc->products_name;
                    $product->products_description = ($desc == null) ? '' : $desc->products_description;
                    return $product;
                });
            }

        return $products;
      }

    public static function cateChildAry($catId)
    {
        $cateArray = array();

        $cat = PcCategory::select('categories_id')->where('parent_id', $catId)->get();

        foreach($cat as $scate){
             $cateArray[] = $scate->categories_id;
             $subcate = PcCategory::select('categories_id')->where('parent_id', $scate->categories_id)->get();
             foreach($subcate as $sscate)
                $cateArray[] = $sscate->categories_id;
        }
        return $cateArray;
    }

    // Check & Generate Category Slug

    public static function CheckCategorySlug($cate_id, $cateName){
        $tempName=$cateName;
        $Slug=Str::slug($cateName);
        $exist='';
        $exist=Category::where('categories_slug',$Slug)->where('categories_id', '!=',$cate_id)->first();
        if(!empty($exist))
         return CategoryService::CheckCategorySlug($cate_id,$tempName.'-'.rand(1,10));
        else
        return $Slug;
    }

    // Check & Generate Product Slug

    public static function CheckProductSlug($products_id,$ProdName){
        $Slug=Str::slug($ProdName);
        $exist='';
        $exist=Product::where('product_slug',$Slug)->where('product_id', '!=',$products_id)->first();
        if(!empty($exist))
         return CategoryService::CheckProductSlug($products_id,$ProdName.'-'.rand(1,10));
        else
        return $Slug;
    }


    // Add Category   

    public static function CategoryAddStatusUpdate($request,$pcCategory, $parent_id=0){
       
        $cate=Category::updateOrCreate([
            'source_id'=>$pcCategory->categories_id,'source'=>2,
        ],[
            'categories_slug' =>CategoryService::CheckCategorySlug($pcCategory->categories_id, $pcCategory->categories_name),
            'sort_order'=>$pcCategory->sort_order,
            'status'=>$request->status,
            'parent_id'=>$parent_id,
            'is_featured'=>0,
        ]);

        if(!empty( $cate)) {
            
            CategoryDescription::updateOrCreate(
            ['categories_id'=>$cate->categories_id],
            [
            'categories_name'=>$pcCategory->categories_name,
            'categories_menu_name'=>$pcCategory->categories_top_nav_name,   
            'categories_description'=>$pcCategory->categories_description,   
            ]);
        } 

        return $cate;
    }

    // Add Products

    public static function ProductAddStatusUpdate($request,$pccate_id, $sitecate){

        $CategoryProducts=PcCategory::getProductByCatID($pccate_id);
        if(!empty($CategoryProducts) && sizeof($CategoryProducts)>0)
        {
            foreach($CategoryProducts as $cateprduct)
            {   
                // Create Product
           
                $ecProducts=Product::updateOrCreate([
                    'source_id'=>$cateprduct->products_id,'source'=>2,
                ],[      
                    'product_model'=>$cateprduct->products_model,
                    'product_slug' =>CategoryService::CheckProductSlug($cateprduct->products_id,$cateprduct->products_name),
                    'sort_order'=>$cateprduct->sort_order,
                    'product_status'=>$request->status,
                ]);
         
                // Create Product Descriptions

                $ecprdDesc=ProductDescription::updateOrCreate(
                    ['products_id'=>$ecProducts->product_id,],
                    [
                    'products_id'=>$ecProducts->product_id,   
                    'languages_id'=>1,
                    'products_name'=>$cateprduct->products_name,
                    'products_description'=>$cateprduct->products_description,
                    ]
                );

                // Create Product to Categories

                ProductToCategory::updateOrCreate(
                  [ 
                    'products_id'=>$ecProducts->product_id,
                    'categories_id'=>$sitecate->categories_id,

                  ],[
                    'products_id'=>$ecProducts->product_id,
                    'categories_id'=>$sitecate->categories_id,
                ]);

            }
        }
     }
}
