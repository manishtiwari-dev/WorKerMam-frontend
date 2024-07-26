<?php

namespace Modules\Pcapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SiteToCategory extends Model
{
    use HasFactory;
    protected $connection='mysqlSuper';
    protected $table = 'ecm_pc_categories_to_site';

    protected $fillable = [
        'site_id',
        'categories_id',
    ];

}
