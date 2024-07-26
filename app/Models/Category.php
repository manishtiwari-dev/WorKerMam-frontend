<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $connection= 'mysql';
    protected $table = "ecm_categories";
    protected $primaryKey = 'categories_id';
    protected $guarded = [
           'categories_id',
    ];

    public function categorydescription(){
        return $this->hasMany(CategoryDescription::class, 'categories_id', 'categories_id');
    }
  

}
