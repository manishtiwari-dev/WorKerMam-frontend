<?php
namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $primaryKey = 'address_id';

    protected $table = 'crm_customer_address';

    protected $fillable = ['address_id','customer_id','address_type','street_address','city','state','zipcode','countries_id','phone','is_default','status'];

    public function countries(){

        return $this->belongsTo(MasCountry::class, 'countries_id', 'countries_id');
    }
}
