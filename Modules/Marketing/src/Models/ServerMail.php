<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerMail extends Model
{
    use HasFactory;

    protected $table = 'mkt_email_server';

    protected $fillable = [
        'name','provider_name','driver','host','port','username','password','encryption','from_name','from_email','sendmail','pretend','active'
    ];
}
