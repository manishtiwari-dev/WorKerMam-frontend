<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomForm extends Model
{
    use HasFactory;
    protected $primaryKey = 'form_id';

    protected $table = 'crm_form';
    protected $fillable = [
        'form_name', 'form_shortcode', 'form_type',  'status'
     ];

     public function customformfield()
    {
        return $this->hasOne(CustomFormField::class,'form_id','form_id');
        
    } 

    

}
