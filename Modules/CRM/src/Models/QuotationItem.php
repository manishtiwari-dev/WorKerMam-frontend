<?php
namespace Modules\CRM\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;
    protected $primaryKey = 'quotation_item_id';

    protected $table = 'crm_quotation_item';

    protected $fillable = [
        'quotation_item_id','quotation_id','item_id','item_name','quantity',
    'unit_price','discount','item_cost','attributes','status','created_by'
     ];

    // public function countries(){

    //     return $this->belongsTo(MasCountry::class, 'countries_id', 'countries_id');
    // }
    // public function currencies(){

    //     return $this->belongsTo(Currencies::class, 'currencies_id', 'currencies_id');
    // }
}
