<?php
namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSource extends Model
{
    use HasFactory;
    protected $table = 'crm_lead_source'; 

    protected $primaryKey = 'source_id';

     protected $fillable = [
       'source_id','source_name','status','created_by'
    ];

    public function leadsource(){

        return $this->hasOne(Lead::class,'source_id','source_id');
    }
}
