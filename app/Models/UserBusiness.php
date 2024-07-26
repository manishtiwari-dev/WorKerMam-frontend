<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBusiness extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'sub_subscription_to_user';
    protected $connection= 'mysqlSuper';
    protected $primaryKey = "subs_user_id";

     protected $guarded = [
        'subs_user_id',
    ];

    public function subscription(){
        return $this->belongsTo(Subscription::class, 'subscription_id', 'subscription_id');
    }




}
