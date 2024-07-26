<table class="table border table_wrapper" id="template_list_data_reload">
    <thead>
        <tr>
            <th>{{ __('common.sl_no') }}</th>
            <th>Source</th>
            <th>{{ __('newsletter.subject')}}</th>
            <th>{{ __('common.status') }}</th>
            <th class="text-center wd-10p">{{ __('common.action') }}</th>
        </tr>
    </thead>
    <tbody id="Search_Tr">
        @if (!empty($content->data))
            @foreach ($content->data as $key => $remindData)
                <tr>  
                    <td>{{ $key + 1 }}</td>
                    <td> {{ $remindData->source == '1' ? 'Subscription' : 'Payment/Invoice' }}</td>
                    <td>{{ $remindData->subject ?? '' }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input toggle-class" {{ $remindData->status == '1' ? 'checked' : '' }} data-id="{{$remindData->id}}" id="customSwitch{{$remindData->id}}">
                        <label class="custom-control-label" for="customSwitch{{$remindData->id}}"></label>
                        </div>
                    </td>
                    <td class="d-flex align-items-center">
                       
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                        <a href="{{ route('manage-landing.app-reminder.edit', $remindData->id) }}" class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>
                        @endif

                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                        <button data-id="{{ $remindData->id }}" data-toggle="modal" data-target="#delete_modal" class="btn btn-sm btn-white d-flex align-items-center mg-r-5 del_button"><i data-feather="trash"></i></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">
                <h5 class="text-center mb-0 py-1">No Record Found !</h5>
                </td>
            </tr>
        @endif
    </tbody>
</table>
  <!--Pagination Start-->
  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.template-list.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
  <!--Pagination End--> 