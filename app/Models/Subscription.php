<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubscriberBusiness;
use App\Models\SubscriptionHistory;
use App\Models\SubscriptionTransaction;
use App\Models\Industry;
use App\Models\Super\IndustryCategory;

class Subscription extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection= 'mysqlSuper';
    protected $table = 'sub_subscription';
    protected $primaryKey = 'subscription_id';
   
    protected $guarded = [
        'subscription_id',
    ];



    public function subscriber_business(){
        return $this->belongsTo(SubscriberBusiness::class, 'business_id', 'business_id');
    }

    public function subscription_history(){
        return $this->hasMany(SubscriptionHistory::class, 'subscription_id', 'subscription_id');
    }

    public function subscription_transaction(){
        return $this->hasMany(SubscriptionTransaction::class, 'subscription_id', 'subscription_id');
    }

    public function industry_details(){ 
        return $this->belongsTo(Industry::class, 'industry_id', 'industry_id');
    }

    public function industry_category_details(){ 
        return $this->belongsTo(IndustryCategory::class, 'industry_category_id', 'industry_category_id');
    }
    
}

