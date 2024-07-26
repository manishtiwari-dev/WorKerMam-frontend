<table class="table  table_wrapper">
    <thead>
        <tr>
            <th>{{__('common.sl_no')}}</th>
            <th>{{__('settings.link_name')}}</th>
            <th>{{__('settings.link_url')}}</th>
            <th>{{ __('seo.status') }}</th>
            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
            <th class="wd-10p text-center">
                {{__('common.action')}}
            </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if(sizeof($content->data)>0)
            @foreach($content->data as $key=>$webLinkdata)
                <tr>
                    <td>{{$key+1}}</td>
                    <td class="text-truncate">{{$webLinkdata->link_name ?? ''}}</td>
                    <td class="text-truncate">{{$webLinkdata->link_url ?? ''}}</td>
                
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                class="custom-control-input urlToggleBtn"
                                {{ $webLinkdata->status == '1' ? 'checked' : '' }}
                                data-id="{{ $webLinkdata->link_id }}"
                                id="customSwitch{{ $webLinkdata->link_id }}">
                            <label class="custom-control-label"
                                for="customSwitch{{ $webLinkdata->link_id }}"></label>
                        </div>
                    </td>

                    <td class="d-flex align-items-center gap-2 justify-content-center">

                        <a href="javascript:void(0)"
                        class="btn btn-sm  table_btn py-1 px-2 mg-r-5" id="viewBtn"
                        data-toggle="modal" data-id="{{$webLinkdata->link_id}}">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <span class="d-sm-inline mg-l-5"></span>
                        </a>

                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true') 
                        <a href="#edit_url"
                        class="btn btn-sm  table_btn py-1 px-2 editBtn"
                        data-toggle="modal" data-id="{{$webLinkdata->link_id}}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        <span
                        class="d-sm-inline mg-l-5"></span>
                        </a>
                        @endif

                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true') 
                        <a href="#url_delete_modal" data-toggle="modal"
                            data-id="{{$webLinkdata->link_id}}"
                            class="btn btn-sm  table_btn py-1 px-2 url_delete_btn">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline mg-l-5"></span>
                        </a>
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
    'seo.redirection',
    ['start_date'=>$content->start_date ?? '','end_date'=>$content->end_date ?? '']
) !!}
<!--Pagination End-->