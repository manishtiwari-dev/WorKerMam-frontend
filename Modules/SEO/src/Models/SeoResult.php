<?php

namespace Modules\SEO\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoResult extends Model
{
    use HasFactory;

   protected $table = 'seo_settings_result_title';
   protected $primarykey='id';
   protected $connection= 'mysqlSuper';
   

    
    protected $fillable = ['title_name', 'parent_id', 'sort_order','status'];

    
    public function Seowebsiteresult()
    {
        return $this->hasMany(SeoWebsiteResult::class, 'result_title_id', 'id');
    }
}
