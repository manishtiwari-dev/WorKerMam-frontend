<table class="table  table_wrapper">
    <thead>
        <tr>
            <th>{{ __('common.sl_no') }}</th>
            <th>{{ __('newsletter.group_name') }}</th>
            <th>{{ __('common.status') }}</th>
            <th class="text-center wd-10p">{{ __('common.action') }}</th>
        </tr>
    </thead>
    <tbody>
    
        @if (!empty($content->data_list))
            @foreach ($content->data_list as $key => $groupData)
                <tr>
                    <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>  
                    <td>{{ $groupData->group_name }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input toggle-class"
                                {{ $groupData->status == '1' ? 'checked' : '' }}
                                data-id="{{ $groupData->id }}"
                                id="customSwitch{{ $groupData->id }}">
                            <label class="custom-control-label"
                                for="customSwitch{{ $groupData->id }}"></label>
                        </div>
                    </td>
       
                    <td class="align-items-center justify-content-center d-flex gap-2">
                        <a href="{{ route('marketing.contact-group-view', $groupData->id) }}"
                            value="{{ $groupData->id }}"
                            class="btn btn-sm  d-flex align-items-center mg-r-5 px-0">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                            <button type="button" value="{{ $groupData->id }}"
                                class="btn btn-sm  d-flex align-items-center px-0 mg-r-5 px-0"
                                value="1" id="edit_btn" data-bs-toggle="modal"
                                data-target="#edit_groupData_modal">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        @endif

                        <button class="btn btn-sm  d-flex align-items-center px-0"
                            id="delete_btn" data-target="#delete_modal" data-bs-toggle="modal"
                            value="{{ $groupData->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></button>

                    </td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="8" class="text-center"><h5>{{__('common.no_record')}}</h5></td></tr>
        @endif
    </tbody>
</table>

<!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.contact-group',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
<!--Pagination End-->