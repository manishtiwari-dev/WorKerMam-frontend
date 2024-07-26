<table class="table  table_wrapper">
    <thead >
        <tr>
            <th>{{ __('common.sl_no') }}</th>
            <th>{{__('newsletter.contact_name')}}</th>
            <th>{{__('newsletter.contact_email')}}</th>
            <th>{{ __('contact.last_mail_sent') }}</th>
             <th>{{ __('contact.subs_status') }}</th>
             <th>{{ __('contact.approval_status') }}</th>
             <th>{{ __('contact.email_status') }}</th>
            <th class="text-center wd-10p">{{ __('common.action') }}</th>
        </tr>
    </thead>  
    <tbody> 
     
        @forelse($content->data_list as $key=>$contact)
          
            @if(!empty($contact))
            
            <tr>       
                <td>{{ $loop->iteration }}</td>
                <td>{{$contact->c_name ?? ''}}</td>
                <td>{{$contact->c_email ?? ''}}</td>
                    
                <td>
                    @if(!empty($contact->contactNewsData))
                      {{ date('d-M-Y', strtotime($contact->contactNewsData->newsletter_sent_date ?? '')) }}
                    @else
                        ---
                    @endif
                    </td>
                <td>
                    @if(!empty($contact->contactNewsData))
                        @if($contact->contactNewsData->subscription_status==0)
                        <span class="badge badge-pill text-bg-danger"> Not Subscribed</span>
                        @elseif($contact->contactNewsData->subscription_status==1) 
                        <span class="badge badge-pill text-bg-success"> Subscribed</span>
                        @else
                        <span class="badge badge-pill text-bg-warning"> Unsubscribed</span>
                        @endif
                    @else
                   ---
                    @endif
                </td>
                <td>
                    @if(!empty($contact->contactNewsData))
                        @if($contact->contactNewsData->approval_status==0)
                        <span class="badge badge-pill text-bg-danger">Pending</span>
                        @elseif($contact->contactNewsData->approval_status==1) 
                        <span class="badge badge-pill text-bg-success"> Approved</span>
                        @elseif($contact->contactNewsData->approval_status==2) 
                        <span class="badge badge-pill text-bg-info"> Stop</span>
                        @else
                        <span class="badge badge-pill text-bg-dark">Blocked</span>
                        @endif
                    @else
                    ---
                    @endif
                </td>
                <td>
                    @if(!empty($contact->contactNewsData))
                        @if($contact->contactNewsData->email_status==0)
                        <span class="badge badge-pill text-bg-primary">Junk</span>
                        @elseif($contact->contactNewsData->email_status==1) 
                        <span class="badge badge-pill text-bg-success"> Valid</span>
                        @elseif($contact->contactNewsData->email_status==2) 
                        <span class="badge badge-pill text-bg-dark">Invalid</span>
                        @else
                        <span class="badge badge-pill text-bg-warning">Bounce</span>
                        @endif
                    @else
                    ---
                    @endif
                </td>
                <td class="align-items-center justify-content-center d-flex gap-2">
                    <a href="{{route('marketing.contact-edit',$contact->c_id)}}" class="btn btn-sm  d-flex align-items-center px-0 mg-r-5" id="">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>

                    @if($content->source=="imported")
        
                    <a href="{{route('marketing.contact-edit',$contact->c_id)}}" class="btn btn-sm  d-flex align-items-center px-0 mg-r-5" id="">
                        <i data-feather="edit-2"></i>
                    </a>
                    <button class="btn btn-sm  d-flex align-items-center px-0" id="delete_btn" data-target="#delete_modal" data-bs-toggle="modal" value="{{$contact->c_id}}"><i data-feather="trash"></i></button>

                    @endif
                </td>
            </tr>
           @else
           <tr>
                <td colspan="7">
                    <h5 class="text-center my-2">{{__('common.no_record')}}</h5>
                </td> 
           </tr>
            @endif
        @empty
            <tr>
                <td colspan="7">
                    <h5 class="text-center my-2">{{__('common.no_record')}}</h5>
                </td> 
            </tr>
        @endforelse
    </tbody>
</table>

   <!--Pagination Start-->
   {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.contact-list',['source'=>$content->source,'start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
   <!--Pagination End-->