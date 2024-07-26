<?php

namespace Modules\Pcapi\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PcProductAttribute extends Model
{
    use HasFactory;
    protected $connection= 'mysqlSuper';
    protected $table = 'ecm_pc_products_attributes';
    protected $primaryKey = 'products_attributes_id';
    protected $guarded = ['products_attributes_id'];
    public $timestamps = false;
}