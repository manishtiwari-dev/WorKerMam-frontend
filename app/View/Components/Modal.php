<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Models\Country;
use App\Models\BussinessUser;
use Auth;
use Modules\SEO\Models\SeoResult; 
use Modules\SEO\Models\SeoTask; 

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $seoresult = SeoResult::where('parent_id',0)->get();

        if(!empty($seoresult)){
            $seoresult = $seoresult->map(function($result){
                $result->child = SeoResult::where('parent_id', $result->id)->get();
                return $result;
            });
        }

        $this->seoresult = $seoresult;
        $seotask = SeoTask::OrderBy('task_priority','asc')->get();
        

        return view('SEO::seo-settings.modals',compact('seoresult','seotask'));
    }
}
