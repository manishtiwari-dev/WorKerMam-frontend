 <table class="table  table_wrapper  px-3">
    <thead>
        <tr>
            <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no') }}</th>
            <th class="border-bottom" style="">{{ __('crm.date') }}
            </th>

            <th class="border-bottom" style="">{{ __('crm.source') }}
            </th>
            <th class="border-bottom" style="">{{ __('crm.source_id') }}
            </th>
            <th class="border-bottom" style="min-width: 150px;">{{ __('crm.contact_details') }}
            </th>
            <th class="border-bottom" style="min-width: 150px;">{{ __('crm.last_followup') }}
            </th>
            <th class="border-bottom" style="min-width: 100px;">
                {{ __('crm.next_followup') }}
            </th>
            <th class="border-bottom text-center">
                {{ __('crm.followup_status') }}
            </th>
            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                <th class="text-center border-bottom" style="min-width: 70px;">
                    {{ __('common.action') }}
                </th>
            @endif
        </tr>
    </thead>
    <tbody id="Search_Tr">
        @if (!empty($content->lead_list)) 
            @forelse ($content->lead_list as $key => $leads)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td> {{ \Carbon\Carbon::parse($leads->created_at)->format('d/m/Y') }}</td>
                    <td>
                        @if ($leads->source == 1)
                            General
                        @elseif($leads->source == 2)
                            Enquiry
                        @elseif($leads->source == 3)
                            Quotation
                        @else
                            Order
                        @endif
                    </td>
                    <td>
                        @if ($leads->source == 1)
                            -
                        @elseif($leads->source == 2)
                            @if (!empty($leads->enquiry))
                                {{ $leads->enquiry->enquiry_no }}
                            @endif
                        @elseif($leads->source == 3)
                            @if (!empty($leads->quotation))
                                {{ $leads->quotation->quotation_no }}
                            @endif
                        @elseif($leads->source == 4)
                            @if (!empty($leads->order))
                                {{ $leads->order->order_number }}
                            @endif
                        @endif
                    </td>
                    <td>
                        <h6 class="tx-semibold mg-b-0">{{ $leads->crm_lead->contact_name ?? '' }}</h6>
                        <span class="tx-color-03">{{ $leads->crm_lead->contact_email ?? '' }}</span><br />
                    </td>
                    <td>
                        {{ $leads->last_followup ?? '' }}
                    </td>
                    <td>
                        {{ $leads->next_followup ?? '' }}
                    </td>
                    <td>
                        {{-- {{ $leads->crm_lead_status->status_name ?? '' }} --}}
                        <span class="badge" style="background-color: {{ $leads->crm_lead_status->status_color ?? '' }} ;">{{ $leads->crm_lead_status->status_name ?? '' }}</span>
                    </td>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                        <td class="d-flex align-items-center gap-2 justify-content-center">
                            {{-- <a href="{{ route('crm.lead-followup.show', [$leads->lead_id]) }}"
                                class="btn btn-sm data-bs-toggle d-flex align-items-center mg-r-5"><i
                                    data-feather="eye"></i></a> --}}

                            <a href="{{ route('crm.lead-followup.show', [$leads->lead_id]) }}" class="btn btn-sm data-bs-toggle"><i class="fa fa-eye"  aria-hidden="true"></i></a>
                        </td>
                    @endif
                </tr>
            @empty
                <h1>No Record Found !</h1>
            @endforelse
        @endif
    </tbody>
</table>
<!--Pagination Start-->
  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'crm.lead-followup.index',['start_date' => $content->start_date, 'end_date' => $content->end_date,'search'=>$content->search,'source_name'=>$content->source_name,'followup'=>$content->followup,'tags'=>$content->tags,'crm_agent'=>$content->crm_agent]) !!}
  <!--Pagination End-->

