<table id="example1" class="table  table_wrapper ">
    <thead>
        <tr>
            <th class="wd-10p">{{ __('common.sl_no') }}</th>
            <th class="wd-20p">{{ __('sender-list.sender_name') }}</th>
            <th class="wd-25p">{{ __('sender-list.sender_email') }}</th>
            <th class="wd-15p">{{ __('common.status') }}</th>
            <th class="wd-10p text-center">{{ __('common.action') }}</th>
        </tr>
    </thead>
    <tbody>

        @if (!empty($content->data))
            @foreach ($content->data as $key => $sender)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $sender->sender_name }}</td>
                    <td>{{ $sender->sender_email }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                class="custom-control-input senderToggleBtn"
                                {{ $sender->status == '1' ? 'checked' : '' }}
                                data-id="{{ $sender->id }}"
                                id="customSwitch{{ $sender->id }}">
                            <label class="custom-control-label"
                                for="customSwitch{{ $sender->id }}"></label>
                        </div>
                    </td>
                    <td class="align-items-center justify-content-center d-flex gap-2">
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                            <a href="#edit_sender"
                                class="btn btn-sm btn-white d-flex align-items-center px-0 mg-r-5 editBtn"
                                data-bs-toggle="modal" data-id="{{ $sender->id }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <span class="d-sm-inline mg-l-5"></span></a>
                        @endif
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                            <a href="#sender_delete_modal" data-bs-toggle="modal"
                                data-id="{{ $sender->id }}"
                                class="btn btn-sm btn-white d-flex px-0 align-items-center sender_delete_btn">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <span class="d-none d-sm-inline mg-l-5"></span></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                    </td>
                </tr>
           @endif
    </tbody>
</table>

<!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination(
    $content->total_records,
    $content->per_page,
    $content->current_page,
    $content->total_page,
    'marketing.sender-list.index',
    ['start_date'=>$content->start_date,'end_date'=>$content->end_date]
) !!}
<!--Pagination End-->