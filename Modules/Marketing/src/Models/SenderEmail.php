<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderEmail extends Model
{
    use HasFactory;

    protected $table = 'mkt_sender_email';

    protected $fillable = ['sender_email','sender_name','status'];
}
