<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    public $timestamps = false;
   
    protected $connection= 'mysqlSuper';
    protected $table = 'app_industry';
    protected $primaryKey = 'industry_id';

    protected $guarded = [
            'industry_id',
        ];

  

 
  
}
