<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $table = 'mkt_campaigns'; 

     protected $fillable = [
       'campaign_name','description','campaign_subject','template_id','smtp_server_id','group_ids','status','id'
    ];

    public function template()
    {
        return $this->belongsTo(TemplateList::class,'template_id','id');
        
    } 
    public function SMTPServer()
    {
        return $this->belongsTo(ServerMail::class,'smtp_server_id','id');
        
    } 
    public function GroupList()
    {
        return $this->belongsTo(ContactGroup::class,'group_ids','id');
        
    } 
}
