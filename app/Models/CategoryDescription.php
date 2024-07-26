<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    use HasFactory;


    protected $connection= 'mysql';
    protected $table = "ecm_categories_description";
    protected $primaryKey = 'categories_description_id';
    protected $guarded = [
           'categories_description_id',
    ];

  
  

}
