<?php
namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $primaryKey = 'quotation_id';
    protected $connection= 'mysql';
    protected $table = 'crm_quotation';

    protected $fillable = [
    'quotation_id','quotation_no','customer_id','currencies_id',
    'currency','tax_name','tax_percent','sub_total','shipping_cost','total_tax',
    'total_discount', 'final_cost', 'note','convert_invoice','status','created_by'
    
    ];

    public function customer_details(){

        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // public function currencies_details(){

    //     return $this->hasOne(Currencies::class, 'currencies_id', 'currencies_id');
    // }

    public function QuotationItem()
    {
        return $this->hasOne(QuotationItem::class,'quotation_id','quotation_id');
        
    } 
}

