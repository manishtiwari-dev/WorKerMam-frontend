<table class="table  table_wrapper" id="template_list_data_reload">
    <thead>
        <tr>
            <th>{{ __('common.sl_no') }}</th>
            <th>{{ __('common.date') }}</th>
            <th>{{ __('newsletter.subject')}}</th>
            <th>{{ __('common.status') }}</th>
            <th class="text-center wd-10p">{{ __('common.action') }}</th>
        </tr>
    </thead>
    <tbody id="Search_Tr">
        @if (!empty($content->data))
            @foreach ($content->data as $key => $templategroup)
                <tr>  
                    <td>{{ $key + 1 }}</td>
                    <td>  {{ date('d-M-Y', strtotime($templategroup->created_at ?? '')) }}</td>
                    <td>{{ $templategroup->subject ?? '' }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input toggle-class" {{ $templategroup->status == '1' ? 'checked' : '' }} data-id="{{$templategroup->id}}" id="customSwitch{{$templategroup->id}}">
                        <label class="custom-control-label" for="customSwitch{{$templategroup->id}}"></label>
                        </div>
                    </td>
                    <td class="align-items-center justify-content-center d-flex gap-2">
                        <a href="{{ route('marketing.template-list.show', $templategroup->id) }}" target="_blank" class="btn btn-sm d-flex align-items-center  px-0 mg-r-5"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                        <a href="{{ route('marketing.template-list.edit', $templategroup->id) }}" class="btn btn-sm d-flex align-items-center px-0 mg-r-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        @endif

                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                        <button data-id="{{ $templategroup->id }}" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-sm d-flex align-items-center  px-0 del_button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="5">
                <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
            </td>
        </tr>
        @endif
    </tbody>
</table>

  <!--Pagination Start-->
  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.template-list.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
  <!--Pagination End-->