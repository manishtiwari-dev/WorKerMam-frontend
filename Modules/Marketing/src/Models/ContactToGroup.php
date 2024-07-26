<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactToGroup extends Model
{
    use HasFactory;
    protected $table = 'mkt_contacts_to_groups'; 

    protected $primaryKey = 'id';

     protected $fillable = [
       'group_id','contact_id','status'
    ];
    public function GroupList()
    {
        return $this->belongsTo(ContactGroup::class,'group_id','id');
        
    } 
    public function ContactList()
    {
        return $this->belongsTo(Contact::class,'contact_id','id');
        
    } 
    
}
