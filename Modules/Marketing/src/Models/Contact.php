<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'mkt_contacts'; 

    protected $primaryKey = 'id';

     protected $fillable = [
       'contact_name','contact_email','company','website','country_code','phone','address','favourites','blocked','trashed','is_subscribed','is_unsubscribed'
    ];

    
}
