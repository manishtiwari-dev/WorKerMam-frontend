<?php

namespace Modules\SEO\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTitle extends Model
{
    use HasFactory;

    protected $table = 'seo_settings_result_title';
    protected $connection= 'mysqlSuper';
    

    protected $fillable = ['id', 'title_name', 'parent_id', 'sort_order','status'];
    public function seowebsiteresult()
    {
        return $this->hasMany(SeoTitle::class,'id','result_title_id');
    }
    public function resultvalue()
    {
        return $this->belongs(SeoWebsiteResult::class,'result_title_id','id');
    }
}
