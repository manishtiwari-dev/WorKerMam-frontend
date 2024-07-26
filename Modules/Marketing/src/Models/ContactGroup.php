<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    use HasFactory;
    protected $table = 'mkt_contacts_groups'; 

    protected $primaryKey = 'id';

     protected $fillable = [
       'name','description','status'
    ];

    
}
