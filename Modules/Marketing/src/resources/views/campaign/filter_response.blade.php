<table class="table  table_wrapper" id="table">
    <thead>
        <tr>
            <th class="">{{ __('common.sl_no') }}</th>
            <th class="text-center">Start Date</th>
            <th class="text-center">{{ __('campaign.campaign_name') }}</th>
            <th class="text-center">Source</th>
            <th class="text-center">No. Of Contacts</th>
            <th class="text-center">Sender Name</th>
            <th class="text-center">{{ __('common.status') }}</th>
            <th class="text-center">{{ __('common.action') }}</th>

        </tr>
    </thead>
    <tbody>
        <!-- Start -->
        @if (!empty($content->data))
            @foreach ($content->data as $key => $campaign)
   
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">
                        {{ date('d-M-Y', strtotime($campaign->start_date ?? '')) }}
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)"  data-bs-target="#modal_{{$campaign->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                             {{ $campaign->campaign_name }}
                        </a>
                    </td>
                    <td class="text-center">
                      @if($campaign->source==1)
                        <span class="badge badge-pill text-bg-primary">Customer</span>
                      @elseif($campaign->status==2)
                         <span class="badge badge-pill text-bg-primary">Lead</span>
                      @else
                        <span class="badge badge-pill text-bg-primary">Marketing Contact</span>
                      @endif
                    </td>
                    <td class="text-center">
                        @if(!empty($campaign->campaign_email))
                        {{count($campaign->campaign_email)}}
                        @endif
                    </td>
                
                    <td class="text-center">
                        <span class="badge text-bg-info"> {{$campaign->sender_name  ?? ''}}</span>
                    </td>


                    <td class="text-center">
                      @if($campaign->status==0)
                        <span class="badge badge-pill text-bg-danger">InActive</span>
                      @elseif($campaign->status==1)
                         <span class="badge badge-pill text-bg-success">Active</span>
                      @else
                        <span class="badge badge-pill text-bg-primary">Completed</span>
                      @endif

                    </td>
                    <td class="align-items-center justify-content-center d-flex gap-2">
                        <a href="{{ url('marketing/campaign/view/' . $campaign->id) }}"
                            class="btn btn-sm  d-flex align-items-center px-0 mg-r-5">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')

                            <a href="{{ url('marketing/campaign-edit/' . $campaign->id) }}"
                                id="editmodal" value="{{ $campaign->id }}"
                                class="btn btn-sm  d-flex align-items-center px-0">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                   <!-- Modals Start-->
                    <div class="modal fade" id="modal_{{$campaign->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$campaign->campaign_subject}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{$campaign->description}}
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div> 
                   <!-- Modals End-->
            @endforeach
        @else
            <tr>
                <td colspan="8">
                    <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                </td>
            </tr>
        @endif
    </tbody>
</table>

<!--Pagination Start-->
    {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.campaign.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
<!--Pagination End-->