 <table class="table  table_wrapper" id="lead_listing">
     <thead>
         <tr>
             <th>{{ __('common.sl_no') }}</th>
             <th>{{ __('date') }}</th>
             <th>{{ __('crm.client_details') }}</th>
             {{-- <th>{{ __('crm.tags') }}</th> --}}
             <th>{{ __('crm.followupStatus') }}</th>
             <th>{{ __('crm.group') }}</th>
             <th>{{ __('crm.source') }}</th>
             <th class="text-center wd-10p">{{ __('common.action') }}</th>
         </tr>
     </thead>
     <tbody id="Search_Tr">
         @if (!empty($content->crmleadlist))
             @forelse ($content->crmleadlist as $key => $crmlead)
                 <tr>
                     <td>{{ $content->current_page * $content->per_page + $key + 1 - $content->per_page }}</td>
                     <td>{{ \Carbon\Carbon::parse($crmlead->created_at)->format('Y-m-d') }}</td>
                     <td>
                         <h6 class="tx-semibold mg-b-0"><a
                                 href="{{ route('crm.lead-followup.show', [$crmlead->lead_id]) }}">{{ $crmlead->contact_name }}</a>
                         </h6>
                         @if(!empty($crmlead->phone))
                            <span class="tx-color-03">{{ $crmlead->phone ?? '' }}</span> <br />
                         @endif
                         @if(!empty($crmlead->contact_email))
                            <span class="tx-color-03">{{ $crmlead->contact_email ?? '' }}</span><br />
                         @endif

                        @if (!empty($crmlead->crm_lead_to_tag))
                         @foreach ($crmlead->crm_lead_to_tag as $key => $crmTag)
                             <span class="badge"
                                 style="background-color: {{ $crmTag->tags_color ?? '' }}">{{ $crmTag->tags_name ?? '-' }}</span>
                             @if ($key == 1)
                                 <br />
                             @endif
                         @endforeach
                       @endif

                     </td>
                     {{-- <td>
                        @if (!empty($crmlead->crm_lead_to_tag))
                            @foreach ($crmlead->crm_lead_to_tag as $key => $crmTag)
                                <span class="badge"
                                    style="background-color: {{ $crmTag->tags_color ?? '' }}">{{ $crmTag->tags_name ?? '' }}</span>  @if ($key == 1) <br/> @endif
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $crmlead->crm_lead_industry->group_name ?? '-' }}</td>
                    <td>{{ $crmlead->crm_lead_source->source_name ?? '-' }}</td> --}}

                     {{-- <td class="tagselect">
                         @php
                             $results = [];
                             
                             foreach ($crmlead->crm_lead_to_tag as $key => $crmTag) {
                                 $tagArr = $crmTag->tags_id;
                                 array_push($results, $tagArr);
                             }
                         @endphp


                         <select class="form-select form-control select2 lead_tags dropdown-class"
                                        data-leadtag="{{ $crmlead->lead_id }}" multiple="multiple"
                                        name="tags_select">
                             <option disable disabled>{{ __('crm.select_tag') }} </option>
                             @if (!empty($content->crmtags))
                                 @foreach ($content->crmtags as $value)
                                     @php
                                         $isValueInArray = in_array($value->tags_id, $results);
                                         if ($isValueInArray) {
                                             $select = 'selected';
                                         } else {
                                             $select = '';
                                         }
                                     @endphp
                                     <option value="{{ $value->tags_id }}" {{ $select }}>
                                         {{ $value->tags_name }}
                                     </option>
                                 @endforeach
                             @endif
                         </select>
                     </td> --}}

                     <td>
                        @if(!empty($crmlead->lead_followup))
                            @php
                            
                                $results = [];
                                $dataList = $crmlead->lead_followup;
                                    
                                usort($dataList, function ($a, $b) {
                                    return strtotime($b->last_followup) - strtotime($a->last_followup);
                                });
                                
                                $status = $dataList[0]->crm_lead_status->status_name ?? '-';
                                $status_color = $dataList[0]->crm_lead_status->status_color ?? '';
                                $date = $dataList[0]->last_followup ?? '';
                                
                            @endphp
                            <span class="badge"> {{$date}} </span> <br />
                            <span class="badge" style="background-color: {{$status_color}};"> {{$status}} </span>
                        @endif

                        {{-- <span class="badge" style="background-color: {{  $leads->crm_lead_status->status_color ?? '' }} ;">{{  $leads->crm_lead_status->status_name ?? '' }}</span>  --}}
                    </td>

                     <td>
                         <select class="form-control source_group dropdown-class select2" data-group="{{ $crmlead->lead_id }}"
                             name="group_name" id="group_name">
                             <option disabled selected value="">Select</option>
                             @if (!empty($content->crmindustrylist))
                                 @foreach ($content->crmindustrylist as $group)
                                     <option value="{{ $group->id }}"
                                         {{ $crmlead->industry_id == $group->id ? 'selected' : '' }}>
                                         {{ $group->group_name }}
                                     </option>
                                 @endforeach
                             @endif
                         </select>
                     </td>

                     

                     <td>

                         <select class="form-control source_data dropdown-class select2" name="source_data" id="source_data"
                             data-source="{{ $crmlead->lead_id }}">
                             <option disabled selected value="">Select</option>
                             @if (!empty($content->sourcelist))
                                 @foreach ($content->sourcelist as $source)
                                     <option value="{{ $source->source_id }}"
                                         {{ $crmlead->source_id == $source->source_id ? 'selected' : '' }}>
                                         {{ $source->source_name }}
                                     </option>
                                 @endforeach
                             @endif
                         </select>
                     </td>
                     <td class="align-items-center justify-content-center d-flex gap-2">

                         <a href="{{ route('crm.lead-followup.show', [$crmlead->lead_id]) }}"
                             class="btn btn-sm  px-0"><i class="fa fa-eye" aria-hidden="true"></i></a>

                         {{-- <a href="{{ route('crm.lead.edit', [$crmlead->lead_id]) }}" class="btn btn-sm btn-white"><i class="fa fa-pencil"  aria-hidden="true"></i></a> --}}

                         <a href="#UpdateLeadEdit" data-id="{{ $crmlead->lead_id }}" data-toggle="modal"
                             class="btn btn-sm  result_edit_btn px-0"><i class="fa fa-pencil"
                                 aria-hidden="true"></i> </a>
                     </td>
                 </tr>
             @empty
             @endforelse
            @else
             <tr><td colspan="8" class="text-center"><h5>{{__('common.no_record')}}</h5></td></tr>
         @endif
     </tbody>
 </table>
 {!! \App\Helper\Helper::make_pagination(
     $content->total_records,
     $content->per_page,
     $content->current_page,
     $content->total_page,
     'crm.lead.index',
     ['start_date' => $content->start_date, 'end_date' => $content->end_date,'search'=>$content->search,'source_name'=>$content->source_name,'tags'=>$content->tags,'crm_agent'=>$content->crm_agent],
 ) !!}
